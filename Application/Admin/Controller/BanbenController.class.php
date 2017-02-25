<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class BanbenController extends AuthController
{
	public function _initialize(){
         parent::_initialize();
    }

    /*
    *Android 版本
    * 
    */


    public function andlistAction()
    {

        $pagesize = 10;
        $page = I('get.p', '1');
        $banben = M('Banben');
        $cond['lb_banben.status'] = 1;

        $ban = $banben->where($cond)->order('id desc')->page($page, $pagesize)->select();

        $total = $banben->where($cond)->count();
        $t_page = new Page($total, $pagesize);
        $this->assign('page_html', $t_page->show());
        $this->assign('ban',$ban);
    	$this->display();
    }

     /*
    *ios版本
    * 
    */

     public function ioslistAction()
    {
        $pagesize = 10;
        $page = I('get.p', '1');
        $banben = M('Banben');
        $cond['lb_banben.status'] = 2;

        $ban = $banben->where($cond)->order('id desc')->page($page, $pagesize)->select();

        $total = $banben->where($cond)->count();
        $t_page = new Page($total, $pagesize);
        $this->assign('page_html', $t_page->show());
        $this->assign('ban',$ban);
        $this->display();

    }

     /*
    *H5 版本
    * 
    */


     public function hlistAction()
    {

        $pagesize = 10;
        $page = I('get.p', '1');
        $banben = M('Banben');
        $cond['lb_banben.status'] = 3;

        $ban = $banben->where($cond)->order('id desc')->page($page, $pagesize)->select();

        $total = $banben->where($cond)->count();
        $t_page = new Page($total, $pagesize);
        $this->assign('page_html', $t_page->show());
        $this->assign('ban',$ban);
        $this->display();
    }


    /*
    *Android 新增版本
    * 
    */

    public function andaddAction()
    {

        $banben = M('Banben');
        if(IS_POST){

            $banben->banbenhao = $_POST['banbenhao'];
            $banben->shuoming = $_POST['shuoming'];
            $banben->status = $_POST['status'];
            $banben->cname = $_POST['cname'];
            $banben->sname = $_POST['sname'];
            $banben->yname = $_POST['yname'];
            $banben->hname = $_POST['hname'];
            $banben->shiname = $_POST['shiname'];
            $banben->app = $_POST['app'];
            $banben->shijian = strtotime($_POST['shijian']);
            // var_dump($m);exit;
            // $app_path = pictime().$_FILES['app']['name'];
            // $app = move_uploaded_file($_FILES['app']['tmp_name'],'./photo/banben/'.$app_path);
         
            // if($app){
            //     $banben->app = $app_path;
                
            // }else{

            //    $this->Error('文件上传错误');
            // }

            $banben->add();

            $this->redirect('Banben/andlist');
        }


    	$this->display();
    }

     /*
    *ios 新增版本
    * 
    */
    public function iosaddAction()
    {
        $banben = M('Banben');
        if(IS_POST){

            $banben->banbenhao = $_POST['banbenhao'];
            $banben->shuoming =  $_POST['shuoming'];  
            $banben->status = $_POST['status'];
            $banben->cname = $_POST['cname'];
            $banben->sname = $_POST['sname'];
            $banben->yname = $_POST['yname'];
            $banben->hname = $_POST['hname'];
            $banben->shiname = $_POST['shiname'];
            $banben->app = $_POST['app'];
            $banben->shijian = strtotime($_POST['shijian']);
            // $app_path = pictime().$_FILES['app']['name'];
            // $app = move_uploaded_file($_FILES['app']['tmp_name'],'./photo/banben/'.$app_path);
            // // var_dump($_FILES);exit;
         
            // if($app){
            //     $banben->app = $app_path;
                
            // }else{

            //    $this->Error('文件上传错误');
            // }

            $banben->add();

            $this->redirect('Banben/ioslist');
        }

    	$this->display();
    }

     /*
    *H5 新增版本
    * 
    */
    public function haddAction()
    {

        $banben = M('Banben');
        if(IS_POST){

            $banben->banbenhao = $_POST['banbenhao'];
            $banben->shuoming = $_POST['shuoming'];
            $banben->status = $_POST['status'];
            $banben->cname = $_POST['cname'];
            $banben->sname = $_POST['sname'];
            $banben->yname = $_POST['yname'];
            $banben->hname = $_POST['hname'];
            $banben->shiname = $_POST['shiname'];
            $banben->shijian = strtotime($_POST['shijian']);
            $banben->app = $_POST['app'];

            $banben->add();

            $this->redirect('Banben/hlist');
        }


        $this->display();
    }


    /*
    *Android 查看详情
    * 
    */

    public function andeditAction($id)
    {
        $banben = M('Banben');

        if(IS_POST){

        //     $app_path = pictime().$_FILES['app']['name'];
        //     $app = move_uploaded_file($_FILES['app']['tmp_name'],'./photo/banben/'.$app_path);
        
        // if(!empty($app)){
  
        //     $banben->app = $app_path;
        // }

        $banben->banbenhao = $_POST['banbenhao'];
        $banben->shuoming = $_POST['shuoming'];
        $banben->cname = $_POST['cname'];
        $banben->sname = $_POST['sname'];
        $banben->hname = $_POST['hname'];
        $banben->yname = $_POST['yname'];
        $banben->shiname = $_POST['shiname'];
        $banben->app = $_POST['app'];

        // var_dump($_FILES);exit;
        $banben->where('id='.$id)->save();

        $this->redirect('Banben/andlist/p/'.I('get.p'));

       }

       $ban = $banben->where('id='.$id)->find();

       $this->assign('ban',$ban);
       $this->display();
    }

    /*
    *ios 查看详情
    * 
    */

    public function ioseditAction($id)
    {
        $banben = M('Banben');

        if(IS_POST){

        $banben->banbenhao = $_POST['banbenhao'];
        $banben->shuoming = $_POST['shuoming'];
        $banben->cname = $_POST['cname'];
        $banben->sname = $_POST['sname'];
        $banben->hname = $_POST['hname'];
        $banben->yname = $_POST['yname'];
        $banben->shiname = $_POST['shiname'];
        $banben->app = $_POST['app'];
        $banben->where('id='.$id)->save();
        $this->redirect('Banben/ioslist/p/'.I('get.p'));  
    }
        $ban = $banben->where('id='.$id)->find();

       $this->assign('ban',$ban);
    	$this->display();
    

}

     /*
    *H5  查看详情
    * 
    */

    public function heditAction($id)
    {
        $banben = M('Banben');

        if(IS_POST){

        $banben->banbenhao = $_POST['banbenhao'];
        $banben->shuoming = $_POST['shuoming'];
        $banben->cname = $_POST['cname'];
        $banben->sname = $_POST['sname'];
        $banben->hname = $_POST['hname'];
        $banben->yname = $_POST['yname'];
        $banben->shiname = $_POST['shiname'];
        $banben->app = $_POST['app'];

        $banben->where('id='.$id)->save();

        $this->redirect('Banben/hlist/p/'.I('get.p'));

       }

       $ban = $banben->where('id='.$id)->find();

       $this->assign('ban',$ban);

        $this->display();
    }


    public function fetchAction()
    {
        $pagesize = 10;
        $page = I('get.p', '1');
        $banben = M('Banben');
        if($_GET['banbenhao'] == $_GET['banbenhao']){

        $cond['lb_banben.banbenhao'] = $_GET['banbenhao'];
        $cond['lb_banben.status'] = 1;
        $ban = $banben->where($cond)->order('id desc')->page($page, $pagesize)->select();
        // var_dump($ban);exit;
        $total = $banben->where($cond)->count();
        $t_page = new Page($total, $pagesize);
        $this->assign('page_html', $t_page->show());
        $this->assign('ban',$ban);
  
        }

        $this->display('Banben/andlist');

    }

    public function fetch1Action()
    {
        $pagesize = 10;
        $page = I('get.p', '1');
        $banben = M('Banben');
        if($_GET['banbenhao'] == $_GET['banbenhao']){

        $cond['lb_banben.banbenhao'] = $_GET['banbenhao'];
        $cond['lb_banben.status'] = 2;
        $ban = $banben->where($cond)->order('id desc')->page($page, $pagesize)->select();
        $total = $banben->where($cond)->count();
        $t_page = new Page($total, $pagesize);
        $this->assign('page_html', $t_page->show());
        $this->assign('ban',$ban);
    }

        $this->display('Banben/ioslist');

}

    public function fetch2Action()
    {
        $pagesize = 10;
        $page = I('get.p', '1');
        $banben = M('Banben');
        if($_GET['banbenhao'] == $_GET['banbenhao']){

        $cond['lb_banben.banbenhao'] = $_GET['banbenhao'];
        $cond['lb_banben.status'] = 3;
        $ban = $banben->where($cond)->order('id desc')->page($page, $pagesize)->select();
        $total = $banben->where($cond)->count();
        $t_page = new Page($total, $pagesize);
        $this->assign('page_html', $t_page->show());
        $this->assign('ban',$ban);
    }

        $this->display('Banben/hlist');
 }

}