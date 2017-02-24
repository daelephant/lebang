<?php

	function tree($list=[], $category_id=0, $deep=0)
	{
		static $tree = [];
		// 遍历所有的分类
		foreach ($list as $row) 
		{
			// 判断是否是当前分类的子分类
			if ($row['sid'] == $category_id)
			{
				// 是子分类，记下
				$row['deep'] = $deep;
				$tree[] = $row;

				// 递归查找
				tree($list, $row['id'], $deep+1);
			}
		}
		return $tree;
	}