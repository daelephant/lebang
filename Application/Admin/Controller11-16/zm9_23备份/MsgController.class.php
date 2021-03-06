<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class MsgController extends Controller
{
	/**
	 * 展示msg列表
	 */
	public function listAction()
	{
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');

		$m_msg = M('Msg');
		// 通用查询条件
		$cond['is_deleted'] = '0';
		$msg_list = $m_msg
			->field('id,title,brief,url,content,pic,addtime')
			->where($cond)
			->order('id desc')
			->page($page, $pagesize)
			->select();
		//var_dump($msg_list);exit;

		// 将日期格式化
		foreach ($msg_list as &$msg) 
		{
			$msg['addtime'] = date("Y-m-d H:s:i", $msg['addtime']);
			//$msg['logintimes'] = date("Y-m-d H:s:i", $msg['logintimes']);
			$number=$msg['status'];
		}
		$this->assign('msg_list', $msg_list);

		$total = $m_msg->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();

	}


	/**
	 * 添加消息
	 */
	public function addAction()
	{
		/// 判断当前是post还是get
		if (IS_POST)
		{
			$m_msg = D('Msg');

			// 上传文件的处理
			$t_upload = new Upload();
			// 配置上传属性
			$t_upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
			//$t_upload->rootPath = './Upload/Msg/'; // 设置附件上传根目录http://www.qinlinlebang.com/photo/avatar/20160826153153_702.jpg
			$t_upload->rootPath = './photo/Msg/'; // 设置附件上传根目录
			$t_upload->subName = false;
			if ($info = $t_upload->uploadOne($_FILES['pic']))
			{
				// 上传成功
				// 生成缩略图
				$t_image = new Image();
				$t_image->open($t_upload->rootPath . $info['savepath'] . $info['savename']);
				$thumb_rootpath = './Public/Thumb/Msg/';
				$thumb_savepath = $info['savepath'];
				if (!is_dir($thumb_rootpath . $thumb_savepath))
				{
					mkdir($thumb_rootpath . $thumb_savepath, 755, true);
				}
				$thumb_savename = $info['savename'];
		
				$t_image->thumb(800, 540)->save($thumb_rootpath . $thumb_savepath . $thumb_savename);
			
				$_POST['pic'] = $thumb_savepath . $thumb_savename;
			}
			// echo '<pre>';var_dump($info);die;
		
			// 处理提交的数据
			//$m_msg->create(); // 默认去post中获取数据
			
			$result=$m_msg->create();
			// var_dump($_POST['starttime']);
			// var_dump($_POST['endtime']);

			$m_msg->addtime = time();
			//echo date("Y-m-d",strtotime($row["t_time"]));   将输出 2008-2-29
			$m_msg->starttime =strtotime(date("Y-m-d H:s:i",strtotime( $_POST['starttime'])));
			$m_msg->endtime =strtotime(date("Y-m-d H:s:i", strtotime($_POST['endtime'])));
			//$msg['regtime'] = date("Y-m-d H:s:i", $msg['regtime']);
			$m_msg->content = htmlspecialchars_decode($_POST['content']);
			
				// 数据校验通过
			$m_msg->add();

			//var_dump($result);
			//exit;
				
			// 数据插入或者验证存在问题
			$this->error('OK：' . $m_msg->getError(), U('Msg/list'), 2);
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
	 * 修改xiaoxi
	 */
	//

	//
	//zhangmin start
// 9月19日修改
		public function editAction($msg_id)
	{
		$m_msg = D('Admin/Msg');
		//$ms_id = I('get.msg_id');
		//var_dump($msg_id);exit;
		//匹配msgid 并展示
			if(!IS_POST){
				$msg = $m_msg->find(I('get.msg_id'));
				$this->assign('msg',$msg);
				$this->display();

			}else{
				//var_dump($_POST);
				$m_msg = D('Msg');

		
			// 处理提交的数据
			$m_msg->create(); // 默认去post中获取数据
			
			$m_msg->starttime =strtotime(date("Y-m-d H:s:i",strtotime($_POST['starttime'])));
			$m_msg->endtime =strtotime(date("Y-m-d H:s:i", strtotime($_POST['endtime'])));
			$m_msg->content = htmlspecialchars_decode($_POST['content']);
				// 数据校验通过
			$m_msg->where('id='.$msg_id)->save();
				//echo $m_msg->getLastSql();exit;ok
			// 数据插入或者验证无存在问题
			$this->success('OK：' , U('msg/list'), 2);
				
				//  $m_msg->where('id='.$msg_id)->save($_POST);
				// //var_dump($_POST);exit;
				// //echo $m_msg->getLastSql();exit;
				// //var_dump($msg_id);
				// $this->success('修改成功',U('Msg/list'));
			}		
	}
	//zhangmin end


	/**
	 * 删除xiaoxi
	 */
	public function removeMsg($msg_id=0)
	{
		$m_msg = M('msg');
		if (false === $m_msg->delete($msg_id))
		{
			$this->error('删除数据失败：'.$m_msg->getError(), U('list'), 2);
		}
		else
		{
			$this->redirect('list', [], 0);
		}
	}
}