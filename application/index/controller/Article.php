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
    $data['comm_PostTime'] = strtotime('now');
    $data['comm_IP'] = $_SERVER['REMOTE_ADDR'];

    $comment = Comment::create($data,true);
    if(!$comment){
      $status = 0;
      $message = "发表评论失败";
      return ['status'=>$status,'message'=>$message];
    }
    
    if(array_key_exists('comm_ParentID',$data)){
      $fComment = Comment::get(['comm_ID'=>$data['comm_ParentID']]);
      $comm_Path = $fComment->comm_Path . ',' .  $comment->comm_ID;
      $comm_Level = $fComment->Level + 1;
    }else{
      $comm_Path = $comment->comm_ID;
      $comm_Level = 0;
    }

    $res = Comment::where('comm_ID','=',$comment->comm_ID)->update([
      'comm_Path'  => $comm_Path,
      'comm_Level' => $comm_Level,
    ]);

    if(!$res){
      Comment::where(['comm_ID'=>$comment->comm_ID])->delete();
      $status = 0;
      $message = "发表评论失败";
      return ['status'=>$status,'message'=>$message];
    }

    $status = 1;
    $message = "发表评论成功";
    return ['status'=>$status,'message'=>$message];
  }
}