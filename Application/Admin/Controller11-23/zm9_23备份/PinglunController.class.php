<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class XinxianshiController extends Controller
{
	
	public function listAction()
		{	
					
				// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					$m_xinxianshi = M('Xinxianshi');
					// 通用查询条件
					$cond['beipinglunid'] = '0';
					//$Model->join('t2 on t1.id = t2.uid', 'left')->join('t3 on t2.uid = t3.sid', 'left')->select();
					$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.name as name,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					//var_dump($xinxianshi_list);exit;
					//echo $m_xinxianshi->getLastSQL();
					//var_dump($xinxianshi_list);exit;
		// 将日期格式化
		// foreach ($xinxianshi_list as &$xinxianshi) 
		// {	
		// 	//$moneys=sprintf("%.2f", $money);
		// 	$xinxianshi['moneys'] = sprintf("%.2f", $xinxianshi['moneys']);//将金额设置为两位浮点型
		// 	$xinxianshi['regtime'] = date("Y-m-d H:s:i", $xinxianshi['regtime']);
		// 	$xinxianshi['logintimes'] = date("Y-m-d H:s:i", $xinxianshi['logintimes']);
		// 	$number=$xinxianshi['status'];
		// 	if ($number==1) {
		// 		$xinxianshi['status']="新事";
		// 	}elseif ($number==2) {
		// 		$xinxianshi['status']="审核中";
		// 	}else {
		// 		$xinxianshi['status']="雷锋";
		// 	}
		// }
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		//var_dump($xinxianshi_list);exit;

	}
	//
	//
	/**
	 * 展示xinxianshi待审核列表list1
	 */
	public function list1Action()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_xinxianshi = M('Xinxianshi');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '1';
		$xinxianshi_list = $m_xinxianshi
			->field('id,name,phone,idnumber,status,status,regtime,logintimes')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
		
		// 将日期格式化
		foreach ($xinxianshi_list as &$xinxianshi) 
		{	
			$xinxianshi['moneys'] = sprintf("%.2f", $xinxianshi['moneys']);//将金额设置为两位浮点型
			$xinxianshi['regtime'] = date("Y-m-d H:s:i", $xinxianshi['regtime']);
			$xinxianshi['logintimes'] = date("Y-m-d H:s:i", $xinxianshi['logintimes']);
			$number=$xinxianshi['status'];
			if ($number==1) {
				$xinxianshi['status']="新事";
			}elseif ($number==2) {
				$xinxianshi['status']="审核中";
			}else {
				$xinxianshi['status']="雷锋";
			}
		}
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();

	}
	/**
	 * 展示xinxianshi待审核列表list3
	 */
	public function list3Action()
	{
		// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					$m_xinxianshi = M('Xinxianshi');
					// 通用查询条件
					// $cond['is_deleted'] = '0';
					//$Model->join('t2 on t1.id = t2.uid', 'left')->join('t3 on t2.uid = t3.sid', 'left')->select();
					$cond['beipinglunid'] = '0';

					$cond['lb_xinxianshi.xianshi'] = '1';
					$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.name as name,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					//echo $m_xinxianshi->getLastSQL();
					//var_dump($xinxianshi_list);exit;
		// 将日期格式化
		// foreach ($xinxianshi_list as &$xinxianshi) 
		// {	
		// 	//$moneys=sprintf("%.2f", $money);
		// 	$xinxianshi['moneys'] = sprintf("%.2f", $xinxianshi['moneys']);//将金额设置为两位浮点型
		// 	$xinxianshi['regtime'] = date("Y-m-d H:s:i", $xinxianshi['regtime']);
		// 	$xinxianshi['logintimes'] = date("Y-m-d H:s:i", $xinxianshi['logintimes']);
		// 	$number=$xinxianshi['status'];
		// 	if ($number==1) {
		// 		$xinxianshi['status']="新事";
		// 	}elseif ($number==2) {
		// 		$xinxianshi['status']="审核中";
		// 	}else {
		// 		$xinxianshi['status']="雷锋";
		// 	}
		// }
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		//var_dump($xinxianshi_list);exit;

	}
	/**
	 * 展示xinxianshi待审核列表list4
	 */
	
	public function list4Action()
	{
		// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					$m_xinxianshi = M('Xinxianshi');
					// 通用查询条件
					// $cond['is_deleted'] = '0';
					//$Model->join('t2 on t1.id = t2.uid', 'left')->join('t3 on t2.uid = t3.sid', 'left')->select();
					$cond['lb_xinxianshi.beipinglunid'] = '0';
					$cond['lb_xinxianshi.xianshi'] = '0';
					$cond['_logic'] = 'and';
					$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.name as name,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					//echo $m_xinxianshi->getLastSQL();exit;
					//echo $m_xinxianshi->getLastSQL();
					//var_dump($xinxianshi_list);exit;
		// 将日期格式化
		// foreach ($xinxianshi_list as &$xinxianshi) 
		// {	
		// 	//$moneys=sprintf("%.2f", $money);
		// 	$xinxianshi['moneys'] = sprintf("%.2f", $xinxianshi['moneys']);//将金额设置为两位浮点型
		// 	$xinxianshi['regtime'] = date("Y-m-d H:s:i", $xinxianshi['regtime']);
		// 	$xinxianshi['logintimes'] = date("Y-m-d H:s:i", $xinxianshi['logintimes']);
		// 	$number=$xinxianshi['status'];
		// 	if ($number==1) {
		// 		$xinxianshi['status']="新事";
		// 	}elseif ($number==2) {
		// 		$xinxianshi['status']="审核中";
		// 	}else {
		// 		$xinxianshi['status']="雷锋";
		// 	}
		// }
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		//var_dump($xinxianshi_list);exit;

	}

	//list5被举报的评论列表：
	public function list5Action($xinxianshi_id=0)
		{	
					
			// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					 $m_xinxianshi = M('Xinxianshi');
            //匹配xinxianshiid并展示：
             //var_dump($xinxianshi_id);exit;s
                    //$cond['beipinglunid'] = $xinxianshi_id;
                    $cond['lb_xinxianshi.xianshi'] = '0';
                    $cond['lb_xinxianshi.beipinglunid'] = '1';
                    $m_xinxianshi = D('Xinxianshi');
                    $xinxianshi = $m_xinxianshi
                   ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('lb_xinxianshi.*,lb_user.name as name,lb_shequ.mingcheng as mingcheng')
                    ->where($cond)
                    ->order('id desc')
                    ->page($page, $pagesize)
                    ->group('id')
                    ->select();
                    //var_dump($xinxianshi);exit;
		$this->assign('xinxianshi', $xinxianshi);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		//var_dump($xinxianshi);exit;

		}
	//编辑器
	public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }


	/**
	 * 添加事
	 */
	public function addAction()
	{

		// 判断当前是post还是get
		if (IS_POST)
		{
			$m_xinxianshi = D('Xinxianshi');
			$m_sms = D('Sms');


			// 处理提交的数据
			$m_xinxianshi->create(); // 默认去post中获取数据
			$m_sms->create(); // 默认去post中获取数据
			//xinxianshi表：
			$m_xinxianshi->birthday = strtotime($_POST['birthday']);
			$m_xinxianshi->regtime = time();
			$m_xinxianshi->logintimes = time();
			$m_xinxianshi->openid = md5($_POST['phone'].time());
			$m_xinxianshi->nickname = $_POST['name'];
			

			//sms表：
			$time = time(); //当前时间戳
			$date = date('Y',$time) - 1 . '-' . date('m-d H:i:s');//一年前日期
			$time = strtotime($date);
			//var_dump($time,$date);exit;
			$m_sms->senttime = $time;
			// 数据校验通过
			$m_xinxianshi->add();
			$m_sms->add();
			

				
			// 数据插入或者验证存在问题
			$this->success('OK：' . $m_xinxianshi->getError(), U('Xinxianshi/list'), 1);
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
	 * 编辑前展示xinxianshi
	 */
	public function bianjiAction($id=0)
	{	
			// 判断当前是post还是get
		if (IS_GET)
		{
			$m_xinxianshi = M("Xinxianshi");

					
     				//var_dump($_GET);
     				$data['id']=$_GET['xinxianshi_id'];
     				$data['beizhu'] =$_GET['beizhu'];
     				$data['xianshi'] = 0;
 // $User = M("User"); // 实例化User对象// 要修改的数据对象属性赋值
  // $data['id'] = 5;$data['name'] = 'ThinkPHP';$data['email'] = 'ThinkPHP@gmail.com';
  // $User->save($data); // 根据条件保存修改的数据
  //   				
			
			$m_xinxianshi->save($data);
			//echo $m_xinxianshi->getLastSQL();exit;
				
			// 数据插入或者验证无存在问题
			$this->success('OK：' , U('Xinxianshi/list'), 2);
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
//end

	/**
	 * 修改事
	 */
	public function editAction($xinxianshi_id=0)
	{
		$m_xinxianshi = D('Xinxianshi');
		if (IS_POST)
		{
			if ($m_xinxianshi->create())
			{
				if ($m_xinxianshi->save())
				{
					$this->redirect('list', [], 0);
				}
			}

			$this->error('数据更新失败：'.$m_xinxianshi->getError(), U('edit', ['xinxianshi_id'=>I('post.xinxianshi_id')]), 2);
		}
		else
		{
			$m_category = D('Category');
			// 模型获取数状数据
			$category_list = $m_category->getTree();
			$this->assign('category_list', $category_list);

			$this->assign('xinxianshi', $m_xinxianshi->find($xinxianshi_id));
			//$this->assign('xinxianshi', $m_xinxianshi->($xinxianshi_id));
			
			$this->display();
		}

		//echo $m_xinxianshi->getLastSQL;
		//var_dump($_GET);可以拿到值
	}


	/**
	 * 删除事
	 */
	public function removexinxianshi($xinxianshi_id=0)
	{
		$m_xinxianshi = M('xinxianshi');
		if (false === $m_xinxianshi->delete($xinxianshi_id))
		{
			$this->error('删除数据失败：'.$m_xinxianshi->getError(), U('list'), 2);
		}
		else
		{
			$this->redirect('list', [], 0);
		}
	}
	/**
	 * 审核事
	 */
	//false
	public function checkAction()
	{
			//var_dump($_GET);
		    $m_xinxianshi = M('xinxianshi');
		    $num=($_GET['xinxianshi_id']);
		    $map['id']  = array('eq',$num);

			$data['status'] = '1';
			$m_xinxianshi->where($map)->save($data);

			// echo $m_xinxianshi->getLastSQL();
			// var_dump($_GET['xinxianshi_id']);
			// $this->assign('xinxianshi_check', $xinxianshi_check);

			// $this->display();
			$this->redirect('list', [], 0);
	}
	//success
	public function successAction()
	{
			//var_dump($_GET);
		    $m_xinxianshi = M('xinxianshi');
		    $num=($_GET['xinxianshi_id']);
		    $map['id']  = array('eq',$num);

			$data['status'] = '3';
			$m_xinxianshi->where($map)->save($data);

			// echo $m_xinxianshi->getLastSQL();
			// var_dump($_GET['xinxianshi_id']);
			// $this->assign('xinxianshi_check', $xinxianshi_check);

			// $this->display();
			$this->redirect('list', [], 0);
	}
	/**
	 * 查询事
	 */
	public function fetchAction()
	{	
		$_GET['endtime']=strtotime($_GET['endtime']);
		$_GET['starttime']=strtotime($_GET['starttime']);
		//var_dump($_GET['starttime']);exit;
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_xinxianshi = M('Xinxianshi');
		// 通用查询条件
		//$cond['is_deleted'] = '0';
		// $xinxianshiForm=M('xinxianshi'); 
		//$where['phone']=array('like','131%');
		if ($_GET['phone']) {
			$where['phone']=$_GET['phone'];
		}
		if ($_GET['name']) {
			$where['name']=$_GET['name'];
		}
		if ($_GET['idnumber']) {
			$where['idnumber']=$_GET['idnumber'];
		}
		if ($_GET['starttime']) {
			$where['regtime'] = array('gt',$_GET['starttime']);
		}
		if ($_GET['endtime']) {
			$where['regtime'] = array('lt',$_GET['endtime']);
		}

		$where['regtime'] > $_GET['starttime'];
		$where['_logic']='OR';

			$xinxianshi_list = $m_xinxianshi
			->field('id,name,phone,idnumber,status,status,regtime,logintimes')
			->where($where)
			->order('id desc')
			->page($page, $pagesize)

			->select();

			//echo $m_xinxianshi->getLastSQL();
		foreach ($xinxianshi_list as &$xinxianshi) 
		{	
			$xinxianshi['moneys'] = sprintf("%.2f", $xinxianshi['moneys']);//将金额设置为两位浮点型
			$xinxianshi['regtime'] = date("Y-m-d H:s:i", $xinxianshi['regtime']);
			$xinxianshi['logintimes'] = date("Y-m-d H:s:i", $xinxianshi['logintimes']);
			$number=$xinxianshi['status'];
			if ($number==1) {
				$xinxianshi['status']="新事";
			}elseif ($number==2) {
				$xinxianshi['status']="审核中";
			}else {
				$xinxianshi['status']="雷锋";
			}
		}
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();

	}
	/**
	 * 充值事
	 */
	public function rechargeAction($xinxianshi_id=0)
	{			

		// 构造查询条件
				//var_dump($xinxianshi_id);
		    $xinxianshi_id=$_POST['xinxianshi_id'];
			$Dao = M("xinxianshi");
		    $condition['id'] = "$xinxianshi_id";
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
		  	
		   //var_dump($xinxianshi_id);
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
						$m_xinxianshi = M('Xinxianshi');
					// 通用查询条件
					// 	$cond['is_deleted'] = '0';
					$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_money ON lb_xinxianshi.openid = lb_money.openid")
					->field('lb_xinxianshi.*,SUM(lb_money.moneys) as moneys')
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
		foreach ($xinxianshi_list as &$xinxianshi) 
		{
			$xinxianshi['moneys'] = sprintf("%.2f", $xinxianshi['moneys']);//将金额设置为两位浮点型
			$xinxianshi['regtime'] = date("Y-m-d H:s:i", $xinxianshi['regtime']);
			$xinxianshi['logintimes'] = date("Y-m-d H:s:i", $xinxianshi['logintimes']);
			$number=$xinxianshi['status'];
			if ($number==1) {
				$xinxianshi['status']="新事";
			}elseif ($number==2) {
				$xinxianshi['status']="审核中";
			}else {
				$xinxianshi['status']="雷锋";
			}
		}
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();

		//
		$m_money = M('money');

		// if (false === $m_xinxianshi->delete($xinxianshi_id))
		// {
		// 	$this->error('删除数据失败：'.$m_xinxianshi->getError(), U('list'), 2);
		// }
		// else
		// {
		// 	$this->redirect('list', [], 0);
		 }
//start
		public function pingluncheckAction($xinxianshi_id=0)
		{	
					
			// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					 $m_xinxianshi = M('Xinxianshi');
            //匹配xinxianshiid并展示：
             //var_dump($xinxianshi_id);exit;s
                    $cond['beipinglunid'] = $xinxianshi_id;
                    $m_xinxianshi = D('Xinxianshi');
                    $xinxianshi = $m_xinxianshi
                   ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('lb_xinxianshi.*,lb_user.name as name,lb_shequ.mingcheng as mingcheng')
                    ->where($cond)
                    ->order('id desc')
                    ->page($page, $pagesize)
                    ->group('id')
                    ->select();
                    //var_dump($xinxianshi);exit;
		$this->assign('xinxianshi', $xinxianshi);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		//var_dump($xinxianshi);exit;

		}
//end
	
}