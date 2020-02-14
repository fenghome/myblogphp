<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Category as CModel;
use think\Request;

class Category extends Base{

  //显示分类列表页面
  public function showCategories(){
    $categories = CModel::where('cate_ID','>','0')->order(['cate_Path','cate_Order'])->select();
    foreach($categories as $cate){
      $cate->cate_Name = str_repeat('|---',($cate->cate_Level-1)).$cate->cate_Name;
    }
    $this->assign('categories',$categories);
    return $this->fetch('category/category-list');
  }

  //显示新增分类页面
  public function showCategoryAdd(Request $request){
    return $this->fetch('category/category-add');
  }
}