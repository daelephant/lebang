<?php
namespace Admin\Controller;
use Think\Controller;

class CategoryController extends Controller
{
	public function viewAction()
	{
		// 缓存初始化设置
		S(['type'=>'File']);

		// 先判断缓存是否存在
		if (! ($category_view = S('category_tree_0')))
		{
			// 缓存不存在
			// 模型获取数状数据
			$m_category = D('Category');
			$category_view = $m_category->getTree();
			// 存储入缓存中
			S('category_tree_0', $category_view);
		}
		$this->assign('category_view', $category_view);

		// 视图模板展示
		$this->display();
	}
	// ###
	public function readAction(){
    
    $m_user = M('User');
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
   
    $this->assign('list1', $list1);
    $this->assign('list3', $list3);
    $this->assign('list4', $list4);
    $this->display();
	}
	//##### 
	/**
	 * 展示符合条件的列表
	 */
	public function view1Action()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_user = M('User');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$cond['status'] = '0';

		$user_view = $m_user
			->field('id,name,phone,idnumber,status,status,regtime,logintimes')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
		//var_dump($user_view);
		// 将日期格式化
		foreach ($user_view as &$user) 
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
		$this->assign('user_view', $user_view);

		$total = $m_user->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();

	}


	/**
	 * 添加分类
	 */
	// public function addAction()
	// {
	// 	$m_category = D('Category');

	// 	// 判断当前是post还是get
	// 	if (IS_POST)
	// 	{
	// 		// 上传文件的处理
	// 		$t_upload = new Upload();
	// 		// 配置上传属性
	// 		$t_upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
	// 		$t_upload->rootPath = './Upload/Category/'; // 设置附件上传根目录
	// 		if ($info = $t_upload->uploadOne($_FILES['image']))
	// 		{
	// 			// 上传成功
	// 			$_POST['image'] = $info['savepath'].$info['savename'];
	// 		}
	// 		// echo '<pre>';var_dump($info);die;
	// 		// 处理提交的数据
	// 		$result = $m_category->create(); // 默认去post中获取数据
	// 		if ($result)
	// 		{
	// 			// 数据校验通过
	// 			$category_id = $m_category->add();
	// 			if (category_id)
	// 			{
	// 				// 添加成功
	// 				// 删除缓存
	// 				S(['type'=>'File']);
	// 				// 删除后台的树状缓存
	// 				S('category_tree_0', null);
	// 				// 删除前台的嵌套缓存
	// 				S('category_nested_0', null);
	// 				$this->redirect('Back/Category/view', [], 0);
	// 			}
	// 		}

	// 		// 数据插入或者验证存在问题
	// 		$this->error('添加失败：' . $m_category->getError(), U('Back/Category/add'), 2);
	// 	}
	// 	else
	// 	{
	// 		// 展示添加表单
	// 		// 获取上级分类
	// 		// 模型获取数状数据
	// 		$category_view = $m_category->getTree();
	// 		$this->assign('category_view', $category_view);
	// 		$this->display();
	// 	}
	// }
}