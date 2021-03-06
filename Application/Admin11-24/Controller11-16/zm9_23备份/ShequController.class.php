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
          //s
			   $upload = new \Think\UploadFile();// 实例化上传类  
   $upload->maxSize = 3000000 ;// 设置附件上传大小  C('UPLOAD_SIZE');   
   //$upload->savePath = './Public/Uploads/' . $path; // 设置附件上传目录  
   $upload->savePath = './photo/Shequ/'; // 设置附件上传目录  
   $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型  
   $upload->saveRule = 'time';  
   $upload->uploadReplace = true; //是否存在同名文件是否覆盖  
   $upload->thumb = true; //是否对上传文件进行缩略图处理  
   $upload->thumbMaxWidth = '300,600,1000'; //缩略图处理宽度  
   $upload->thumbMaxHeight = '300,600,1000'; //缩略图处理高度  
   //$upload->thumbPrefix = $prefix; //缩略图前缀  
   $upload->thumbPrefix = 's_,m_,b_';  //生产3张缩略图  
   //$upload->thumbPath = './Public/Uploads/' . $path . date('Ymd', time()) . '/'; //缩略图保存路径  
   $upload->thumbPath = './photo/Shequ/'; //缩略图保存路径  
    
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
       $_POST['zhaopian'] = $picname;
      // echo json_encode(array('status' => 1, 'msg' => $picname));
       $result=$m_shequ->create();
       // var_dump($_POST['mingcheng']);var_dump($_POST['zuobiao']);exit;//s
		$m_shequ->add();
		// 数据插入或者验证存在问题
//高德地图,添加
$bs='gdadd';		
if($bs=='gdadd'){
$gdcreate= 'http://yuntuapi.amap.com/datamanage/data/create';
$locations=$_POST['zuobiao']?$_POST['zuobiao']:$_GET['zuobiao'];
$openid='1234';$phone='5678';$phonetype='1';$cid='3';
$_data = json_encode(array('_name' =>$_POST['mingcheng'], '_location' =>$locations,'_address' =>$_POST['weizhi'],'mingcheng'=>$_POST['mingcheng'],'image' =>$_POST['zhaopian'],'zhaopian'=>$_POST['zhaopian'],'xianshi' =>$_POST['xianshi']));
//echo  $_data;
$date="key=9a9c5d6acf7495d1b7401dbbd3655277" . $gdkey . "&tableid=57d289477bbf195d70fbcf13" . $gdtableid . "&loctype=1&data=" . $_data;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_URL, $gdcreate);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    )
  );
  $rslut = curl_exec($ch);  
  curl_close($ch);
  $rslut= json_decode($rslut,true);
  print_r($rslut);
  if($rslut['_id']){
	  $response=array('code'=>200,'obj'=>array('id'=>$rslut['_id']));
	  }else{
		$response=array('code'=>4444);  
		  }		
	}

//修改
if($bs=='gdup'){
$gdupdate= 'http://yuntuapi.amap.com/datamanage/data/update';
$locations=$_POST['locations']?$_POST['locations']:$_GET['locations'];
$id=$_POST['id']?$_POST['id']:$_GET['id'];
$_data = json_encode(array('_id'=>$id,'_location' =>$locations));
$date="key=" . $gdkey . "&tableid=" . $gdtableid . "&loctype=1&data=" . $_data;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_URL, $gdupdate);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    )
  );
  $rslut = curl_exec($ch);  
  curl_close($ch);
  $rslut= json_decode($rslut,true);
 // print_r($rslut);
  if($rslut['status']){
	  $response=array('code'=>200);
	  }else{
		$response=array('code'=>4444);  
		  }		
	}
	//删除
if($bs=='gddel'){
$gdupdate= 'http://yuntuapi.amap.com/datamanage/data/delete';
$id=$_POST['id']?$_POST['id']:$_GET['id'];
$date="key=" . $gdkey . "&tableid=" . $gdtableid . "&ids=".$id;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_URL, $gdupdate);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    )
  );
  $rslut = curl_exec($ch);  
  curl_close($ch);
  $rslut= json_decode($rslut,true);
 // print_r($rslut);
  if($rslut['status']){
	  $response=array('code'=>200);
	  }else{
		$response=array('code'=>4444);  
		  }		
	}

//e


			$this->success('OK：' . $m_shequ->getError(), U('Shequ/list'), 2);
   } 
			//e
			if ($info =  $info = $upload->getUploadFileInfo())
			{	

		// 		// 上传成功
		// 		// 生成缩略图
		// 		$t_image = new Image();
		// 		$t_image->open($t_upload->rootPath . $info['savepath'] . $info['savename']);
		// 		$thumb_rootpath = './Public/Thumb/Shequ/';
		// 		$thumb_savepath = $info['savepath'];
		// 		if (!is_dir($thumb_rootpath . $thumb_savepath))
		// 		{
		// 			mkdir($thumb_rootpath . $thumb_savepath, 755, true);
		// 		}
		// 		$thumb_savename = $info['savename'];
		// //$image->thumb(150, 150,\Think\Image::IMAGE_THUMB_CENTER)->save('./thumb.jpg');
		// 		$t_image->thumb(300, 300,\Think\Image::IMAGE_THUMB_SCALE)->save($thumb_rootpath . $thumb_savepath . $thumb_savename);
		// 		$_POST['zhaopian'] = $thumb_savepath . $thumb_savename;
			}
			//echo '<pre>';var_dump($info);die;
			//var_dump($_POST);exit;
			// 处理提交的数据
			// $m_shequ->create(); // 默认去post中获取数据
			
			//$result=$m_shequ->create();
			// $m_shequ->addtime = time();
			// $m_shequ->content = htmlspecialchars_decode($_POST['content']);
			
				// 数据校验通过
			// var_dump($_POST);
			// $m_shequ->add();

			//var_dump($result);
			//exit;
				
			// 数据插入或者验证存在问题
			//$this->error('OK：' . $m_shequ->getError(), U('Shequ/list'), 2);
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

	//start编辑
	/**
	 * 编辑前展示shequ
	 */
	public function bianjiAction($shequ_id=0)
	{

		// 通用查询条件
		$m_shequ = M('Shequ');
			//匹配shequid并展示：
     				$condition['id'] = $shequ_id;
					$m_shequ = D('Shequ');
					$shequ = $m_shequ
					->table('lb_shequ')
					->field('lb_shequ.*')
					->where($condition)
					->find();
					
					$this->assign('shequ', $shequ);
					//echo $m_shequ->getLastSQL();exit;
					//var_dump($shequ);
			//$this->display();

			//更新	
			// 判断当前是post还是get
		if (IS_POST)
		{
			$m_shequ = D('Shequ');

		
			// 处理提交的数据
			$m_shequ->create(); // 默认去post中获取数据
			//$m_shequ->birthday = strtotime($_POST['birthday']);
			//$m_shequ->regtime = time();
			//$m_shequ->logintimes = time();
				// 数据校验通过
			$m_shequ->save();
				
			// 数据插入或者验证无存在问题
			$this->success('OK：' , U('Shequ/list'), 2);
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



}