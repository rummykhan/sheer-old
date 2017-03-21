<?php


use App\Core\Router;

Router::get('/', 'HomeController@index');
Router::get('/test', 'HomeController@test');