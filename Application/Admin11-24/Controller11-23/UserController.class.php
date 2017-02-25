<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class UserController extends AuthController
{
	public function _initialize(){
         parent::_initialize();
    }
	
	public function listAction()
		{	
					
						// 考虑分页
						$pagesize = 10;
						$page = I('get.p', '1');

					$m_user = M('User');
					// 通用查询条件
					// $cond['is_deleted'] = '0';
					$user_list = $m_user
					->table('lb_user')
					->join("LEFT JOIN lb_money ON lb_user.openid = lb_money.openid")
					->field('lb_user.*,SUM(lb_money.moneys) as moneys')
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					//echo $m_user->getLastSQL();
					//var_dump($user_list);
		// 将日期格式化
		foreach ($user_list as &$user) 
		{	
			//$moneys=sprintf("%.2f", $money);
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		$this->assign('user_list', $user_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		//var_dump($user_list);exit;

	}
	/**
	 * 展示user待审核列表list1
	 */
	public function list1Action()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
 		$cond['_string'] = 'lb_user.status = 1';

		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e

		
		//查询评论s
 		$cond['_string'] = 'lb_user.status = 1';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
 		
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.*,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status = 1';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
 		
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
			
		$cond['_string'] = 'lb_user.status = 1';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  
			$user['age']=$year_diff;
			//var_dump($user['age']);exit;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			if ($user_list[$key]['pinglunshu']==0) {
				$user_list[$key]['pinglunshu']="0";
			}
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		//var_dump($user_list);exit;
		$this->assign('user_list', $user_list);
		$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());



		$this->display();

	}
	/**
	 * 展示user排序待审核列表按任务
	 */
	public function listOrderAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
 		$cond['_string'] = 'lb_user.status != 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.*,count(lb_order.openid) as order1')
			->where($cond)
			->order('order1 desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status != 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  
			$user['age']=$year_diff;
			//var_dump($user['age']);exit;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		//var_dump($user_list);exit;
		$this->assign('user_list', $user_list);
		$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());



		$this->display('list1');

	}
	/**
	 * 展示user排序待审核列表按beipinglun
	 */
	public function listPinglunAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
 		$cond['_string'] = 'lb_user.status != 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.*,count(lb_order.openid) as order1')
			->where($cond)
			->order('order1 desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('beipinglunshu desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status != 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('xinxianshi desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  
			$user['age']=$year_diff;
			//var_dump($user['age']);exit;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		//var_dump($user_list);exit;
		$this->assign('user_list', $user_list);
		$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());



		$this->display('list1');

	}
	/**
	 * 展示user排序待审核列表按Xinxianshi
	 */
	public function listXinxianshiAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
 		$cond['_string'] = 'lb_user.status != 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.*,count(lb_order.openid) as order1')
			->where($cond)
			->order('order1 desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status != 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('xinxianshi desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  
			$user['age']=$year_diff;
			//var_dump($user['age']);exit;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		//var_dump($user_list);exit;
		$this->assign('user_list', $user_list);
		$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());



		$this->display('list1');

	}
	/**
	 * 展示user待审核列表list2
	 */
	public function list2Action()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '2';
		$user_list = $m_user
			->field('id,name,nickname,phone,idnumber,status,status,regtime,logintimes,sex,birthday,idnumber,idpic')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
		//var_dump($user_list);exit;
		// 将日期格式化
		foreach ($user_list as &$user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			$user['birthday'] = date("Y-m-d ", $user['birthday']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="待审核用户";
			}elseif($number==3) {
				$user['status']="雷锋用户";
			}else {
				$user['status']="审核未通过";
			}
		}
		$this->assign('user_list', $user_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());


		$this->display();

	}
	/**
	 * 展示user待审核列表list3
	 */
	public function list3Action()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询发任务数s
 		$cond['_string'] = 'lb_user.status = 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询发任务数e
		//查询接任务数s
 		$cond['_string'] = 'lb_user.status = 3';
		$jdorder_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.jdopenid = lb_user.openid")
->field('lb_user.id,count(lb_order.jdopenid) as jdorder1')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询接任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid ")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status = 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('renzhengtime desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['jdorder1'] = $jdorder_list[$key][jdorder1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		$this->assign('user_list', $user_list);
		//$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());



		$this->display();


	}

	/**
	 * 展示user待审核列表order排序
	 */
	public function list3OrderAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
 		$cond['_string'] = 'lb_user.status = 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			->order('order1 desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
			//查询接任务数s
 		$cond['_string'] = 'lb_user.status = 3';
		$jdorder_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.jdopenid = lb_user.openid")
