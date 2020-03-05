<?php
namespace app\index\model;
use think\Model;

class Member extends Model{
  public function getMemLevelAttr($value)
  {
      $status = [1=>'管理员',2=>'网站编辑',3=>'作者',4=>'协作者',5=>'评论者',6=>'游客'];
      return $status[$value];
  }

  public function article(){
    return $this->hasMany('Article','log_AuthoID','mem_ID');
  }

  public function comment(){
    return $this->hasMany('Comment','comm_AuthorID','mem_ID');
  }
}