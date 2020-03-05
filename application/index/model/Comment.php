<?php
namespace app\index\model;
use think\Model;

class Comment extends Model{
  public function article(){
    return $this->belongsTo('Article','comm_LogID','log_ID');
  }
  public function author(){
    return $this->belongsTo('Member','comm_AuthorID','mem_ID'); 
  }
  
}
