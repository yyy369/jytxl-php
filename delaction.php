<?php
session_start();
include "classes/member.class.php";
$member= new member($_SESSION['user']['id']);
$rs=$member->del();
if ($rs) {
	echo "<script>alert('删除成功!');location.href='index.php';</script>";
}else{
	echo "<script>alert('删除失败!');history.back();</script>";
}




?>