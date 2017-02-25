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
		//
				// foreach ($order_list as &$order) 
				// {
				// $m_user = M('User');
				// $list = $m_user->field('name')
		  //   	->where(user.openid == order.openid)
		  //   	->select();//("select name from user where user.openid = order.openid");
		  //   	var_dump($list);exit;
		  //   	if($list){
		  //       $this->assign('list', $list );
		  //       $this->display();
		  //   	 } else {
		  //       $this->error($Dao->getError());
		  //  		 }
					
				// }
		// $m_user = M('User');
		// $list = $m_user->field('name')
  //   	->where(user.openid == order.openid)
  //   	->select();//("select name from user where user.openid = order.openid");
  //   	//var_dump($list);exit;
  //   	if($list){
  //       $this->assign('list', $list );
  //       $this->display();
  //   	 } else {
  //       $this->error($Dao->getError());
  //  		 }
		//

		$m_order = M('order');
		// 通用查询条件
		//
		//$Model->join('LEFT JOIN work ON artist.id = work.artist_id')->select();
		//

		//$cond['is_deleted'] = '0';
		$m_user = M('User');
		// $ll=$m_user->field('name')->select();
		//
		// $categories=M("Categories");
		// $category=$categories->table('xpf_categories')->join('xpf_log on xpf_categories.id=xpf_log.categoryid')->field('xpf_categories.*,count(xpf_log.categoryid) as artnum')->group('xpf_log.categoryid')->select();
		//
		// var_dump($ll);
		$order_list = $m_order
			->table('lb_order')
			->join('lb_user ON lb_order.openid = lb_user.openid')
			//->on($cond)
			->field('lb_order.*,lb_user.name as username')
			->order('id desc')
			->page($page, $pagesize)
			->select();
			// var_dump($order['id']);exit;
		  //   	$m_user = M('User');
				// $list = $m_user->field('name')
		  //   	->where(user.openid == order.openid)
		  //   	->select();//("select name from user where user.openid = order.openid");
		  //   	//var_dump($list);exit;
		  //   	if($list){
		  //       $this->assign('list', $list );
		  //       //$this->display();
		  //   	 } else {
		  //       $this->error($Dao->getError());
		  //  		 }

			// $list = $m_user->table('user,order')->where('user.openid = order.openid')->field('user.openid,user.name, order.openid')->select();
			// dump($list);
			// exit;
		//$m_user = M('User');
		// $db = new Model();
		// $sql = "select user.name,user.openid,order.openid from user,order where user.openid = order.openid";
		// $result = $m_user->query($sql);
		// dump($result);
		// exit;
		
		// 通用查询条件
		// $cond['openid'] = '0';
		// $user_list = $m_user
		// 	->field('id,name,openid')
		// 	->where($cond)
		// 	->order('id desc')
		// 	->page($page, $pagesize)
		// 	->select();
			//var_dump($order_list);
		// 将日期格式化
		foreach ($order_list as &$order) 
		{
			$order['addtime'] = date("Y-m-d", $order['addtime']);
			$order['starttime'] = date("Y-m-d", $order['starttime']);
			$order['jdtime'] = date("Y-m-d", $order['jdtime']);
			$order['endtime'] = date("Y-m-d", $order['endtime']);
			$order['paytime'] = date("Y-m-d", $order['paytime']);
	
		// $m_user = M('User');
		// $list = $m_user->field('name')
  //   	->where(user.openid == order.openid)
  //   	->select();//("select name from user where user.openid = order.openid");
    	
  //   	var_dump($list);exit;
  //   	$this->assign('list', $list );
        //$this->display();

		}
		$this->assign('order_list', $order_list);
		//var_dump($order['username']);
		//$this->assign('list', $list );
        

		$total = $m_order->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
	}
	// public function read(){
 //   		 // 实例化一个空模型，没有对应任何数据表
 //    	$Dao = M();
 //    	//或者使用 $Dao = new Model();

 //    	$list = $Dao->query("select user.name,user.openid,order.openid from user,order where user.openid = order.openid");
 //    	var_dump($list);exit;
 //    	if($list){
 //        $this->assign('list', $list );
 //        $this->display();
 //    	 } else {
 //        $this->error($Dao->getError());
 //   		 }
	// 	}


	// /**
	//  * 添加订单
	//  */
	// public function addAction()
	// {
	// 	// 判断当前是post还是get
	// 	if (IS_POST)
	// 	{
	// 		$m_order = D('order');

	// 		// 上传文件的处理
	// 		$t_upload = new Upload();
	// 		// 配置上传属性
	// 		$t_upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
	// 		$t_upload->rootPath = './Upload/Order/'; // 设置附件上传根目录
	// 		if ($info = $t_upload->uploadOne($_FILES['cover']))
	// 		{
	// 			// 上传成功
	// 			// 生成缩略图
	// 			$t_image = new Image();
	// 			$t_image->open($t_upload->rootPath . $info['savepath'] . $info['savename']);
	// 			$thumb_rootpath = './Public/Thumb/Order/';
	// 			$thumb_savepath = $info['savepath'];
	// 			if (!is_dir($thumb_rootpath . $thumb_savepath))
	// 			{
	// 				mkdir($thumb_rootpath . $thumb_savepath, 755, true);
	// 			}
	// 			$thumb_savename = $info['savename'];
		
	// 			$t_image->thumb(800, 540)->save($thumb_rootpath . $thumb_savepath . $thumb_savename);
			
	// 			$_POST['cover'] = $thumb_savepath . $thumb_savename;
	// 		}
	// 		// echo '<pre>';var_dump($info);die;
	// 		// 处理提交的数据
	// 		$result = $m_order->create(); // 默认去post中获取数据
	// 		if ($result)
	// 		{
	// 			// 数据校验通过
	// 			$category_id = $m_order->add();
	// 			if (category_id)
	// 			{
	// 				// 添加成功
	// 				$this->redirect('Order/list', [], 0);
	// 			}
	// 		}

	// 		// 数据插入或者验证存在问题
	// 		$this->error('添加订单失败：' . $m_order->getError(), U('Order/add'), 2);
	// 	}
	// 	else
	// 	{
	// 		// 展示添加表单
	// 		// 把分类分配给表单
	// 		$m_category = D('Category');
	// 		$category_list = $m_category->getTree();
	// 		$this->assign('category_list', $category_list);

	// 		$this->display();
	// 	}
	// }


	/**
	 * 修改订单
	 */
	public function editAction($order_id=0)
	{
		$m_order = D('Order');
		$m_order = M('order');
		$m_user = M('User');
		$order_list = $m_order
			->table('lb_order')
			->join('lb_user ON lb_order.openid = lb_user.openid')
			//->on($cond)
			->field('lb_order.*,lb_user.name as username')
			->order('id desc')
			->page($page, $pagesize)
			->select();
			foreach ($order_list as &$order) 
			{
			$order['addtime'] = date("Y-m-d", $order['addtime']);
			$order['starttime'] = date("Y-m-d", $order['starttime']);
			$order['jdtime'] = date("Y-m-d", $order['jdtime']);
			$order['endtime'] = date("Y-m-d", $order['endtime']);
			$order['paytime'] = date("Y-m-d", $order['paytime']);
			}
		$this->assign('order_list', $order_list);
		var_dump($order['username']);exit;
		$total = $m_order->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		//$this->display();

		if (IS_POST)
		{
			if ($m_order->create())
			{
				if ($m_order->save())
				{   
					
					//$this->redirect('list', [], 0);
				}
			}

			$this->error('数据更新失败：'.$m_order->getError(), U('edit', ['order_id'=>I('post.order_id')]), 2);
		}
		else
		{
			$m_category = D('Category');
			// 模型获取数状数据
			$category_list = $m_category->getTree();
			$this->assign('category_list', $category_list);


			$this->assign('order', $m_order->find($order_id));
			//$this->assign('order', $m_order->($order_id));
			
			$this->display();
		}

		//echo $m_order->getLastSQL;
		//var_dump($_GET);可以拿到值
	}

	// public function editAction($order_id=0)
	// {
	// 	$m_order = D('order');
	// 	if (IS_POST)
	// 	{
	// 		if ($m_order->create())
	// 		{
	// 			if ($m_order->save())
	// 			{
	// 				$this->redirect('list', [], 0);
	// 			}
	// 		}

	// 		$this->error('数据更新失败：'.$m_order->getError(), U('edit', ['order_id'=>I('post.order_id')]), 2);
	// 	}
	// 	else
	// 	{
	// 		$m_category = D('Category');
	// 		// 模型获取数状数据
	// 		$category_list = $m_category->getTree();
	// 		$this->assign('category_list', $category_list);

	// 		$this->assign('order', $m_order->find($order_id));
			
	// 		$this->display();
	// 	}
	// }


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
}