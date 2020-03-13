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
}