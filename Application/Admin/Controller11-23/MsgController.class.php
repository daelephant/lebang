<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class MsgController extends AuthController
{
	public function _initialize(){
         parent::_initialize();
    }

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
          //s
			   $upload = new \Think\UploadFile();// 实例化上传类  
   $upload->maxSize = 3000000 ;// 设置附件上传大小  C('UPLOAD_SIZE');   
   //$upload->savePath = './Public/Uploads/' . $path; // 设置附件上传目录  
   $upload->savePath = './photo/Msg/'; // 设置附件上传目录  
   $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型  
   $upload->saveRule = 'time';  
   $upload->uploadReplace = true; //是否存在同名文件是否覆盖  
   $upload->thumb = true; //是否对上传文件进行缩略图处理  
   $upload->thumbMaxWidth = '300,600,1000'; //缩略图处理宽度  
   $upload->thumbMaxHeight = '300,600,1000'; //缩略图处理高度  
   //$upload->thumbPrefix = $prefix; //缩略图前缀  
   $upload->thumbPrefix = 's_,m_,b_';  //生产3张缩略图  
   //$upload->thumbPath = './Public/Uploads/' . $path . date('Ymd', time()) . '/'; //缩略图保存路径  
   $upload->thumbPath = './photo/Msg/'; //缩略图保存路径  
    
  //$upload->thumbRemoveOrigin = true; //上传图片后删除原图片  
   $upload->thumbRemoveOrigin = false; //上传图片后删除原图片
   $upload->saveRule = 'time'; // 采用时间戳命名
   // $upload->autoSub = true; //是否使用子目录保存图片  
   // $upload->subType = 'date'; //子目录保存规则  
   // $upload->dateFormat = 'Ymd'; //子目录保存规则为date时时间格式 
   if (!$upload->upload()) {// 上传错误提示错误信息  
       echo json_encode(array('msg' => $this->error($upload->getErrorMsg()), 'status' => 0));  
   } else {// 上传成功 获取上传文件信息  
       $info = $upload->getUploadFileInfo();  
       $picname = $info[0]['savename'];  
  
       // $picname = explode('/', $picname);  
       // //$picname = $picname[0] . '/' . $prefix . $picname[1];  
       // $picname = $picname[0] . '/' . '_hz' . $picname[1];  
       //print_r($picname);  
       $_POST['pic'] = $picname;
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
//s
$m_msg = D('Msg');

	// 上传文件的处理
          //s
			   $upload = new \Think\UploadFile();// 实例化上传类  
   $upload->maxSize = 3000000 ;// 设置附件上传大小  C('UPLOAD_SIZE');   
   //$upload->savePath = './Public/Uploads/' . $path; // 设置附件上传目录  
   $upload->savePath = './photo/Msg/'; // 设置附件上传目录  
   $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型  
   $upload->saveRule = 'time';  
   $upload->uploadReplace = true; //是否存在同名文件是否覆盖  
   $upload->thumb = true; //是否对上传文件进行缩略图处理  
   $upload->thumbMaxWidth = '300,600,1000'; //缩略图处理宽度  
   $upload->thumbMaxHeight = '300,600,1000'; //缩略图处理高度  
   //$upload->thumbPrefix = $prefix; //缩略图前缀  
   $upload->thumbPrefix = 's_,m_,b_';  //生产3张缩略图  
   //$upload->thumbPath = './Public/Uploads/' . $path . date('Ymd', time()) . '/'; //缩略图保存路径  
   $upload->thumbPath = './photo/Msg/'; //缩略图保存路径  
    
  //$upload->thumbRemoveOrigin = true; //上传图片后删除原图片  
   $upload->thumbRemoveOrigin = false; //上传图片后删除原图片
   $upload->saveRule = 'time'; // 采用时间戳命名
   // $upload->autoSub = true; //是否使用子目录保存图片  
   // $upload->subType = 'date'; //子目录保存规则  
   // $upload->dateFormat = 'Ymd'; //子目录保存规则为date时时间格式 
   if ($upload->upload()) {// 上传成功 获取上传文件信息  
       $info = $upload->getUploadFileInfo();  
       $picname = $info[0]['savename'];  
  
       // $picname = explode('/', $picname);  
       // //$picname = $picname[0] . '/' . $prefix . $picname[1];  
       // $picname = $picname[0] . '/' . '_hz' . $picname[1];  
       //print_r($picname);  
       $_POST['pic'] = $picname;
      // echo json_encode(array('status' => 1, 'msg' => $picname));
       //$result=$m_msg->create();
       // var_dump($_POST['mingcheng']);var_dump($_POST['zuobiao']);exit;//s
		//$m_msg->add();
		// 数据插入或者验证存在问题
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
			//var_dump($msg_id);exit;
				// 数据校验通过
			$m_msg->where('id='.$msg_id)->save();
		}
			//$msg_id = I('get.msg_id');
			// var_dump($msg_id);
			// echo $m_msg->getLastSql();
//e

		    //var_dump($_POST);exit;
			// 处理提交的数据
			$m_msg->create(); // 默认去post中获取数据
			//$m_msg->starttime=
			$m_msg->starttime =strtotime(date("Y-m-d H:s:i",strtotime($_POST['starttime'])));
			$m_msg->endtime =strtotime(date("Y-m-d H:s:i", strtotime($_POST['endtime'])));
			$m_msg->content = htmlspecialchars_decode($_POST['content']);
				// 数据校验通过
			$m_msg->where('id='.$msg_id)->save();
				//echo $m_msg->getLastSql();exit;ok
			// 数据插入或者验证无存在问题
			//$this->success('OK：' , U('msg/list'), 2);
			$this->redirect('Msg/list');
				
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