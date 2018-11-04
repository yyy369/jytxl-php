<?php
include "classes/member.class.php";
session_start();
$member= new member($_SESSION['user']['id']);
if ($member->insert()) {
	echo "<script>alert('添加联系人成功');location.href:'index.php';</script>";
}else{
	echo "<script>alert('添加联系人失败:{$user->error}');history.back();</script>";
}





?>