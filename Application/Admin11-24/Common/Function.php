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

    function getTree2($cats=[],$id=0,$names='name'){
    	static $i=0;
        $tree = [];
        foreach ($cats as $k => $v) {
            if($v['sid'] == $id){
        		$i+=1;
            	$v['CodeName'] = $v[$names];
            	$v['CodeValue'] = $i;
                $v['maxhycode'] = getTree2($cats,$v['id'],$names);
                $tree[] = $v;
            }
        }
        return $tree;
    }

    function getTree3($cats=[],$id=0,$names='name'){
    	static $i=0;
        $tree = [];
        foreach ($cats as $k => $v) {
            if($v['sid'] == $id){
        		$i+=1;
            	$v['CodeName'] = $v[$names];
            	$v['CodeValue'] = $i;
                $v['maxhycode'] = getTree2($cats,$v['id'],$names);
                $tree[] = $v;
            }
        }
        return $tree;
    }

	function pictime(){
		return time().mt_rand(100,999);
	}

	function str_replace_once($needle, $replace, $haystack) {

		$pos = strpos($haystack, $needle);

		if ($pos === false) {

		return $haystack;

		}

		return substr_replace($haystack, $replace, $pos, strlen($needle));

	}

    function uploadpic($img,$url='upload')
    { 
               $url = './photo/'.$url.'/';
               $upload =  new \Think\UploadFile();// 实例化上传类 
               $upload->maxSize = 3000000 ;// 设置附件上传大小  C('UPLOAD_SIZE');   
               $upload->savePath = $url; // 设置附件上传目录  
               $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型  
               $upload->saveRule = 'time';  
               $upload->uploadReplace = true; //是否存在同名文件是否覆盖  
               $upload->thumb = true; //是否对上传文件进行缩略图处理  
               $upload->thumbMaxWidth = '300,600,1000'; //缩略图处理宽度  
               $upload->thumbMaxHeight = '300,600,1000'; //缩略图处理高度  
               $upload->thumbPrefix = 's_,m_,b_';  //生产3张缩略图
               $upload->thumbPath = $url; //缩略图保存路径   
               $upload->thumbRemoveOrigin = false; //上传图片后删除原图片
               $upload->saveRule = 'pictime'; // 采用时间戳命名xs
               if(!is_dir($url)){
                  mkdir($url,true);
               }
               $info = $upload->uploadOne($img);
               if (!$info) {// 上传错误提示错误信息  
                   //return json_encode(array('msg' =>($upload->getErrorMsg()), 'status' => 0));  
                   // print_r($upload->getError());
               }else{
                     // $info['savepath'].$info['savename'];
                     return $info[0]['savename'];
               }
    }