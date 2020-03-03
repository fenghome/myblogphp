<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Article as AModel;
use app\index\model\Category as CModel;
use app\index\model\Comment;
use think\Request;

class Category extends Controller{
  public function index(Request $request){
    $cate_ID = $request->param('cate_ID');
    $articles = AModel::where('log_CateID','=',$cate_ID)->select();
    $this->assign('articles',$articles);
    $categories = CModel::all();
    $this->assign('categories',$categories);
    return $this->fetch('category/category');
  }
}