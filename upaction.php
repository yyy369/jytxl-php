<?php
session_start();
include "classes/member.class.php";
$member=new member($_SESSION['user']['id']);
if($member->update()){
   echo "<script>alert('修改成功');location.href='detail.php?id={$_POST[id]}';</script>";
}else{
	echo "<script>alert('修改失败');location.href='index.php';</script>";
}





?>