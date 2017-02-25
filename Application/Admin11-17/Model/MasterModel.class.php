<?php 

namespace Admin\Model;
use Think\Model;

class MasterModel extends Model{

	protected $masters = array();

	public function __construct(){
		parent::__construct();
		$this->masters = $this->select();
	}

 
	public function getTree($id=0 ,$lev=0){
		//var_dump($this->masters);exit;
		$tree = array();
		foreach($this->masters as $k=>$v){

			if($v['sid'] == $id){
				$v['lev'] = $lev;
				$tree[] = $v;
         
				$tree = array_merge($tree,$this->getTree($v['id'],$lev+1));
			}
		}
		
		return $tree;

	}
}





