<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Member;
use app\admin\model\Category;

class Index extends Base{
    public function index(){
        return $this->fetch('index/index');
    }

    public function test(){
        $str = "0,1|" ;
        print_r(count(explode('|',$str)));
        
    }
}