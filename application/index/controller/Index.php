<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Article;
use app\index\model\Category;
use app\index\model\Comment;
use think\facade\Session;

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
        if(Session::has('user_info')){
            $this->error('用户已登录','admin/index/index');
        }else{
            return $this->fetch('index/login');
        }
        
    }

    public function test(){
        $comms = Comment::where('comm_ID','>','0')->order('comm_Path', 'desc')->select();
        foreach($comms as $comm){
            dump($comm->comm_Path);
        }
    }
}
