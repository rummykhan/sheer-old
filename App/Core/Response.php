<?php

namespace App\Core;

class Response
{
    protected $view_base_path = '';
    protected $data = null;
    protected $view = null;

    public function __construct($view, $data)
    {
        $this->view = str_replace('.','/',$view);
        $this->data = $data;
    }

    public function render()
    {
        include("../views/{$this->view}.php");
    }
}