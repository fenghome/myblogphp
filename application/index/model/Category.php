<?php
namespace app\index\model;
use think\Model;

class Category extends Model{
  public function article(){
    return $this->hasMany('Article','log_CateID','cate_ID');
  }
}
