<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Article;
use app\index\model\Category;
use app\index\model\Comment;

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

    public function test(){
        $comms = Comment::where('comm_ID','>','0')->order('comm_Path', 'desc')->select();
        foreach($comms as $comm){
            dump($comm->comm_Path);
        }
    }
}
