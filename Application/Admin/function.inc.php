<?php
	
function avatar($name) {
		$up = new FileUpload();
		$up -> set("path", "../photo/avatar/");
		if($up->upload($name)) {
			$pic = $up->getFileName();
			//创建图像对象
			$img = new Image("../photo/avatar/");
			//缩放两张， 一个原图， 一个是用来，列表使用的小图
			$img -> cut($pic, 1,1,1,1, "b_");
			$img -> cut($pic, 1,1,1,1, "m_");
			$img -> cut($pic, 1,1,1,1, "s_");
			$img -> thumb("b_".$pic,300,300,"");
			$img -> thumb("m_".$pic,120,120,"");
			$img -> thumb("s_".$pic, 60, 60,"");
			return $pic;
		}
}
function idpic($name) {
		$up = new FileUpload();
		$up -> set("path", "__photo__/photo/idpic/");
		if($up->upload($name)) {
			$pic = $up->getFileName();
			//创建图像对象
			$img = new Image("__photo__/photo/idpic/");
			return $pic;
		}
}
function msg($name) {
		$up = new FileUpload();
		$up -> set("path", "../photo/msg/");
		if($up->upload($name)) {
			$pic = $up->getFileName();
			//创建图像对象
			$img = new Image("../photo/msg/");
			//缩放两张， 一个原图， 一个是用来，列表使用的小图
			$img -> thumb($pic, 1000,1000, "b_");
			$img -> thumb($pic, 600, 600, "m_");
			$img -> cut($pic, 1,2,360,240, "s_");
			$img -> thumb("s_".$pic,240,160,"");
			return $pic;
		}
}
function xinxianshi($name) {
		$up = new FileUpload();
		$up -> set("path", "../photo/xinxianshi/");
		if($up->upload($name)) {
			$pic = $up->getFileName();
			//创建图像对象
			$img = new Image("../photo/xinxianshi/");
			//缩放两张， 一个原图， 一个是用来，列表使用的小图
			$img -> thumb($pic, 1000,1000, "b_");
			$img -> thumb($pic, 600, 600, "m_");
			$img -> thumb($pic,300,300,"s_");
			return $pic;
		}
}

function shequ($name) {
		$up = new FileUpload();
		$up -> set("path", "/lebang2/photo/shequ/");
		if($up->upload($name)) {
			$pic = $up->getFileName();
			//创建图像对象
			$img = new Image("/lebang2/photo/shequ/");
			//缩放两张， 一个原图， 一个是用来，列表使用的小图
			$img -> thumb($pic, 1000,1000, "b_");
			$img -> thumb($pic, 600, 600, "m_");
			$img -> thumb("s_".$pic,300,300,"");
			return $pic;
		}
}