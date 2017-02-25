<?php
if($bs=='gdadd'){
$gdcreate= 'http://yuntuapi.amap.com/datamanage/data/create';
$locations=$_POST['locations']?$_POST['locations']:$_GET['locations'];
$openid=$_POST['openid']?$_POST['openid']:$_GET['openid'];
$phonetype=$_POST['phonetype']?$_POST['phonetype']:$_GET['phonetype'];
$cid=$_POST['cid']?$_POST['cid']:$_GET['cid'];
$sql="SELECT id,openid,phone,name,nickname,sex,avatar,status,logintime,logintimes,tjid,idnumber,idpic,profession,beizhu,birthday FROM `lb_user` where openid='$openid'";
$count=mysqli_query($link,$sql);
$row = mysqli_fetch_row($count);
$_data = json_encode(array('_name' =>$row[3], '_location' =>$locations,'openid'=>$openid,'phone'=>$row[2],'phonetype'=>$phonetype,'cid'=>$cid));
//echo  $_data;
$date="key=" . $gdkey . "&tableid=" . $gdtableid . "&loctype=1&data=" . $_data;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_URL, $gdcreate);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    )
  );
  $rslut = curl_exec($ch);  
  curl_close($ch);
  $rslut= json_decode($rslut,true);
 // print_r($rslut);
  if($rslut['_id']){
	  $response=array('code'=>200,'obj'=>array('id'=>$rslut['_id']));
	  }else{
		$response=array('code'=>4444);  
		  }		
	}

if($bs=='gdup'){
$gdupdate= 'http://yuntuapi.amap.com/datamanage/data/update';
$locations=$_POST['locations']?$_POST['locations']:$_GET['locations'];
$id=$_POST['id']?$_POST['id']:$_GET['id'];
$_data = json_encode(array('_id'=>$id,'_location' =>$locations));
$date="key=" . $gdkey . "&tableid=" . $gdtableid . "&loctype=1&data=" . $_data;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_URL, $gdupdate);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    )
  );
  $rslut = curl_exec($ch);  
  curl_close($ch);
  $rslut= json_decode($rslut,true);
 // print_r($rslut);
  if($rslut['status']){
	  $response=array('code'=>200);
	  }else{
		$response=array('code'=>4444);  
		  }		
	}
if($bs=='gddel'){
$gdupdate= 'http://yuntuapi.amap.com/datamanage/data/delete';
$id=$_POST['id']?$_POST['id']:$_GET['id'];
$date="key=" . $gdkey . "&tableid=" . $gdtableid . "&ids=".$id;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_URL, $gdupdate);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    )
  );
  $rslut = curl_exec($ch);  
  curl_close($ch);
  $rslut= json_decode($rslut,true);
 // print_r($rslut);
  if($rslut['status']){
	  $response=array('code'=>200);
	  }else{
		$response=array('code'=>4444);  
		  }		
	}
