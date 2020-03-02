<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Article;
use app\index\model\Category;

class Index extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $this->assign('articles',$articles);
        $categories = Category::all();
        $this->assign('categories',$categories);
        return $this->fetch('index/index');
    }

    public function login()
    {
        return $this->fetch('index/login');
    }
}
