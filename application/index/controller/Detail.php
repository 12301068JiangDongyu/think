<?php
namespace app\index\controller;

use think\Controller;
use think\Session;
use app\index\model\Note;

class Deatil extends Controller
{
    public function index($id)
    {
        if (!Session::has('user')) {
            return $this->error('请先登录', '/login');
        } 

        $user = Session::get('user');
        $data['title'] = '笔记详情';     
        $data['user'] = $user;
        $note = Note::get(['id'=>$id]);

        $data['note'] = $note;
        $this->assign('data', $data);
        return $this->fetch();
    }
}
