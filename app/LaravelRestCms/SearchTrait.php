<?php namespace App\LaravelRestCms;

trait SearchTrait {

    public static $labelCol = [];
    public static $searchCols = [];

    /**
     * Adds search methods to the model
     *         
     * @param string $keyword
     * @param string $labelCol
     * @return \BaseModel
     */
    public function addSearch($keyword = null, $labelCol = null)
    {
        $searchCols = self::getSearchCols(null, $labelCol);
        $keyword = strtolower($keyword);
        
        if ($searchCols && !is_null($keyword) && trim($keyword) != '') {
            $that = self::orWhere(function($query) use ($searchCols, $keyword)
            {
                foreach ($searchCols as $key=>$val) {
                    $query->orWhere($val, 'like', "%{$keyword}%");
                }
            });
            
            return $that;
        } else {
            return $this;
        }
    }
    
    /**
     * Retrieves the columns to search
     * 
     * @param  string $override
     * @param  string $default
     * @return array
     */
    public function getSearchCols($override = null, $default = null)
    {
        if (!is_null($override)) {
            $searchCols = $override;
        } else if (!is_null(static::$searchCols)) {
            $searchCols = static::$searchCols;
        } else if (!is_null(static::$labelCol)) {
            $searchCols = static::$labelCol;
        } else if (!is_null($default)) {
            $searchCols = $default;
        } else {
            return false;
        }
        
        return (array) $searchCols;
    }
    
    /**
     * Eloquent scope of the search
     * 
     * @param  Illuminate/Database/Eloquent/Builder $query
     * @param  string $keyword
     * @return Illuminate/Database/Eloquent/Builder
     */
    public function scopeSearch($query, $keyword = null) 
    {        
        $searchCols = $this->getSearchCols(null, static::$labelCol);
        $select = array_merge([static::$labelCol], ['url']);
        //$query->select('*', implode(' ', static::$labelCol) .  ' as label', \DB::raw('concat("' . static::$urlPrepend . '",url) as url'));
        $query->select('*', implode(' ', static::$labelCol) .  ' as label', 'url');
        $match = '';

        // make search results use the "and" clause
        //$keyword[0] = '+' . implode(' +', explode(' ', $keyword[0]));
        $keyword[0] = '"' . $keyword[0] . '"';

        foreach ($searchCols as $searchCol) {
            $match = "MATCH(" . $searchCol . ") AGAINST (? IN BOOLEAN MODE)";
            //$query = $query->orWhereRaw($match, $keyword);
            $query = $query->whereRaw($match, $keyword);
        }
               
        return $query->orderByRaw($match . ' desc', $keyword);  
    }
}