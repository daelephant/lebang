<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class FuwuController extends AuthController
{
	public function _initialize(){
         parent::_initialize();
    }


/**
	 * 添加展示ajax
	 */
	public function ajaxAction($id){
		$area = M('Fuwuleibie')->where('sid='.$id)->select();
		$this->ajaxReturn($area);
	}

	public function ajaxfuwuAction($id){
		$area = M('Fuwuxiangmu')->where('id='.$id)->find();
		$this->ajaxReturn($area);
	}


	public function shanghufuwuAction()
	{
		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('shanghufuwuxiangmu');
		$m_yuyue = M('yuyue');
		$m_shanghu = M('shanghu');

		$pagesize = 10;
		$page = I('get.p', '1');
		$cond['lb_shanghufuwuxiangmu.status'] = 2;
		$leibie = $m_fuwuxiangmu
				->table('lb_shanghufuwuxiangmu')
		        ->join('LEFT JOIN lb_fuwuleibie ON lb_fuwuleibie.id = lb_shanghufuwuxiangmu.erjileibie')
		        ->field('lb_shanghufuwuxiangmu.*,lb_fuwuleibie.name as lname')
		        ->where($cond)
		        ->order('id desc')
		        ->page($page, $pagesize)
		        ->select();

		        //var_dump($leibie);exit;
		 
		 $yuyue = $m_fuwuxiangmu
		 		->table('lb_shanghufuwuxiangmu')
		 		->join('LEFT JOIN lb_yuyue ON lb_shanghufuwuxiangmu.id = lb_yuyue.xid ')
		 		->field('lb_shanghufuwuxiangmu.id,count(lb_yuyue.id) as yuyues')
		 		->where($cond)
		 		->order('id desc')
		 		->page($page, $pagesize)
		 		->group('id')
		 		->select();
		 		// echo '<pre>';
		 		// print_r($yuyue);exit;


		 $shanghu = $m_shanghu
		 			->table('lb_shanghufuwuxiangmu')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_shanghufuwuxiangmu.shanghuid,lb_shanghu.id)')
		 			->join('LEFT JOIN lb_user ON lb_shanghu.openid = lb_user.openid')
		 			->field('lb_shanghufuwuxiangmu.id,lb_shanghu.mingcheng,lb_user.name as username,lb_user.phone')
		 			->where($cond)
		 			->order('id desc')
		 			->page($page, $pagesize)
		 			->group('id')
		 			->select();
		 			// echo '<pre>';
		 		 // print_r($shanghu);exit;
		 		 
		 // echo $m_shanghu->getLastSQL();exit;

		$this->assign('leibie',$leibie);
		$this->assign('yuyue',$yuyue);
		$this->assign('shanghu',$shanghu);
		$total = $m_fuwuxiangmu->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

	

		$this->display();
	}


	public function jinyongshAction()
	{
		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('shanghufuwuxiangmu');
		$m_yuyue = M('yuyue');
		$m_shanghu = M('shanghu');

		if(IS_POST){
				$m_fuwuxiangmu->status = 2;
				$m_fuwuxiangmu->where('id = ' . I('post.xinid'))->save();
				$this->redirect( 'Fuwu/jinyongsh/p/' . I('post.p') );
		}

				$pagesize = 10;
				$page = I('get.p', '1');
				$cond['lb_shanghufuwuxiangmu.status'] = '0';
		$leibie = $m_fuwuxiangmu
				->table('lb_shanghufuwuxiangmu')
		        ->join('LEFT JOIN lb_fuwuleibie ON lb_fuwuleibie.id = lb_shanghufuwuxiangmu.erjileibie')
		        ->field('lb_shanghufuwuxiangmu.*,lb_fuwuleibie.name as lname')
		        ->where($cond)

		        ->select();

		        //var_dump($leibie);exit;
		 
		 $yuyue = $m_fuwuxiangmu
		 		->table('lb_shanghufuwuxiangmu')
		 		->join('LEFT JOIN lb_yuyue ON lb_shanghufuwuxiangmu.id = lb_yuyue.xid ')
		 		->field('lb_shanghufuwuxiangmu.id,count(lb_yuyue.id) as yuyues')
		 		->where($cond)
		 		->group('id')
		 		->select();
		 		// echo '<pre>';
		 		// print_r($yuyue);exit;


		 $shanghu = $m_shanghu
		 			->table('lb_shanghufuwuxiangmu')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_shanghufuwuxiangmu.id,lb_shanghu.xiangmu)')
		 			->join('LEFT JOIN lb_user ON lb_shanghu.openid = lb_user.openid')
		 			->field('lb_shanghufuwuxiangmu.id,lb_shanghu.mingcheng,lb_user.name as username,lb_user.phone')
		 			->where($cond)
		 			->group('id')
		 			->select();
		 			// echo '<pre>';
		 		 // print_r($shanghu);exit;
		 		 
		 // echo $m_shanghu->getLastSQL();exit;

		$this->assign('leibie',$leibie);
		$this->assign('yuyue',$yuyue);
		$this->assign('shanghu',$shanghu);
		$total = $m_fuwuxiangmu->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
	

		$this->display();
	}


	

	public function listAction()
	{
		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('fuwuxiangmu');
		$m_yuyue = M('yuyue');
		$m_shanghu = M('shanghu');

		$pagesize = 10;
		$page = I('get.p', '1');
		$cond['lb_fuwuxiangmu.status'] = '2';
		$leibie = $m_fuwuxiangmu
				->table('lb_fuwuxiangmu')
		        ->join('LEFT JOIN lb_fuwuleibie ON lb_fuwuleibie.id = lb_fuwuxiangmu.erjileibie')
		        ->field('lb_fuwuxiangmu.*,lb_fuwuleibie.name as lname')
		        ->where($cond)
		        ->page($page, $pagesize)
		        ->select();

		        //var_dump($leibie);exit;
		 
		 $yuyue = $m_fuwuxiangmu
		 		->table('lb_fuwuxiangmu')
		 		->join('LEFT JOIN lb_yuyue ON lb_fuwuxiangmu.id = lb_yuyue.xid ')
		 		->field('lb_fuwuxiangmu.id,count(lb_yuyue.id) as yuyues')
		 		->where($cond)
		 		->group('id')
		 		->page($page, $pagesize)
		 		->select();
		 		// echo '<pre>';
		 		// print_r($yuyue);exit;


		 $shanghu = $m_shanghu
		 			->table('lb_fuwuxiangmu')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_fuwuxiangmu.id,lb_shanghu.xiangmu)')
		 			->field('lb_fuwuxiangmu.id,count(lb_shanghu.id) as shanghus')
		 			->where($cond)
		 			->group('id')
		 			->page($page, $pagesize)
		 			->select();
		 			// echo '<pre>';
		 		 // print_r($shanghu);exit;
