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
        $categories = Category::where('cate_ID','>','0')->order(['cate_Path','cate_Order'])->select();
        foreach($categories as $cate){
          $cate->cate_Name = str_repeat('|---',($cate->cate_Level-1)).$cate->cate_Name;
        }

        foreach($categories as $cate){
            dump($cate->cate_Name);
        }
    }
}