<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Category;
use app\admin\model\Member;
use app\admin\model\Article as AModel;
use app\admin\model\Comment as CommentModel;
use think\Request;

class Comment extends Base{
  public function showComments(Request $request){
    $comments = CommentModel::all();
    $this->assign('comments',$comments);
    return $this->fetch('comment/comment-list');
  }

  public function agreeComment(Request $request){
    $data = $request->param();
    $updateList = [];
    foreach($data['comment_IDs'] as $key=>$value){
      $v = ['comm_ID'=>$key,'comm_IsChecking'=>1];
      array_push($updateList,$v);
    }
  
    $comments = new CommentModel;
    $res = $comments->saveAll($updateList);

    if(!$res){
      $status = 0;
      $message = "批量审核失败";
      return ['status'=>$status,'message'=>$message];
    }

    $status = 1;
    $message = "批量审核成功";
    return ['status'=>$status,'message'=>$message];
  }

  public function noComment(Request $request){
    $data = $request->param();
    $updateList = [];
    foreach($data['comment_IDs'] as $key=>$value){
      $v = ['comm_ID'=>$key,'comm_IsChecking'=>0];
      array_push($updateList,$v);
    }

    $comments = new CommentModel;
    $res = $comments->saveAll($updateList);
    if(!$res){
      $status = 0;
      $message = "批量审核不通过失败";
      return ['status'=>$status,'message'=>$message];
    }

    $status = 1;
    $message = "批量审核不通过成功";
    return ['status'=>$status,'message'=>$message];
  }


  public function stopComment(Request $request){
    $id = $request->param('id');
    $res = CommentModel::where('comm_ID','=',$id)->update(['comm_IsChecking'=>0]);
    if(!$res){
      $message = '审核不通过失败';
      $status = 0;
      return ['status'=>$status,'message'=>$message];
    }
    $message = '审核不通过成功';
    $status = 1;
    return ['status'=>$status,'message'=>$message];
  }

  public function startComment(Request $request){
    $id = $request->param('id');
    $res = CommentModel::where('comm_ID','=',$id)->update(['comm_IsChecking'=>1]);
    if(!$res){
      $message = '审核通过失败';
      $status = 0;
      return ['status'=>$status,'message'=>$message];
    }
    $message = '审核通过成功';
    $status = 1;
    return ['status'=>$status,'message'=>$message];
  }

  public function deleteComment(Request $request){
    $id = $request->param('id');
    $comment = CommentModel::get(['comm_ID'=>$id]);
    $path = $comment->comm_Path;
    $pathArr = explode(",",$path);
    $findArr = array_slice($pathArr,0,$comment->comm_Level+1);
    $find = implode(",",$findArr);
    $res = CommentModel::where('comm_Path','like',$find.'%')->delete();
    if(!$res){
      $status = 0;
      $message = "删除失败";
      return ['status'=>$status,'message'=>$message];
    }
    $status = 1;
    $message = "删除成功";
    return ['status'=>$status,'message'=>$message];
  }
}