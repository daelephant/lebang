<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class OrderController extends Controller
{
	/**
	 * 展示订单列表
	 */
	public function listAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_order = M('order');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$order_list = $m_order
			->field('id,location,tel,ordernum,demand,addtime,status,endtime,money,starttime,jdtime,paytime')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
			//var_dump($order_list);
		// 将日期格式化
		foreach ($order_list as &$order) 
		{
			$order['addtime'] = date("Y-m-d H:s:i", $order['addtime']);
			$order['starttime'] = date("Y-m-d H:s:i", $order['starttime']);
			$order['jdtime'] = date("Y-m-d H:s:i", $order['jdtime']);
			$order['endtime'] = date("Y-m-d H:s:i", $order['endtime']);
			$order['paytime'] = date("Y-m-d H:s:i", $order['paytime']);
		}
		$this->assign('order_list', $order_list);

		$total = $m_order->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
	}

	/**
	 * 查看订单chengyinxiang93@163.com
	 */
	public function editAction($order_id)
	{
		//$m_order = D('Order');
		
		// 通用查询条件
		//$m_user = M('User');
		//$order_list = $m_order//->join('RIGHT JOIN work ON artist.id = work.artist_id')->select()
			//匹配openid
					$m_order = D('Order');
					if(!IS_POST){
						$order = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid AND lb_order.id = $order_id")
					->field('lb_order.*,lb_user.name as username')
					->find();
						$this->assign('order', $order);


					
					// echo $m_order->getLastSQL();exit;
					 //var_dump($order);exit;
					
			//匹配jdopenid
					$m_order1 = D('Order');
					$order1 = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.jdopenid = lb_user.openid AND lb_order.id = $order_id")
					->field('lb_order.*,lb_user.name as username1')
					//->order('id desc')
					->find();
						
						$this->assign('order1', $order1);
			}else{
					 $m_order->where('lb_order.id='.$order_id)->save($_POST);

					 $order = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid AND lb_order.id = $order_id")
					->field('lb_order.*,lb_user.name as username')
					->find();
						
					$this->assign('order', $order);

					$order1 = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.jdopenid = lb_user.openid AND lb_order.id = $order_id")
					->field('lb_order.*,lb_user.name as username1')
					//->order('id desc')
					->find();
					
					$this->assign('order1', $order1);
				   
				}
					// echo $m_order->getLastSQL();exit;
					
					//echo $m_order1->getLastSQL();exit;
			$this->display();	
	}


	public function fetchAction()
	{	
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_order = M('Order');
		if ($_GET['tel']) {
			$where['tel']=$_GET['tel'];
		}
		if ($_GET['ordernum']) {
			$where['ordernum']=$_GET['ordernum'];
		}
		$where['_logic']='OR';

			$order_list = $m_order
			->field('id,location,tel,ordernum,demand,addtime,status,endtime,money,starttime,jdtime,paytime')
			->where($where)
			->order('id desc')
			->page($page, $pagesize)
			->select();
			// 将日期格式化
				foreach ($order_list as &$order) 
				{
					$order['addtime'] = date("Y-m-d H:s:i", $order['addtime']);
					$order['starttime'] = date("Y-m-d H:s:i", $order['starttime']);
					$order['jdtime'] = date("Y-m-d H:s:i", $order['jdtime']);
					$order['endtime'] = date("Y-m-d H:s:i", $order['endtime']);
					$order['paytime'] = date("Y-m-d H:s:i", $order['paytime']);
				}
		$this->assign('order_list', $order_list);
		$tota = $m_order->where($cond)->count();
		$t_page = new Page($tota, $pagesize);
		$this->assign('page_html', $t_page->show());
		$this->display();
		//页面下显示echo $m_order->getLastSQL();
		
	}
	
	/**
	 * 展示流失订单列表
	 */
	public function liushiAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_order = M('order');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['jdopenid'] = '';
		$order_list = $m_order
			->field('id,location,tel,ordernum,demand,addtime,status,endtime,money,starttime,jdtime,paytime')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
			//var_dump($order_list);
		// 将日期格式化
		foreach ($order_list as &$order) 
		{
			$order['addtime'] = date("Y-m-d H:s:i", $order['addtime']);
			$order['starttime'] = date("Y-m-d H:s:i", $order['starttime']);
			$order['jdtime'] = date("Y-m-d H:s:i", $order['jdtime']);
			$order['jdtime'] = date("Y-m-d H:s:i", $order['jdtime']);
			$order['endtime'] = date("Y-m-d H:s:i", $order['endtime']);
			$order['paytime'] = date("Y-m-d H:s:i", $order['paytime']);
		}
		$this->assign('order_list', $order_list);

		$total = $m_order->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
	}

/**
	 * 展示未支付订单列表nopay
	 */
	public function nopayAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_order = M('order');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		//$cond['jdopenid'] = '';
		$cond['status'] = '0';
		$order_list = $m_order
			->field('id,location,tel,ordernum,demand,addtime,status,endtime,money,starttime,jdtime,paytime')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
			//var_dump($order_list);
		//$m_order->getLastSQL();exit;	
		// 将日期格式化
		foreach ($order_list as &$order) 
		{
			$order['addtime'] = date("Y-m-d H:s:i", $order['addtime']);
			$order['starttime'] = date("Y-m-d H:s:i", $order['starttime']);
			$order['jdtime'] = date("Y-m-d H:s:i", $order['jdtime']);
			$order['jdtime'] = date("Y-m-d H:s:i", $order['jdtime']);
			$order['endtime'] = date("Y-m-d H:s:i", $order['endtime']);
			$order['paytime'] = date("Y-m-d H:s:i", $order['paytime']);
		}
		$this->assign('order_list', $order_list);

		$total = $m_order->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
	}


	/**
	 * 删除订单
	 */
	public function removeAction($order_id=0)
	{
		$m_order = M('order');
		if (false === $m_order->delete($order_id))
		{
			$this->error('删除数据失败：'.$m_order->getError(), U('list'), 2);
		}
		else
		{
			$this->redirect('list', [], 0);
		}
	}

	/**
	 *修改订单状态
	 */
	// public function ddztAction($order_id){
	// 	$orders = M('Order');
	// 	if(!IS_POST){
	// 		$ord = $orders->find($order_id);
	// 		$this->assign('ord',$ord);
	// 		$this->display;
	// 	}
	// }
}