<?php
namespace app\index\controller;

use think\Controller;
use think\Session;
use app\index\model\User;

class Login extends Controller
{
    public function index()
    {

        $data['title'] = '登录';
        $data['user'] = null;
        $this->assign('data', $data);
        return $this->fetch();
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = User::get([
            'username' => $username,
        ]);
 
        if (count($user) == 0) {      
            return $this->error('用户名或密码错误');
        }

        if (md5($password) !== $user['password']) {
            // 密码错误
            $data['title'] = '登录';
            $data['user'] = null;
            $data['success'] = false;
            $data['msg'] = '用户名或密码错误';
            return $this->error('用户名或密码错误');
        } else {
            Session::set('user', $username);

            return $this->success('登录成功', '/');
        }
    }

    public function logout() {
        Session::clear();
        return $this->success('已注销', '/login');
    }
}
