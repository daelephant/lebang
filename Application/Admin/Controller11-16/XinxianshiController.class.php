<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class XinxianshiController extends AuthController
{
	public function _initialize(){
         parent::_initialize();
    }
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
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					// if (empty($xinxianshi['mingcheng'])) {
					// 	$xinxianshi['mingcheng']='体验小区';
					// }
//echo $m_xinxianshi->getLastSQL();
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
		//echo $m_xinxianshi->getLastSQL();
//var_dump($xinxianshi_list);exit;
		$this->display();
		

	}
		public function list1Action()
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
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('dianzanshu desc')
					->page($page, $pagesize)
					->group('id')
					->select();

		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display('xinxianshi/list');
		//var_dump($xinxianshi_list);exit;

	}
	public function list2Action()
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
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('zhuanfashu desc')
					->page($page, $pagesize)
					->group('id')
					->select();

		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display('xinxianshi/list');
		//var_dump($xinxianshi_list);exit;

	}
	/**
	 * 举报数排序list11
	 */
	public function list11Action()
		{	
					
				// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					$m_xinxianshi = M('Xinxianshi');
					$m_jubao = M('jubao');
					// 通用查询条件
					$cond['beipinglunid'] = '0';
					//$cond['_string'] = 'lb_jubao.xinxiid = 70'; 
					//$Model->join('t2 on t1.id = t2.uid', 'left')->join('t3 on t2.uid = t3.sid', 'left')->select();
					$xinxianshi_list= $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->join("right JOIN lb_jubao ON lb_xinxianshi.id = lb_jubao.xinxiid")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_shequ.mingcheng as mingcheng,count(lb_jubao.xinxiid) as xinxiid,lb_jubao.openid,lb_jubao.jubaoid,lb_jubao.jubaoleixing,lb_jubao.chuli')
					->where($cond)
					->order('xinxiid desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					//var_dump($xinxianshi_list);exit;
					foreach ($xinxianshi_list as &$xinxianshi) 
					{	
						//$moneys=sprintf("%.2f", $money);
						// $xinxianshi['moneys'] = sprintf("%.2f", $xinxianshi['moneys']);//将金额设置为两位浮点型
						// $xinxianshi['regtime'] = date("Y-m-d H:s:i", $xinxianshi['regtime']);
						// $xinxianshi['logintimes'] = date("Y-m-d H:s:i", $xinxianshi['logintimes']);
						$number=$xinxianshi['jubaoid'];
						if ($number==14) {
							$xinxianshi['jubaoid']="不实信息";
						}elseif ($number==15) {
							$xinxianshi['jubaoid']="有害信息";
						}elseif ($number==16) {
							$xinxianshi['jubaoid']="人身攻击";
						}elseif ($number==17) {
							$xinxianshi['jubaoid']="淫秽色情";
						}
						else {
							$xinxianshi['jubaoid']="违法信息";
						}
					}
					// $date[_string] = 'lb_jubao.xinxiid = '; 
					// $jubaoSum = $m_jubao->where($date)->count();
//echo $m_xinxianshi->getLastSQL();
//dump($xinxianshi);exit;
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
		//echo $m_xinxianshi->getLastSQL();
//var_dump($xinxianshi);exit;
		$this->display('jubao');

	}


	public function list8Action()
		{	
					
				// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					$m_xinxianshi = M('Xinxianshi');
					// 通用查询条件
					$cond['beipinglunid'] = '0';
					$cond['_string'] = 'lb_xinxianshi.top != 0';
					//$Model->join('t2 on t1.id = t2.uid', 'left')->join('t3 on t2.uid = t3.sid', 'left')->select();
					$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					// if (empty($xinxianshi['mingcheng'])) {
					// 	$xinxianshi['mingcheng']='体验小区';
					// }
//echo $m_xinxianshi->getLastSQL();
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
		//echo $m_xinxianshi->getLastSQL();
//var_dump($xinxianshi_list);exit;
		$this->display();
		

	}
	public function list10Action()
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
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('pinglunshu desc')
					->page($page, $pagesize)
					->group('id')
					->select();

		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display('xinxianshi/list');
		//var_dump($xinxianshi_list);exit;

	}
	


	//start
	/**
	 * 编辑前展示xinxianshi
	 */
	public function bianji1Action($xinxianshi_id=0)
	{	
     	$m_xinxianshi = M('Xinxianshi');
     	$m_xinxianshizhaopian = M('Xinxianshizhaopian');

		if (IS_POST)
		{
			// var_dump($_POST);exit;
			$m_xinxianshi = D('Xinxianshi');
 			if(isset($_POST['pingbizhouqi'])){
 				$_POST['pingbizhouqi'] = time();
 			}
 			if(isset($_POST['zhidings'])){
 				$_POST['starttime'] = strtotime($_POST['starttime']);
 				$_POST['endtime'] = strtotime($_POST['endtime']);
 			}
 			
			// var_dump($_POST);exit;
			// 处理提交的数据
			$m_xinxianshi->create(); // 默认去post中获取数据
			$m_xinxianshi->where('id='.I('post.xinxianshi_id'))->save();

			// $cid="7269143c199f568a2e9e1c996fc77885";
			if(!empty($cid)){
				Vendor('Igetui.igts');
				$igt = new\igts();
				$content=json_encode(array('code'=>1008,"obj"=>array('id'=>$_GET['xinxianshiid'])));
	 			$refg=$igt->pushMessageToSingle($cid,$content,"管理员屏蔽了您的新鲜事"); 
	 			// print_r($refg);
	 			// exit;
			}
			$this->redirect('Xinxianshi/list3/p/'.I('get.p'));
			
		}





     	$cond['leixing'] = '1';
		$cond['lb_xinxianshi.xianshi'] = '1';
		$cond['lb_xinxianshi.id'] = $xinxianshi_id;
		$xinxianshi = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					// ->join('LEFT JOIN lb_xinxianshizhaopian ON lb_xinxianshi.id = lb_xinxianshizhaopian.xinxianshiid')
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->find();



			$this->assign('xinxianshi',$xinxianshi);

			$zhaopian = $m_xinxianshizhaopian->where('xinxianshiid='.$xinxianshi_id)->select();
			$this->assign('zhaopian',$zhaopian);
		
					
			// 展示添加表单
			// 把分类分配给表单
			$m_category = D('Category');
			$category_list = $m_category->getTree();
			$this->assign('category_list', $category_list);

			$this->display();


	}

	/**
	 * 查看屏蔽新鲜事
	 */

	public function pingbikAction($xinxianshi_id= 0)
	{

		$m_xinxianshi = M('Xinxianshi');
     	$m_xinxianshizhaopian = M('Xinxianshizhaopian');

     		if (IS_POST)
		{
			$m_xinxianshi = D('Xinxianshi');
			$m_xinxianshi->neirong = $_POST['neirong'];
			$m_xinxianshi->xianshi = $_POST['xianshi'];

			// var_dump( $_POST['neirong']);exit;
			// var_dump($_POST['xianshi']);exit;
			$m = $m_xinxianshi->where('id='.I('post.xinxianshi_id'))->save();


			$this->redirect('Xinxianshi/list4/p/'.I('get.p'));
			// var_dump($m);exit;
		}

     	$cond['leixing'] = '1';
		$cond['lb_xinxianshi.xianshi'] = '0';
		$cond['lb_xinxianshi.id'] = $xinxianshi_id;
		$xinxianshi = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->find();

					// var_dump($xinxianshi);exit;
			$this->assign('xinxianshi',$xinxianshi);

			$zhaopian = $m_xinxianshizhaopian->where('xinxianshiid='.$xinxianshi_id)->select();
			$this->assign('zhaopian',$zhaopian);


			$this->display();
		
	}

	/**
	 * 查看置顶新鲜事
	 */


	public function zhidingkAction($xinxianshi_id= 0)
	{

		$m_xinxianshi = M('Xinxianshi');
     	$m_xinxianshizhaopian = M('Xinxianshizhaopian');

     	if (IS_POST)
		{
			// echo '<pre>';
			// print_r($_POST);exit;
			$m_xinxianshi->zhiding = $_POST['zhiding'];
			$m = $m_xinxianshi->where('id='.I('post.xinxianshi_id'))->save();
			
			$this->redirect('Xinxianshi/zhiding/p/'.I('get.p'));
		}

					$cond['lb_xinxianshi.id'] = $xinxianshi_id;
					$cond['lb_xinxianshi.leixing'] = '1';
					$cond['_string'] = 'lb_xinxianshi.zhiding !=0';
                    $m_xinxianshi = D('Xinxianshi');
                    $xinxianshi = $m_xinxianshi
                    ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
                    ->where($cond)
                    ->order('id desc')
                    ->page($page, $pagesize)
                    ->group('id')
                    ->find();

					// var_dump($xinxianshi);exit;
			$this->assign('xinxianshi',$xinxianshi);

			$zhaopian = $m_xinxianshizhaopian->where('xinxianshiid='.$xinxianshi_id)->select();
			$this->assign('zhaopian',$zhaopian);


			$this->display();
		
	}




	//
	/**
	 * 展示xinxianshi待审核列表list1
	 */
	public function dianzhanlistAction()
	{
		// 考虑分页
		$pagesize = 10;
				$page = I('get.p', '1');

					$m_xinxianshi = M('Xinxianshi');

					$cond['leixing'] = '1';

					$cond['lb_xinxianshi.xianshi'] = '1';
					$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('dianzanshu desc')
					->page($page, $pagesize)
					->group('id')
					->select();

		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		//var_dump($xinxianshi_list);exit;

	}

	public function pinglunlistAction()
	{
		// 考虑分页
		$pagesize = 10;
				$page = I('get.p', '1');

					$m_xinxianshi = M('Xinxianshi');

					$cond['leixing'] = '1';

					$cond['lb_xinxianshi.xianshi'] = '1';
					$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('pinglunshu desc')
					->page($page, $pagesize)
					->group('id')
					->select();

		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		//var_dump($xinxianshi_list);exit;

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

					$cond['leixing'] = '1';

					$cond['lb_xinxianshi.xianshi'] = '1';
					$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();

				// echo $m_xinxianshi->getLastSQL();exit;
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
					$cond['lb_xinxianshi.leixing'] = '1';
					$cond['lb_xinxianshi.xianshi'] = '0';
					$cond['_logic'] = 'and';
					$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('pingbizhouqi desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					
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
			$m_xinxianshi = M('Xinxianshi');


			// 屏蔽新鲜事
			if(IS_POST){
				$m_xinxianshi->xianshi = 1;
				$xin = $m_xinxianshi->where('id = ' . I('post.xinid'))->save();
				$this->redirect( 'Xinxianshi/list5/p/' . I('post.p') );
			}
					
			// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');
					 
            //匹配xinxianshiid并展示：
             //var_dump($xinxianshi_id);exit;s
                    //$cond['beipinglunid'] = $xinxianshi_id;
                    $cond['lb_xinxianshi.xianshi'] = '0';
                    $cond['lb_xinxianshi.leixing'] = '0';
                    // $cond['lb_xinxianshi.beipinglunid'] >= '1';
                    $m_xinxianshi = D('Xinxianshi');
                    $xinxianshi = $m_xinxianshi
                   ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('lb_xinxianshi.*,lb_user.nickname as name, lb_user.phone,lb_shequ.mingcheng as mingcheng')
                    ->where($cond)
                    ->order('pingbizhouqi desc')
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

		//list7启用的评论列表：
	public function list7Action($xinxianshi_id=0)
		{	
					
			// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					 $m_xinxianshi = M('Xinxianshi');
		            //匹配xinxianshiid并展示：
		             //var_dump($xinxianshi_id);exit;s
                    //$cond['beipinglunid'] = $xinxianshi_id;
                    $cond['lb_xinxianshi.xianshi'] = '1';
                    $cond['_string'] = 'lb_xinxianshi.beipinglunid !=0';
                    $m_xinxianshi = D('Xinxianshi');
                    $xinxianshi = $m_xinxianshi
                   ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('lb_xinxianshi.*,lb_user.nickname as name,lb_shequ.mingcheng as mingcheng')
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
	
		//list6评论列表：
	public function list6Action($xinxianshi_id=0)
		{	
					
			// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					 $m_xinxianshi = M('Xinxianshi');
            //匹配xinxianshiid并展示：
             //var_dump($xinxianshi_id);exit;s
                    //$cond['beipinglunid'] = $xinxianshi_id;
                    $cond['lb_xinxianshi.xianshi'] = '1';
					$cond['lb_xinxianshi.leixing'] = '0';
                   // $cond['lb_xinxianshi.beipinglunid'] = '1';
                    $m_xinxianshi = D('Xinxianshi');
                    $xinxianshi = $m_xinxianshi
                    ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
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
			//$this->success('OK：' . $m_xinxianshi->getError(), U('Xinxianshi/list'), 1);
			$this->redirect('Shequ/list');
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
     				$data['pingbizhouqi'] = time();
     				$data['xianshi'] = 0;	
			$m_xinxianshi->save($data);


   //       // $cid="7269143c199f568a2e9e1c996fc77885";
			// if(!empty($cid)){
			// 	Vendor('Igetui.igts');
			// 	$igt = new\igts();
			// 	$content=json_encode(array('code'=>1008,"obj"=>array('id'=>$_GET['xinxianshiid'])));
	 	// 		$refg=$igt->pushMessageToSingle($cid,$content,"管理员屏蔽了您的新鲜事"); 
	 	// 		// print_r($refg);
	 	// 		// exit;
			// }

			//echo $m_xinxianshi->getLastSQL();exit;
				
			// 数据插入或者验证无存在问题
			//$this->success('OK：' , U('Xinxianshi/list'), 0);
			$this->redirect('Xinxianshi/list6/p/'.I('get.p'));
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
//跳转评论管理
	public function pinglunAction($id=0)
	{	
			// 判断当前是post还是get
		if (IS_GET)
		{
			$m_xinxianshi = M("Xinxianshi");

     				//var_dump($_GET);
     				$data['id']=$_GET['xinxianshi_id'];
     				$data['beizhu'] =$_GET['beizhu'];
     				$data['xianshi'] = 0;	
			$m_xinxianshi->save($data);


			// $cid="7269143c199f568a2e9e1c996fc77885";
			if(!empty($cid)){
				Vendor('Igetui.igts');
				$igt = new\igts();
				$content=json_encode(array('code'=>1008,"obj"=>array('id'=>$_GET['xinxianshiid'])));
	 			$refg=$igt->pushMessageToSingle($cid,$content,"管理员屏蔽了您的新鲜事"); 
	 			// print_r($refg);
	 			// exit;
			}
			
			
			$this->redirect('Xinxianshi/list6');
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
	 * 查询发帖人和内容
	 */
	public function fetchAction()
	{	
		
		//var_dump($_GET['name']);exit;ok
		//var_dump($_GET['neirong']);exit;
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_xinxianshi = M('Xinxianshi');
		$m_user = M('User');
		$m_shequ = M('Shequ');
		
		if ($_GET['sosuo']==1) {
			$where['phone']=$_GET['value'];
		}
		if ($_GET['sosuo'] ==2) {//$where['title']  = array('like','%thinkphp%');
			$where['mingcheng']= $_GET['value'];
		}
		$where['lb_xinxianshi.xianshi'] = '1';
		$where['lb_xinxianshi.leixing'] = '1';
			$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
					->where($where)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();			
		//s
		$this->assign('xinxianshi_list', $xinxianshi_list);

			$total = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('count(lb_xinxianshi.id) as total')
					->where($where)
					->find();	
				
				$t_page = new Page($total['total'], $pagesize);
				$this->assign('page_html', $t_page->show());

				$this->display('Xinxianshi/list3');
		//e						
	}
	/**
	 * 搜索新鲜事评论
	 */
	public function fetch1Action()
	{	
		
		//var_dump($_GET['name']);exit;ok
		//var_dump($_GET['neirong']);exit;
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_xinxianshi = M('Xinxianshi');
		$m_user = M('User');
		$m_shequ = M('Shequ');
		if ($_GET['sosuo']==1) {
			$cond['phone']=$_GET['value'];
		}
		if ($_GET['sosuo']==2) {//$where['title']  = array('like','%thinkphp%');
			$cond['mingcheng']=$_GET['value'] ;
		}
			$cond['lb_xinxianshi.xianshi'] = '1';
			$cond['lb_xinxianshi.leixing'] = '0';
			$xinxianshi = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();			
		//s
		$this->assign('xinxianshi', $xinxianshi);
			$total = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('count(lb_xinxianshi.id) as total')
					->where($cond)
					->find();	
				$t_page = new Page($total['total'], $pagesize);
				$this->assign('page_html', $t_page->show());

				$this->display('Xinxianshi/list6');
		//e						
	}

	/**
	 * 搜索置顶新鲜事
	 */
	public function fetch2Action()
	{	
		
		//var_dump($_GET['name']);exit;ok
		//var_dump($_GET['neirong']);exit;
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_xinxianshi = M('Xinxianshi');
		$m_user = M('User');
		$m_shequ = M('Shequ');
		if ($_GET['sosuo']==1) {
			$cond['phone']=$_GET['value'];
		}
		if ($_GET['sosuo']==2) {
			$cond['mingcheng']=$_GET['value'] ;
		}
					$cond['lb_xinxianshi.leixing'] = '1';
					$cond['_string'] = 'lb_xinxianshi.zhiding !=0';
                   // $cond['lb_xinxianshi.beipinglunid'] = '1';
                   // var_dump($cond);exit;
                    $m_xinxianshi = D('Xinxianshi');
                    $xinxianshi_list = $m_xinxianshi
                    ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
                    // ->where('lb_xinxianshi.leixing =1 and lb_xinxianshi.zhiding != 0')
                    ->where($cond)
                    ->order('id desc')
                    ->page($page, $pagesize)
                    ->group('id')
                    ->select();
                    // var_dump($xinxianshi_list);exit;
		$this->assign('xinxianshi_list', $xinxianshi_list);

                    $total = $m_xinxianshi
                    ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('count(lb_xinxianshi.id) as total')
                    // ->where('lb_xinxianshi.leixing =1 and lb_xinxianshi.zhiding != 0')
                    ->where($cond)
                    ->find();

		// $total = $m_xinxianshi->where($cond)->count();

		$t_page = new Page($total['total'], $pagesize);
		$this->assign('page_html', $t_page->show());

				$this->display('Xinxianshi/zhiding');
		//e						
	}






	/*
	*搜索屏蔽的新鲜事
	*
	 */

	public function fetch3Action()
	{
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_xinxianshi = M('Xinxianshi');
		$m_user = M('User');
		$m_shequ = M('Shequ');
		if ($_GET['sosuo']==1) {
			$where['phone']=$_GET['value'];
		}
		if ($_GET['sosuo']==2) {
			$where['mingcheng']=$_GET['value'] ;
		}
			$where['lb_xinxianshi.leixing'] = '1';
			$where['lb_xinxianshi.xianshi'] = '0';
			// $cond['_logic'] = 'and';
					$xinxianshi_list = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
					->where($where)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->field('count(lb_xinxianshi.id) as total')
					->where($where)
					->find();
		$t_page = new Page($total['total'], $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display('Xinxianshi/list4');

	}


	/*
	*搜索屏蔽的评论
	*
	 */
	
	public function fetch4Action()
	{
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_xinxianshi = M('Xinxianshi');
		$m_user = M('User');
		$m_shequ = M('Shequ');
		if ($_GET['sosuo']==1) {
			$where['phone']=$_GET['value'];
		}
		if ($_GET['sosuo']==2) {
			$where['mingcheng']=$_GET['value'] ;
		}
			$where['lb_xinxianshi.xianshi'] = '0';
            $where['lb_xinxianshi.leixing'] = '0';
                    // $cond['lb_xinxianshi.beipinglunid'] >= '1';
            $m_xinxianshi = D('Xinxianshi');
            $xinxianshi = $m_xinxianshi
                    ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('lb_xinxianshi.*,lb_user.nickname as name, lb_user.phone,lb_shequ.mingcheng as mingcheng')
                    ->where($where)
                    ->order('id desc')
                    ->page($page, $pagesize)
                    ->group('id')
                    ->select();
                    //var_dump($xinxianshi);exit;
		$this->assign('xinxianshi', $xinxianshi);


			$total = $m_xinxianshi
                    ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('count(lb_xinxianshi.id) as total')
                    ->where($where)
                    ->find();
		$t_page = new Page($total['total'], $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display('xinxianshi/list5');



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
                    ->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
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
		/**
	 * 展示举报新鲜事jubao
	 */
	
	public function jubaoAction()
	{
		// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					$m_xinxianshi = M('Xinxianshi');
					$m_jubao = M('jubao');
					// 通用查询条件
					$cond['beipinglunid'] = '0';
					//$cond['_string'] = 'lb_jubao.xinxiid = 70'; 
					//$Model->join('t2 on t1.id = t2.uid', 'left')->join('t3 on t2.uid = t3.sid', 'left')->select();
					$xinxianshi_list= $m_xinxianshi
					->table('lb_xinxianshi')
					->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
					->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
					->join("right JOIN lb_jubao ON lb_xinxianshi.id = lb_jubao.xinxiid")
					->field('lb_xinxianshi.*,lb_user.nickname as name,lb_shequ.mingcheng as mingcheng,count(lb_jubao.xinxiid) as xinxiid,lb_jubao.openid,lb_jubao.jubaoid,lb_jubao.jubaoleixing,lb_jubao.chuli')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
					//var_dump($xinxianshi_list);exit;
					foreach ($xinxianshi_list as &$xinxianshi) 
					{	
						//$moneys=sprintf("%.2f", $money);
						// $xinxianshi['moneys'] = sprintf("%.2f", $xinxianshi['moneys']);//将金额设置为两位浮点型
						// $xinxianshi['regtime'] = date("Y-m-d H:s:i", $xinxianshi['regtime']);
						// $xinxianshi['logintimes'] = date("Y-m-d H:s:i", $xinxianshi['logintimes']);
						$number=$xinxianshi['jubaoid'];
						if ($number==14) {
							$xinxianshi['jubaoid']="不实信息";
						}elseif ($number==15) {
							$xinxianshi['jubaoid']="有害信息";
						}elseif ($number==16) {
							$xinxianshi['jubaoid']="人身攻击";
						}elseif ($number==17) {
							$xinxianshi['jubaoid']="淫秽色情";
						}
						else {
							$xinxianshi['jubaoid']="违法信息";
						}
					}
					// $date[_string] = 'lb_jubao.xinxiid = '; 
					// $jubaoSum = $m_jubao->where($date)->count();
//echo $m_xinxianshi->getLastSQL();
//dump($xinxianshi);exit;
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
		//echo $m_xinxianshi->getLastSQL();
//var_dump($xinxianshi);exit;
		$this->display();
	}

	public function xpinglunAction()
	{

		$this->display();
	}

	public function zhidingAction()
	{ 
		// 考虑分页
				$pagesize = 10;
				$page = I('get.p', '1');

					 $m_xinxianshi = M('Xinxianshi');
            //匹配xinxianshiid并展示：
             //var_dump($xinxianshi_id);exit;s
                    //$cond['beipinglunid'] = $xinxianshi_id;
                    // $cond['lb_xinxianshi.xianshi'] = '1';
					$cond['lb_xinxianshi.leixing'] = '1';
					$cond['_string'] = 'lb_xinxianshi.zhiding !=0';
                   // $cond['lb_xinxianshi.beipinglunid'] = '1';
                   // var_dump($cond);exit;
                    $m_xinxianshi = D('Xinxianshi');
                    $xinxianshi_list = $m_xinxianshi
                    ->table('lb_xinxianshi')
                    ->join("LEFT JOIN lb_user ON lb_xinxianshi.openid = lb_user.openid")
                    ->join("LEFT JOIN lb_shequ ON lb_xinxianshi.shequid = lb_shequ.id")
                    ->field('lb_xinxianshi.*,lb_user.nickname as name,lb_user.phone,lb_shequ.mingcheng as mingcheng')
                    // ->where('lb_xinxianshi.leixing =1 and lb_xinxianshi.zhiding != 0')
                    ->where($cond)
                    ->order('starttime desc')
                    ->page($page, $pagesize)
                    ->group('id')
                    ->select();
                    // var_dump($xinxianshi_list);exit;
		$this->assign('xinxianshi_list', $xinxianshi_list);

		$total = $m_xinxianshi->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		

		}




	
}





