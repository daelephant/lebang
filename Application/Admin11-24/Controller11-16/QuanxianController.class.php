<?php

namespace Admin\Controller;
use Think\Controller;
use Org\Util\Page;


class QuanxianController extends AuthController
{

	public function listAction()
	{
		$m_user = M('Admin');
		$user = $m_user->where('qiyong = 1')->order('id desc')->select();
		$this->assign('user',$user);
		$this->display();
	}

	public  function list3Action()
	{

		$m_user = M('Admin');

		if(IS_POST){
				$m_user->qiyong = 1;
				$xin = $m_user->where('id = ' . I('post.xinid'))->save();
				$this->redirect( 'Quanxian/list3/p/' . I('post.p') );
			}

		$user = $m_user->where('qiyong = 0')->order('id desc')->select();

		// var_dump($user);exit;
		$this->assign('user',$user);
		$this->display();

	}



	public function addAction()
	{ 

		if(IS_POST){
			// echo '<pre>';
			// var_dump($_POST);exit;
			
			$m_user = M('Admin')->where('username="'.$_POST['username'].'"')->find();
			if(isset($m_user))
			{
				$this->error('用户已存在: ',U('list'),2);
			}

			if(empty($_POST['password']))
			{
				$this->error('密码不能为空',U('list'),2);
			}

			$m_access = M('auth_group_access');
			$m_user = M('Admin');
			$m_user->username = $_POST['username'];
			$m_user->realname = $_POST['realname'];
			$m_user->qiyong = $_POST['qiyong'];
			$m_user->password = md5($_POST['password']);
			$groups = explode('|',$_POST['groups']);
			$m_user ->groups = $groups[1];
			$uid = $m_user->add();

			$m_access->uid = $uid;
			$m_access->group_id = $groups[0];
			$m_access->add();
			$this->redirect('Quanxian/list');
		}else{
			$group = M('auth_group');
			$groups = $group->where("id != 1")->select();
			$this->assign('groups',$groups);
			$this->display();
			}
	}

	public function delAction($uid= 0)
	{
		$m_user = M('Admin');
		$m_access = M('auth_group_access');
		if(false === $m_user->delete($uid)){
			$this->error('删除失败',U('Quanxian/list'),2);
			exit;
		}
		if(false === $m_access->where('uid='.$uid)->delete()){
			$this->error('删除失败',U('Quanxian/list'),2);
			exit;
		}

		$this->redirect('Quanxian/list');

	}


	public function editAction($uid)
	{
		$m_user = M('Admin');
		$m_access = M('auth_group');

		if(!IS_POST){
			$mcc = M('auth_group_access')->where('uid='.$uid)->find();
			$msg = $m_user->find(I('get.uid'));
			$mgr = $m_access->where("id !=1")->select();

			$this->assign('mcc',$mcc);
			$this->assign('msg',$msg);
			$this->assign('mgr',$mgr);
			$this->display();
		}else{

			if(!empty($_POST['password']))
			{
				$m_user->password = md5($_POST['password']);
			}
			
			$m_user->realname = $_POST['realname'];
			$m_user->qiyong = $_POST['qiyong'];
			$groups = explode('|',$_POST['groups']);
			$m_user ->groups = $groups[1];
			$m_user->where('id='.$uid)->save();

			M('auth_group_access')->group_id = $groups[0];
			M('auth_group_access')->where('uid='.$uid)->save();
			$this->redirect('Quanxian/list');
		}
	}


	public function list1Action()
	{
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_use = M('auth_group');
		$use = $m_use->order('id desc')->page($page, $pagesize)->select();
		$this->assign('use', $use);
		$total = $m_use->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
		$this->display();

	}

	public function add1Action()
	{
		if(IS_POST){

			$m_auth = M('auth_group');

			$title = $m_auth->where('title="'.$_POST['title'].'"')->find();
			if(isset($title))
			{
				$this->error('用户已存在: ',U('Quanxian\list1'),2);
			}

			$m_auth->title = $_POST['title'];
			$m_auth->add();
			$this->redirect('Quanxian/list1');
		}
		$this->display();
	}

	public function edit1Action($uid)
	{
			$m_us= M('auth_group');
			if(!IS_POST){
				$us = $m_us->find(I('get.uid'));
				$this->assign('us',$us);
	
				$rule = M('auth_rule')->select();	// 读取无限分类
				$rule = tree($rule);
				$this->assign('rule',$rule);

				$rules = explode(',',$us['rules']);
				$this->assign('rules',$rules);

				$this->display();

			}else{
				$auth = $m_us;
				$auth = $auth->where('title="'.$_POST['title'].'"')->select();
				if(count($auth)>1){
					$this->error('已有用户组：', U('Quanxian/list1'), 2);
				}

				$rules = '';			// 获取权限id
				foreach ($_POST as $k => $v) {
					if(is_numeric($k)){
						$rules .= $k . ','; // 是数字id,保存
					}
				}
				$rules = trim($rules,',');  // 清除头尾逗号

				$m_us->title = $_POST['title'];
				$m_us->rules = $rules;
				$m_us->where('id='.$uid)->save();
				$this->redirect('Quanxian/list1');

			}

		
	}


		public function del1Action($uid=0)
	{
		$m_access = M('auth_group');

		if(false === $m_access->delete($uid)){

			$this->error('删除失败',U('list1'),2);
			exit;
		}
		$this->redirect('Quanxian/list1');
	}


	public function list2Action()
	{
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_use = M('auth_rule');

		$rule = $m_use->page($page, $pagesize)->select();
		$ru = $m_use->where('sid = 52')->select();
		//var_dump($ru);exit;
		$total = $m_use->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
		$this->assign('rule', $rule);
		$this->assign('ru',$ru);
		$this->display();
	}

	public function add2Action()
	{
		if (IS_POST)
		{
			$auth_rule = M('auth_rule');
			$auth = $auth_rule;
			$auth = $auth->where('name="'.$_POST['name'].'"')->find();
			if(isset($auth))
			{
				$this->error('已有权限：', U('Quanxian/list2'), 2);
			}
			
			$auth_rule->sid = $_POST['sid'];
			$auth_rule->name = $_POST['name'];
			$auth_rule->title = $_POST['title'];
	        $auth_rule->add();
	        $this->redirect('Quanxian/list2');
		}else{

			
			$this->display();
		}
 		
	}

	public function del2Action($uid=0)
	{
		$m_access = M('auth_rule');

		if(false === $m_access->delete($uid))
		{

			$this->error('删除失败',U('list2'),2);
			exit;
		}
		$this->redirect('Quanxian/list2');
	}


	public function edit2Action($uid=0)
	{
		$m_access = M('auth_rule');

			if(IS_POST){

				$m_access->name = $_POST['name'];
				$m_access->title = $_POST['title'];
				$m = $m_access->where('id='.I('post.id'))->save();
				$this->redirect('Quanxian/list2');

			}

		$access = $m_access->where('id='.$uid)->find();

		$this->assign('access',$access);
		$this->display();
	}

}


