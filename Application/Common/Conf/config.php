<?php
return array(
	//'配置项'=>'配置值'

	// 添加Action后缀
	'ACTION_SUFFIX' => 'Action',
	// 引入数据库扩展配置
	'LOAD_EXT_CONFIG' => 'db',
	
	  //Auth配置
    'AUTH_CONFIG'  => array(
    // 用户组数据表名
    'AUTH_GROUP' => 'lb_auth_group',
    // 用户-用户组关系表
    'AUTH_GROUP_ACCESS' => 'lb_auth_group_access',
    // 权限规则表
    'AUTH_RULE' => 'lb_auth_rule',
    // 用户信息表
    'AUTH_USER' => 'lb_admin'
    ),
);