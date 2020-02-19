<?php
namespace app\admin\controller;
use app\admin\controller\Base;

class Article extends Base{
  public function showArticles(){
    return $this->fetch('article/article-list');
  }

  public function showArticleAdd(){
    return $this->fetch('article/article-add');
  }
}