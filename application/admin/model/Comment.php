<?php
namespace app\admin\model;
use think\Model;

class Comment extends Model{

  public function getCommPostTimeAttr($value)
  {
      return date('Y-m-d H:i:s',$value);
  }

  public function article(){
    return $this->belongsTo('Article','comm_LogID','log_ID');
  }
  public function author(){
    return $this->belongsTo('Member','comm_AuthorID','mem_ID'); 
  }
  
}
