<?php
namespace app\admin\controller;
use think\Controller;
use think\facade\Session;

class Base extends Controller{
  protected $beforeActionList = [

    'checkislogin'=>['except'=>'checkLogin'],
    'ispromise',
    // 'second' =>  ['except'=>'hello'],
    // 'three'  =>  ['only'=>'hello,data'],
  ];



  protected function checkislogin(){
    if(!Session::has('user_info')){
      $this->error('没有登录', 'index/index/login');
    }
  }

  protected function ispromise(){
    if(Session::has('user_info')){
      $level = Session::get('user_info')["mem_Level"];
      $action = $this->request->action();
      if(!checkPromise($level,$action)){
        $this->error('无此操作权限', 'admin/index/index');
      }
    }

  }
}