<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Category;
use app\admin\model\Member;
use app\admin\model\Post;
use think\Request;

class Article extends Base{
  public function showArticles(){
    return $this->fetch('article/article-list');
  }

  public function showArticleAdd(){
    $cates = Category::where('cate_ID','>','0')->order('cate_Path')->select();
    foreach($cates as $cate){
      $cate->cate_Name = str_repeat('|-------',($cate->cate_Level-1)).$cate->cate_Name;
    }
    $this->assign('cates',$cates);
    $auths = Member::all();
    $this->assign('auths',$auths);
    return $this->fetch('article/article-add');
  }

  public function addArticle(Request $request){
    $data = $request->param();
    $article = Post::create($data,true);
    if(!$article){
      $status = 0;
      $message = "新增文章失败";
      return ['status'=>$status,'message'=>$message];
    }

    $res = Category::where(['cate_ID'=>$data['log_CateID']])->inc('cate_Count')->update();
    if($res<=0){
      Post::where(['log_ID'=>$article->id])->delete();
      $status = 0;
      $message = "新增文章失败";
      return ['status'=>$status,'message'=>$message];
    }
    $status = 1;
    $message = "新增文章成功";
    
 

  }


}