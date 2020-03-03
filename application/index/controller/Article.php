<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\Article as AModel;
use app\index\model\Category;
use app\index\model\Comment;
use think\Request;

class Article extends Controller{
  public function index(Request $request){
    $id = $request->param('id');

    $article = AModel::get(['log_ID'=>$id]);
    $this->assign('article',$article);

    $categories = Category::all();
    $this->assign('categories',$categories);

    $comments = Comment::where('comm_LogID','=',$article->log_ID)->select();
    $this->assign('comments',$comments);

    return $this->fetch('article/article');
  }

  public function addComment(Request $request){
    $data = $request->param();
    $res = Comment::create($data,true);
    if(!$res){
      $status = 0;
      $message = "发表评论失败";
      return ['status'=>$status,'message'=>$message];
    }
    $status = 1;
    $message = "发表评论成功";
    return ['status'=>$status,'message'=>$message];
  }
}