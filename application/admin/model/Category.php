<?php
namespace app\admin\model;
use think\Model;

class Category extends Model{
  public function article(){
    return $this->hasMany('Post','cate_ID');
  }
}
