<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class UserController extends Controller
{
	/**
	 * 展示user列表
	 */
	public function listAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$user_list = $m_user
			->field('id,name,phone,idnumber,status,status,regtime,logintimes')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
		//var_dump($user_list);
		// 将日期格式化
		foreach ($user_list as &$user) 
		{
			$user['regtime'] = date("Y-m-d", $user['regtime']);
			$user['logintimes'] = date("Y-m-d", $user['logintimes']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="新用户";
			}elseif ($number==2) {
				$user['status']="审核中";
			}else {
				$user['status']="雷锋";
			}
		}
		$this->assign('user_list', $user_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();

	}
	public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }


	/**
	 * 添加用户
	 */
	public function addAction()
	{

		// 判断当前是post还是get
		if (IS_POST)
		{
			$m_user = D('User');

		
			// 处理提交的数据
			$m_user->create(); // 默认去post中获取数据
			$m_user->birthday = strtotime($_POST['birthday']);
			$m_user->regtime = time();
			$m_user->logintimes = time();
				// 数据校验通过
			$m_user->add();
				
			// 数据插入或者验证存在问题
			$this->error('OK：' . $m_user->getError(), U('User/list'), 2);
		}
		else
		{
			// 展示添加表单
			// 把分类分配给表单
			$m_category = D('Category');
			$category_list = $m_category->getTree();
			$this->assign('category_list', $category_list);

			$this->display();
		}
		#####
		// $User = D("User");
		// $User->create();// 创建User数据对象，默认通过表单提交的数据进行创建
		// // 增加或者更改其中的属性
		// $result['birthday'] = strtotime($_POST['birthday']);
		// var_dump($result['birthday']);

		//  $User->birthday =$result['birthday'];$User->create_time = time();// 把数据对象添加到数据库
		//  $User->add(); 
		####
		// // 判断当前是post还是get
		// //print_r($_POST);
		// if (IS_POST)
		// {	
		// 	$m_user = M('User');
		// // 通用查询条件
		// 	$cond['is_deleted'] = '0';
		// 	$user_list = $m_user
		// 	->add('');
		// 	echo $m_user->getLastSQL;
		// 	exit;
			####
			// $m_user = D('user');

			
			// // echo '<pre>';var_dump($info);die;
			// // 处理提交的数据
			// //var_dump(expression)
			// var_dump($_POST['birthday']);
			// $result = $m_user->create(); // 默认去post中获取数据
			// var_dump($m_user);
			// $result['birthday'] = strtotime($_POST['birthday']);
			// $m_user->create();
			// // if ($result)
			// // {
			// // 	// 数据校验通过
			// 	//print_f($_POST['birthday']);
			// 	var_dump($_POST['birthday']);
			// 	//$result['birthday'] = strtotime($_POST['birthday']);
			// 	//var_dump($birthday);
			// 	//$category_id = $m_user->add();
			// 	$result->add();
				
			// 	var_dump($result);
				
			// 	if (category_id)
			// 	{
			// 		// 添加成功
			// 		//$this->redirect('user/list', [], 0);
			// 	}
			// }

			// 数据插入或者验证存在问题
			//$this->error('添加用户失败：' . $m_user->getError(), U('user/add'), 2);
		// }
		// else
		// {
		// 	// 展示添加表单
		// 	// 把分类分配给表单
		// 	$m_category = D('Category');
		// 	$category_list = $m_category->getTree();
		// 	$this->assign('category_list', $category_list);

		// 	$this->display();
		// }
	}


	/**
	 * 修改用户
	 */
	public function editAction($user_id=0)
	{
		$m_user = D('User');
		if (IS_POST)
		{
			if ($m_user->create())
			{
				if ($m_user->save())
				{
					$this->redirect('list', [], 0);
				}
			}

			$this->error('数据更新失败：'.$m_user->getError(), U('edit', ['user_id'=>I('post.user_id')]), 2);
		}
		else
		{
			$m_category = D('Category');
			// 模型获取数状数据
			$category_list = $m_category->getTree();
			$this->assign('category_list', $category_list);

			$this->assign('user', $m_user->find($user_id));
			//$this->assign('user', $m_user->($user_id));
			
			$this->display();
		}

		//echo $m_user->getLastSQL;
		//var_dump($_GET);可以拿到值
	}


	/**
	 * 删除用户
	 */
	public function removeUser($user_id=0)
	{
		$m_user = M('user');
		if (false === $m_user->delete($user_id))
		{
			$this->error('删除数据失败：'.$m_user->getError(), U('list'), 2);
		}
		else
		{
			$this->redirect('list', [], 0);
		}
	}
	/**
	 * 审核用户
	 */
	//false
	public function checkAction()
	{
			//var_dump($_GET);
		    $m_user = M('user');
		    $num=($_GET['user_id']);
		    $map['id']  = array('eq',$num);

			$data['status'] = '1';
			$m_user->where($map)->save($data);

			echo $m_user->getLastSQL();
			var_dump($_GET['user_id']);
			// $this->assign('user_check', $user_check);

			// $this->display();
			$this->redirect('list', [], 0);
	}
	//success
	public function successAction()
	{
			var_dump($_GET);
		    $m_user = M('user');
		    $num=($_GET['user_id']);
		    $map['id']  = array('eq',$num);

			$data['status'] = '3';
			$m_user->where($map)->save($data);

			echo $m_user->getLastSQL();
			var_dump($_GET['user_id']);
			// $this->assign('user_check', $user_check);

			// $this->display();
			$this->redirect('list', [], 0);
	}
}