<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class OrderController extends AuthController
{
	public function _initialize(){
         parent::_initialize();
    }
	/**
	 * 展示进行中的任务列表
	 */
	public function listAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_order = M('order');
	
		$order_list = $m_order
			->table('lb_order')
		    ->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
		    ->field('lb_order.*,lb_user.nickname as username')
			->where('lb_order.status = 2 or lb_order.status =3')
			// ->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
			//var_dump($order_list);exit;
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

		$total = $m_order->where('lb_order.status = 2 or lb_order.status =3')->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
	}

	/**
	 *进行中订单详情
	 */
	public function editAction($order_id)
	{

					$m_order = D('Order');

					if(!IS_POST){
						$order = $m_order->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
					->field('lb_order.*,lb_user.nickname as username')
					->where("lb_order.id = $order_id")
					->find();
					$this->assign('order', $order);
					// echo $m_order->getLastSQL();exit;
				 // var_dump($order);exit;
					
			//匹配jdopenid
					$m_order1 = D('Order');
					$order1 = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.jdopenid = lb_user.openid")
					->field('lb_order.*,lb_user.name or phone as username1,lb_user.*')
					->where("lb_order.id = $order_id")
					//->order('id desc')
					->find();

					$this->assign('order1', $order1);

//匹配dingdanzhaopain

				if($order['leixing']==1){
					$m_order2 = D('Order');
					$order2 = $m_order2
							->table('lb_order')
							->join('INNER JOIN lb_dingdanzhaopian ON lb_order.id = lb_dingdanzhaopian.order_id')
							->field('lb_order.*,lb_dingdanzhaopian.zhaopian as zhaopian')
							->where("lb_order.id = $order_id ")
							->select();

//var_dump($order2);exit;
					$this->assign('path','dingdan');
					$this->assign('order2',$order2);
				}else{
			//匹配xinxianshizhaopain
					$order2 = D('Order');
					$order2 = $order2
							->table('lb_order')
							->join('INNER JOIN lb_xinxianshizhaopian ON lb_order.xinxianshiid = lb_xinxianshizhaopian.xinxianshiid')
							->field('lb_order.*,lb_xinxianshizhaopian.zhaopian as zhaopian')
							->where("lb_order.id = $order_id ")
							->select();

// var_dump($order4);exit;
					$this->assign('path','xinxianshi');
					$this->assign('order2',$order2);

				}



					



			//匹配 fen		
			
						$m_order3 = D('Order');
						$order3 = $m_order3
							->table('lb_order')
							->join('INNER JOIN lb_comment ON lb_comment.openid = lb_order.jdopenid ')
							->field('lb_order.*,avg(lb_comment.fen) as fen')
							->where("lb_order.id = '$order_id' and lb_comment.plbs = 2  ")
							->find();

							//var_dump($order3);exit;
							//echo $m_order3->getLastSQL();exit;			
						$this->assign('order3',$order3);

				$fens = $order3['fen'];	
				$img1 = '<img src="/img/xing1.png" height="15"/>';		
				$img2 = '<img src="/img/xing2.png" height="15"/>';		
				$img3 = '<img src="/img/xing3.png" height="15"/>';		
switch ($fens){
				  case 0:
					$pfs=$img3.$img3.$img3.$img3.$img3;
					$fens=5;
					break;
				  case 1>$fens:
					$pfs=$img2.$img1.$img1.$img1.$img1;
					break;
				  case 1:
					$pfs=$img3.$img1.$img1.$img1.$img1;
					break;
				  case 2>$fens:
					$pfs=$img3.$img2.$img1.$img1.$img1;
					break;
				  case 2:
					$pfs=$img3.$img3.$img1.$img1.$img1;
					break;
				  case 3>$fens:
					$pfs=$img3.$img3.$img1.$img1.$img1;
					break;
				  case 3:
					$pfs=$img3.$img3.$img3.$img1.$img1;
					break;
				  case 4>$fens:
					$pfs=$img3.$img3.$img3.$img2.$img1;
					break;
				  case 4:
					$pfs=$img3.$img3.$img3.$img3.$img1;
					break;
				  case 5>$fens:
					$pfs=$img3.$img3.$img3.$img3.$img2;
					break;
				default;
        		$pfs=$img3.$img3.$img3.$img3.$img3;
				$fens=5;
				break;
		  }	
$this->assign('pfs',$pfs);






			}else{  
				   	$m_order->demand =  $_POST['demand'];
					//var_dump($_POST);exit;
					$m_order->where('lb_order.id='.$order_id)->save($_POST);
					$this->redirect('Order/list/p/'.I('get.p'));  
				}
					// echo $m_order->getLastSQL();exit;	
					//echo $m_order1->getLastSQL();exit;
			$this->display();	
	}


    public function yjinyongAction(){
      $id = $_POST['xid'];
      $data['status'] = 5;
      $data['beizhu'] = $_POST['beizhu'];
      $data['endtime'] = time();
      M('order')->where('id='.$id)->save($data);
      $this->redirect('order/list');
    }


	/**
	 * 未支付订单  任务详情
	 */

	public function nopaykAction($order_id)
	{
		$m_order = D('Order');

					if(!IS_POST){
						$order = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
					->field('lb_order.*,lb_user.nickname as username')
					->where("lb_order.id = $order_id")
					->find();
					$this->assign('order', $order);
					// echo $m_order->getLastSQL();exit;
				// var_dump($order);exit;
					
			//匹配jdopenid
					$m_order1 = D('Order');
					$order1 = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.jdopenid = lb_user.openid")
					->field('lb_order.*,lb_user.name or phone as username1,lb_user.*')
					->where("lb_order.id = $order_id")
					//->order('id desc')
					->find();

					$this->assign('order1', $order1);

			//匹配dingdanzhaopain

				if($order['leixing']==1){
					$m_order2 = D('Order');
					$order2 = $m_order2
							->table('lb_order')
							->join('INNER JOIN lb_dingdanzhaopian ON lb_order.id = lb_dingdanzhaopian.order_id')
							->field('lb_order.*,lb_dingdanzhaopian.zhaopian as zhaopian')
							->where("lb_order.id = $order_id ")
							->select();

//var_dump($order2);exit;
					$this->assign('path','dingdan');
					$this->assign('order2',$order2);
				}else{
			//匹配xinxianshizhaopain
					$order2 = D('Order');
					$order2 = $order2
							->table('lb_order')
							->join('INNER JOIN lb_xinxianshizhaopian ON lb_order.xinxianshiid = lb_xinxianshizhaopian.xinxianshiid')
							->field('lb_order.*,lb_xinxianshizhaopian.zhaopian as zhaopian')
							->where("lb_order.id = $order_id ")
							->select();

// var_dump($order4);exit;
					$this->assign('path','xinxianshi');
					$this->assign('order2',$order2);

				}

			//匹配 fen 
			
					$m_order3 = D('Order');
					$order3 = $m_order3
							->table('lb_order')
							->join('INNER JOIN lb_comment ON lb_order.id = lb_comment.order_id')
							->field('lb_order.*,lb_comment.fen as fen')
							->where('lb_order.jdopenid = lb_comment.openid')
							->find();
							//var_dump($order3);exit;
							$this->assign('order3',$order3);




			}else{  
				   $m_order->demand =  $_POST['demand'];
					//var_dump($_POST);exit;
					 $m_order->where('lb_order.id='.$order_id)->save($_POST);
					 $this->redirect('Order/nopay/p/'.I('get.p'));
				}
					// echo $m_order->getLastSQL();exit;	
					//echo $m_order1->getLastSQL();exit;
			$this->display();	
	}


			public function liushikAction($order_id)
			{
						$m_order = D('Order');

					if(!IS_POST){
						$order = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
					->field('lb_order.*,lb_user.nickname as username')
					->where("lb_order.id = $order_id")
					->find();
					$this->assign('order', $order);
					// echo $m_order->getLastSQL();exit;
				// var_dump($order);exit;
					
			//匹配jdopenid
					$m_order1 = D('Order');
					$order1 = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.jdopenid = lb_user.openid")
					->field('lb_order.*,lb_user.name or phone as username1,lb_user.*')
					->where("lb_order.id = $order_id")
					//->order('id desc')
					->find();

					$this->assign('order1', $order1);

			//匹配dingdanzhaopain

				if($order['leixing']==1){
					$m_order2 = D('Order');
					$order2 = $m_order2
							->table('lb_order')
							->join('INNER JOIN lb_dingdanzhaopian ON lb_order.id = lb_dingdanzhaopian.order_id')
							->field('lb_order.*,lb_dingdanzhaopian.zhaopian as zhaopian')
							->where("lb_order.id = $order_id ")
							->select();

//var_dump($order2);exit;
					$this->assign('path','dingdan');
					$this->assign('order2',$order2);
				}else{
			//匹配xinxianshizhaopain
					$order2 = D('Order');
					$order2 = $order2
							->table('lb_order')
							->join('INNER JOIN lb_xinxianshizhaopian ON lb_order.xinxianshiid = lb_xinxianshizhaopian.xinxianshiid')
							->field('lb_order.*,lb_xinxianshizhaopian.zhaopian as zhaopian')
							->where("lb_order.id = $order_id ")
							->select();

// var_dump($order4);exit;
					$this->assign('path','xinxianshi');
					$this->assign('order2',$order2);

				}

			//匹配 fen 
			
					$m_order3 = D('Order');
					$order3 = $m_order3
							->table('lb_order')
							->join('INNER JOIN lb_comment ON lb_order.id = lb_comment.order_id')
							->field('lb_order.*,lb_comment.fen as fen')
							->where('lb_order.jdopenid = lb_comment.openid')
							->find();
							//var_dump($order3);exit;
							$this->assign('order3',$order3);




			}else{  
				   $m_order->demand =  $_POST['demand'];
					//var_dump($_POST);exit;
					 $m_order->where('lb_order.id='.$order_id)->save($_POST);
					 $this->redirect('Order/liushi/p/'.I('get.p'));
				}
					// echo $m_order->getLastSQL();exit;	
					//echo $m_order1->getLastSQL();exit;
			$this->display();	
	}


	/**
	 * 取消任务的详情
	 */

	public function cancelkAction($order_id)
	{
		$m_order = D('Order');

					if(!IS_POST){
						$order = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
					->field('lb_order.*,lb_user.nickname as username')
					->where("lb_order.id = '$order_id'")
					->find();
					$this->assign('order', $order);
					// echo $m_order->getLastSQL();exit;
				 //var_dump($order);exit;
					
			//匹配jdopenid
					$m_order1 = D('Order');
					$order1 = $m_order1
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.jdopenid = lb_user.openid")
					->field('lb_order.*,lb_user.name or phone as username1,lb_user.*')
					->where("lb_order.id = '$order_id'")
					//->order('id desc')
					->find();

					$this->assign('order1', $order1);

			//匹配dingdanzhaopain
					// var_dump($order1);exit;
				if($order['leixing']==1){
					$m_order2 = D('Order');
					$order2 = $m_order2
							->table('lb_order')
							->join('INNER JOIN lb_dingdanzhaopian ON lb_order.id = lb_dingdanzhaopian.order_id')
							->field('lb_order.*,lb_dingdanzhaopian.zhaopian as zhaopian')
							->where("lb_order.id = $order_id ")
							->select();

//var_dump($order2);exit;
					$this->assign('path','dingdan');
					$this->assign('order2',$order2);
				}else{
			//匹配xinxianshizhaopain
					$order2 = D('Order');
					$order2 = $order2
							->table('lb_order')
							->join('INNER JOIN lb_xinxianshizhaopian ON lb_order.xinxianshiid = lb_xinxianshizhaopian.xinxianshiid')
							->field('lb_order.*,lb_xinxianshizhaopian.zhaopian as zhaopian')
							->where("lb_order.id = $order_id ")
							->select();

// var_dump($order4);exit;
					$this->assign('path','xinxianshi');
					$this->assign('order2',$order2);

				}

					
			//匹配 fen		
			
						$m_order3 = D('Order');
						$order3 = $m_order3
							->table('lb_order')
							->join('INNER JOIN lb_comment ON lb_comment.openid = lb_order.jdopenid ')
							->field('lb_order.*,avg(lb_comment.fen) as fen')
							->where("lb_order.id = '$order_id' and lb_comment.plbs = 2")
							->find();
							//var_dump($order3);exit;
							//echo $m_order3->getLastSQL();exit;			
						$this->assign('order3',$order3);

				$fens = $order3['fen'];	
				$img1 = '<img src="/img/xing1.png" height="15"/>';		
				$img2 = '<img src="/img/xing2.png" height="15"/>';		
				$img3 = '<img src="/img/xing3.png" height="15"/>';		
switch ($fens){
				  case 0:
					$pfs=$img3.$img3.$img3.$img3.$img3;
					$fens=5;
					break;
				  case 1>$fens:
					$pfs=$img2.$img1.$img1.$img1.$img1;
					break;
				  case 1:
					$pfs=$img3.$img1.$img1.$img1.$img1;
					break;
				  case 2>$fens:
					$pfs=$img3.$img2.$img1.$img1.$img1;
					break;
				  case 2:
					$pfs=$img3.$img3.$img1.$img1.$img1;
					break;
				  case 3>$fens:
					$pfs=$img3.$img3.$img1.$img1.$img1;
					break;
				  case 3:
					$pfs=$img3.$img3.$img3.$img1.$img1;
					break;
				  case 4>$fens:
					$pfs=$img3.$img3.$img3.$img2.$img1;
					break;
				  case 4:
					$pfs=$img3.$img3.$img3.$img3.$img1;
					break;
				  case 5>$fens:
					$pfs=$img3.$img3.$img3.$img3.$img2;
					break;
				default;
        		$pfs=$img3.$img3.$img3.$img3.$img3;
				$fens=5;
				break;
		  }	
$this->assign('pfs',$pfs);






			}else{  
				   	$m_order->demand =  $_POST['demand'];
					//var_dump($_POST);exit;
					$m_order->where('lb_order.id='.$order_id)->save($_POST);
					$this->redirect('Order/cancel/p/'.I('get.p'));  
				}
					// echo $m_order->getLastSQL();exit;	
					//echo $m_order1->getLastSQL();exit;
			$this->display();	

	}


