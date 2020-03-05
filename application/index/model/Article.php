<?php
namespace app\index\model;

use think\Model;

class Article extends Model{

  protected $type = [
    'log_PostTime'  =>  'timestamp',
  ];


  public function getLogStatusAttr($value)
  {
    
    $status = [0=>'公开',1=>'草稿',2=>'审核'];
    return $status[$value];
  }

  public function category(){
    return $this->belongsTo('Category','log_CateID','cate_ID');
  }

  public function author(){
    return $this->belongsTo('Member','log_AuthorID','mem_ID');
  }

  public function commonent(){
    return $this->hasMany('Comment','comm_LogID','log_ID');
  }

}