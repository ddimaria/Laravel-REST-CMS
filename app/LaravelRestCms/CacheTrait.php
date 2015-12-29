<?php namespace App\LaravelRestCms;

trait CacheTrait {

    /**
     * The key to use to cache this model
     * @var string
     */
    public static $cacheKeyPart = 'id';
    
    /**
     * The
     * @var [type]
     */
    public static $cacheTime; 
        
    
    /**
     * Tie caching features into the Eloquent::boot() method
     */
    public static function boot()
    {
        parent::boot();
        
        self::$cacheTime = \Config::get('laravel-rest-cms.cacheTime');
        
        static::saved(function($model)
        {
            $model::cache($model, $model->{$model::$cacheKeyPart}, $model::getModelCache($model));

            return true;
        });
        
        static::deleting(function($model)
        {
           \Cache::forget($model::getCacheKey());
            
            return true;
        });
    }   

    /**
     * Retrieves the model
     * Override this function to create a custom cache with eager loading
     * 
     * @param  string $model The name of the model
     * @return string
     */
    public static function getModelCache($model)
    {
        return $model;
    }       
    
    /**
     * Caches a model
     * 
     * @param  string                       $model      The name of the model
     * @param  string                       $keyPart    The key to use to cache the model (e.g. primary key)
     * @param  App\LaravelRestCms\BaseModel $data       The model instance
     * @return string
     */
    public static function cache($model, $keyPart, $data)
    {
        $key = $model::getCacheKey($keyPart);
        \Cache::forget($key);
        \Cache::put($key, $data, static::$cacheTime);
        
        return $model;
    }
    
    public static function getCacheKey($keyPart = null)
    {
        if (is_null($keyPart)) {
            $keyPart = static::$cacheKeyPart;
        }

        return with(new static)->getTable() . '.' . $keyPart;
    }
}