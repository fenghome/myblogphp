<?php
namespace app\admin\model;

use think\Model;

class Post extends Model{
  public function category(){
    return $this->belongsTo('Category','cate_ID');
  }

  public function user(){
    return $this->belongsTo('Member','cate_ID');
  }
}