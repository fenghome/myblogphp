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
        $res = Member::create(['mem_Name'=>'sdfsdf','mem_Password'=>'zzzz']);
        $aa = Member::where(['mem_ID'=>$res->id])->delete();
        return $aa;
    }
}