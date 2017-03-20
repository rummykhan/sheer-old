<?php

namespace App\Core;

class Request
{
    protected $root = null;
    protected $method = null;
    protected $path = null;

    public function __construct()
    {
        $this->init($_SERVER);
    }

    protected function init(array $request)
    {
        $this->root = $request['DOCUMENT_ROOT'];
        $this->method = $request['REQUEST_METHOD'];
        $this->path = $request['REQUEST_URI'];
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function getRequestMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }
}