public function finishkAction($order_id)
	{
		$m_order = D('Order');

					if(!IS_POST){
						$order = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
					->field('lb_order.*,lb_user.nickname as username')
					->where("lb_order.id = '$order_id'")
					->find();
					$this->assign('order', $order);
					// echo $m_order->getLastSQL();exit;
				 //var_dump($order);exit;
					
			//匹配jdopenid
					$m_order1 = D('Order');
					$order1 = $m_order
					->table('lb_order')
					->join("INNER JOIN lb_user ON lb_order.jdopenid = lb_user.openid")
					->field('lb_order.*,lb_user.name or phone as username1,lb_user.*')
					->where("lb_order.id = $order_id")
					//->order('id desc')
					->find();

					$this->assign('order1', $order1);

			//匹配dingdanzhaopain

				if($order['leixing']==1){
					$m_order2 = D('Order');
					$order2 = $m_order2
							->table('lb_order')
							->join('INNER JOIN lb_dingdanzhaopian ON lb_order.id = lb_dingdanzhaopian.order_id')
							->field('lb_order.*,lb_dingdanzhaopian.zhaopian as zhaopian')
							->where("lb_order.id = $order_id ")
							->select();

//var_dump($order2);exit;
					$this->assign('path','dingdan');
					$this->assign('order2',$order2);
				}else{
			//匹配xinxianshizhaopain
					$order2 = D('Order');
					$order2 = $order2
							->table('lb_order')
							->join('INNER JOIN lb_xinxianshizhaopian ON lb_order.xinxianshiid = lb_xinxianshizhaopian.xinxianshiid')
							->field('lb_order.*,lb_xinxianshizhaopian.zhaopian as zhaopian')
							->where("lb_order.id = $order_id ")
							->select();

// var_dump($order4);exit;
					$this->assign('path','xinxianshi');
					$this->assign('order2',$order2);

				}

					
			//匹配 fen		
			
						$m_order3 = D('Order');
						$order3 = $m_order3
							->table('lb_order')
							->join('INNER JOIN lb_comment ON lb_comment.openid = lb_order.jdopenid ')
							->field('lb_order.*,avg(lb_comment.fen) as fen')
							->where("lb_order.id = '$order_id' and lb_comment.plbs = 2 ")
							->find();
							//var_dump($order3);exit;
							//echo $m_order3->getLastSQL();exit;			
						$this->assign('order3',$order3);

				$fens = $order3['fen'];	
				$img1 = '<img src="/img/xing1.png" height="15"/>';		
				$img2 = '<img src="/img/xing2.png" height="15"/>';		
				$img3 = '<img src="/img/xing3.png" height="15"/>';		
switch ($fens){
				  case 0:
					$pfs=$img3.$img3.$img3.$img3.$img3;
					$fens=5;
					break;
				  case 1>$fens:
					$pfs=$img2.$img1.$img1.$img1.$img1;
					break;
				  case 1:
					$pfs=$img3.$img1.$img1.$img1.$img1;
					break;
				  case 2>$fens:
					$pfs=$img3.$img2.$img1.$img1.$img1;
					break;
				  case 2:
					$pfs=$img3.$img3.$img1.$img1.$img1;
					break;
				  case 3>$fens:
					$pfs=$img3.$img3.$img1.$img1.$img1;
					break;
				  case 3:
					$pfs=$img3.$img3.$img3.$img1.$img1;
					break;
				  case 4>$fens:
					$pfs=$img3.$img3.$img3.$img2.$img1;
					break;
				  case 4:
					$pfs=$img3.$img3.$img3.$img3.$img1;
					break;
				  case 5>$fens:
					$pfs=$img3.$img3.$img3.$img3.$img2;
					break;
				default;
        		$pfs=$img3.$img3.$img3.$img3.$img3;
				$fens=5;
				break;
		  }	
$this->assign('pfs',$pfs);






			}else{  
				   	$m_order->demand =  $_POST['demand'];
					//var_dump($_POST);exit;
					$m_order->where('lb_order.id='.$order_id)->save($_POST);
					$this->redirect('Order/finish/p/'.I('get.p'));  
				}
					// echo $m_order->getLastSQL();exit;	
					//echo $m_order1->getLastSQL();exit;
			$this->display();	

	}






	/**
	 * 进行中任务搜索
	 */

	public function fetchAction()
	{	
		// 考虑分页
		$m_order = M('Order');
		$pagesize = 10;
		$page = I('get.p', '1');

		
		if ($_GET['sosuo'] == 1) {
			$where['lb_order.status'] = 3;
			$where['lb_order.status'] = 2;
			$where['lb_order.tel']=$_GET['value'];
		}
		if ($_GET['sosuo'] == 2) {
			
			$where['lb_order.ordernum']=$_GET['value'];
		}

			
			$order_list = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('lb_order.*,lb_user.nickname as username')
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

		$total = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('count(lb_order.id) as total')
			->where($where)
			->find();

		// $tota = $m_order->where($where)->count();
		$t_page = new Page($total['total'], $pagesize);
		$this->assign('page_html', $t_page->show());
		$this->display('Order/list');
		//页面下显示echo $m_order->getLastSQL();
		
	}

	/**
	 * 未支付任务搜索
	 */

	public function fetch1Action()
	{	
		// 考虑分页
		$m_order = M('Order');
		$pagesize = 10;
		$page = I('get.p', '1');

		
		if ($_GET['sosuo'] == 1) {

			$where['lb_order.jdopenid'] = '';
			$where['lb_order.status'] = 0;
			$where['lb_order.tel']=$_GET['value'];
		}
		if ($_GET['sosuo'] == 2) {
			
			$where['lb_order.ordernum']=$_GET['value'];
		}
		//$where['_logic']='OR';

			$order_list = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('lb_order.*,lb_user.nickname as username')
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

		$total = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('count(lb_order.id) as total')
			->where($where)
			->find();

		// $total= $m_order->where($where)->count();
		$t_page = new Page($total['total'], $pagesize);
		$this->assign('page_html', $t_page->show());
		$this->display('Order/nopay');
		//页面下显示echo $m_order->getLastSQL();
		
	}


	/**
	 * 流失任务搜索
	 */

	public function fetch2Action()
	{	
		// 考虑分页
		$m_order = M('Order');
		$pagesize = 10;
		$page = I('get.p', '1');

		
		if ($_GET['sosuo'] == 1) {
			$where['lb_order.jdopenid'] = '';
			$where['lb_order.tel']=$_GET['value'];
		}
		if ($_GET['sosuo'] == 2) {
			
			$where['lb_order.ordernum']=$_GET['value'];
		}
		//$where['_logic']='OR';

			$order_list = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('lb_order.*,lb_user.nickname as username')
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

		$total = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('count(lb_order.id) as total')
			->where($where)
			->find();

		// $tota = $m_order->where($where)->count();
		$t_page = new Page($total['total'], $pagesize);
		$this->assign('page_html', $t_page->show());
		$this->display('Order/liushi');
		//页面下显示echo $m_order->getLastSQL();
		
	}

	/**
	 * 取消订单搜索列表
	 */
	public function fetch3Action()
	{
		// 考虑分页
		$m_order = M('Order');
		$pagesize = 10;
		$page = I('get.p', '1');

		
		if ($_GET['sosuo'] == 1) {
			// $where['jdopenid'] = '';
			$where['lb_order.status'] = 5;
			$where['lb_order.tel']=$_GET['value'];
		}
		if ($_GET['sosuo'] == 2) {
			
			$where['lb_order.ordernum']=$_GET['value'];
		}
		//$where['_logic']='OR';

			$order_list = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('lb_order.*,lb_user.nickname as username')
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

		$total = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('count(lb_order.id) as total')
			->where($where)
			->find();

		// $tota = $m_order->where($where)->count();
		$t_page = new Page($total['total'], $pagesize);
		$this->assign('page_html', $t_page->show());
		$this->display('Order/cancel');
	}

	/**
	 * 完成任务的搜索
	 */

	public function fetch4Action()
	{
		// 考虑分页
		$m_order = M('Order');
		$pagesize = 10;
		$page = I('get.p', '1');

		
		if ($_GET['sosuo'] == 1) {
			// $where['jdopenid'] = '';
			$where['lb_order.status'] = 4;
			$where['lb_order.tel']=$_GET['value'];
		}
		if ($_GET['sosuo'] == 2) {
			
			$where['lb_order.ordernum']=$_GET['value'];
		}

			$order_list = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('lb_order.*,lb_user.nickname as username')
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

		$total = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('count(lb_order.id) as total')
			->where($where)
			->find();

		// $tota = $m_order->where($where)->count();
		$t_page = new Page($total['total'], $pagesize);
		$this->assign('page_html', $t_page->show());
		$this->display('Order/finish');

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
		// $cond['is_deleted'] = '0';
		$cond['jdopenid'] = '';
		$cond['_string'] = "lb_order.pays != ''";
		// $cond['pays'] = 1;
		$order_list = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('lb_order.*,lb_user.nickname as username')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
		// var_dump($order_list);exit;
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
		// $cond['is_deleted'] = '0';
		$cond['lb_order.status'] = 0;
		$cond['lb_order.pays'] = '';
		$order_list = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('lb_order.*,lb_user.nickname as username')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
			//var_dump($order_list);exit;
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
	 * 展示取消订单列表cancel
	 */
	public function cancelAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_order = M('order');
		// 通用查询条件
		// $cond['is_deleted'] = '0';
		//$cond['jdopenid'] = '';
		$cond['lb_order.status'] = 5;
		$order_list = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('lb_order.*,lb_user.nickname as username')
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
	// 
	/**
	 *完成任务
	 */
	public function finishAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_order = M('order');
		// 通用查询条件
		// $cond['is_deleted'] = '0';
		$cond['lb_order.status'] = '4';
		$order_list = $m_order
			->table('lb_order')
			->join("INNER JOIN lb_user ON lb_order.openid = lb_user.openid ")
			->field('lb_order.*,lb_user.nickname as username')
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

}