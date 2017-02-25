<?php
namespace Admin\Model;
use Think\Model;

class XinxianshiModel extends Model
{
	// 自动完成
	protected $_auto = [
		['create_at', 'time', self::MODEL_INSERT, 'function'],
		['update_at', 'time', self::MODEL_BOTH, 'function'],
		['is_deleted', '0', self::MODEL_INSERT],
	];
}