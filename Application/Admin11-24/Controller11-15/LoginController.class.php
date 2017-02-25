<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller{

public function LoginAction(){
	if(IS_POST){
		$uAdmin = M('Admin');
		$username = $_POST['username'];
		$lebang = $uAdmin->where('username="'.$username.'"')->find();
		if($lebang['qiyong'] == 0){
			$this->error('您已禁用！');
		}
		if($lebang['password'] == md5($_POST['password']))
		{
			session('user',$lebang);
			// session('auth', $lebang);
			// session('userid',$lebang['id']);
			// var_dump($_SESSION);
			// var_dump(session('userid'));exit;
			session('username',$lebang['username']);
			$this->redirect('/');
		}else{
			$this->error('用户名或密码错误！');
		}

	}	
		
		$this->display();
	}

	  /*
     * 退出登录
     */
    public function logoutAction()
    {
        session('[destroy]');
        //$this->success('退出成功！', U('Login/login'));
        $this->redirect('Login/login');
    }

	
}