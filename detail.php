<?php
header("Content-type: text/html; charset=utf-8"); 
   session_start();
   include "classes/member.class.php";
   if ($_GET[id]=='') {
     header("location:index.php");
   }
   $member = new member($_SESSION['user']['id']);
   $rs=$member->findbyid($_GET[id]);
   if (mysql_num_rows($rs)==0) {
   	echo "<script>alert('您访问的联系人不存在');location.href='index.php';</script>";
   }else{
   	$one=mysql_fetch_assoc($rs);
   }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>联系人信息页</title>
<link href="style/basic.css" rel="stylesheet" type="text/css" />
<link href="style/detail.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="content">
<h2 class="center">联系人信息</h2>
<ul>
	<li>姓名：<?=$one['name']?></li>
    <li>电话：<?=$one['telephone']?></li>
    <li>地址：<?=$one['address']?></li>
    <li>Email：<?=$one['Email']?></li>
    <li>QQ：<?=$one['QQ']?></li>
</ul>
<p class="right"><a href="update.php?id=<?=$one[id]?>">修改</a> <a href="del.php?id=<?=$one[id]?>">删除</a> <a href="" onclick="history.back();">返回</a></p>
</div>
</body>
</html>