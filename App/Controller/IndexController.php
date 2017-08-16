<?php

namespace App\Controller;

class IndexController extends \App\Controller\BaseController
{
    public function index()
    {
        return $this->jsonSuccess('Hello world!');
    }

    public function test()
    {
        return $this->jsonSuccess('Key validated!');
    }
}
