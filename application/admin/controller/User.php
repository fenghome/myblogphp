<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Member;
use think\Request;
use think\facade\Session;


class User extends Base
{
    //检测用户登录
    public function checkLogin(Request $request)
    {
        $data = $request->param();
        $user_info = Member::get(['mem_Name'=>$data['mem_Name'],'mem_Password'=>$data['mem_Password']]);
        if(is_null($user_info)){
            $status = 0;
            $message = "用户名或密码错误";
        }else{
            Session::set('user_info',$user_info->getData());
            $status = 1;
            $message = "登录成功";
        }

        return ['status'=>$status,'message'=>$message];
    }

    //显示用户管理页面
    public function showUsers(){
        $users = Member::all();
        $this->assign('users',$users);
        return $this->fetch('user/admin-list');
    }

    //显示增加用户页面
    public function showUserAdd(){
        return $this->fetch('user/admin-add');
    }

    //添加用户
    public function addUser(Request $request){
        $data = $request->param();
        $data['mem_Password'] = md5($data['mem_Password']);
        $res = Member::create($data,true);
        if($res){
            $status = 1;
            $message = "用户新增成功";
        }else{
            $status = 0;
            $message = "用户新增失败";
        }

        return ['status'=>$status,'message'=>$message];
    }

    //显示编辑用户页面
    public function showUserEdit(Request $request){
        $id = $request->param('id');
        $user = Member::get(['mem_ID'=>$id]);
        $this->assign('user',$user);
        return $this->fetch('user/admin-edit');
    }

    //更新用户
    public function editUser(Request $request){
        $data = $request->param();
        //查找用户名是否存在
        $res = Member::where([
            ['mem_Name','=',$data['mem_Name']],
            ['mem_ID','<>',$data['mem_ID']]
        ])->find();
        
        if($res){
            $status = 0;
            $message = "用户名已存在";
            return ['status'=>$status,'message'=>$message];
        }  

        $user = Member::get(['mem_ID'=>$data['mem_ID']]);
        if($data['mem_Password'] === ""){
            $data['mem_Password'] = $user->mem_Password;
        }else{
            $data['mem_Password'] = md5($data['mem_Password']);
        }
        $res = $user->allowField(true)->save($data);
        if(!$res){
            $status = 0;
            $message = "更新失败";
            return ['status'=>$status,'message'=>$message];
        }

        $status = 1;
        $message = "更新成功";
        return ['status'=>$status,'message'=>$message];       
    }
}