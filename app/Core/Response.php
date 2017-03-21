<?php

namespace App\Core;

use Exception;

class Response
{
    protected $view_base_path = '../views/';
    protected $extension = '.php';
    protected $data = null;
    protected $view = null;

    public function __construct($view, $data = null)
    {
        $this->view = $view;
        $this->data = $data ?: [];
    }

    protected function viewToPath($view)
    {
        return str_replace('.', '/', $view);
    }

    public function render()
    {
        $path = "{$this->view_base_path}".$this->viewToPath($this->view)."{$this->extension}";

        if (!file_exists($path)) {
            throw new Exception("{$this->view} not found.");
        }

        include($path);
    }
}