->field('lb_user.id,count(lb_order.jdopenid) as jdorder1')
			->where($cond)
			//->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询接任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			//->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			//->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status = 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			//->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['jdorder1'] = $jdorder_list[$key][jdorder1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		$this->assign('user_list', $user_list);
		$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());



		$this->display('list3');


	}
	/**
	 * 展示user待审核列表order排序
	 */
	public function list3JdOrderAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
 		$cond['_string'] = 'lb_user.status = 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			//->order('order1 desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
			//查询接任务数s
 		$cond['_string'] = 'lb_user.status = 3';
		$jdorder_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.jdopenid = lb_user.openid")
->field('lb_user.id,count(lb_order.jdopenid) as jdorder1')
			->where($cond)
			->order('jdorder1 desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询接任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			//->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			//->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status = 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			//->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['jdorder1'] = $jdorder_list[$key][jdorder1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		$this->assign('user_list', $user_list);
		$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());



		$this->display('list3');


	}

	/**
	 * 展示user待审核列表xinxianshi排序
	 */
	public function list3XinxianshiAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
 		$cond['_string'] = 'lb_user.status = 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			//->order('order1 desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
			//查询接任务数s
 		$cond['_string'] = 'lb_user.status = 3';
		$jdorder_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.jdopenid = lb_user.openid")
->field('lb_user.id,count(lb_order.jdopenid) as jdorder1')
			->where($cond)
			//->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询接任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			//->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			//->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status = 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('xinxianshi desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['jdorder1'] = $jdorder_list[$key][jdorder1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		$this->assign('user_list', $user_list);
		$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());



		$this->display('list3');


	}

		/**
	 * 展示user待审核列表list3Pinglun排序
	 */
	public function list3PinglunAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
 		$cond['_string'] = 'lb_user.status = 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			//->order('order1 desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
			//查询接任务数s
 		$cond['_string'] = 'lb_user.status = 3';
		$jdorder_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.jdopenid = lb_user.openid")
