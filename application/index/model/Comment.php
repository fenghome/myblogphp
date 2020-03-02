<?php
namespace app\index\model;
use think\Model;

class Comment extends Model{
  public function article(){
    return $this->hasOne('Article','comm_LogID');
  }
  public function author(){
    return $this->hasOne('Member','comm_AuthorID'); 
  }
  
}
