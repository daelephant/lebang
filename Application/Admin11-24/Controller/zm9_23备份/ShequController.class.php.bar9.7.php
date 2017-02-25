<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class ShequController extends Controller
{
	/**
	 * 展示社区列表
	 */
	public function listAction()
		{	
					
						// 考虑分页
						$pagesize = 10;
						$page = I('get.p', '1');

					$m_shequ = M('Shequ');
					// 通用查询条件
					// $cond['is_deleted'] = '0';
					$shequ_list = $m_shequ
					->table('lb_shequ')
					
					->field('lb_shequ.*')
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();
				
		$this->assign('shequ_list', $shequ_list);

		$total = $m_shequ->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		$this->display();
		//var_dump($shequ_list);exit;

	}
//@elephant
		/**
	 * 添加消息
	 */
	public function addAction()
	{
		/// 判断当前是post还是get
		if (IS_POST)
		{
			$m_shequ = D('Shequ');


			// 上传文件的处理
			$t_upload = new Upload();
			// 配置上传属性
			$t_upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
			//$t_upload->rootPath = './Upload/shequ/'; // 设置附件上传根目录http://www.qinlinlebang.com/photo/avatar/20160826153153_702.jpg
			$t_upload->rootPath = './photo/Shequ/'; // 设置附件上传根目录
			$t_upload->subName = false;
			$info   =   $t_upload->upload();//if ($info = $t_upload->upload($_FILES['zhaopian']))
			if ($info)
			{
				// 上传成功
				echo "ok";
				 foreach($info as $file){ echo $file['savepath'].$file['savename'];}

				// // 生成缩略图
				// $t_image = new Image();
				// $t_image->open($t_upload->rootPath . $file['savepath'] . $file['savename']);
				// $thumb_rootpath = './Public/Thumb/Shequ/';
				// $thumb_savepath = $file['savepath'];
				// if (!is_dir($thumb_rootpath . $thumb_savepath))
				// {
				// 	mkdir($thumb_rootpath . $thumb_savepath, 755, true);
				// }
				// $thumb_savename = $file['savename'];
		
				// $t_image->thumb(800, 540)->save($thumb_rootpath . $thumb_savepath . $thumb_savename);
			
				// $_POST['zhaopian[]'] = $thumb_savepath . $thumb_savename;
			}
			// echo '<pre>';var_dump($info);die;
			//var_dump($_POST);exit;
			//var_dump($_FILES);exit;
			// 处理提交的数据
			//$m_shequ->create(); // 默认去post中获取数据
			
// $result=$m_shequ->create();
// $m_shequ->addtime = time();
// $m_shequ->content = htmlspecialchars_decode($_POST['content']);
// 数据校验通过
//$m_shequ->add();
	//
	$m_shequ = D('Shequ');// 取得成功上传的文件信息
	foreach($info as $file){ echo $file['savepath'].$file['savename'];}
	$info   =   $t_upload->upload($_FILES['zhaopian']);// 保存当前数据对象
	//$info = $t_upload->upload($_FILES['zhaopian']
	var_dump($info);
	// $data['zhaopian'] = $info[0]['savename'];
	//$data['create_time'] = NOW_TIME;
	$m_shequ->add($data);
	//

			//var_dump($result);
			//exit;
				
			// 数据插入或者验证存在问题

			$this->error('OK：' . $m_shequ->getError(), U('Shequ/list'), 2);
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



}