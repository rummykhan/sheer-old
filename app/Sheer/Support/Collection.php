<?php

namespace App\Sheer\Support;

class Collection
{
    protected  $data = [];

    public function __construct($data)
    {
        $this->data = $this->normalize($data);
    }

    public function where($key, $operator, $value=null)
    {
        if( !$value ){
            $value = $operator;
            $operator = '=';
        }

        return $this->applyWhere($key, $operator, $value);
    }

    public function applyWhere($key, $operator, $value)
    {
        return new self([]);
    }

    protected function normalize($data)
    {
        if( is_array($data) ){
            return $data;
        }elseif ($this->isJson($data)){
            return json_decode($data, true);
        }

        throw new \Exception("Cannot create collection because data is invalid.");
    }

    function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}