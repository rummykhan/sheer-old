<?php

namespace App\Controllers;

use App\Repositories\PersonRepository;

class HomeController
{
    protected $repository = null;
    public function __construct(PersonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->repository->all();
    }
}