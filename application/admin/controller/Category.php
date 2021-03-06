<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Category as CModel;
use think\Request;

class Category extends Base{

  //显示分类列表页面
  public function showCategories(){
    $categories = CModel::where('cate_ID','>','0')->order(['cate_Path','cate_Order'])->select();
    foreach($categories as $cate){
      $cate->cate_Name = str_repeat('|-------',($cate->cate_Level-1)).$cate->cate_Name;
    }
    $this->assign('categories',$categories);
    return $this->fetch('category/category-list');
  }

  //显示新增分类页面
  public function showCategoryAdd(Request $request){
    $categories = CModel::where('cate_ID','>','0')->order(['cate_Path','cate_Order'])->select();
    foreach($categories as $cate){
      $cate->cate_Name = str_repeat('|-------',($cate->cate_Level-1)).$cate->cate_Name;
    }
    $this->assign('categories',$categories);
    return $this->fetch('category/category-add');
  }

  //新增分类
  public function addCategory(Request $request){
    $data = $request->param();
    
    //检查分类是否存在
    $res = CModel::get(['cate_Name'=>$data['cate_Name'],'cate_Pid'=>$data['cate_Pid']]);
    if($res){
      $status = 0;
      $message = "分类名已存在";
      return ['status'=>$status,'message'=>$message];
    }

    $newId = count(CModel::all())+1;
  
    //计算cate_Path,cate_Level
    if($data['cate_Pid'] == 0){
      $data['cate_Path'] = $data['cate_Order'].','.$newId.'|';
      $data['cate_Level'] = 1;
    }else{
      $PCategory = CModel::get(['cate_ID'=>$data['cate_Pid']]);
      $data['cate_Path'] = $PCategory->cate_Path.$data['cate_Order'].','.$newId.'|';
      $data['cate_Level'] = $PCategory->cate_Level + 1;
    }

    //插入数据
    $res = CModel::create($data,true);
    if(!$res){
      $status = 0;
      $message = "新增分类失败";
      return ['status'=>$status,'message'=>$message];
    }

    $status = 1;
    $message = "新增分类成功";
    return ['status'=>$status,'message'=>$message];
  }

  //显示编辑分类页面
  public function showCategoryEdit(Request $request){
    $id = $request->param('id');
    $path = CModel::get(['cate_ID'=>$id])->cate_Path;
    $categories = CModel::where('cate_Path','not like',$path.'%')->order(['cate_Path','cate_Order'])->select();
    foreach($categories as $cate){
      $cate->cate_Name = str_repeat('|-------',($cate->cate_Level-1)).$cate->cate_Name;
    }
    $this->assign('categories',$categories);
    $category = CModel::get(['cate_ID'=>$id]);
    $this->assign('category',$category);
    return $this->fetch('category/category-edit');
  }

  //编辑分类
  public function editCategory(Request $request){
    $data = $request->param();
    $res = CModel::where([
      ['cate_Name','=',$data['cate_Name']],
      ['cate_ID','<>',$data['cate_ID']],
      ['cate_Pid','=',$data['cate_Pid']],
    ])->find();
    if($res){
      $status = 0;
      $message = "分类名存在";
      return ['status'=>$status,'message'=>$message];
    }

    //更新该分类的所有子分类的path和level
    $oldCate = CModel::get(['cate_ID'=>$data['cate_ID']]);
    $oldPath = $oldCate->cate_Path;
    $fatherPath = "";
    if($data['cate_Pid'] != 0){
      $fatherPath = CModel::get(['cate_ID'=>$data['cate_Pid']])->cate_Path;
    }
    $newPath = $fatherPath.$data['cate_Order'].','.$data['cate_ID'].'|';

    $res = CModel::where('cate_Path','like',$oldPath.'%')->select();
   
    foreach($res as $cate){
      $tempPath = str_replace($oldPath,$newPath,$cate->cate_Path);
      $tempLevel = count(explode('|',$tempPath))-1;
      CModel::where(['cate_ID'=>$cate->cate_ID])->update(['cate_Path'=>$tempPath,'cate_Level'=>$tempLevel]);
    }
    //更新该分类信息
    $res1 = CModel::where(['cate_ID'=>$data['cate_ID']])->update($data);
    
    if($res1<=0){
      $status = 0;
      $message = "更新失败";
      return ['status'=>$status,'message'=>$message];
    }

    $status = 1;
    $message = "更新成功";
    return ['status'=>$status,'message'=>$message];
  }

  //删除分类
  public function deleteCategory(Request $request){
    $id = $request->param('id');

    $findChildCate = CModel::get(['cate_Pid'=>$id]);
    if($findChildCate){
      $status = 0;
      $message = "存在子分类，不能删除";
      return ['status'=>$status,'message'=>$message];
    }

    $cate = CModel::get(['cate_ID'=>$id]);
    if($cate->cate_Count>0){
      $status = 0;
      $message = "该分类下有文章，不能删除";
      return ['status'=>$status,'message'=>$message];
    }

    $res = $cate->delete();
    if(!$res){
      $status = 0;
      $message = "删除失败";
      return ['status'=>$status,'message'=>$message];
    }

    $status = 1;
    $message = "删除成功";
    return ['status'=>$status,'message'=>$message];
  }
}