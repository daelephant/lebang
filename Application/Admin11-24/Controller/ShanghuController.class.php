<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class ShanghuController extends AuthController
{
	public function _initialize(){
         parent::_initialize();
    }


    public function addAction(){

        $m_shanghu = M('Shanghu');
        $m_master = M('master');
        $m_shequ = M('shequ');
        $m_area = M('Area');
        $m_user = M('User');
        $m_fuwuxiangmu = M('fuwuleibie');


        $master = $m_master->where('sid = 1')->select();
        $shequ = $m_shequ->where('xianshi = 1')->select();
        $fuwu = $m_fuwuxiangmu->field('id,sid,name')->select();
        $area = $m_area->field('id,sid,mingcheng')->select();
        $this->assign('master',$master);
        $this->assign('shequ',$shequ);
        $this->assign('fuwu',json_encode(getTree2($fuwu)));
        $this->assign('area',json_encode(getTree3($area,'52','mingcheng')));

        if(IS_POST){
        $user = $m_user->where('phone="'.$_POST['phone'].'"')->find();
        if(!$user->phone){
          $data['phone'] = $_POST['phone'];
        }
        $data['nickname'] = $_POST['nickname'];
        $data['profession'] = $_POST['profession'];
        $data['name'] = $_POST['name'];
        $data['sex'] = $_POST['sex'];
        $data['idnumber'] = $_POST['idnumber'];
        $data['location'] = $_POST['suozaixiaoqutxt'];
        $data['birthday'] = strtotime($_POST['birthday']);
        // if(!$user['status']){
        $data['status'] = 3;
        // }
        if($user['renzhengtime']!==''){
            $data['renzhengtime'] = time();
        }
        if(!$user['regtime']){
            $data['regtime'] = time();
        }

        if(!empty($_FILES['avatar']['tmp_name'])){
            $data['avatar'] = uploadpic($_FILES['avatar'],'avatar');
        }
        if(!empty($_FILES['idpic']['tmp_name'])){
            $data['idpic'] = uploadpic($_FILES['idpic'],'idpic');
        }
        
        $data['shequid'] = $_POST['suozaixiaoqu'];
        
        if(!$user){
          $data['openid'] = md5($_POST['phone'].time());
          $openid = $data['openid'];
          $m_user->add($data);

        }else{
          $openid = $user['openid'];
          // $m_users = $m_shanghu->where("openid='".$openid."'")->select();
          // if(count($m_users) >0){
          //   $this->error('该用户已注册为商户!!!!!');
          // }
          $m_user->where('phone="'.$_POST['phone'].'"')->save($data);
        }
        // $info = $this->addpic('./photo/shanghu/');

        $m_shanghu->openid = $openid;
        // var_dump($data);exit;


        if(!empty($_FILES['logo']['tmp_name'])){
            $m_shanghu->logo = uploadpic($_FILES['logo'],'shanghu');
        }else{
          // $this->error('店铺封面');
          // $m_shanghu->logo = '';
        }
        if(!empty($_FILES['zhizhao']['tmp_name'])){
            $m_shanghu->zhizhao = uploadpic($_FILES['zhizhao'],'shanghu');
        }else{
          // $this->error('营业执照');
          // $m_shanghu->zhizhao = '';
        }
        // $m_shanghu->logo = $info[0]['savename'];
        // $m_shanghu->zhizhao = $info[1]['savename'];
        if(!empty($_POST['daojia'])){
             $m_shanghu->daojia = $_POST['daojia'];
        }else{
           $m_shanghu->daojia = 0;
        }
        if(!empty($_POST['daodian'])){
          $m_shanghu->daodian = $_POST['daodian'];
        }else{
          $m_shanghu->daodian = 0;
        }

        $m_shanghu->mingcheng = $_POST['mingcheng'];
        $m_shanghu->dianhua = $_POST['dianhua'];
     
        $m_shanghu->kaishishijian = $_POST['kaishishijian'];
        $m_shanghu->jieshushijian = $_POST['jieshushijian'];
        // $xiangmu = implode(',',$_POST['xiangmu']);
        $m_shanghu->xiangmu = ','.str_replace('-',',',$_POST['xiangmu']).',';
        // $xiangmutxt = implode('',$_POST['xiangmutxt']);
        $m_shanghu->xiangmutxt = str_replace(['&nbsp',' '],'',$_POST['xiangmutxt']);
        $m_shanghu->quyu = ','.str_replace('-',',',$_POST['quyu']).',';
        $m_shanghu->quyutxt = $_POST['quyutxt'];
        $m_shanghu->dizhi = $_POST['dizhi'];
        $m_shanghu->jianjie = $_POST['jianjie'];
        $m_shanghu->jieshao = $_POST['jieshao'];
       
        $m_shanghu->xiaoqu = '';
        $m_shanghu->xiaoqutxt = '';
        $m_shanghu->status = 0;
         // var_dump($_POST);exit;
         // var_dump($_POST);exit;
        $shanghuid = $m_shanghu->add();

        $m_user->shanghuid = $shanghuid;
        $m_user->where('phone="'.$_POST['phone'].'"')->save();
 
        $this->redirect('Shanghu/daishenhe');
        
        }

        $this->display();
    }

          public function addtupianAction(){
        $data['success'] = "true";
        $data['file_path'] = "/photo/shanghu/".uploadpic($_FILES['fileData'],'shanghu');
        $this->ajaxReturn($data);
      }



    public function daishenheAction()
    {
      // 分页
      $pagesize = 10;
      $page = I('get.p', '1');

      $m_shanghu = M('Shanghu');
      $cond['lb_shanghu.status'] = 0;
      $shanghu = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                           ->field('lb_user.name,lb_user.phone,lb_user.sex,lb_user.idpic,lb_shanghu.*')
                           ->where($cond)
                           ->page($page, $pagesize)
                           ->order('id desc')
                           ->select();

    	$this->assign('shanghu',$shanghu);

      $total = $m_shanghu->where($cond)->count();
      $t_page = new Page($total, $pagesize);
      $this->assign('page_html', $t_page->show());

    	$this->display();
    }

    public function tongguoAction(){
    	$id = $_POST['xid'];
    	$data['status'] = 2;
    	M('shanghu')->where('id='.$id)->save($data);
      $this->redirect('Shanghu/daishenhe/p/'.$_GET['p']);
    }

    public function butongguoAction(){
    	$id = $_POST['xid'];
    	$data['status'] = 1;
      $data['beizhu'] = $_POST['beizhu'];
      M('shanghu')->where('id='.$id)->save($data);
      $this->redirect('Shanghu/daishenhe/p/'.$_GET['p']);
    }

    public function weitongguoAction()
    {
      // 分页
      $pagesize = 10;
      $page = I('get.p', '1');

      $m_shanghu = M('Shanghu');
      $cond['lb_shanghu.status'] = 1;
      $shanghu = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                           ->field('lb_user.name,lb_user.phone,lb_user.sex,lb_shanghu.*')
                           ->where($cond)
                           ->page($page, $pagesize)
                           ->order('id desc')
                           ->select();
      $this->assign('shanghu',$shanghu);

      $total = $m_shanghu->where($cond)->count();
      $t_page = new Page($total, $pagesize);
      $this->assign('page_html', $t_page->show());

      $this->display();
    }


    public function renzhengAction()
    {
      // 分页
      $pagesize = 10;
      $page = I('get.p', '1');

      $m_shanghu = M('Shanghu');
      $cond['lb_shanghu.status'] = 2;
      $cond['lb_shanghu.tuijian'] = 0;

      $shanghu = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                          ->join('lb_shanghufuwuxiangmu on lb_shanghu.id = lb_shanghufuwuxiangmu.shanghuid')
                          ->field('lb_user.name,lb_user.phone,lb_user.sex,lb_shanghu.*,count(lb_shanghufuwuxiangmu.id) as fumu')
                          ->where($cond)
                          ->page($page, $pagesize)
                          ->order('lb_shanghu.id desc')
                          ->group('lb_shanghu.id')
                          ->select();

      $orders = $m_shanghu->join('left join lb_order on lb_shanghu.openid = lb_order.jdopenid')
                           ->field('lb_shanghu.id,count(lb_order.id) as orders')
                           ->where($cond)
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->group('lb_shanghu.id')
                           ->select();

      $order = [];
      foreach($orders as $k=>$v){
        $order[$v['id']] = $v['orders'];
      }

      $renwus = $m_shanghu->join('left join lb_order on lb_shanghu.openid = lb_order.jdopenid')
                           ->field('lb_shanghu.id,count(lb_order.id) as orders')
                           ->where(array($cond,'lb_order.status'=>4))
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->group('lb_shanghu.id')
                           ->select();

      $renwu = [];
      foreach($renwus as $k=>$v){
        $renwu[$v['id']] = $v['orders'];
      }

      $this->assign('shanghu',$shanghu);
      $this->assign('order',$order);
      $this->assign('renwu',$renwu);
      // $this->assign('fuwu',$fuwu);

      $total = $m_shanghu->where($cond)->count();
      $t_page = new Page($total, $pagesize);
      $this->assign('page_html', $t_page->show());

      $this->display();
    }

    public function rbianjiAction($user_id)
    {
        $m_shanghu = M('Shanghu');
        $m_master = M('master');
        $m_shequ = M('shequ');
        $m_area = M('Area');
        $m_user = M('User');
        $m_fuwuxiangmu = M('fuwuxiangmu');

        if(IS_POST){
            // var_dump($_POST);exit;
      
        // $user = $m_user->where('phone="'.$_POST['phone'].'"')->find();
        if(!empty($_FILES['avatar']['tmp_name'])){
            $m_user->avatar = uploadpic($_FILES['avatar'],'avatar');
        }
        if(!empty($_FILES['idpic']['tmp_name'])){
            $m_user->idpic= uploadpic($_FILES['idpic'],'idpic');
        }

        $m_user->phone = $_POST['phone'];
        $m_user->nickname = $_POST['nickname'];
        $m_user->profession = $_POST['profession'];
        $m_user->name = $_POST['name'];
        $m_user->sex = $_POST['sex'];
        $m_user->idnumber = $_POST['idnumber'];
        $m_user->birthday = strtotime($_POST['birthday']);
        $m_user->shequid = $_POST['suozaixiaoqu'];
        $m_user->where('phone="'.$_POST['phone'].'"')->save();

        // $info = $this->addpic('./photo/shanghu/');

        // if(!empty($info[0])){
        //   $m_shanghu->logo = $info[0]['savename'];
        // }
        // if(!empty($info[1])){
        //   $m_shanghu->zhizhao = $info[1]['savename'];
        // }
        if(!empty($_FILES['logo']['tmp_name'])){
            $m_shanghu->logo = uploadpic($_FILES['logo'],'shanghu');
        }else{

        }
        if(!empty($_FILES['zhizhao']['tmp_name'])){
            $m_shanghu->zhizhao = uploadpic($_FILES['zhizhao'],'shanghu');
        }

        $m_shanghu->mingcheng = $_POST['mingcheng'];
        $m_shanghu->dianhua = $_POST['dianhua'];
        $m_shanghu->kaishishijian = $_POST['kaishishijian'];
        $m_shanghu->jieshushijian = $_POST['jieshushijian'];

        $m_shanghu->xiangmu = ','.str_replace('-',',',$_POST['xiangmu']).',';
        $m_shanghu->xiangmutxt = str_replace(['&nbsp',' '],'',$_POST['xiangmutxt']);
        $m_shanghu->quyu = ','.str_replace('-',',',$_POST['quyu']).',';
        $m_shanghu->quyutxt = $_POST['quyutxt'];

        // $xiangmu = implode(',',$_POST['xiangmu']);
        // $m_shanghu->xiangmu = $_POST['xiangmu'];
        // $xiangmutxt = implode('',$_POST['xiangmutxt']);
        // $m_shanghu->xiangmutxt = str_replace(['&nbsp',' '],'',$_POST['xiangmutxt']);
        // $m_shanghu->quyu = $_POST['quyu'];
        // $m_shanghu->quyutxt = $_POST['quyutxt'];
        $m_shanghu->dizhi = $_POST['dizhi'];
        $m_shanghu->jianjie = $_POST['jianjie'];
        $m_shanghu->xiaoqu = $_POST['xiaoqu'];
        $m_shanghu->xiaoqutxt = $_POST['xiaoqutxt'];
        $shanghuid = $m_shanghu->where('id='.$user_id)->save();
 
        $this->redirect('Shanghu/renzheng/p/'.I('get.p'));
        }

        $master = $m_master->where('sid = 1')->select();
        $shequ = $m_shequ->where('xianshi = 1')->select();
        $fuwu = $m_fuwuxiangmu->select();
        $area = $m_area->where('sid = 52')->select();

        $this->assign('master',$master);
        $this->assign('shequ',$shequ);
        $this->assign('fuwu',$fuwu);
        $this->assign('area',$area);

        $cond['lb_shanghu.id'] = $user_id;
        $shanghu = $m_shanghu->join('left join lb_user on lb_shanghu.openid = lb_user.openid')
                             ->where($cond)
                             ->find();
        $this->assign('shanghu',$shanghu);
        $this->assign('quyutxt',explode(',',$shanghu['quyutxt']));
        $this->assign('xiaoqutxt',explode(',',$shanghu['xiaoqutxt']));

        $shequ = $m_shequ->where('id='.$shanghu['shequid'])->find();
        $this->assign('shequ',$shequ);
        
        $m_fuwuxiang = M('fuwuleibie');
        $fuwu = $m_fuwuxiang->field('id,sid,name')->select();
        $area = $m_area->field('id,sid,mingcheng')->select();
        $this->assign('fuwu',json_encode(getTree2($fuwu)));
        $this->assign('area',json_encode(getTree3($area,'52','mingcheng')));
        $this->assign('xiangmu',explode(',',trim($shanghu['xiangmu'],',')));
        $this->assign('quyu',explode(',',trim($shanghu['quyu'],',')));
        $this->assign('qt',explode('-',trim($shanghu['quyutxt'],',')));


        $this->display();
    }

    public function yjinyongAction(){
      $id = $_POST['xid'];
      $data['status'] = -1;
      $data['beizhu'] = $_POST['beizhu'];
      $data['jinyongshijian'] = time();
      M('shanghu')->where('id='.$id)->save($data);
      $this->redirect('Shanghu/jinyong');
    }

    public function ytuijianAction(){
      $id = $_POST['xid'];
      $data['tuijian'] = 1;
      M('shanghu')->where('id='.$id)->save($data);
      $this->redirect('Shanghu/tuijian');
    }

    public function yrtuijianAction(){
      $id = $_POST['xid'];
      $data['tuijian'] = 0;
      M('shanghu')->where('id='.$id)->save($data);
      $this->redirect('Shanghu/renzheng');
    }

    public function tuijianAction()
    {
      // 分页
      $pagesize = 10;
      $page = I('get.p', '1');

      $m_shanghu = M('Shanghu');
      $cond['lb_shanghu.status'] = 2;
      $cond['lb_shanghu.tuijian'] = 1;

      $shanghu = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                          ->field('lb_user.name,lb_user.phone,lb_user.sex,lb_shanghu.*')
                          ->where($cond)
                          ->page($page, $pagesize)
                          ->order('lb_shanghu.id desc')
                          ->group('lb_shanghu.id')
                          ->select();

      $orders = $m_shanghu->join('left join lb_order on lb_shanghu.openid = lb_order.jdopenid')
                           ->field('lb_shanghu.id,count(lb_order.id) as orders')
                           ->where($cond)
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->group('lb_shanghu.id')
                           ->select();

      $order = [];
      foreach($orders as $k=>$v){
        $order[$v['id']] = $v['orders'];
      }

      $renwus = $m_shanghu->join('left join lb_order on lb_shanghu.openid = lb_order.jdopenid')
                           ->field('lb_shanghu.id,count(lb_order.id) as orders')
                           ->where(array($cond,'lb_order.status'=>4))
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->group('lb_shanghu.id')
                           ->select();

      $renwu = [];
      foreach($renwus as $k=>$v){
        $renwu[$v['id']] = $v['orders'];
      }

      $this->assign('shanghu',$shanghu);
      $this->assign('order',$order);
      $this->assign('renwu',$renwu);

      $total = $m_shanghu->where($cond)->count();
      $t_page = new Page($total, $pagesize);
      $this->assign('page_html', $t_page->show());

      $this->display();
    }

    public function rtuijianAction($user_id)
    {
        $m_shanghu = M('Shanghu');
        $m_master = M('master');
        $m_shequ = M('shequ');
        $m_area = M('Area');
        $m_user = M('User');
        $m_fuwuxiangmu = M('fuwuxiangmu');

        
        if(IS_POST){
        // $m_shanghus = $m_shanghu->field('openid')->find($userid);
       if(!empty($_FILES['avatar']['tmp_name'])){
            $m_user->avatar = uploadpic($_FILES['avatar'],'avatar');
        }
        if(!empty($_FILES['idpic']['tmp_name'])){
            $m_user->idpic= uploadpic($_FILES['idpic'],'idpic');
        }
        // var_dump($m_user);exit;
      
        $m_user->phone = $_POST['phone'];
      
        $m_user->nickname = $_POST['nickname'];
        $m_user->profession = $_POST['profession'];
        $m_user->name = $_POST['name'];
        $m_user->sex = $_POST['sex'];
        $m_user->idnumber = $_POST['idnumber'];
        $m_user->birthday = strtotime($_POST['birthday']);
        $m_user->shequid = $_POST['suozaixiaoqu'];
        // $m_user->where('openid="'.$m_shanghus['openid'].'"')->save();
        $m_user->where('phone="'.$_POST['phone'].'"')->save();

        
        if(!empty($_FILES['logo']['tmp_name'])){
            $m_shanghu->logo = uploadpic($_FILES['logo'],'shanghu');
        }else{

        }
        if(!empty($_FILES['zhizhao']['tmp_name'])){
            $m_shanghu->zhizhao = uploadpic($_FILES['zhizhao'],'shanghu');
        }
        $m_shanghu->mingcheng = $_POST['mingcheng'];
        $m_shanghu->dianhua = $_POST['dianhua'];
        $m_shanghu->kaishishijian = $_POST['kaishishijian'];
        $m_shanghu->jieshushijian = $_POST['jieshushijian'];

        $m_shanghu->xiangmu = ','.str_replace('-',',',$_POST['xiangmu']).',';
        $m_shanghu->xiangmutxt = str_replace(['&nbsp',' '],'',$_POST['xiangmutxt']);
        $m_shanghu->quyu = ','.str_replace('-',',',$_POST['quyu']).',';
        $m_shanghu->quyutxt = $_POST['quyutxt'];

        // $xiangmu = implode(',',$_POST['xiangmu']);
        // $m_shanghu->xiangmu = $_POST['xiangmu'];
        // $xiangmutxt = implode('',$_POST['xiangmutxt']);
        // $m_shanghu->xiangmutxt = str_replace(['&nbsp',' '],'',$_POST['xiangmutxt']);
        // $m_shanghu->quyu = $_POST['quyu'];
        // $m_shanghu->quyutxt = $_POST['quyutxt'];
        $m_shanghu->dizhi = $_POST['dizhi'];
        $m_shanghu->jianjie = $_POST['jianjie'];
        $m_shanghu->xiaoqu = $_POST['xiaoqu'];
        $m_shanghu->xiaoqutxt = $_POST['xiaoqutxt'];
        $shanghuid = $m_shanghu->where('id='.$user_id)->save();
 
        $this->redirect("Shanghu/tuijian/p/".I('get.p'));
        }


        $master = $m_master->where('sid = 1')->select();
        $shequ = $m_shequ->where('xianshi = 1')->select();
        $fuwu = $m_fuwuxiangmu->select();
        $area = $m_area->where('sid = 52')->select();

        $this->assign('master',$master);
        $this->assign('shequ',$shequ);
        $this->assign('fuwu',$fuwu);
        $this->assign('area',$area);

        $cond['lb_shanghu.id'] = $user_id;
        $shanghu = $m_shanghu->join('left join lb_user on lb_shanghu.openid = lb_user.openid')
                             ->where($cond)
                             ->find();
        $this->assign('shanghu',$shanghu);
        $this->assign('quyutxt',explode(',',$shanghu['quyutxt']));
        $this->assign('xiaoqutxt',explode(',',$shanghu['xiaoqutxt']));

        $shequ = $m_shequ->where('id='.$shanghu['shequid'])->find();
        $this->assign('shequ',$shequ);
        
        $m_fuwuxiang = M('fuwuleibie');
        $fuwu = $m_fuwuxiang->field('id,sid,name')->select();
        $area = $m_area->field('id,sid,mingcheng')->select();
        $this->assign('fuwu',json_encode(getTree2($fuwu)));
        $this->assign('area',json_encode(getTree3($area,'52','mingcheng')));
        $this->assign('xiangmu',explode(',',trim($shanghu['xiangmu'],',')));
        $this->assign('quyu',explode(',',trim($shanghu['quyu'],',')));
        $this->assign('qt',explode('-',trim($shanghu['quyutxt'],',')));
        $this->display();
    }


    public function jinyongAction()
    {
      // 分页
      $pagesize = 10;
      $page = I('get.p', '1');

      $m_shanghu = M('Shanghu');
      $cond['lb_shanghu.status'] = -1;
      $shanghu = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                           ->field('lb_user.name,lb_user.phone,lb_user.sex,lb_shanghu.*')
                           ->where($cond)
                           ->page($page, $pagesize)
                           ->order('id desc')
                           ->select();
      $this->assign('shanghu',$shanghu);

      $total = $m_shanghu->where($cond)->count();
      $t_page = new Page($total, $pagesize);
      $this->assign('page_html', $t_page->show());

      $this->display();
    }

    public function qiyongAction(){
      $id = $_POST['xid'];
      $data['status'] = 2;
      M('shanghu')->where('id='.$id)->save($data);
      $this->redirect('Shanghu/jinyong/p/'.$_GET['p']);
    }

    public function ajaxAction($id){
        $area = M('area')->where('sid='.$id)->select();
        $this->ajaxReturn($area);
    }

    public function ajaxdianpuAction($openid,$dianpu){
        $shanghu = M('shanghu')->where('mingcheng like "%'.$dianpu.'%"')->limit(1)->select();
        $this->ajaxReturn($shanghu);

    }

    public function ajaxshequAction($id){
        $area = M('Shequ')->where('quyu like "%'.$id.'%"')->select();
        $this->ajaxReturn($area);
    }

    public function getUserAction($addr){
        $user = M('User')->join('lb_shequ on lb_shequ.id = lb_user.shequid')->where('phone like "%'.$addr.'%"')->limit(1)->select();
        $this->ajaxReturn($user);
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
                   //return json_encode(array('msg' =>($upload->getErrorMsg()), 'status' => 0));  
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

    public function fetchAction()
    {

    if ($_GET['sosuo'] == 1) {

      $cond1['lb_user.phone']=$_GET['value'];
       $cond['lb_shanghu.status'] = 0;
    }
    if ($_GET['sosuo'] == 2) {
   
      $cond1['lb_user.name']=$_GET['value'];
       $cond['lb_shanghu.status'] = 0;
        }

    if($_GET['sosuo'] == 3){

      $cond1['lb_shanghu.mingcheng'] = $_GET['value'];
      $cond['lb_shanghu.status'] = 0;
    }

      $pagesize = 10;
      $page = I('get.p', '1');

      $m_shanghu = M('Shanghu');

     
      $shanghu = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                           ->field('lb_user.name,lb_user.phone,lb_user.sex,lb_user.idpic,lb_shanghu.*')
                           ->where([$cond,$cond1])
                           ->page($page, $pagesize)
                           ->order('id desc')
                           ->select();
      
      $this->assign('shanghu',$shanghu);

      $total = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                           ->field('count(lb_shanghu.id) as total')
                           ->where([$cond,$cond1])
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->find();

      $t_page = new Page($total['total'], $pagesize);
      $this->assign('page_html', $t_page->show());

      $this->display('Shanghu/daishenhe');
  
    }

    public function fetch1Action()
    {

      if ($_GET['sosuo'] == 1) {

      $cond1['lb_user.phone']=$_GET['value'];

    }
    if ($_GET['sosuo'] == 2) {
   
      $cond1['lb_user.name']=$_GET['value'];

      }

    if($_GET['sosuo'] == 3){

      $cond1['lb_shanghu.mingcheng'] = $_GET['value'];

    }


      $cond['lb_shanghu.status'] = 1;
      $pagesize = 10;
      $page = I('get.p', '1');
      $m_shanghu = M('Shanghu');
      $shanghu = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                           ->field('lb_user.name,lb_user.phone,lb_user.sex,lb_shanghu.*')
                           ->where([$cond,$cond1])
                           ->page($page, $pagesize)
                           ->order('id desc')
                           ->select();
      $this->assign('shanghu',$shanghu);

      $total = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                           ->field('count(lb_shanghu.id) as total')
                           ->where([$cond,$cond1])
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->find();

      // $total = $m_shanghu->where($cond)->count();
      $t_page = new Page($total['total'], $pagesize);
      $this->assign('page_html', $t_page->show());
  

     $this->display('Shanghu/weitongguo');
    }
    
    public  function fetch2Action()
    {

    if ($_GET['sosuo'] == 1) {

      $cond1['lb_user.phone']=$_GET['value'];

    }
    if ($_GET['sosuo'] == 2) {
   
      $cond1['lb_user.name']=$_GET['value'];

      }

    if($_GET['sosuo'] == 3){

      $cond1['lb_shanghu.mingcheng'] = $_GET['value'];

    }

    $pagesize = 10;
      $page = I('get.p', '1');

      $m_shanghu = M('Shanghu');
      $cond['lb_shanghu.status'] = 2;
      $cond['lb_shanghu.tuijian'] = 0;

      $shanghu = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                          ->field('lb_user.name,lb_user.phone,lb_user.sex,lb_shanghu.*')
                          ->where([$cond,$cond1])
                          ->page($page, $pagesize)
                          ->order('lb_shanghu.id desc')
                          ->group('lb_shanghu.id')
                          ->select();

      $orders = $m_shanghu->join('left join lb_order on lb_shanghu.openid = lb_order.jdopenid')
                           ->field('lb_shanghu.id,count(lb_order.id) as orders')
                           ->where($cond)
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->group('lb_shanghu.id')
                           ->select();

      $order = [];
      foreach($orders as $k=>$v){
        $order[$v['id']] = $v['orders'];
      }

      $renwus = $m_shanghu->join('left join lb_order on lb_shanghu.openid = lb_order.jdopenid')
                           ->field('lb_shanghu.id,count(lb_order.id) as orders')
                           ->where(array([$cond,'lb_order.status'=>4]))
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->group('lb_shanghu.id')
                           ->select();

      $renwu = [];
      foreach($renwus as $k=>$v){
        $renwu[$v['id']] = $v['orders'];
      }

      $this->assign('shanghu',$shanghu);
      $this->assign('order',$order);
      $this->assign('renwu',$renwu);

      $total = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                          ->field('count(lb_shanghu.id) as total')
                          ->where([$cond,$cond1])
                          ->page($page, $pagesize)
                          ->order('lb_shanghu.id desc')
                          ->group('lb_shanghu.id')
                          ->find();
      //$total = $m_shanghu->where([$cond,$cond1])->count();
      $t_page = new Page($total['total'], $pagesize);
      $this->assign('page_html', $t_page->show());

      $this->display('Shanghu/renzheng');

    }


    public function fetch3Action()
    {

      if ($_GET['sosuo'] == 1) {

      $cond1['lb_user.phone']=$_GET['value'];

    }
    if ($_GET['sosuo'] == 2) {
   
      $cond1['lb_user.name']=$_GET['value'];

      }

    if($_GET['sosuo'] == 3){

      $cond1['lb_shanghu.mingcheng'] = $_GET['value'];

    }

    $pagesize = 10;
      $page = I('get.p', '1');

      $m_shanghu = M('Shanghu');
      $cond['lb_shanghu.status'] = 2;
      $cond['lb_shanghu.tuijian'] = 1;

      $shanghu = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                          ->field('lb_user.name,lb_user.phone,lb_user.sex,lb_shanghu.*')
                          ->where([$cond,$cond1])
                          ->page($page, $pagesize)
                          ->order('lb_shanghu.id desc')
                          ->group('lb_shanghu.id')
                          ->select();

      $orders = $m_shanghu->join('left join lb_order on lb_shanghu.openid = lb_order.jdopenid')
                           ->field('lb_shanghu.id,count(lb_order.id) as orders')
                           ->where($cond)
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->group('lb_shanghu.id')
                           ->select();

      $order = [];
      foreach($orders as $k=>$v){
        $order[$v['id']] = $v['orders'];
      }

      $renwus = $m_shanghu->join('left join lb_order on lb_shanghu.openid = lb_order.jdopenid')
                           ->field('lb_shanghu.id,count(lb_order.id) as orders')
                           ->where(array($cond,'lb_order.status'=>4))
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->group('lb_shanghu.id')
                           ->select();

      $renwu = [];
      foreach($renwus as $k=>$v){
        $renwu[$v['id']] = $v['orders'];
      }

      $this->assign('shanghu',$shanghu);
      $this->assign('order',$order);
      $this->assign('renwu',$renwu);

      $total = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                          ->field('count(lb_shanghu.id) as total')
                          ->where([$cond,$cond1])
                          ->page($page, $pagesize)
                          ->order('lb_shanghu.id desc')
                          ->group('lb_shanghu.id')
                          ->find();


      // $total = $m_shanghu->where($cond)->count();
      $t_page = new Page($total['total'], $pagesize);
      $this->assign('page_html', $t_page->show());

      $this->display('Shanghu/tuijian');

    }




    public function fetch4Action()
    {

    if ($_GET['sosuo'] == 1) {

      $cond1['lb_user.phone']=$_GET['value'];

    }
    if ($_GET['sosuo'] == 2) {
   
      $cond1['lb_user.name']=$_GET['value'];

      }

    if($_GET['sosuo'] == 3){

      $cond1['lb_shanghu.mingcheng'] = $_GET['value'];

    }

      $pagesize = 10;
      $page = I('get.p', '1');

      $m_shanghu = M('Shanghu');
      $cond['lb_shanghu.status'] = -1;
      $shanghu = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                           ->field('lb_user.name,lb_user.phone,lb_user.sex,lb_shanghu.*')
                           ->where([$cond,$cond1])
                           ->page($page, $pagesize)
                           ->order('id desc')
                           ->select();
      $this->assign('shanghu',$shanghu);

      $cond['lb_shanghu.status'] = -1;
      $total = $m_shanghu->join('lb_user on lb_shanghu.openid = lb_user.openid')
                           ->field('count(lb_shanghu.id) as total')
                           ->where([$cond,$cond1])
                           ->page($page, $pagesize)
                           ->order('lb_shanghu.id desc')
                           ->find();


      // $total = $m_shanghu->where($cond)->count();
      $t_page = new Page($total['total'], $pagesize);
      $this->assign('page_html', $t_page->show());

      $this->display('Shanghu/jinyong');



    }



 }