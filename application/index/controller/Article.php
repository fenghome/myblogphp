<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Article as AModel;
use app\index\model\Category;
use think\Request;

class Article extends Controller{
  public function index(Request $request){
    $id = $request->param('id');
    $article = AModel::get(['log_ID'=>$id]);
    $this->assign('article',$article);
    $categories = Category::all();
    $this->assign('categories',$categories);
    return $this->fetch('article/article');
  }
}