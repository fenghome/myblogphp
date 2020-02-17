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
    $categories = CModel::where('cate_ID','>','0')->order(['cate_Path','cate_Order'])->select();
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

    //path构成:序号,自ID|
    //修改自己的Path
    $oldCate = CModel::get(['cate_ID'=>$data['cate_ID']]);
    $oldPath = $oldCate->cate_Path;
    $oldLevel = $oldCate->cate_Level;
    $oldPathSlice = substr($oldPath,$oldLevel*4-4,4);
    $newPathSlice = replaceIndex($data['cate_Order'],$oldPath,0);

    $cates = CModel::where('cate_Path','like','%'.$oldPathSlice.'%')->select();

    foreach($cates as $cate){
      $newPath = str_replace($oldPathSlice,$newPathSlice,$cate->cate_Path);
      CModel::where('cate_Id','=',$cate->cate_ID)->update(['cate_Path'=>$newPath]);
    }
    
    return $cates->toArray();

    // if($data['cate_Pid']== 0){      
    //   $oldPathArr[0] = $data['cate_Order'].$data['cate_ID'].'|';
    //   $data['cate_Path'] = implode('',$oldPathArr); 
    // }else{
    //   $res1 = CModal::all(['cate_Pid'=>$data['cate_']])
    // }

    
    // $res1 = CModel::get(['cate_ID'=>$data['cate_ID']])
    //         ->allowField(true)
    //         ->save($data);
    
    // if(!$res1){
    //   $status = 

    //   $message = "编辑分类失败";
    //   return ['status'=>$status,'message'=>$message];
    // }

    // $status = 1;
    // $message = "编辑分类成功";
    // return ['status'=>$status,'message'=>$message];
  }
}