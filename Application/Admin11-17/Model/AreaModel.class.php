<?php 

namespace Admin\Model;
use Think\Model;

class AreaModel extends Model{

	protected $areas = array();

	public function __construct(){
		parent::__construct();
		$this->areas = $this->select();
	}

 
	public function getTree($id=0 ,$lev=0){
		//var_dump($this->areas);exit;
		$tree = array();
		foreach($this->areas as $k=>$v){

			if($v['sid'] == $id){
				$v['lev'] = $lev;
				$tree[] = $v;
         
				$tree = array_merge($tree,$this->getTree($v['id'],$lev+1));
			}
		}
		
		return $tree;

	}
}





