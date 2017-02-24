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
	/**
	 * 展示started社区列表
	 */
	public function startedAction()
		{	
					
						// 考虑分页
						$pagesize = 10;
						$page = I('get.p', '1');

					$m_shequ = M('Shequ');
					// 通用查询条件
					$cond['xianshi'] = '1';
					//$map['_string'] = 'lb_shequ.xianshi=1';
					$shequ_list = $m_shequ
					->table('lb_shequ')
					->field('lb_shequ.*')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();

		//echo $m_shequ->getLastSQL();exit;		
		$this->assign('shequ_list', $shequ_list);

		$total = $m_shequ->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

			
		
		//var_dump($shequ_list);exit;
		$this->display();

	}
	/**
	 * 展示 starting社区列表
	 */
	public function startingAction()
		{	
					
					// 考虑分页
					$pagesize = 10;
					$page = I('get.p', '1');

					$m_shequ = M('Shequ');
					// 通用查询条件
					$cond['xianshi'] = '0';
					//$map['_string'] = 'lb_shequ.xianshi=1';
					$shequ_list = $m_shequ
					->table('lb_shequ')
					->field('lb_shequ.*')
					->where($cond)
					->order('id desc')
					->page($page, $pagesize)
					->group('id')
					->select();

		//echo $m_shequ->getLastSQL();exit;		
		$this->assign('shequ_list', $shequ_list);

		$total = $m_shequ->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

			
		
		//var_dump($shequ_list);exit;
		$this->display();

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
$date="key=8c828d134dcde3e99cca85bcdca165a3" . $gdkey . "&tableid=57f8944c305a2a4da20fea3a" . $gdtableid . "&loctype=1&data=" . $_data;

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
	public function bianjiActionbar($shequ_id=0)
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

	/**
	 * 编辑前展示ajax
	 */
	public function ajaxAction($id){
		$area = M('area')->where('sid='.$id)->select();
		echo json_encode($area);
	}

		//start编辑
	/**
	 * 编辑前展示shequ
	 */
	public function bianjiAction($shequ_id)
	{

		$m_shequ = D('Admin/Shequ');
		$m_area = M('Area');
		
		//匹配shequid 并展示
			if(!IS_POST){
				$shequ = $m_shequ->find(I('get.shequ_id'));
				//$area = $m_area->where('sid=1')->select();
				//$this->assign('area',$area);
				$this->assign('shequ',$shequ);
				$this->display();

			}else{	

		// echo '<pre>';
		// print_r($_POST);
		// exit;
		
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
   if ($upload->upload()) {// 上传成功 获取上传文件信息  
       $info = $upload->getUploadFileInfo();  
       $picname = $info[0]['savename'];  
  
       // $picname = explode('/', $picname);  
       // //$picname = $picname[0] . '/' . $prefix . $picname[1];  
       // $picname = $picname[0] . '/' . '_hz' . $picname[1];  
       //print_r($picname);  
       $_POST['zhaopian'] = $picname;
      // echo json_encode(array('status' => 1, 'msg' => $picname));
       //$result=$m_shequ->create();
       // var_dump($_POST['mingcheng']);var_dump($_POST['zuobiao']);exit;//s
		//$m_shequ->add();
		// 数据插入或者验证存在问题
			// echo '<pre>';var_dump($info);die;
		
			// 处理提交的数据
			//$m_shequ->create(); // 默认去post中获取数据
			
			$result=$m_shequ->create();
			// var_dump($_POST['starttime']);
			// var_dump($_POST['endtime']);

			$m_shequ->addtime = time();
			//echo date("Y-m-d",strtotime($row["t_time"]));   将输出 2008-2-29
			$m_shequ->starttime =strtotime(date("Y-m-d H:s:i",strtotime( $_POST['starttime'])));
			$m_shequ->endtime =strtotime(date("Y-m-d H:s:i", strtotime($_POST['endtime'])));
			//$shequ['regtime'] = date("Y-m-d H:s:i", $shequ['regtime']);
			$m_shequ->content = htmlspecialchars_decode($_POST['content']);
			//var_dump($shequ_id);exit;
				// 数据校验通过
			 
			$m_shequ->where('id='.$shequ_id)->save();
			//$shequ_id = I('get.shequ_id');
			// var_dump($shequ_id);
			// echo $m_shequ->getLastSql();
		}

			// var_dump($result);
			// exit;
				
			// 数据插入或者验证存在问题
			//$this->success('OK：' . $m_shequ->getError(), U('Shequ/list'), 2);
//e

		    //var_dump($_POST);
			// 处理提交的数据
			$m_shequ->create(); // 默认去post中获取数据

			//$m_shequ->starttime=
			$m_shequ->starttime =strtotime(date("Y-m-d H:s:i",strtotime($_POST['starttime'])));
			$m_shequ->endtime =strtotime(date("Y-m-d H:s:i", strtotime($_POST['endtime'])));
			$m_shequ->content = htmlspecialchars_decode($_POST['content']);
				// 数据校验通过
		   $arr = implode(',',$_POST['quyu']);
		    if(!empty($arr)){
		    	$m_shequ->quyu = $arr;
		    }
			// var_dump($arr);exit;
			$m_shequ->where('id='.$shequ_id)->save();
		   //echo $m_shequ->getLastSql();exit;
			//9-28s
			//高德地图,添加,修改
			
//$bs='gdadd';		
if($bs=='gdadd'){
$gdcreate= 'http://yuntuapi.amap.com/datamanage/data/create';
$locations=$_POST['zuobiao']?$_POST['zuobiao']:$_GET['zuobiao'];
$openid='1234';$phone='5678';$phonetype='1';$cid='3';
$_data = json_encode(array('_name' =>$_POST['mingcheng'], '_location' =>$locations,'_address' =>$_POST['weizhi'],'mingcheng'=>$_POST['mingcheng'],'image' =>$_POST['zhaopian'],'zhaopian'=>$_POST['zhaopian'],'xianshi' =>$_POST['xianshi']));
//echo  $_data;
$date="key=8c828d134dcde3e99cca85bcdca165a3" . $gdkey . "&tableid=57f8944c305a2a4da20fea3a" . $gdtableid . "&loctype=1&data=" . $_data;

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
$bs='gdup';	
if($bs=='gdup'){
$gdupdate= 'http://yuntuapi.amap.com/datamanage/data/update';
$locations=$_POST['zuobiao']?$_POST['zuobiao']:$_GET['zuobiao'];
$openid='1234';$phone='5678';$phonetype='1';$cid='3';
$_data = json_encode(array('_name' =>$_POST['mingcheng'],'_id' =>$_POST['id'], '_location' =>$locations,'_address' =>$_POST['weizhi'],'mingcheng'=>$_POST['mingcheng'],'image' =>$_POST['zhaopian'],'zhaopian'=>$_POST['zhaopian'],'xianshi' =>$_POST['xianshi']));
echo  $_data;
$date="key=8c828d134dcde3e99cca85bcdca165a3" . $gdkey . "&tableid=57f8944c305a2a4da20fea3a" . $gdtableid . "&loctype=1&data=" . $_data;
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
  print_r($rslut);
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
			//9-28e
			// 数据插入或者验证无存在问题
			//$this->success('OK：' , U('shequ/list'), 2);
			$this->redirect('Shequ/list');
				
				//  $m_shequ->where('id='.$shequ_id)->save($_POST);
				// //var_dump($_POST);exit;
				// //echo $m_shequ->getLastSql();exit;
				// //var_dump($shequ_id);
				// $this->success('修改成功',U('shequ/list'));
			}		
	}
//end


}