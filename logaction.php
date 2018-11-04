<?php
header("Content-type: text/html; charset=utf-8"); 
include "classes/user.class.php";
$user= new user();
//$yonghu是如果登录成功从user.class里面传来的$one;
//这里有个问题，如果运行了LOGIN方法不把他保存在$用户数组中，是否还可以运行，直接给session赋值_post中的数值
if ($yonghu=$user->login($_POST)) {
	session_start();
	$_SESSION['user']=$yonghu;
	echo "<script>alert('登陆成功');location.href='index.php';</script>";
}else{
	echo "<script>alert('登陆失败:{$user->error}');history.back();</script>";
}


?>