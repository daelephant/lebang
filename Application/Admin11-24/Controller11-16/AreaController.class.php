<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload;
use Think\Image;
use Org\Util\Page;

class AreaController extends AuthController
{
  public function _initialize(){
         parent::_initialize();
    }


       //实例化D类以后赋值的变量
        public $model= null;
       //使用构造方法,自动实例化
        public function __construct(){
        //防止父类的初始化工作重写
        parent::__construct();
        //将实例化的D类赋值给属性
        $this->model = D('Admin/Area');
        $this->shequ = D('Admin/Shequ');
      }


      public function listAction()
       {
        
        // 考虑分页
            $pagesize = 10;
            $page = I('get.p', '1');
        if(!IS_POST){
          $cat = D('Admin/Area');
         // var_dump($cat);exit;
         //$cats = $cat->page($page, $pagesize)->getTree();
        //var_dump($cat->getTree());exit;
          
          $total = $cat->where('id>3408')->count();
          $t_page = new Page($total, $pagesize);
          $this->assign('page_html', $t_page->show());
          // $cats = $cat->page($page, $pagesize)->getTree();
          // echo '<pre>';
          // print_r($cats);
          // exit;
          $cats = tree($cat->page($page, $pagesize)->getTree());
          echo '<pre>';
          print_r($cats);
          exit;
          $ct = $cat->where('id>3408')->select();
          $this->assign('cats',$cats);
          $this->assign('ct',$ct);
          $this->display();

        }
      }

        public function addAction()
        {
          //判断POST值是否为空
          if(!IS_POST){
            $this->dispaly();
          }else{
            //执行添加Area表的值
            $this->model->sid = I('post.sid');
            $this->model->mid = I('post.mid');
            $this->model->mingcheng = I('post.mingcheng');
           
            //
            // $m_shequ = D('Shequ');
            // $m_shequ->mingcheng = I('post.mingcheng');
            // $m_shequ->add();
            //
            //var_dump(I('post.mingcheng'));exit;
            //判断是否添加成功
            if($this->model->add()){
              //添加成功跳转到list
              $this->redirect('Admin/Area/list');
            }else{
              //如果失败则输出 添加失败
              echo '添加失败';
            }

          }
  
        }  

        public function editAction()
    {
            if(!IS_POST){
            $cat = D('Admin/Area');
            $row = $this->model->find(I('get.id'));
            $this->assign('cats',$cat->getTree());
            $this->assign('row',$row);
            $this->display();
        }else{
          //var_dump($_POST);exit;
            if($this->model->where('id='.I('get.id'))->save($_POST)) {
                //$this->success('修改成功',U('Admin/Area/list',3));
                 $this->redirect('Admin/Area/list');
            }else{
                echo "修改失败";          
              }  
        }
    }
}