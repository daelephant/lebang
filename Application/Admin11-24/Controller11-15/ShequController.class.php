<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class ShequController extends AuthController
{

	public function _initialize(){
         parent::_initialize();
    }

	/**
	 * 展示社区列表
	 */
	public function listbarAction()
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

		$m_user = M('User');
		$m_shequ = M('Shequ');
					
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');
		// 通用查询条件
		$cond['_string'] = 'lb_shequ.xianshi = 1';
		//$map['_string'] = 'lb_shequ.xianshi=1';
		$shequ_list = $m_shequ
		->table('lb_shequ')
		->field('lb_shequ.*')
		->where($cond)
		->order('id desc')
		->page($page, $pagesize)
		->group('id')
		->select();


		//查询小区的普通用户
		$list_user = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num')
							 ->where('lb_user.status = 1')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();
		
		//查询小区的雷锋用户
		$list_user2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num2')
							 ->where('lb_user.status = 3')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		//查询新鲜事
		$list_xinxianshi = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num')
							 // ->where('lb_xinxianshi.xianshi = 1')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 查询
		// $list_order = $m_shequ->table('lb_shequ')
		//                      ->join('LEFT JOIN lb_order ON lb_order.shequ_id = lb_shequ.id')
		// 					 ->field('lb_shequ.id,count(lb_order.id) as order_num')
		// 					 ->where('lb_order.status = 1')
		// 					 ->order('lb_shequ.id desc')
		// 					 ->page($page, $pagesize)
		// 					 ->group('id')
		// 					 ->select();
		$list_xinxianshi2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num2')
							 ->where('lb_xinxianshi.leixing = 2 or lb_xinxianshi.leixing = 3')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 整合数据
		foreach ($shequ_list as $key => $shequ) 
		{	
			if(count($list_user)){
				foreach ($list_user as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num'] = $user['user_num'];
					}else{
						if(!isset($shequ_list[$key]['user_num'])){
							$shequ_list[$key]['user_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num'] = 0;
			}

			if(count($list_user2)){
				foreach ($list_user2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num2'] = $user['user_num2'];
					}else{
						if(!isset($shequ_list[$key]['user_num2'])){
							$shequ_list[$key]['user_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num2'] = 0;
			}

			if(count($list_xinxianshi)){
				foreach ($list_xinxianshi as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num'] = $user['xinxianshi_num'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num'])){
							$shequ_list[$key]['xinxianshi_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num'] = 0;
			}

			if(count($list_xinxianshi2)){
				foreach ($list_xinxianshi2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num2'] = $user['xinxianshi_num2'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num2'])){
							$shequ_list[$key]['xinxianshi_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num2'] = 0;
			}
		}

		//echo $list->getLastSQL();exit;		
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
	public function getXiaquAction(){
		$key = $_POST['xiaqu'];
		$xiaqu = M('xiaqu');
		$key = $xiaqu->where('xiaqu like "%'.$key.'%"')->limit(10)->select();
		// echo json_encode($key);
		//返回json 数据
		$this->ajaxReturn($key);
	}


	   /**  
	    * 添加社区
	    **/
	public function addAction()
	{
		
		if(IS_POST)
		{
			$m_shequ = M('shequ');
			$m_xiaqu = M('xiaqu');
			$info = $this->addpic();
			// echo '<pre>';
			// print_r($m_xiequ);exit;
			 $xia = $m_xiaqu->where('xiaqu="'.$_POST['xiaqu'].'"')->find();
			 if($xia){
			 	$xid = $xia['id'];
			 }else{
			 	 $m_xiaqu->xiaqu = $_POST['xiaqu'];
				 $m_xiaqu->lianxiren = $_POST['lianxiren2'];
				 $m_xiaqu->dianhua = $_POST['dianhua2'];
				 $m_xiaqu->dizhi = $_POST['dizhi2'];
				 if(!empty($info[2]['savename'])){
				 	$m_xiaqu->tupian = $info[2]['savename'];
				 }
				 $xid = $m_xiaqu->add();
				 // var_dump($m_xiaqu->add());
			 }
			
			 $m_shequ->xid = $xid;
			 $m_shequ->mingcheng = $_POST['mingcheng'];
			 $m_shequ->zuobiao = $_POST['zuobiao'];
			 $m_shequ->loudong = $_POST['loudong'];
			 $m_shequ->zhuhu = $_POST['zhuhu'];
			 $m_shequ->weizhi = $_POST['weizhi'];
			 $m_shequ->wuye = $_POST['wuye'];
			 $m_shequ->lianxiren = $_POST['lianxiren1'];
			 $m_shequ->dianhua = $_POST['dianhua'];
			 $m_shequ->wuyedizhi = $_POST['wuyedizhi'];
			 $quyu = implode(',',$_POST['quyu']);
			 $m_shequ->quyu = $quyu;
			 // var_dump($quyu);exit;
			 $m_shequ->xianshi = $_POST['xianshi'];
			 if($m_shequ->xianshi == 1){
			 	$m_shequ->qiyong = time();
			 }
			 $m_shequ->quyu = ','.str_replace('-',',',$_POST['quyu']).',';
			 if(!empty($info[0]['savename'])){
			 	$m_shequ->zhaopian = $info[0]['savename'];
			 }
			 if(!empty($info[1]['savename'])){
			 	$m_shequ->wuyezhaopian = $info[1]['savename'];
			 }

			 $m_shequ->add();
			 	
			 $this->redirect('shequ/started');
		}

		$m_area = M('Area');
		$this->assign('area',$area);
		$area = $m_area->field('id,sid,mingcheng')->select();
		$this->assign('area',json_encode(getTree3($area,'52','mingcheng')));
		// $shequ = $m_shequ->find($shequ_id);
		// $this->assign('quyu',explode(',',trim($shequ['quyu'],',')));
		$this->display();
	}

	public function getAreaAction(){
		$addr = str_replace_once('省',' ',$_POST['addr']);
		$addr = str_replace_once('市',' ',$addr);
		$addr = explode(' ', $addr);
		$area = M('area');
		$pro = $area->where('mingcheng="'.$addr[0].'"')->find();
		if(count($addr)===2){
			$city = $area->where('sid='.$pro['id'])->find();
			$quyu = $area->where('sid='.$city['id'].' and mingcheng="'.$addr[1].'"')->find();
		}else{
			$city = $area->where('sid='.$pro['id'].' and mingcheng="'.$addr[1].'"')->find();
			$quyu = $area->where('sid='.$city['id'].' and mingcheng="'.$addr[2].'"')->find();
		}
		
		$xiaoquyu = $area->where('sid='.$quyu['id'])->select();
		$this->ajaxReturn($xiaoquyu);
	}

	public function addpic()
	{
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
			   $upload->saveRule = 'pictime'; // 采用时间戳命名
			   // $upload->autoSub = true; //是否使用子目录保存图片  
			   // $upload->subType = 'date'; //子目录保存规则  
			   // $upload->dateFormat = 'Ymd'; //子目录保存规则为date时时间格式 
			   if (!$upload->upload()) {// 上传错误提示错误信息  
			       // echo json_encode(array('msg' => $this->error($upload->getErrorMsg()), 'status' => 0));  
			   }else{
			   	       $infos= $upload->getUploadFileInfo();
			   	       $info = [];
			   	       foreach ($infos as $k => $v) {
			   	       	$info[$v['key']] = $v; 
			   	       }
       				   return $info;
			   }
	}


		/**
	 * 添加消息
	 */
	public function add1Action()
	{
		/// 判断当前是post还是get
		if (IS_POST)
		{
          $m_shequ = D('Shequ');

			// 上传文件的处理
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
			$m_shequ->starttime =strtotime(date("Y-m-d H:i:s",strtotime( $_POST['starttime'])));
			$m_shequ->endtime =strtotime(date("Y-m-d H:i:s", strtotime($_POST['endtime'])));
			//$shequ['regtime'] = date("Y-m-d H:i:s", $shequ['regtime']);
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
			$m_shequ->starttime =strtotime(date("Y-m-d H:i:s",strtotime($_POST['starttime'])));
			$m_shequ->endtime =strtotime(date("Y-m-d H:i:s", strtotime($_POST['endtime'])));
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

			$this->redirect('Shequ/list');
				
				
			}		
	}

		public function qyaddAction(){

			$m_area = M('Area');

			
			//var_dump($area);exit;
			
			if(IS_POST){
				$m_area->sid = $_POST['area'];
				$m_area->mingcheng = $_POST['quyu'];
				$m_area->mid = 4;
				$m_area->add();
				$this->redirect('Shequ/qylist');
			}

			$area = $m_area->where('sid = 1')->select();
			$this->assign('area',$area);
			$this->display();
		}

				

		public function listAction($shequ_id)
		{
			$m_area = M('Area');
			$m_shequ = M('Shequ');
			$m_xiaqu = M('Xiaqu');

			if(IS_POST){

				$m =  $m_xiaqu->where('xiaqu="'.$_POST['xiaqu'].'"')->find();
				$m_xiaqu = M('Xiaqu');
				$info = $this->addpic();
				// var_dump($info);exit;
				

				if($m){
					$m_xiaqu->lianxiren = $_POST['lianxiren2'];
					$m_xiaqu->dianhua = $_POST['dianhua2'];
					$m_xiaqu->dizhi = $_POST['dizhi2'];

					$tupian	= $info[2]['savename'];
					// var_dump($tupian);exit;
					if(!empty($tupian)){
						$m_xiaqu->tupian = $tupian;

						// var_dump($tupian);exit;
					}
					
					$m_xiaqu->where('id='.$m['id'])->save();
					$xid = $m['id'];
				}else{
					$m_xiaqu->xiaqu = $_POST['xiaqu'];
					$m_xiaqu->lianxiren = $_POST['lianxiren2'];
					$m_xiaqu->dianhua = $_POST['dianhua2'];
					$m_xiaqu->dizhi = $_POST['dizhi2'];
					$tupian	= $info[2]['savename'];
					if(!empty($tupian)){
						$m_xiaqu->tupian = $tupian;
					}
					$xid = $m_xiaqu->add();
				}
			
			$m_shequ->xid = $xid;
			$m_shequ->loudong = $_POST['loudong'];
			$m_shequ->zhuhu = $_POST['zhuhu'];
			$m_shequ->wuye = $_POST['wuye'];
			$m_shequ->lianxiren = $_POST['lianxiren'];
			$m_shequ->dianhua = $_POST['dianhua'];
			$m_shequ->wuyedizhi = $_POST['wuyedizhi'];
			$m_shequ->xianshi = $_POST['xianshi'];
			if($m_shequ->xianshi == 1){
		 		$m_shequ->qiyong = time();
			}

			// -------要修改的
			$zhaopian	= $info[0]['savename'];
			if(!empty($zhaopian)){
				$m_shequ->zhaopian = $zhaopian;
			}
			// $m_shequ->zhaopian = $info[0]['savename'];

			$wuyezhaopian	= $info[1]['savename'];
			if(!empty($wuyezhaopian)){
				$m_shequ->wuyezhaopian = $wuyezhaopian;
			}
			// $m_shequ->wuyezhaopian = $info[1]['savename'];
			// -------

			// $arr = implode(',',$_POST['quyu']);
			$m_shequ->quyu = ','.str_replace('-',',',$_POST['quyu']).',';
			// var_dump($arr);exit;
			$m_shequ->where('id='.$shequ_id)->save();
			 	// var_dump($m);exit;
			 	// var_dump(I('get.p'));exit;
			$this->redirect('Shequ/'.I('get.s').'/p/'.I('get.p'));
				
			}

			$shequ = $m_shequ->find($shequ_id);
			$xiaqu = $m_xiaqu->where('id='.$shequ['xid'])->find();

			$this->assign('area_quyu',$shequ['quyu']);
			$map['id'] = array('in',$shequ['quyu']);
			$area = $m_area->field('sid')->where($map)->select();
			$area_num = '';
			foreach($area as $k=>$v){
				$area_num .= $v['sid'] . ',';
			}
			$this->assign('xingzhenid',$area[0]['sid']);

			unset($area);
			unset($map);
			$map['sid'] = array('in',$area_num);
			$area = $m_area->where($map)->select();
			array_shift($area);
			// $area = $m_area->where('sid = '.$shequ['sid'])->select();
			// $m_areas = $m_area->where('id='.I('get.shequ_id'))->find();
			$this->assign('area',$area);
			// $this->assign('m_area',$m_areas);

			$xingzhen = $m_area->where('sid = 52')->select();
			$this->assign('xingzhen',$xingzhen);

			$this->assign('shequ',$shequ);
			$this->assign('xiaqu',$xiaqu);

			$area = $m_area->field('id,sid,mingcheng')->select();
			$this->assign('area',json_encode(getTree3($area,'52','mingcheng')));
			$this->assign('quyu',explode(',',trim($shequ['quyu'],',')));
			$this->display();
		}

		public function qylistAction(){
			// 考虑分页
			$area = M('Area');
			$pagesize = 10;
			$page = I('get.p', '1');
			$area_list = $area->join('lb_area as c on c.sid = lb_area.id')
							  ->field('c.*,lb_area.mingcheng as bming')
							  ->where('lb_area.sid = 52')
							  ->order('bming asc')
							  ->group('c.id')
			                  ->page($page, $pagesize)
			                  ->select();

			$shequ = M('Shequ');
			// echo '<pre>';
			foreach ($area_list as $key => $areas) {
				$shequs = $shequ->field('mingcheng')->where('quyu like "%'.$areas['id'].'%"')->select();
				$mingcheng = '';
				foreach($shequs as $k=>$v){
					$mingcheng .= $v['mingcheng'] . ',';
				}
				$area_list[$key]['shequ_mingcheng'] = rtrim($mingcheng,',');
				// echo implode(',',$shequs);
				// print_r($shequs);
			}
			// print_r($area_list);
			// exit;

			$this->assign('area',$area_list);
			// $total = $area->where('sid=52')->count();

			$total = $area->join('lb_area as c on c.sid = lb_area.id')
							  ->field('count(c.id) as total')
							  ->where('lb_area.sid = 52')
			                  ->find();

			$t_page = new Page($total['total'], $pagesize);
			$this->assign('page_html', $t_page->show());

			$this->display();
		}

/**
 *  启用小区搜索
 */
		public function fetch1Action()
		{
			$m_user = M('User');
			$m_shequ = M('Shequ');

			if($_GET['mingcheng'] == $_GET['mingcheng']){

				// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');
		// 通用查询条件
		$cond['_string'] = 'lb_shequ.xianshi = 1';
		$cond['mingcheng'] = $_GET['mingcheng'];
		//$map['_string'] = 'lb_shequ.xianshi=1';
		$shequ_list = $m_shequ
		->table('lb_shequ')
		->field('lb_shequ.*')
		->where($cond)
		->order('id desc')
		->page($page, $pagesize)
		->group('id')
		->select();


		//查询小区的普通用户
		$list_user = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num')
							 ->where('lb_user.status = 1')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();
		
		//查询小区的雷锋用户
		$list_user2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num2')
							 ->where('lb_user.status = 3')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		//查询新鲜事
		$list_xinxianshi = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num')
							 // ->where('lb_xinxianshi.xianshi = 1')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 查询
		// $list_order = $m_shequ->table('lb_shequ')
		//                      ->join('LEFT JOIN lb_order ON lb_order.shequ_id = lb_shequ.id')
		// 					 ->field('lb_shequ.id,count(lb_order.id) as order_num')
		// 					 ->where('lb_order.status = 1')
		// 					 ->order('lb_shequ.id desc')
		// 					 ->page($page, $pagesize)
		// 					 ->group('id')
		// 					 ->select();
		$list_xinxianshi2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num2')
							 ->where('lb_xinxianshi.leixing = 2 or lb_xinxianshi.leixing = 3')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 整合数据
		foreach ($shequ_list as $key => $shequ) 
		{	
			if(count($list_user)){
				foreach ($list_user as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num'] = $user['user_num'];
					}else{
						if(!isset($shequ_list[$key]['user_num'])){
							$shequ_list[$key]['user_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num'] = 0;
			}

			if(count($list_user2)){
				foreach ($list_user2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num2'] = $user['user_num2'];
					}else{
						if(!isset($shequ_list[$key]['user_num2'])){
							$shequ_list[$key]['user_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num2'] = 0;
			}

			if(count($list_xinxianshi)){
				foreach ($list_xinxianshi as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num'] = $user['xinxianshi_num'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num'])){
							$shequ_list[$key]['xinxianshi_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num'] = 0;
			}

			if(count($list_xinxianshi2)){
				foreach ($list_xinxianshi2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num2'] = $user['xinxianshi_num2'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num2'])){
							$shequ_list[$key]['xinxianshi_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num2'] = 0;
			}
		}

		//echo $list->getLastSQL();exit;		
		$this->assign('shequ_list', $shequ_list);

		$total = $m_shequ->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

			
		
		//var_dump($shequ_list);exit;
		$this->display('Shequ/started');

			}

		}



/**
 *  待开通小区搜索
 */

		public function fetch2Action()
		{
			//var_dump($_GET);exit;	
			$m_shequ = M('Shequ');
			if($_GET['mingcheng'] == $_GET['mingcheng']){
				
				$pagesize = 10;
				$page = I('get.p', '1');
				// $cond['is_deleted'] = '0';
				$cond['xianshi'] = '0';
				$cond['mingcheng'] = $_GET['mingcheng'];
				$shequ_list = $m_shequ
							 ->field('id,mingcheng,zhuhu,loudong,wuye,lianxiren,dianhua,weizhi')
							 ->where($cond)
							 ->order('id desc')
							 ->page($page, $pagesize)
							 ->select();

							 //var_dump($shequ_list);exit;
				$this->assign('shequ_list',$shequ_list);
				$total = $m_shequ->where($cond)->count();
				$t_page = new Page($total, $pagesize);
				$this->assign('page_html', $t_page->show());

		}
				$this->display('shequ/starting');

			}




			public function fetch3Action()
			{
				//var_dump($_GET);exit;
				$area = M('Area');
				if($_GET['mingcheng'] == $_GET['mingcheng']){
					// $pagesize = 10;
					// $page = I('get.p', '1');
					// $cond['mingcheng'] = $_GET['mingcheng'];
					// $cond['sid'] = 52; 
					$area_list = $area->join('lb_area as b on b.id = lb_area.id')
							  ->join('lb_area as c on c.sid = b.id')
							  ->field('c.*,b.mingcheng as bming')
							  // ->where('b.sid = 52' and $cond)
							  ->where(' c.mingcheng = "'.$_GET['mingcheng'].'"')
							
							  ->order('bming asc')
							  ->group('c.id')
			                  // ->page($page, $pagesize)
			                  ->select();

			                  //var_dump($area_list);exit;
			 			    // $area_list = $area->field('id,sid,mingcheng')
			 			    // 			->where($cond)
			 			    // 			->select();

			           //echo $area->getLastSQL();exit;
					$shequ = M('Shequ');
					// echo '<pre>';
					foreach ($area_list as $key => $areas) {
						$shequs = $shequ->field('mingcheng')->where('quyu like "%'.$areas['id'].'%"')->select();
						$mingcheng = '';
						foreach($shequs as $k=>$v){
							$mingcheng .= $v['mingcheng'] . ',';
						}
						$area_list[$key]['shequ_mingcheng'] = rtrim($mingcheng,',');
				// echo implode(',',$shequs);
				// print_r($shequs);
			}
			// print_r($area_list);
			// exit;

			$this->assign('area',$area_list);
					
				}
					$this->display('Shequ/qylist');
			}


			public function qybianjiAction($area_id = 0)
			{
				$m_area = M('Area');
				if(IS_POST){
					// echo $_POST['id'];
					// exit;
					$m_area->mingcheng = $_POST['quyu'];
					$m_area->where('id='.$_POST['id'])->save();
					$this->redirect('Shequ/qylist/p/'.I('get.p'));
				}
				$area = $m_area->where('sid = 1')->select();
				$m_areas = $m_area->where('id='.I('get.areas_id'))->find();

				$this->assign('area',$area);
				$this->assign('m_area',$m_areas);

				$this->display();

			}


	public function putonglistAction()
	{

		$m_user = M('User');
		$m_shequ = M('Shequ');
					
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');
		// 通用查询条件
		$cond['_string'] = 'lb_shequ.xianshi = 1';
		//$map['_string'] = 'lb_shequ.xianshi=1';
		$shequ_list = $m_shequ
		->table('lb_shequ')
		->field('lb_shequ.*')
		->where($cond)
		// ->order('id desc')
		->page($page, $pagesize)
		->group('id')
		->select();


		//查询小区的普通用户
		$list_user = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num')
							 ->where('lb_user.status = 1')
							 ->order('user_num desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();
		
		//查询小区的雷锋用户
		$list_user2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num2')
							 ->where('lb_user.status = 3')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		//查询新鲜事
		$list_xinxianshi = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num')
							 // ->where('lb_xinxianshi.xianshi = 1')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 查询
		// $list_order = $m_shequ->table('lb_shequ')
		//                      ->join('LEFT JOIN lb_order ON lb_order.shequ_id = lb_shequ.id')
		// 					 ->field('lb_shequ.id,count(lb_order.id) as order_num')
		// 					 ->where('lb_order.status = 1')
		// 					 ->order('lb_shequ.id desc')
		// 					 ->page($page, $pagesize)
		// 					 ->group('id')
		// 					 ->select();
		$list_xinxianshi2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num2')
							 ->where('lb_xinxianshi.leixing = 2 or lb_xinxianshi.leixing = 3')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 整合数据
		foreach ($shequ_list as $key => $shequ) 
		{	
			if(count($list_user)){
				foreach ($list_user as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num'] = $user['user_num'];
					}else{
						if(!isset($shequ_list[$key]['user_num'])){
							$shequ_list[$key]['user_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num'] = 0;
			}

			if(count($list_user2)){
				foreach ($list_user2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num2'] = $user['user_num2'];
					}else{
						if(!isset($shequ_list[$key]['user_num2'])){
							$shequ_list[$key]['user_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num2'] = 0;
			}

			if(count($list_xinxianshi)){
				foreach ($list_xinxianshi as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num'] = $user['xinxianshi_num'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num'])){
							$shequ_list[$key]['xinxianshi_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num'] = 0;
			}

			if(count($list_xinxianshi2)){
				foreach ($list_xinxianshi2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num2'] = $user['xinxianshi_num2'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num2'])){
							$shequ_list[$key]['xinxianshi_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num2'] = 0;
			}
		}

		//echo $list->getLastSQL();exit;		
		$this->assign('shequ_list', $shequ_list);

		$total = $m_shequ->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

			
		
		//var_dump($shequ_list);exit;
		$this->display();

			}



	public  function leifenglistAction()
	{

		$m_user = M('User');
		$m_shequ = M('Shequ');
					
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');
		// 通用查询条件
		$cond['_string'] = 'lb_shequ.xianshi = 1';
		//$map['_string'] = 'lb_shequ.xianshi=1';
		$shequ_list = $m_shequ
		->table('lb_shequ')
		->field('lb_shequ.*')
		->where($cond)
		->page($page, $pagesize)
		->group('id')
		->select();


		//查询小区的普通用户
		$list_user = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num')
							 ->where('lb_user.status = 1')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();
		
		//查询小区的雷锋用户
		$list_user2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num2')
							 ->where('lb_user.status = 3')
							 ->order('user_num2 desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		//查询新鲜事
		$list_xinxianshi = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num')
							 // ->where('lb_xinxianshi.xianshi = 1')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 查询
		// $list_order = $m_shequ->table('lb_shequ')
		//                      ->join('LEFT JOIN lb_order ON lb_order.shequ_id = lb_shequ.id')
		// 					 ->field('lb_shequ.id,count(lb_order.id) as order_num')
		// 					 ->where('lb_order.status = 1')
		// 					 ->order('lb_shequ.id desc')
		// 					 ->page($page, $pagesize)
		// 					 ->group('id')
		// 					 ->select();
		$list_xinxianshi2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num2')
							 ->where('lb_xinxianshi.leixing = 2 or lb_xinxianshi.leixing = 3')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 整合数据
		foreach ($shequ_list as $key => $shequ) 
		{	
			if(count($list_user)){
				foreach ($list_user as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num'] = $user['user_num'];
					}else{
						if(!isset($shequ_list[$key]['user_num'])){
							$shequ_list[$key]['user_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num'] = 0;
			}

			if(count($list_user2)){
				foreach ($list_user2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num2'] = $user['user_num2'];
					}else{
						if(!isset($shequ_list[$key]['user_num2'])){
							$shequ_list[$key]['user_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num2'] = 0;
			}

			if(count($list_xinxianshi)){
				foreach ($list_xinxianshi as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num'] = $user['xinxianshi_num'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num'])){
							$shequ_list[$key]['xinxianshi_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num'] = 0;
			}

			if(count($list_xinxianshi2)){
				foreach ($list_xinxianshi2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num2'] = $user['xinxianshi_num2'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num2'])){
							$shequ_list[$key]['xinxianshi_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num2'] = 0;
			}
		}

		//echo $list->getLastSQL();exit;		
		$this->assign('shequ_list', $shequ_list);

		$total = $m_shequ->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

			
		
		//var_dump($shequ_list);exit;
		$this->display();


	}


	Public function xinxianshilistAction()
	{

		$m_user = M('User');
		$m_shequ = M('Shequ');
					
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');
		// 通用查询条件
		$cond['_string'] = 'lb_shequ.xianshi = 1';
		//$map['_string'] = 'lb_shequ.xianshi=1';
		$shequ_list = $m_shequ
		->table('lb_shequ')
		->field('lb_shequ.*')
		->where($cond)
		->page($page, $pagesize)
		->group('id')
		->select();


		//查询小区的普通用户
		$list_user = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num')
							 ->where('lb_user.status = 1')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();
		
		//查询小区的雷锋用户
		$list_user2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num2')
							 ->where('lb_user.status = 3')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		//查询新鲜事
		$list_xinxianshi = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num')
							 // ->where('lb_xinxianshi.xianshi = 1')
							 ->order('xinxianshi_num desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 查询
		// $list_order = $m_shequ->table('lb_shequ')
		//                      ->join('LEFT JOIN lb_order ON lb_order.shequ_id = lb_shequ.id')
		// 					 ->field('lb_shequ.id,count(lb_order.id) as order_num')
		// 					 ->where('lb_order.status = 1')
		// 					 ->order('lb_shequ.id desc')
		// 					 ->page($page, $pagesize)
		// 					 ->group('id')
		// 					 ->select();
		$list_xinxianshi2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num2')
							 ->where('lb_xinxianshi.leixing = 2 or lb_xinxianshi.leixing = 3')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 整合数据
		foreach ($shequ_list as $key => $shequ) 
		{	
			if(count($list_user)){
				foreach ($list_user as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num'] = $user['user_num'];
					}else{
						if(!isset($shequ_list[$key]['user_num'])){
							$shequ_list[$key]['user_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num'] = 0;
			}

			if(count($list_user2)){
				foreach ($list_user2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num2'] = $user['user_num2'];
					}else{
						if(!isset($shequ_list[$key]['user_num2'])){
							$shequ_list[$key]['user_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num2'] = 0;
			}

			if(count($list_xinxianshi)){
				foreach ($list_xinxianshi as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num'] = $user['xinxianshi_num'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num'])){
							$shequ_list[$key]['xinxianshi_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num'] = 0;
			}

			if(count($list_xinxianshi2)){
				foreach ($list_xinxianshi2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num2'] = $user['xinxianshi_num2'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num2'])){
							$shequ_list[$key]['xinxianshi_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num2'] = 0;
			}
		}

		//echo $list->getLastSQL();exit;		
		$this->assign('shequ_list', $shequ_list);

		$total = $m_shequ->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

			
		
		//var_dump($shequ_list);exit;
		$this->display();



	}


	public function renwulistAction()
	{
		$m_user = M('User');
		$m_shequ = M('Shequ');
					
		// 考虑分页
		$pagesize = 10;
		$page = I('get.p', '1');
		// 通用查询条件
		$cond['_string'] = 'lb_shequ.xianshi = 1';
		//$map['_string'] = 'lb_shequ.xianshi=1';
		$shequ_list = $m_shequ
		->table('lb_shequ')
		->field('lb_shequ.*')
		->where($cond)
		->page($page, $pagesize)
		->group('id')
		->select();


		//查询小区的普通用户
		$list_user = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num')
							 ->where('lb_user.status = 1')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();
		
		//查询小区的雷锋用户
		$list_user2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_user ON lb_user.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_user.id) as user_num2')
							 ->where('lb_user.status = 3')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		//查询新鲜事
		$list_xinxianshi = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num')
							 // ->where('lb_xinxianshi.xianshi = 1')
							 ->order('lb_shequ.id desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 查询
		// $list_order = $m_shequ->table('lb_shequ')
		//                      ->join('LEFT JOIN lb_order ON lb_order.shequ_id = lb_shequ.id')
		// 					 ->field('lb_shequ.id,count(lb_order.id) as order_num')
		// 					 ->where('lb_order.status = 1')
		// 					 ->order('lb_shequ.id desc')
		// 					 ->page($page, $pagesize)
		// 					 ->group('id')
		// 					 ->select();
		$list_xinxianshi2 = $m_shequ->table('lb_shequ')
		                     ->join('LEFT JOIN lb_xinxianshi ON lb_xinxianshi.shequid = lb_shequ.id')
							 ->field('lb_shequ.id,count(lb_xinxianshi.id) as xinxianshi_num2')
							 ->where('lb_xinxianshi.leixing = 2 or lb_xinxianshi.leixing = 3')
							 ->order('xinxianshi_num2 desc')
							 ->page($page, $pagesize)
							 ->group('id')
							 ->select();

		// 整合数据
		foreach ($shequ_list as $key => $shequ) 
		{	
			if(count($list_user)){
				foreach ($list_user as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num'] = $user['user_num'];
					}else{
						if(!isset($shequ_list[$key]['user_num'])){
							$shequ_list[$key]['user_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num'] = 0;
			}

			if(count($list_user2)){
				foreach ($list_user2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['user_num2'] = $user['user_num2'];
					}else{
						if(!isset($shequ_list[$key]['user_num2'])){
							$shequ_list[$key]['user_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['user_num2'] = 0;
			}

			if(count($list_xinxianshi)){
				foreach ($list_xinxianshi as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num'] = $user['xinxianshi_num'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num'])){
							$shequ_list[$key]['xinxianshi_num'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num'] = 0;
			}

			if(count($list_xinxianshi2)){
				foreach ($list_xinxianshi2 as $k1 => $user) {
					if($shequ_list[$key]['id'] == $user['id']){
						$shequ_list[$key]['xinxianshi_num2'] = $user['xinxianshi_num2'];
					}else{
						if(!isset($shequ_list[$key]['xinxianshi_num2'])){
							$shequ_list[$key]['xinxianshi_num2'] = 0;
						}
					}
				}
			}else{
				$shequ_list[$key]['xinxianshi_num2'] = 0;
			}
		}

		//echo $list->getLastSQL();exit;		
		$this->assign('shequ_list', $shequ_list);

		$total = $m_shequ->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

			
		
		//var_dump($shequ_list);exit;
		$this->display();


	}

}