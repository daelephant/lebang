<?php 
namespace Admin\Controller;
use Think\Controller;
use Think\Auth;
class AuthController extends Controller {
    protected function _initialize() {
        $user = session('user');
        if (!$user) {
            $this->error('非法访问！正在跳转登录页面！',U('Login/login'));
        }
        if ($user['id'] == 1) {
            return true;
        }
        $auth = new Auth();
        if(!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME, $user['id'])){
            $this->error('没有权限');
        }
    }
}
