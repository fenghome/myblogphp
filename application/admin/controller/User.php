<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Member;
use think\Request;


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
            $status = 1;
            $message = "登录成功";
        }

        return ['status'=>$status,'message'=>$message];
    }

    //显示用户管理页面
    public function showUsers(){
        return $this->fetch('user/admin-list');
    }
}