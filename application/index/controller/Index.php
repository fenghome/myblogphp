<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return $this->fetch('index/index');
    }

    public function login()
    {
        return $this->fetch('index/login');
    }
}
