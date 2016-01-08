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
    public static $cacheTime = '3600'; 
        
    
    /**
     * Tie caching features into the Eloquent::boot() method
     */
    public static function bootCacheTrait()
    {
        static::$cacheTime = \Config::get('laravel-rest-cms.cacheTime');
        static::savedEvent();
        static::deletingEvent();        
    }

    protected static function savedEvent()
    {
        static::saved(function($model)
        {
            $model::cache($model, $model->{$model::$cacheKeyPart}, $model::getModelCache($model));

            return true;
        });
    }

    protected static function deletingEvent()
    {
        static::deleting(function($model)
        {
           \Cache::forget($model::getCacheKey($model));
            
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
     * @param  string   $model      The name of the model
     * @param  string   $keyPart    The key to use to cache the model (e.g. primary key)
     * @param  App\LaravelRestCms\BaseModel $data   The model instance
     * @return string
     */
    public static function cache($model, $keyPart, $data)
    {
        $key = static::getCacheKey($model, $keyPart);
        \Cache::forget($key);
        \Cache::put($key, $data, static::$cacheTime);
        
        return $model;
    }       
    
    /**
     * Caches a model
     * 
     * @param  string   $model      The name of the model
     * @param  string   $keyPart    The key to use to cache the model (e.g. primary key)
     * @return string
     */
    public static function getCache($model, $keyPart)
    {
        $key = static::getCacheKey($model, $keyPart);
        
        return \Cache::get($key);
    }
    
    /**
     * Gets the cache key for a model
     * 
     * @param  string   $model      The name of the model
     * @param  string   $keyPart    The key to use to cache the model (e.g. primary key)
     * @return string
     */
    public static function getCacheKey($model, $keyPart = null)
    {
        if (is_null($keyPart)) {
            $keyPart = static::$cacheKeyPart;
        }
        
        return with(new $model)->getTable() . '.' . $keyPart;
    }
}