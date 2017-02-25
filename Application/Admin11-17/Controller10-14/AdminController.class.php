<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends AuthController
{

	public function _initialize(){
         parent::_initialize();
    }
	/**
	 * 展示后台首页
	 */
	public function indexAction()
	{
		// if (empty(session('user')['username'])){
		// 	$this->redirect('Admin/Login/login');
		// }else{
			//$this->display();
		$m_user = M('User');
		$m_order = M('Order');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '1';
		$con['status'] = '3';
		$co['status'] = '4';
		// 添加条件：
		$list1=$user_list = $m_user
			->where($cond)
			->count();
		//var_dump($list1);
		$list3=$user_list = $m_user
			->where($con)
			->count();
			//var_dump($list3);exit;
		$list4=$user_list = $m_user
		->where($co)
		->count();
		//var_dump($list4);exit;
		$list5=$order_list = $m_order->count();
   
    $this->assign('list1', $list1);
    $this->assign('list3', $list3);
    $this->assign('list4', $list4);
    $this->assign('list5', $list5);
    $this->display();
		}


		

	

}
