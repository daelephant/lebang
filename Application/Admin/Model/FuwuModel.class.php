<?php 

namespace Admin\Model;
use Think\Model;

class FuwuModel extends Model{

	protected $fuwus = array();

	public function __construct(){
		parent::__construct();
		$this->fuwus = $this->select();
	}

 
	public function getTree($id=0 ,$lev=0){
		//var_dump($this->fuwus);exit;
		$tree = array();
		foreach($this->fuwus as $k=>$v){

			if($v['sid'] == $id){
				$v['lev'] = $lev;
				$tree[] = $v;
         
				$tree = array_merge($tree,$this->getTree($v['id'],$lev+1));
			}
		}
		
		return $tree;

	}
}