// echo $m_shanghu->getLastSQL();exit;
		$this->assign('leibie',$leibie);
		$this->assign('yuyue',$yuyue);
		$this->assign('shanghu',$shanghu);
		$total = $m_fuwuxiangmu->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
		$this->display();
	
	}


	/**
	 * 待开通服务项目
	 **/
	public function list1Action()
	{
		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('fuwuxiangmu');
		$m_yuyue = M('yuyue');
		$m_shanghu = M('shanghu');

		$pagesize = 10;
		$page = I('get.p', '1');
		$cond['lb_fuwuxiangmu.status'] = '1';
		$leibie = $m_fuwuxiangmu
				->table('lb_fuwuxiangmu')
		        ->join('LEFT JOIN lb_fuwuleibie ON lb_fuwuleibie.id = lb_fuwuxiangmu.erjileibie')
		        ->field('lb_fuwuxiangmu.*,lb_fuwuleibie.name as lname')
		        ->where($cond)
		        ->page($page, $pagesize)
		        ->select();

		        // var_dump($leibie);exit;
		 
		 $yuyue = $m_fuwuxiangmu
		 		->table('lb_fuwuxiangmu')
		 		->join('LEFT JOIN lb_yuyue ON lb_fuwuxiangmu.id = lb_yuyue.xid')
		 		->field('lb_fuwuxiangmu.id,count(lb_yuyue.id) as yuyues')
		 		->where($cond)
		 		->page($page, $pagesize)
		 		->group('id')
		 		->select();
		 		// echo '<pre>';
		 		// print_r($yuyue);exit;


		 $shanghu = $m_shanghu
		 			->table('lb_fuwuxiangmu')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_fuwuxiangmu.id,lb_shanghu.xiangmu)')
		 			->field('lb_fuwuxiangmu.id,count(lb_shanghu.id) as shanghus')
		 			->where($cond)
		 			->page($page, $pagesize)
		 			->group('id')
		 			->select();
		 			// echo '<pre>';
		 		 // print_r($shanghu);exit;

		$this->assign('leibie',$leibie);
		$this->assign('yuyue',$yuyue);
		$this->assign('shanghu',$shanghu);
		$total = $m_fuwuxiangmu->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
		$this->display();
	}


	public function addAction()
	{
		$xiangmu = M('fuwuxiangmu');
		$leibie = M('Fuwuleibie');
		if(IS_POST){
			// echo '<pre>';
			// print_r($_FILES);
			// exit;
			$tupian = $this->addpic('./photo/fuwu/');
			$xiangmu->name = $_POST['name'];
			$xiangmu->danwei = $_POST['danwei'];
			$xiangmu->yijileibie = $_POST['yijileibie'];
			$xiangmu->erjileibie = $_POST['erjileibie'];
			$xiangmu->jianjie = $_POST['jianjie'];
			$xiangmu->xiangqing = $_POST['xiangqing'];
			$xiangmu->photo = $tupian[0]['savename'];
			$xiangmu->shijian = time();
			$xiangmu->status = 1;
			$xiangmu->add();
			//var_dump($m);exit;
			$this->redirect('Fuwu/list1');
		}else{
			$leibie_list = $leibie->where('sid = 0')->select();
			$this->assign('leibie_list',$leibie_list);

		}

		$this->display();

	}


	public function addpic($url='./photo/Shequ/')
	{ 
			
			   $upload =  new \Think\UploadFile();// 实例化上传类 
			   $upload->maxSize = 3000000 ;// 设置附件上传大小  C('UPLOAD_SIZE');   
			   //$upload->savePath = './Public/Uploads/' . $path; // 设置附件上传目录  
			   $upload->savePath = $url; // 设置附件上传目录  
			   $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型  
			   $upload->saveRule = 'time';  
			   $upload->uploadReplace = true; //是否存在同名文件是否覆盖  
			   $upload->thumb = true; //是否对上传文件进行缩略图处理  
			   $upload->thumbMaxWidth = '300,600,1000'; //缩略图处理宽度  
			   $upload->thumbMaxHeight = '300,600,1000'; //缩略图处理高度  
			   //$upload->thumbPrefix = $prefix; //缩略图前缀  
			   $upload->thumbPrefix = 's_,m_,b_';  //生产3张缩略图  
			   //$upload->thumbPath = './Public/Uploads/' . $path . date('Ymd', time()) . '/'; //缩略图保存路径  
			   $upload->thumbPath = $url; //缩略图保存路径  
			    
			  //$upload->thumbRemoveOrigin = true; //上传图片后删除原图片  
			   $upload->thumbRemoveOrigin = false; //上传图片后删除原图片
			   $upload->saveRule = 'pictime'; // 采用时间戳命名
			   // $upload->autoSub = true; //是否使用子目录保存图片  
			   // $upload->subType = 'date'; //子目录保存规则  
			   // $upload->dateFormat = 'Ymd'; //子目录保存规则为date时时间格式 
			   if (!$upload->upload()) {// 上传错误提示错误信息  
			       // return json_encode(array('msg' =>($upload->getErrorMsg()), 'status' => 0));  
			       // print_r($upload->getErrorMsg());
			       // exit;
			   }else{
			   	       $infos= $upload->getUploadFileInfo();
			   	       $info = [];
			   	       foreach ($infos as $k => $v) {
			   	       	$info[$v['key']] = $v; 
			   	       }
       				   return $info;
			   }
	}

	public function addtupianAction(){
		$data['success'] = "true";
		$data['file_path'] = "/photo/fuwu/".uploadpic($_FILES['fileData'],'fuwu');
		$this->ajaxReturn($data);
	}







	public function add1Action()
	{
		$m_fuwu = D('fuwuleibie');

		if(IS_POST){

			$tupian = $this->addpic('./photo/leibie/');
			$m_fuwu->sid = I('post.sid');
			$m_fuwu->name = $_POST['name'];
			$m_fuwu->logo = $tupian[0]['savename'];
			$m_fuwu->shijian = time();
			$m = $m_fuwu->add();
			//var_dump($m);exit;
			$this->redirect('Fuwu/list2');
		}
		
		$fuwu_list = $m_fuwu->where('sid = 0')->select();
		$this->assign('fuwu_list',$fuwu_list);
		$this->display();
	}



	public function chak1Action($id)
	{

		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('fuwuxiangmu');

		if(IS_POST){
			if(count($_FILES)){
				$tupian = $this->addpic('./photo/fuwu/');
				if(!empty($tupian)){
					$m_fuwuxiangmu->photo = $tupian[0]['savename'];
				}
			}
			$m_fuwuxiangmu->name = $_POST['name'];
			$m_fuwuxiangmu->danwei = $_POST['danwei'];
			$m_fuwuxiangmu->yijileibie = $_POST['yijileibie'];
			$m_fuwuxiangmu->erjileibie = $_POST['erjileibie'];
			$m_fuwuxiangmu->jianjie = $_POST['jianjie'];
			$m_fuwuxiangmu->xiangqing = $_POST['xiangqing'];
			$m_fuwuxiangmu->status = $_POST['status'];
			
			if($m_fuwuxiangmu->status == '2'){

				$m_fuwuxiangmu->starttime = time();

			}
			

			$m_fuwuxiangmu->where('id='.I('post.id'))->save();
			$this->redirect('Fuwu/list1/p/'.I('get.p'));
		}

		$fuwuxiangmu = $m_fuwuxiangmu->find($id);

		$leibie = $m_fuwuleibie->where('sid = 0')->select();
		
		$leibie1 = $m_fuwuleibie->where('sid ='.$fuwuxiangmu['yijileibie'])->select();
		$this->assign('fuwuxiangmu',$fuwuxiangmu);
		$this->assign('leibie',$leibie);
		$this->assign('leibie1',$leibie1);


		$this->display();

	}


	public function chakAction($id)
	{
		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('fuwuxiangmu');

		if(IS_POST){
			
			if(count($_FILES)){
				$tupian = $this->addpic('./photo/fuwu/');
				if(!empty($tupian)){
					$m_fuwuxiangmu->photo = $tupian[0]['savename'];
				}
			}

			$m_fuwuxiangmu->name = $_POST['name'];
			$m_fuwuxiangmu->danwei = $_POST['danwei'];
			$m_fuwuxiangmu->yijileibie = $_POST['yijileibie'];
			$m_fuwuxiangmu->erjileibie = $_POST['erjileibie'];
			$m_fuwuxiangmu->jianjie = $_POST['jianjie'];
			$m_fuwuxiangmu->xiangqing = $_POST['xiangqing'];
			$m_fuwuxiangmu->status = $_POST['status'];

			$m_fuwuxiangmu->where('id='.I('post.id'))->save();
			$this->redirect('Fuwu/list/p/'.I('get.p'));
		}

		$fuwuxiangmu = $m_fuwuxiangmu->find($id);

		//查询一级类别
		$leibie = $m_fuwuleibie->where('sid = 0')->select();
		
		//查询二级类别
		$leibie1 = $m_fuwuleibie->where('sid ='.$fuwuxiangmu['yijileibie'])->select();
		$this->assign('fuwuxiangmu',$fuwuxiangmu);
		$this->assign('leibie',$leibie);
		$this->assign('leibie1',$leibie1);


		$this->display();



	}

			public function chakshAction($id)
	{
		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('shanghufuwuxiangmu');
		$m_shanghu = M('shanghu');
		$m_user = M('user');

		if(IS_POST){
			if(count($_FILES)){
				$tupian = $this->addpic('./photo/fuwu/');
				if(!empty($tupian)){
					$tupians = [];
					$tupians = $m_fuwuxiangmu->field('tupian')->find($id);
					$tupians = explode(',',$tupians['tupian']);

					if(!empty($tupian[0])){
						$m_fuwuxiangmu->photo = $tupian[0]['savename'];
					}
					unset($tupian[0]);

					foreach($tupian as $k=>$v){
						if(!empty($v)){
							$tupians[$v['key']-1] = $v['savename'];
						}
					}

					$tupian2 = trim(implode(',', $tupians),',');
				}
			}

			$m_fuwuxiangmu->name = $_POST['name'];
			$m_fuwuxiangmu->danwei = $_POST['danwei'];
			$m_fuwuxiangmu->yijileibie = $_POST['yijileibie'];
			$m_fuwuxiangmu->erjileibie = $_POST['erjileibie'];
			$m_fuwuxiangmu->jianjie = $_POST['jianjie'];
			$m_fuwuxiangmu->xiangqing = $_POST['xiangqing'];
			$m_fuwuxiangmu->beizhu = $_POST['beihzu'];
			$m_fuwuxiangmu->status = $_POST['status'];
			$m_fuwuxiangmu->tupian = $tupian2;
		 	$m_fuwuxiangmu->where('id='.I('post.id'))->save();
			$this->redirect('Fuwu/shanghufuwu/p/'.I('get.p'));

		}

		$fuwuxiangmu = $m_fuwuxiangmu->find($id);

		//查询一级类别
		$leibie = $m_fuwuleibie->where('sid = 0')->select();
		
		//查询二级类别
		$leibie1 = $m_fuwuleibie->where('sid ='.$fuwuxiangmu['yijileibie'])->select();

		$shanghu = $m_shanghu
		 			->table('lb_shanghufuwuxiangmu')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_shanghufuwuxiangmu.shanghuid,lb_shanghu.id)')
		 			->join('LEFT JOIN lb_user ON lb_shanghu.openid = lb_user.openid')
		 			->field('lb_shanghufuwuxiangmu.*,lb_shanghu.mingcheng,lb_user.name as username,lb_user.phone')
		 			->where("lb_shanghufuwuxiangmu.id = $id")
		 			->group('id')
		 			->find();

		$zhaopian = explode(',', $fuwuxiangmu['tupian']);
		if(count($zhaopian) ==1 and $zhaopian[0] == ''){
			unset($zhaopian);
			$zhaopian ='';
		}
		$this->assign('fuwuxiangmu',$fuwuxiangmu);
		$this->assign('zhaopian',$zhaopian);
		$this->assign('leibie',$leibie);
		$this->assign('leibie1',$leibie1);
		$this->assign('shanghu',$shanghu);


		$this->display();



	}

	public function add2Action($user_id)
	{
		$m_fuwuleibie = M('fuwuleibie');
		$m_shanghufuwu = M('shanghufuwuxiangmu');
		$m_fuwuxiangmu = M('fuwuxiangmu');
		$m_shanghu = M('shanghu');
		$m_user = M('user');

		if(IS_POST){

			$tupian = $this->addpic('./photo/fuwu/');
			$m_shanghufuwu->photo = $tupian[0]['savename'];
			$url = $tupian[1]['savename']  . ',' . $tupian[2]['savename'] . ',' .$tupian[3]['savename'];
			$m_shanghufuwu->tupian = $url;
			$m_shanghufuwu->name = $_POST['name'];
			$m_shanghufuwu->danwei = $_POST['danwei'];
			$m_shanghufuwu->yijileibie = $_POST['yijileibie'];
			$m_shanghufuwu->erjileibie = $_POST['erjileibie'];
			// var_dump($_POST['erjileibie']);exit;
			$m_shanghufuwu->jianjie = $_POST['jianjie'];
			$m_shanghufuwu->xiangqing = $_POST['xiangqing'];
			$m_shanghufuwu->fuwumoshi = $_POST['fuwumoshi'];	
			$m_shanghufuwu->shijian = time();
			$m_shanghufuwu->shanghuid = $_POST['shanghuid'];
			$m_shanghufuwu->openid = $_POST['openid'];
			$m_shanghufuwu->starttime = time();
			$m_shanghufuwu->status = 2;
			// echo "<pre>";
			// var_dump($_POST);exit;
		    $m_shanghufuwu->add();
			
		}

		$shanghu = $m_shanghu->find($user_id);
		$user = $m_user->where('openid="'.$shanghu['openid'].'"')->find();

		$fuwuxiangmu = $m_fuwuxiangmu->where('status = 2')->select();
		// var_dump ($fuwuxiangmu['yijileibie']);exit;
		//查询一级类别
	    $leibie = $m_fuwuleibie->where('sid = 0')->select();

		$this->assign('shanghu',$shanghu);
		$this->assign('user',$user);
		$this->assign('fuwuxiangmu',$fuwuxiangmu);
		$this->assign('leibie',$leibie);

		
		//查询二级类别
		$leibie1 = $m_fuwuleibie
		  		->table('lb_fuwuleibie')
		  		->join('lb_fuwuxiangmu ON lb_fuwuleibie.id = lb_fuwuxiangmu.erjileibie')
		  		->field('lb_fuwuxiangmu.id,lb_fuwuleibie.id as sid,lb_fuwuxiangmu.name')
		  		->where('lb_fuwuxiangmu.status = 2')
		  		->select();

		$erjileibie = tree($m_fuwuleibie->select());
		$str = '';
		foreach($leibie1 as $k=>$v){
			$str .= '"' . $v['sid'] .'00'. $v['id'] .'":["'.$v['name'].'","'.$v['id'].'","'.$v['id'].'"],';
		}
		foreach($erjileibie as $k=>$v){
			$str .= '"' . $v['id'] .'":["'.$v['name'].'","'.$v['id'].'"],';
		}
		$list = 'list:{'.rtrim($str,',').'},';


		$str = '';
		foreach ($erjileibie as $k => $v) {
			if($v['sid']==0){
				$str .= '],"' . $v['id'] .'":[';
			}else{
				$str .= '"' .$v['id'] .'",';
			}
		}
		$str = ltrim($str,'],');
		$str = rtrim($str,',');
		$str .= ']';
		// $str = '';
		$data = [];
		foreach($leibie1 as $k=>$v){
			// $str .= ',"' . $v['sid'] .'":["'.$v['sid'] .'00'. $v['id'].'"]';
			$data[$v['sid']][] = $v['sid'] .'00'. $v['id'];
		}
		foreach($data as $k=>$v){
			$str .= ',"' . $k .'":[' . '"'.implode($v,'","').'"' . ']';
		}

		$str = trim($str,',');
		$relations = 'relations:{'.$str.'},';



		$str = '';
		foreach ($leibie as $key => $value) {
			$str .= '"'.$value['id'].'",';
		}
		$str = rtrim($str,',');
		$category = 'category:{provinces:['.$str.']}';



		$xiangmu = '{'.$list.$relations.$category.'};';

		$this->assign('xiangmu',($xiangmu));
		


		$this->display();

	}






	public function jinyongAction($id){
		$m_fuwuxiangmu = M('shanghufuwuxiangmu');
		$m_fuwuxiangmu->status = 0;
		$m_fuwuxiangmu->beizhu = I('post.beizhu');
		$m_fuwuxiangmu->jinyongshijian = time();
		$m_fuwuxiangmu->where('id='.$id)->save();
		$this->redirect("Fuwu/shanghufuwu");
		// $this->redirect("Fuwu/shanghufuwu/p/".I('get.p'));
	}


	//服务类别
	//
	public function list2Action()
	{

		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('shanghufuwuxiangmu');
		$m_yuyue = M('yuyue');
		$m_shanghu = M('shanghu');

		$pagesize = 10;
		$page = I('get.p', '1');
		$cond['_string'] = 'lb_fuwuleibie.sid != 0';
		$leibie = $m_fuwuleibie
				->table('lb_fuwuleibie')
				->join('LEFT JOIN lb_shanghufuwuxiangmu ON lb_shanghufuwuxiangmu.erjileibie = lb_fuwuleibie.id')
				->join('LEFT JOIN lb_fuwuleibie as b ON b.id = lb_fuwuleibie.sid')
				->field('lb_fuwuleibie.*,b.name as bname,count(lb_shanghufuwuxiangmu.id) as xiangmus')
				->where($cond)
				->page($page, $pagesize)
				->order('lb_fuwuleibie.name asc')
				->group('id')
				->select();
		

		 $yuyue = $m_yuyue
		 			->table('lb_fuwuleibie')
		 			->join('LEFT JOIN lb_yuyue ON lb_fuwuleibie.id = lb_yuyue.xid')
		 			->field('lb_fuwuleibie.id,count(lb_yuyue.id) as yuyues')
		 			->where($cond)
		 			->page($page, $pagesize)
		 			->order('lb_fuwuleibie.name asc')
		 			->group('id')
		 			->select();
		// echo '<pre>';
		// print_r($yuyue);
		// exit;

		 $shanghu = $m_shanghu
		 			->table('lb_fuwuleibie')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_fuwuleibie.id,lb_shanghu.xiangmu)')
		 			->field('lb_fuwuleibie.id,count(lb_shanghu.id) as shanghus')
		 			->where($cond)
		 			->page($page, $pagesize)
		 			->order('lb_fuwuleibie.name asc')
		 			->group('id')
		 			->select();

				$this->assign('shanghu',$shanghu);
				$this->assign('yuyue',$yuyue);
				$this->assign('leibie',$leibie);
				$total = $m_fuwuleibie->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
				$this->display();

}



	public function editAction($id)
	{
		$m_leibie = M('fuwuleibie');

		if(IS_POST){
			if(count($_FILES)){
				$tupian = $this->addpic('./photo/leibie/');
				if(!empty($tupian)){
					$m_leibie->logo = $tupian[0]['savename'];
				}
			}
			$m_leibie->name = $_POST['name'];
			$m_leibie->sid = $_POST['sid'];
			$m_leibie->where('id='.I('post.id'))->save();
			$this->redirect('Fuwu/list2/p/'.I('get.p'));

		}

		$leibie1 = $m_leibie->find($id);
		$leibie = $m_leibie->where('sid = 0')->select();
		$this->assign('leibie',$leibie);
		$this->assign('leibie1',$leibie1);

		$this->display();


	}


	public function fetchlistAction()

	{
		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('fuwuxiangmu');
		$m_yuyue = M('yuyue');
		$m_shanghu = M('shanghu');
// var_dump($_GET);exit;
		if($_GET['name'] == $_GET['name']){
			
		$cond['lb_fuwuxiangmu.status'] = '2';
		$cond['lb_fuwuxiangmu.name'] = $_GET['name'];
		$leibie = $m_fuwuxiangmu
				->table('lb_fuwuxiangmu')
		        ->join('LEFT JOIN lb_fuwuleibie ON lb_fuwuleibie.id = lb_fuwuxiangmu.erjileibie')
		        ->field('lb_fuwuxiangmu.*,lb_fuwuleibie.name as lname')
		        ->where($cond)
		        ->page($page, $pagesize)
		        ->select();

		// echo $m_fuwuxiangmu->getLastSQL();exit;
		 
		 $yuyue = $m_fuwuxiangmu
		 		->table('lb_fuwuxiangmu')
		 		->join('LEFT JOIN lb_yuyue ON lb_fuwuxiangmu.id = lb_yuyue.xid ')
		 		->field('lb_fuwuxiangmu.id,count(lb_yuyue.id) as yuyues')
		 		->where($cond)
		 		->group('id')
		 		->page($page, $pagesize)
		 		->select();
		 		// echo '<pre>';
		 		// print_r($yuyue);exit;


		 $shanghu = $m_shanghu
		 			->table('lb_fuwuxiangmu')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_fuwuxiangmu.id,lb_shanghu.xiangmu)')
		 			->field('lb_fuwuxiangmu.id,count(lb_shanghu.id) as shanghus')
		 			->where($cond)
		 			->group('id')
		 			->page($page, $pagesize)
		 			->select();
		 			// echo '<pre>';
		 		 // print_r($shanghu);exit;
 
		$this->assign('leibie',$leibie);
		$this->assign('yuyue',$yuyue);
		$this->assign('shanghu',$shanghu);
		$total = $m_fuwuxiangmu->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
		

		}

		$this->display('Fuwu/list');
	}


	public function fetchlist2Action()
	{

		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('shanghufuwuxiangmu');
		$m_yuyue = M('yuyue');
		$m_shanghu = M('shanghu');

		if($_GET['name'] == $_GET['name']){

		$pagesize = 10;
		$page = I('get.p', '1');
		$cond['_string'] = 'lb_fuwuleibie.sid != 0';
		$cond['lb_fuwuleibie.name'] = $_GET['name'];
		$leibie = $m_fuwuleibie
				->table('lb_fuwuleibie')
				->join('LEFT JOIN lb_shanghufuwuxiangmu ON lb_shanghufuwuxiangmu.erjileibie = lb_fuwuleibie.id')
				->join('LEFT JOIN lb_fuwuleibie as b ON b.id = lb_fuwuleibie.sid')
				->field('lb_fuwuleibie.*,b.name as bname,count(lb_shanghufuwuxiangmu.id) as xiangmus')
				->where($cond)
				->page($page, $pagesize)
				->order('lb_fuwuleibie.name asc')
				->group('id')
				->select();
		

		 $yuyue = $m_yuyue
		 			->table('lb_fuwuleibie')
		 			->join('LEFT JOIN lb_yuyue ON lb_fuwuleibie.id = lb_yuyue.xid')
		 			->field('lb_fuwuleibie.id,count(lb_yuyue.id) as yuyues')
		 			->where($cond)
		 			->page($page, $pagesize)
		 			->order('lb_fuwuleibie.name asc')
		 			->group('id')
		 			->select();
		// echo '<pre>';
		// print_r($yuyue);
		// exit;

		 $shanghu = $m_shanghu
		 			->table('lb_fuwuleibie')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_fuwuleibie.id,lb_shanghu.xiangmu)')
		 			->field('lb_fuwuleibie.id,count(lb_shanghu.id) as shanghus')
		 			->where($cond)
		 			->page($page, $pagesize)
		 			->order('lb_fuwuleibie.name asc')
		 			->group('id')
		 			->select();

				$this->assign('shanghu',$shanghu);
				$this->assign('yuyue',$yuyue);
				$this->assign('leibie',$leibie);
				$total = $m_fuwuleibie->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
				
		}
		$this->display('Fuwu/list2');

	}


	public function fetchlist1Action()
	{

		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('fuwuxiangmu');
		$m_yuyue = M('yuyue');
		$m_shanghu = M('shanghu');

		if($_GET['name'] == $_GET['name']){



		$pagesize = 10;
		$page = I('get.p', '1');
		$cond['lb_fuwuxiangmu.status'] = '1';
		$cond['lb_fuwuxiangmu.name'] = $_GET['name'];
		$leibie = $m_fuwuxiangmu
				->table('lb_fuwuxiangmu')
		        ->join('LEFT JOIN lb_fuwuleibie ON lb_fuwuleibie.id = lb_fuwuxiangmu.erjileibie')
		        ->field('lb_fuwuxiangmu.*,lb_fuwuleibie.name as lname')
		        ->where($cond)
		        ->page($page, $pagesize)
		        ->select();

		        //var_dump($leibie);exit;
		 
		 $yuyue = $m_fuwuxiangmu
		 		->table('lb_fuwuxiangmu')
		 		->join('LEFT JOIN lb_yuyue ON lb_fuwuxiangmu.id = lb_yuyue.xid')
		 		->field('lb_fuwuxiangmu.id,count(lb_yuyue.id) as yuyues')
		 		->where($cond)
		 		->page($page, $pagesize)
		 		->group('id')
		 		->select();
		 		// echo '<pre>';
		 		// print_r($yuyue);exit;


		 $shanghu = $m_shanghu
		 			->table('lb_fuwuxiangmu')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_fuwuxiangmu.id,lb_shanghu.xiangmu)')
		 			->field('lb_fuwuxiangmu.id,count(lb_shanghu.id) as shanghus')
		 			->where($cond)
		 			->page($page, $pagesize)
		 			->group('id')
		 			->select();
		 			// echo '<pre>';
		 		 // print_r($shanghu);exit;

		$this->assign('leibie',$leibie);
		$this->assign('yuyue',$yuyue);
		$this->assign('shanghu',$shanghu);
		$total = $m_fuwuxiangmu->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
		
		}

		$this->display('Fuwu/list1');
	}



	public function shanghufetchAction()
	{
		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('shanghufuwuxiangmu');
		$m_yuyue = M('yuyue');
		$m_shanghu = M('shanghu');

		if($_GET['mingcheng'] == $_GET['mingcheng']){

		$pagesize = 10;
		$page = I('get.p', '1');
		$cond['lb_shanghufuwuxiangmu.name'] = $_GET['mingcheng'];
		$cond['lb_shanghufuwuxiangmu.status'] = 2;
		$leibie = $m_fuwuxiangmu
				->table('lb_shanghufuwuxiangmu')
		        ->join('LEFT JOIN lb_fuwuleibie ON lb_fuwuleibie.id = lb_shanghufuwuxiangmu.erjileibie')
		        ->field('lb_shanghufuwuxiangmu.*,lb_fuwuleibie.name as lname')
		        ->where($cond)
		        ->page($page, $pagesize)
		        ->select();

		        //var_dump($leibie);exit;
		 
		 $yuyue = $m_fuwuxiangmu
		 		->table('lb_shanghufuwuxiangmu')
		 		->join('LEFT JOIN lb_yuyue ON lb_shanghufuwuxiangmu.id = lb_yuyue.xid ')
		 		->field('lb_shanghufuwuxiangmu.id,count(lb_yuyue.id) as yuyues')
		 		->where($cond)
		 		->page($page, $pagesize)
		 		->group('id')
		 		->select();
		 		// echo '<pre>';
		 		// print_r($yuyue);exit;


		 
		 $shanghu = $m_shanghu
		 			->table('lb_shanghufuwuxiangmu')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_shanghufuwuxiangmu.id,lb_shanghu.xiangmu)')
		 			->join('LEFT JOIN lb_user ON lb_shanghu.openid = lb_user.openid')
		 			->field('lb_shanghufuwuxiangmu.id,lb_shanghu.mingcheng,lb_user.name as username,lb_user.phone')
		 			->where($cond)
		 			->page($page, $pagesize)
		 			->group('id')
		 			->select();
		 			// echo '<pre>';
		 		 // print_r($shanghu);exit;
		 		 
		 // echo $m_shanghu->getLastSQL();exit;

		$this->assign('leibie',$leibie);
		$this->assign('yuyue',$yuyue);
		$this->assign('shanghu',$shanghu);
		$total = $m_fuwuxiangmu->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());

		}

		$this->display('Fuwu/shanghufuwu');
	}

	public function jinyongfetchAction()
	{

		if($_GET['mingcheng'] == $_GET['mingcheng'])
		{

		$m_fuwuleibie = M('fuwuleibie');
		$m_fuwuxiangmu = M('shanghufuwuxiangmu');
		$m_yuyue = M('yuyue');
		$m_shanghu = M('shanghu');

		if(IS_POST){
				$m_fuwuxiangmu->status = 2;
				$m_fuwuxiangmu->where('id = ' . I('post.xinid'))->save();
				$this->redirect( 'Fuwu/jinyongsh/p/' . I('post.p') );
		}

				$pagesize = 10;
				$page = I('get.p', '1');
				$cond['lb_shanghufuwuxiangmu.name'] = $_GET['mingcheng'];
				$cond['lb_shanghufuwuxiangmu.status'] = '0';
		$leibie = $m_fuwuxiangmu
				->table('lb_shanghufuwuxiangmu')
		        ->join('LEFT JOIN lb_fuwuleibie ON lb_fuwuleibie.id = lb_shanghufuwuxiangmu.erjileibie')
		        ->field('lb_shanghufuwuxiangmu.*,lb_fuwuleibie.name as lname')
		        ->where($cond)

		        ->select();

		        //var_dump($leibie);exit;
		 
		 $yuyue = $m_fuwuxiangmu
		 		->table('lb_shanghufuwuxiangmu')
		 		->join('LEFT JOIN lb_yuyue ON lb_shanghufuwuxiangmu.id = lb_yuyue.xid ')
		 		->field('lb_shanghufuwuxiangmu.id,count(lb_yuyue.id) as yuyues')
		 		->where($cond)
		 		->group('id')
		 		->select();
		 		// echo '<pre>';
		 		// print_r($yuyue);exit;


		 $shanghu = $m_shanghu
		 			->table('lb_shanghufuwuxiangmu')
		 			->join('LEFT JOIN lb_shanghu ON find_in_set(lb_shanghufuwuxiangmu.id,lb_shanghu.xiangmu)')
		 			->join('LEFT JOIN lb_user ON lb_shanghu.openid = lb_user.openid')
		 			->field('lb_shanghufuwuxiangmu.id,lb_shanghu.mingcheng,lb_user.name as username,lb_user.phone')
		 			->where($cond)
		 			->group('id')
		 			->select();
		 			// echo '<pre>';
		 		 // print_r($shanghu);exit;
		 		 
		 // echo $m_shanghu->getLastSQL();exit;

		$this->assign('leibie',$leibie);
		$this->assign('yuyue',$yuyue);
		$this->assign('shanghu',$shanghu);
		$total = $m_fuwuxiangmu->where($cond)->count();
		$t_page = new Page($total, $pagesize);
		$this->assign('page_html', $t_page->show());
	

		}

		$this->display('Fuwu/jinyongsh');

	}


		


}