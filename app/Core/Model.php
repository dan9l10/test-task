<?php


namespace App\Core;


abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        //$this->fill($attributes);
    }

    /**
     * @param $attributes
     * @return $this|null
     */
    protected function fill($attributes)
    {
        if(empty($attributes)){
            return null;
        }
        $fillable = get_object_vars($this);
        foreach ($fillable as $var=>$value){
            if(!empty($attributes[$var])){
                $this->$var = $attributes[$var];
            }
        }
        return $this;
    }

}