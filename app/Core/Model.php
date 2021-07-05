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

    protected function fill($attributes)
    {

        if(empty($attributes)){
            return null;
        }
        $fillable = get_class_vars(get_called_class());
        foreach ($fillable as $var=>$value){
            if(!empty($attributes[$var])){
                $this->$var = $attributes[$var];
            }
        }


        return $this;

    }


}