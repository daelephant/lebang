<?php
namespace Admin\Model;
use Think\Model;

class CategoryModel extends Model
{
	public function getTree()
	{
		// 初始化配置缓存
		S(['type'=>'File']);

		// 判断缓存是否可用
		if (! ($tree_list = S('category_tree_0')))
		{
			// 缓存不存在
			// 获取所有的分类
			$list = $this
				->order('sort_number')
				->select();
			// 递归获取带有级别的树状列表
			$tree_list = $this->tree($list);

			// 存入缓存
			S('category_tree_0', $tree_list);
		}
		
		return $tree_list;
	}

	/**
	 * 递归处理
	 * @param array $list [description]
	 * @param integer $category_id [description]
	 * @param integer $deep [description]
	 * @return array [description]
	 */
	protected function tree($list=[], $category_id=0, $deep=0)
	{
		static $tree = [];
		// 遍历所有的分类
		foreach ($list as $row) 
		{
			// 判断是否是当前分类的子分类
			if ($row['parent_id'] == $category_id)
			{
				// 是子分类，记下
				$row['deep'] = $deep;
				$tree[] = $row;

				// 递归查找
				$this->tree($list, $row['category_id'], $deep+1);
			}
		}
		return $tree;
	}
	// 自动完成
	protected $_auto = [
		['create_at', 'time', self::MODEL_INSERT, 'function'],
		['update_at', 'time', self::MODEL_BOTH, 'function'],
		['is_deleted', '0', self::MODEL_INSERT],
	];
}