->field('lb_user.id,count(lb_order.jdopenid) as jdorder1')
			->where($cond)
			//->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询接任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			//->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('beipinglunid desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status = 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			//->order('xinxianshi desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['jdorder1'] = $jdorder_list[$key][jdorder1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		$this->assign('user_list', $user_list);
		$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());



		$this->display('list3');


	}

	/**
	 * 展示user待审核列表list4
	 */
	public function list4Action()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '4';
		$user_list = $m_user
			->field('id,name,nickname,phone,idnumber,status,status,regtime,logintimes,sex,birthday,idnumber,idpic,beizhu')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
		//var_dump($user_list);exit;
		// 将日期格式化
		foreach ($user_list as &$user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			$user['birthday'] = date("Y-m-d ", $user['birthday']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="待审核用户";
			}elseif($number==3) {
				$user['status']="雷锋用户";
			}else {
				$user['status']="审核未通过";
			}
		}
		$this->assign('user_list', $user_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());


		$this->display();
	}
	//编辑器
	public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }


	/**
	 * 添加用户
	 */
	public function addAction()
	{
		// 通用查询条件
		$m_master = M('Master');
			//匹配userid并展示：
     				$condition['lb_master.sid'] = 1;
					$m_master = D('master');
					$master_list = $m_master
					//->field(id,mname)
					->where($condition)
					->select();
					$this->assign('master_list', $master_list);
					//echo $m_master->getLastSQL();exit;
					//var_dump($master_list);exit;
			//$this->display();
		$m_shequ = M('shequ');
			//匹配userid并展示：
     				$date['lb_shequ.xianshi'] = 1;
					$shequ = D('shequ');
					$shequ_list = $m_shequ
					->where($date)
					->select();
					$this->assign('shequ', $shequ);
	
		$m_area = M('Area');
		$area = $m_area->field('id,sid,mingcheng')->select();
		$this->assign('area',json_encode(getTree3($area,'52','mingcheng')));

		if (IS_POST)
		{
			
			$m_user = D('User');
			$m_sms = D('Sms');
			$m_master = D('Master');
//s
		/// 判断当前是post还是get
		//var_dump($_POST);exit;
			$m_user = D('User');

		// 上传文件的处理
          //s
	$upload = new \Think\UploadFile();// 实例化上传类  
   $upload->maxSize = 3000000 ;// 设置附件上传大小  C('UPLOAD_SIZE');   
   //$upload->savePath = './Public/Uploads/' . $path; // 设置附件上传目录  
   $upload->savePath = './photo/avatar/'; // 设置附件上传目录  
   $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型  
   $upload->saveRule = 'time';  
   $upload->uploadReplace = true; //是否存在同名文件是否覆盖  
   $upload->thumb = true; //是否对上传文件进行缩略图处理  
   $upload->thumbMaxWidth = '300,600,1000'; //缩略图处理宽度  
   $upload->thumbMaxHeight = '300,600,1000'; //缩略图处理高度  
   //$upload->thumbPrefix = $prefix; //缩略图前缀  
   $upload->thumbPrefix = 's_,m_,b_';  //生产3张缩略图  
   //$upload->thumbPath = './Public/Uploads/' . $path . date('Ymd', time()) . '/'; //缩略图保存路径  
   $upload->thumbPath = './photo/avatar/'; //缩略图保存路径  
    
  //$upload->thumbRemoveOrigin = true; //上传图片后删除原图片  
   $upload->thumbRemoveOrigin = false; //上传图片后删除原图片
   $upload->saveRule = 'time'; // 采用时间戳命名
   // $upload->autoSub = true; //是否使用子目录保存图片  
   // $upload->subType = 'date'; //子目录保存规则  
   // $upload->dateFormat = 'Ymd'; //子目录保存规则为date时时间格式 
   if (!$upload->upload()) {// 上传错误提示错误信息  
       echo json_encode(array('user' => $this->error($upload->getErrorMsg()), 'status' => 0));  
   } else {// 上传成功 获取上传文件信息  
       $info = $upload->getUploadFileInfo();  
       $picname = $info[0]['savename'];  
       $_POST['pic'] = $picname;
			}
			$result=$m_user->create();
			//var_dump($_POST);exit;
			// var_dump($_POST['starttime']);
			// var_dump($_POST['endtime']);
			//var_dump($_POST['pic']);exit;ok
			$m_user->addtime = time();
		    $m_user->birthday = strtotime($_POST['birthday']);
			$m_user->regtime = time();
			$m_user->logintimes = time();
			$m_user->openid = md5($_POST['phone'].time());
			$m_user->name = $_POST['name'];
			$m_user->nickname = $_POST['nickname'];
			$m_user->sex = $_POST['sex'];
			$m_user->profession = $_POST['profession'];
			$m_user->avatar =  $_POST['pic'];

			// 数据校验通过
			$m_user->add();

			// 数据插入或者验证存在问题
			// $this->error('OK：' . $m_user->getError(), U('User/list1'), 2);
			$this->redirect('User/list1');
		//e

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
		
	}


//start
	/**
	 * 编辑前展示user
	 */
	public function bianjiAction($user_id=0)
	{



   		// 通用查询条件
		$m_master = M('Master');
			//匹配userid并展示：
     				$condition['lb_master.sid'] = 1;
					$m_master = D('master');
					$master_list = $m_master
					//->field(id,mname)
					->where($condition)
					->select();
					$this->assign('master_list', $master_list);
					//echo $m_master->getLastSQL();exit;
					//var_dump($master_list);exit;
			//$this->display();
		$m_shequ = M('shequ');
			//匹配userid并展示：
     				$date['lb_shequ.xianshi'] = 1;
					$shequ_list = $m_shequ
					->where($date)
					->select();
					$this->assign('shequ_list', $shequ_list);

	
		$m_area = M('Area');
		$area = $m_area->field('id,sid,mingcheng')->select();
		$this->assign('area',json_encode(getTree3($area,'52','mingcheng')));
		//var_dump($shequ_list);exit;
		// 通用查询条件
		$m_user = M('User');
			//匹配userid并展示：
     				$condition['lb_user.id'] = $user_id;
					$m_user = D('User');
					$user = $m_user
					->table('lb_user')
					->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
					->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
					->field('lb_user.*,lb_shequ.mingcheng as shequ,lb_master.mname as profession')
					->where($condition)
					->find();
					$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
					$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
					$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  
			$user['age']=$year_diff;
					$this->assign('user', $user);
					//echo $m_user->getLastSQL();exit;
			// echo '<pre>';
			// print_r($m_user);
			// exit;
			//$this->display();


			//更新	
			// 判断当前是post还是get
		if (IS_POST)
		{
			$m_user = D('User');

			//var_dump($_POST);
			// 处理提交的数据
			$m_user->create(); // 默认去post中获取数据
			// $m_user->birthday = strtotime($_POST['birthday']);
			// $m_user->regtime = time();
			// $m_user->logintimes = time();
				// 数据校验通过
			$m_user->save();
			//echo $m_user->getLastSQL();
			
			// 数据插入或者验证无存在问题
			//$this -> redirect('javascript:history.back(-1);');

			//$this->success('OK：' , U('User/list'), 2);
			$this->redirect('User/list1/p/'.I('get.p'));
		}
		else
		{
			// 展示添加表单
			// 把分类分配给表单
			$m_category = D('Category');
			$category_list = $m_category->getTree();
			$this->assign('category_list', $category_list);

			$m_user = D('User');
			$user = $m_user->where('id='.$user_id)->find();
			$this->assign('user',$user);
			$shequ = $m_shequ->where('id='.$user['shequid'])->find();
			$this->assign('shequ',$shequ);
			$this->display();
		}


	}
//end
	//start
	/**
	 * 雷锋查看并编辑前展示
	 */
	public function cklfAction($user_id=0)
	{
   		// 通用查询条件
		$m_master = M('Master');
			//匹配userid并展示：
     				$condition['lb_master.sid'] = 1;
					$m_master = D('master');
					$master_list = $m_master
					//->field(id,mname)
					->where($condition)
					->select();
					$this->assign('master_list', $master_list);
					//echo $m_master->getLastSQL();exit;
					//var_dump($master_list);exit;
			//$this->display();
		$m_shequ = M('shequ');
			//匹配userid并展示：
     				$date['lb_shequ.xianshi'] = 1;
					$m_shequ = D('shequ');
					$shequ_list = $m_shequ
					//->field(id,mname)
					->where($date)
					->select();
					$this->assign('shequ_list', $shequ_list);


		$m_area = M('Area');
		$area = $m_area->field('id,sid,mingcheng')->select();
		$this->assign('area',json_encode(getTree3($area,'52','mingcheng')));
		//var_dump($shequ_list);exit;
		// 通用查询条件
		// $m_user = M('User');
		// 	//匹配userid并展示：
  //    				$condition['lb_user.id'] = $user_id;
		// 			$m_user = D('User');
		// 			$user = $m_user
		// 			->table('lb_user')
		// 			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
		// 			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
		// 			->field('lb_user.*,lb_shequ.mingcheng as shequ,lb_master.mname as profession')
		// 			->where($condition)
		// 			->find();
		// 			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
		// 			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
		// 			//$user['birthday'] = date("Y-m-d H:i:s", $user['birthday']);
		// 			$user['renzhengtime'] = date("Y-m-d H:i:s", $user['renzhengtime']);
					//var_dump($user['phone']);
			// 		$birthday = date("Y-m-d", $user['birthday']);
			//  list($year,$month,$day) = explode("-",$birthday);
   //          $year_diff = date("Y") - $year;
			  
			// $user['age']=$year_diff;
					// $this->assign('user', $user);
					//echo $m_user->getLastSQL();exit;
					// var_dump($user);exit;
			//$this->display();

			//更新	
					//var_dump($_POST);exit;
			// 判断当前是post还是get
		if (IS_POST)
		{
			$m_user = D('User');

			//var_dump($_POST);exit;
			// 处理提交的数据
			$m_user->create(); // 默认去post中获取数据
			$m_user->birthday = strtotime($_POST['birthday']);
			// $m_user->regtime = time();
			// $m_user->logintimes = time();
				// 数据校验通过
			$m_user->save();
			
			$this -> redirect('User/list3/p/'.I('get.p'));
			
		}
		else
		{
			// 展示添加表单
			// 把分类分配给表单
			$m_category = D('Category');
			$category_list = $m_category->getTree();
			$this->assign('category_list', $category_list);

			$m_user = D('User');
			$user = $m_user->where('id='.$user_id)->find();
			$this->assign('user',$user);
			$shequ = $m_shequ->where('id='.$user['shequid'])->find();
			$this->assign('shequ',$shequ);
			$this->display();
		}
	}

	/**
	 * 修改用户
	 */
	public function editAction($user_id=0)
	{
		// 通用查询条件
		$m_user = M('User');
			//匹配userid并展示：
			//var_dump($m_user);exit;
     				$condition['id'] = $user_id;
					$m_user = D('User');
					$user = $m_user
					->table('lb_user')
					->field('lb_user.*')
					->where($condition)
					->find();
					
					$this->assign('user', $user);
					//echo $m_user->getLastSQL();exit;
					//var_dump($user);
			//$this->display();

			//更新	
			// 判断当前是post还是get
		// if (IS_POST)
		// {
		// 	$m_user = D('User');

		// 	var_dump($_POST);
		// 	// 处理提交的数据
		// 	$m_user->create(); // 默认去post中获取数据
		// 	$m_user->birthday = strtotime($_POST['birthday']);
		// 	$m_user->regtime = time();
		// 	$m_user->logintimes = time();
		// 		// 数据校验通过
		// 	$m_user->save();
		// 	echo $m_user->getLastSQL();
		// 	// 数据插入或者验证无存在问题
		// 	$this -> redirect('User/list');

		// 	//$this->success('OK：' , U('User/list'), 2);
		// }
		if (IS_GET)
		{	
			

			$user = M("user"); // 实例化User对象// 要修改的数据对象属性赋值
			$map['id'] = $_GET['user_id'];
			//$a=$_GET['user_id'];var_dump($a);
			//var_dump($_GET);
			$user->status = $_GET['status'];
			//
			$time = time(); //当前时间戳
			$date = date('Y',$time). '-' . date('m-d H:i:s');//一年前日期
			//
			$user->beizhu = $date.$_GET['beizhu'];
			$user->renzhengtime = $time;
			$user->where($map)->save(); // 根据条件更新记录
			//echo $user->getLastSQL();
			//$this->success('OK：' , U('user/list'), 2);
			
			// $cid="7269143c199f568a2e9e1c996fc77885";
				if($_GET['status'] == 3)
				{
					Vendor('Igetui.igts');
				$igt = new\igts();
				$content=json_encode(array('code'=>1007,"obj"=>array('status'=>$_GET['status'],'beizhu'=>$_GET['beizhu'])));
	 			$refg=$igt->pushMessageToSingle($cid,$content,"全民乐帮认证通过"); 
	 			 
				}else{

				   Vendor('Igetui.igts');
				$igt = new\igts();
				$content=json_encode(array('code'=>1007,"obj"=>array('status'=>$_GET['status'],'beizhu'=>$_GET['beizhu'])));
	 			$refg=$igt->pushMessageToSingle($cid,$content,"全民乐帮认证不通过"); 
	 			 
				}
				// print_r($refg);
	 		// 	exit;
		

			$this->redirect('user/list2');
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

			$data['status'] = '4';
			$m_user->where($map)->save($data);

			// echo $m_user->getLastSQL();
			// var_dump($_GET['user_id']);
			// $this->assign('user_check', $user_check);

			// $this->display();
			$this->redirect('list', [], 0);
	}
	//success
	public function successAction()
	{
			//var_dump($_GET);
		    $m_user = M('user');
		    $num=($_GET['user_id']);
		    $map['id']  = array('eq',$num);

			$data['status'] = '3';
			$m_user->where($map)->save($data);

			// echo $m_user->getLastSQL();
			// var_dump($_GET['user_id']);
			// $this->assign('user_check', $user_check);

			// $this->display();
			$this->redirect('list', [], 0);
	}
	/**
	 * 查询用户
	 */
	public function fetch4Action()
	{	//var_dump($_GET);EXIT;
		if ($_GET['sosuo'] ==1) {
			// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '4';
		$cond['phone'] = $_GET['value'];
		$user_list = $m_user
			->field('id,name,nickname,phone,idnumber,status,status,regtime,logintimes,sex,birthday,idnumber,idpic,beizhu')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
		//var_dump($user_list);exit;
		// 将日期格式化
			foreach ($user_list as &$user) 
			{	
				$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
				$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
				$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
				$user['birthday'] = date("Y-m-d ", $user['birthday']);
				$number=$user['status'];
				if ($number==1) {
					$user['status']="普通用户";
				}elseif ($number==2) {
					$user['status']="待审核用户";
				}elseif($number==3) {
					$user['status']="雷锋用户";
				}else {
					$user['status']="审核未通过";
				}
			}
		}elseif ($_GET['sosuo'] ==2) {
			// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '4';
		$cond['name'] = $_GET['value'];
		$user_list = $m_user
			->field('id,name,nickname,phone,idnumber,status,status,regtime,logintimes,sex,birthday,idnumber,idpic,beizhu')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
		//var_dump($user_list);exit;
		// 将日期格式化
			foreach ($user_list as &$user) 
			{	
				$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
				$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
				$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
				$user['birthday'] = date("Y-m-d ", $user['birthday']);
				$number=$user['status'];
				if ($number==1) {
					$user['status']="普通用户";
				}elseif ($number==2) {
					$user['status']="待审核用户";
				}elseif($number==3) {
					$user['status']="雷锋用户";
				}else {
					$user['status']="审核未通过";
				}
			}
		}elseif ($_GET['sosuo'] ==3) {
					// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '4';
		$cond['nickname'] = $_GET['value'];
		$user_list = $m_user
			->field('id,name,nickname,phone,idnumber,status,status,regtime,logintimes,sex,birthday,idnumber,idpic,beizhu')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
		//var_dump($user_list);exit;
		// 将日期格式化
			foreach ($user_list as &$user) 
			{	
				$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
				$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
				$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
				$user['birthday'] = date("Y-m-d ", $user['birthday']);
				$number=$user['status'];
				if ($number==1) {
					$user['status']="普通用户";
				}elseif ($number==2) {
					$user['status']="待审核用户";
				}elseif($number==3) {
					$user['status']="雷锋用户";
				}else {
					$user['status']="审核未通过";
				}
			}
		}
	
		$this->assign('user_list', $user_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display('user/list4');

	}

	/**
	 * 查询用户
	 */
	public function fetch2Action()
	{	//var_dump($_GET);EXIT;
		if ($_GET['sosuo'] ==1) {
			// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '2';
		$cond['phone'] = $_GET['value'];
		$user_list = $m_user
			->field('id,name,nickname,phone,idnumber,status,status,regtime,logintimes,sex,birthday,idnumber,idpic,beizhu')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
		//var_dump($user_list);exit;
		// 将日期格式化
			foreach ($user_list as &$user) 
			{	
				$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
				$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
				$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
				$user['birthday'] = date("Y-m-d ", $user['birthday']);
				$number=$user['status'];
				if ($number==1) {
					$user['status']="普通用户";
				}elseif ($number==2) {
					$user['status']="待审核用户";
				}elseif($number==3) {
					$user['status']="雷锋用户";
				}else {
					$user['status']="审核未通过";
				}
			}
		}elseif ($_GET['sosuo'] ==2) {
			// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '4';
		$cond['name'] = $_GET['value'];
		$user_list = $m_user
			->field('id,name,nickname,phone,idnumber,status,status,regtime,logintimes,sex,birthday,idnumber,idpic,beizhu')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
		//var_dump($user_list);exit;
		// 将日期格式化
			foreach ($user_list as &$user) 
			{	
				$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
				$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
				$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
				$user['birthday'] = date("Y-m-d ", $user['birthday']);
				$number=$user['status'];
				if ($number==1) {
					$user['status']="普通用户";
				}elseif ($number==2) {
					$user['status']="待审核用户";
				}elseif($number==3) {
					$user['status']="雷锋用户";
				}else {
					$user['status']="审核未通过";
				}
			}
		}elseif ($_GET['sosuo'] ==3) {
					// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '4';
		$cond['nickname'] = $_GET['value'];
		$user_list = $m_user
			->field('id,name,nickname,phone,idnumber,status,status,regtime,logintimes,sex,birthday,idnumber,idpic,beizhu')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
		//var_dump($user_list);exit;
		// 将日期格式化
			foreach ($user_list as &$user) 
			{	
				$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
				$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
				$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
				$user['birthday'] = date("Y-m-d ", $user['birthday']);
				$number=$user['status'];
				if ($number==1) {
					$user['status']="普通用户";
				}elseif ($number==2) {
					$user['status']="待审核用户";
				}elseif($number==3) {
					$user['status']="雷锋用户";
				}else {
					$user['status']="审核未通过";
				}
			}
		}
	
		$this->assign('user_list', $user_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display('user/list2');

	}


	/**
	 * 搜索普通list1
	 */
	public function fetch1Action()
	{	//var_dump($_GET);EXIT;
		// $m_user = M('User');
		// $m_order = M('Order');
		// $m_xinxianshi = M('Xinxianshi');
		// $m_beixinxianshi = M('Xinxianshi');
		$_GET['endtime']=strtotime($_GET['endtime']);
		$_GET['starttime']=strtotime($_GET['starttime']);
		if ($_GET['sosuo'] ==1) {
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
		//$cond['phone'] = $_GET['value'];
		if ($_GET['value']) {
			$cond['phone']=$_GET['value'];
		}
		if ($_GET['starttime']) {
			if ($_GET['endtime']) {
				$cond['regtime'] = array('between',[$_GET['starttime'],$_GET['endtime']]);
			}
		}
		
 		$cond['_string'] = 'lb_user.status != 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status != 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		}elseif ($_GET['sosuo'] ==2) {
			// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
		$cond['name'] = $_GET['value'];
 		$cond['_string'] = 'lb_user.status != 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status != 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		}elseif ($_GET['sosuo'] ==3) {
					// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
		$cond['nickname'] = $_GET['value'];
 		$cond['_string'] = 'lb_user.status != 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status != 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status != 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		}
	
		$this->assign('user_list', $user_list);
		$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display('user/list1');

	}

	/**
	 * 搜索普通list3
	 */
	public function fetch3Action()
	{	
		$_GET['endtime']=strtotime($_GET['endtime']);
		$_GET['starttime']=strtotime($_GET['starttime']);
		if ($_GET['sosuo'] ==1) {
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
		//$cond['phone'] = $_GET['value'];
		if ($_GET['value']) {
			$cond['phone']=$_GET['value'];
		}
		if ($_GET['starttime']) {
			if ($_GET['endtime']) {
				$cond['regtime'] = array('between',[$_GET['starttime'],$_GET['endtime']]);
			}
		}
		
 		$cond['_string'] = 'lb_user.status = 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status = 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		}elseif ($_GET['sosuo'] ==2) {
			// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
		$cond['name'] = $_GET['value'];
 		$cond['_string'] = 'lb_user.status = 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status = 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		}elseif ($_GET['sosuo'] ==3) {
					// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		$m_order = M('Order');
		$m_xinxianshi = M('Xinxianshi');
		$m_beixinxianshi = M('Xinxianshi');

		// 通用查询条件
		//$cond['is_deleted'] = '0';
		//查询任务数s
		$cond['nickname'] = $_GET['value'];
 		$cond['_string'] = 'lb_user.status = 3';
		$order_list = $m_order
			->table('lb_user')
			->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
->field('lb_user.id,count(lb_order.openid) as order1')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//查询任务数e
		//查询评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		//$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$xinxianshi_list = $m_xinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid and lb_xinxianshi.beipinglunid = 0")
->field('lb_user.id,count(lb_xinxianshi.openid) as pinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump(expression)
			//查询评论e

			//查询被评论s
 		$cond['_string'] = 'lb_user.status = 3';
 		////$cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
		$beixinxianshi_list = $m_beixinxianshi
			->table('lb_user')
			->join("LEFT JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
->field('lb_user.id,count(lb_xinxianshi.beipinglunid) as beipinglunshu')
			->where($cond)
			->order('lb_user.id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
			//var_dump($beixinxianshi_list);exit;
			//查询评论e
			//var_dump($order_list[4][order1]);exit;
		$cond['_string'] = 'lb_user.status = 3';
		$user_list = $m_user
			->table('lb_user')
			// ->join("LEFT JOIN lb_order ON lb_order.openid = lb_user.openid")
			->join("LEFT JOIN lb_master ON lb_master.id = lb_user.profession")
			->join("LEFT JOIN lb_shequ ON lb_shequ.id = lb_user.shequid")
			->join("left JOIN lb_xinxianshi ON lb_xinxianshi.openid = lb_user.openid")
			->field('lb_user.*,lb_master.mname as profession,lb_shequ.mingcheng as shequ,count(lb_xinxianshi.openid) as xinxianshi')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();

		//
		// 将日期格式化as $key => $value
		foreach ($user_list as $key => $user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型e
			$birthday = date("Y-m-d", $user['birthday']);
			 list($year,$month,$day) = explode("-",$birthday);
            $year_diff = date("Y") - $year;
			  //$month_diff = date("m") - $month;
			  //$day_diff  = date("d") - $day;
			$user['age']=$year_diff;
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			// var_dump($order[3]['order1']);exit;
			$user_list[$key]['order1'] = $order_list[$key][order1];
			$user_list[$key]['pinglunshu'] = $xinxianshi_list[$key][pinglunshu];
			$user_list[$key]['beipinglunshu'] = $beixinxianshi_list[$key][beipinglunshu];
			//var_dump($user['order1']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		}
	
		$this->assign('user_list', $user_list);
		$this->assign('order_list', $order_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display('user/list3');

	}
	/**
	 * 充值用户
	 */
	public function rechargeAction($user_id=0)
	{			

		// 构造查询条件
				//var_dump($user_id);
		    $user_id=$_POST['user_id'];
			$Dao = M("user");
		    $condition['id'] = "$user_id";
		    //$condition['password'] = MD5('123456');
		    // 查询数据
		    $list = $Dao->where($condition)->find();
		   // var_dump($list["openid"]);ok
		    $Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
		    //var_dump($list["openid"]);
			$openid=$list["openid"];
			//var_dump($value);exit;
			//$openid=19931014;
			//var_dump($openid);exit;ok
			//$Model->execute("insert into lb_money (openid,moneys) values (a06c5962f215c11048d362e192d91da4,8888)");
			$money=$_POST['money'];
			//$money=222.1;
			$moneys=sprintf("%.2f", $money);// round(-4.635,2);$res=sprintf("%.2f", $num);
			//var_dump($moneys);exit;
			$addtime=time();  // 当前时间的时间戳
			$rand=rand(1000,9999);	//rand(1000,9999)
			//var_dump($rand);exit;		                      
			$ordernum = date("YmdHis",$addtime).$rand;    // 格式化时间戳,拼接起来生成订单
			//var_dump($ordernum);
			$Model->execute("INSERT INTO `lebang`.`lb_money` (`id`, `openid`, `money`, `type`, `pays`, `beizhu`, `moneys`, `addtime`, `ordernum`) VALUES (NULL, '$openid', '$moneys', '4', '4', '0', '$moneys', '$addtime', '$ordernum')");
		  	
		   //var_dump($user_id);
		   //var_dump($_POST['money']);
		    //echo $Model->getLastSQL();
		   // var_dump($list);exit;
		//
		// $Dao = M("money");
		// $list = $Dao->find();


		// $Model = new \Think\Model(); // 实例化一个model对象 没有对应任何数据表
		// $text=$Model->query("find openid from lb_money on id=1");
		// var_dump($text);exit;
		//$openid='270b708fee661d82f8e58407752bb755';
        //$Model->execute("insert into lb_money (moneys) values (1994) where id=1");
        
		//
		// 考虑分页
						$pagesize = 10;
						$page = I('get.p', '1');
						$m_user = M('User');
					// 通用查询条件
					// 	$cond['is_deleted'] = '0';
					$user_list = $m_user
					->table('lb_user')
					->join("LEFT JOIN lb_money ON lb_user.openid = lb_money.openid")
					->field('lb_user.*,SUM(lb_money.moneys) as moneys')
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
		foreach ($user_list as &$user) 
		{
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
			$user['regtime'] = date("Y-m-d H:i:s", $user['regtime']);
			$user['logintimes'] = date("Y-m-d H:i:s", $user['logintimes']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="普通用户";
			}elseif ($number==2) {
				$user['status']="等待审核";
			}elseif ($number==3) {
				$user['status']="雷锋用户";
			}
			else {
				$user['status']="审核未通过";
			}
		}
		$this->assign('user_list', $user_list);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();

		//
		$m_money = M('money');

		// if (false === $m_user->delete($user_id))
		// {
		// 	$this->error('删除数据失败：'.$m_user->getError(), U('list'), 2);
		// }
		// else
		// {
		// 	$this->redirect('list', [], 0);
		// }
	}
}