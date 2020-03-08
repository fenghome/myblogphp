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

    $comments = Comment::where('comm_LogID','=',$article->log_ID)->order('comm_Path', 'desc')->select();
    $this->assign('comments',$comments);

    return $this->fetch('article/article');
  }

  public function showAddComment(Request $request){
    $comm_ParentID = $request->param('cid');
    $comm_LogID = $request->param('aid');
    $this->assign('comm_ParentID',$comm_ParentID);
    $this->assign('comm_LogID',$comm_LogID);
    return $this->fetch('article/add-comment');
  }

  public function addComment(Request $request){
    $data = $request->param();
    $data['comm_PostTime'] = time();
    $data['comm_IP'] = $request->ip();

    $comment = Comment::create($data,true);
    if(!$comment){
      $status = 0;
      $message = "发表评论失败";
      return ['status'=>$status,'message'=>$message];
    }


    if(array_key_exists('comm_ParentID',$data)){
      $fComment = Comment::get(['comm_ID'=>$data['comm_ParentID']]);
      
      $comm_Level = $fComment->comm_Level + 1;
      $pathArr = explode(",", $fComment->comm_Path);
      $pathArr[$comm_Level] = $comment->id;
      $comm_Path =  implode(",",$pathArr);   
    }else{
      $comm_Level = 0;
      $comm_Path = $comment->id.',a,a,a';    
    }

    $res = Comment::where('comm_ID','=',$comment->id)->update([
      'comm_Path'  => $comm_Path,
      'comm_Level' => $comm_Level,
    ]);

    if(!$res){
      Comment::where(['comm_ID'=>$comment->id])->delete();
      $status = 0;
      $message = "发表评论失败";
      return ['status'=>$status,'message'=>$message];
    }

    $status = 1;
    $message = "发表评论成功";
    return ['status'=>$status,'message'=>$message];
  }
}