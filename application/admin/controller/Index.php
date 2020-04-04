<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Member;
use app\admin\model\Category;
use think\facade\Session;
use think\Request;

class Index extends Base{
    public function index(){
        return $this->fetch('index/index');
    }

    public function test(Request $request){
        dump($request->action());
    }
}