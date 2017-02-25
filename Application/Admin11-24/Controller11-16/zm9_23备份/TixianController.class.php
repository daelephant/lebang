<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class TixianController extends Controller
{
	
	public function listAction()
		{	
//////三表联合查询$Model = M('T1');$Model->join('t2 on t1.id = t2.uid', 'left')->join('t3 on t2.uid = t3.sid', 'left')->select();					
					// 考虑分页
					$pagesize = 10;
					$page = I('get.p', '1');

					$m_tixian = M('Tixian');
					// 通用查询条件
					// $cond['is_deleted'] = '0';
					$tixian_list = $m_tixian
					->table('lb_tixian')
					->join("LEFT JOIN lb_user ON lb_tixian.openid = lb_user.openid")
					->join("LEFT JOIN lb_bank ON lb_tixian.bankid = lb_bank.id")
					->field('lb_tixian.*,lb_user.name as name,lb_user.phone as phone,lb_user.idnumber as idnumber,lb_bank.bank as bank,lb_bank.banknum as banknum')
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					// echo $m_tixian->getLastSQL();
					//var_dump($tixian_list);exit;
		// 将日期格式化
		foreach ($tixian_list as &$tixian) 
		{	
			//$moneys=sprintf("%.2f", $money);
			$tixian['money'] = sprintf("%.2f", $tixian['money']);//将金额设置为两位浮点型
			$tixian['addtime'] = date("Y-m-d H:s:i", $tixian['addtime']);
			// $tixian['logintimes'] = date("Y-m-d", $tixian['logintimes']);
			//$number=$tixian['status'];
			// if ($number==1) {
			// 	$tixian['status']="新用户";
			// }elseif ($number==2) {
			// 	$tixian['status']="审核中";
			// }else {
			// 	$tixian['status']="雷锋";
			// }
		}
		$this->assign('tixian_list', $tixian_list);

		$total = $m_tixian->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		//var_dump($tixian_list);exit;

	}
    /**
	 * 展示提现
	 */

    public function bianjiAction($id=0)
	{	//s
		if (IS_GET)
		{	
			//var_dump($_GET);exit;
			// $m_tixian = M('Tixian');
   //   				$a['id']=$_GET['tixian_id'];
   //   				$a['beizhu'] =$_GET['beizhu'];
   //   				$a['status']=1;

			// $m_tixian->save($a);
			// $tixian = M("Tixian"); // 实例化User对象// 要修改的数据对象属性赋值
			// $date['status']= '1';
			// $data['beizhu'] = $_GET['beizhu'];
			// //$date['status']= '1';

			// $tixian->where('id=12')->save($data); // 根据条件更新记录sql="select * from biao where o='"+a+"'"

			$Tixian = M("Tixian"); // 实例化User对象// 要修改的数据对象属性赋值
			$map['id'] = $_GET['tixian_id'];
			//$a=$_GET['tixian_id'];var_dump($a);
			//var_dump($_GET);exit;
			$Tixian->status = $_GET['status'];
			//
$time = time(); //当前时间戳
			$date = date('Y',$time). '-' . date('m-d H:i:s');//一年前日期
			//
			$Tixian->beizhu = $date.$_GET['beizhu'];
			$Tixian->where($map)->save(); // 根据条件更新记录
			// echo $Tixian->getLastSQL();exit;
			$this->success('OK：' , U('Tixian/list'), 2);
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
	 * 展示user待审核列表list1
	 */
	public function list1Action()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '1';
		$user_list = $m_user
			->field('id,name,phone,idnumber,status,status,regtime,logintimes')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->group('id')
			->select();
		
		// 将日期格式化
		foreach ($user_list as &$user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
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
	/**
	 * 展示user待审核列表list3
	 */
	public function list3Action()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '3';
		$user_list = $m_user
			->field('id,name,phone,idnumber,status,status,regtime,logintimes')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
		
		// 将日期格式化
		foreach ($user_list as &$user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
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
			->field('id,name,phone,idnumber,status,status,regtime,logintimes')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
		
		// 将日期格式化
		foreach ($user_list as &$user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
			$user['regtime'] = date("Y-m-d", $user['regtime']);
			$user['logintimes'] = date("Y-m-d", $user['logintimes']);
			$number=$user['status'];
			if ($number==1) {
				$user['status']="新用户";
			}elseif ($number==2) {
				$user['status']="审核中";
			}elseif ($number==4) {
				$user['status']="审核未通过";
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

		// 判断当前是post还是get
		if (IS_POST)
		{
			$m_user = D('User');
			$m_sms = D('Sms');


			// 处理提交的数据
			$m_user->create(); // 默认去post中获取数据
			$m_sms->create(); // 默认去post中获取数据
			//user表：
			$m_user->birthday = strtotime($_POST['birthday']);
			$m_user->regtime = time();
			$m_user->logintimes = time();
			$m_user->openid = md5($_POST['phone'].time());
			$m_user->nickname = $_POST['name'];
			

			//sms表：
			$time = time(); //当前时间戳
			$date = date('Y',$time) - 1 . '-' . date('m-d H:i:s');//一年前日期
			$time = strtotime($date);
			//var_dump($time,$date);exit;
			$m_sms->senttime = $time;
			// 数据校验通过
			$m_user->add();
			$m_sms->add();
			

				
			// 数据插入或者验证存在问题
			$this->success('OK：' . $m_user->getError(), U('User/list'), 1);
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
	public function bianjiActionbar($user_id=0)
	{

		// 通用查询条件
		$m_user = M('User');
			//匹配userid并展示：
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
		if (IS_POST)
		{
			$m_user = D('User');

		
			// 处理提交的数据
			$m_user->create(); // 默认去post中获取数据
			$m_user->birthday = strtotime($_POST['birthday']);
			$m_user->regtime = time();
			$m_user->logintimes = time();
				// 数据校验通过
			$m_user->save();
				
			// 数据插入或者验证无存在问题
			$this->success('OK：' , U('User/list'), 2);
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
	public function fetchAction()
	{	
		$_GET['endtime']=strtotime($_GET['endtime']);
		$_GET['starttime']=strtotime($_GET['starttime']);
		//var_dump($_GET['starttime']);exit;
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		//$cond['is_deleted'] = '0';
		// $userForm=M('user'); 
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

			$user_list = $m_user
			->field('id,name,phone,idnumber,status,status,regtime,logintimes')
			->where($where)
			->order('id desc')
			->page($page, $pagesize)

			->select();

			//echo $m_user->getLastSQL();
		foreach ($user_list as &$user) 
		{	
			$user['moneys'] = sprintf("%.2f", $user['moneys']);//将金额设置为两位浮点型
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