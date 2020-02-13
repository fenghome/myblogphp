<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Member;

class Index extends Base{
    public function index(){
        return $this->fetch('index/index');
    }

    public function test(){
        $res = Member::get(['mem_ID'=>2]);
        dump($res);
        if($res){
            echo 'aaa';
        }else{
            echo 'bbb';
        }
    }
}