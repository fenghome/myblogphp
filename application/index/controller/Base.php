<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Session;

class Base extends Controller{
  protected $beforeActionList = [
    'checkislogin'=>['except'=>'checkLogin'],
    // 'second' =>  ['except'=>'hello'],
    // 'three'  =>  ['only'=>'hello,data'],
  ];

  protected function checkislogin(){
    if(!Session::has('user_info')){
      $this->error('没有登录', 'index/index/login');
    }
  }
}