<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Article as AModel;
use app\index\model\Category;

class Article extends Controller{
  public function index(){
    $articles = AModel::all();
    $this->assign('articles',$articles);
    $categories = Category::all();
    $this->assign('categories',$categories);
    return $this->fetch('article/article');
  }
}