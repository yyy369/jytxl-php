<?php
session_start();
include "classes/member.class.php";
include "classes/page.class.php";
$member=new member($_SESSION['user']['id']);
$total=$member->total();
$page= new page($tatal,4);
$result=$member->selectlimit($page->limit);
$rs=$member->selectall();
$rows=mysql_num_rows($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>简易通讯录</title>
<link href="style/basic.css" rel="stylesheet" type="text/css" />
<link href="style/index.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="content">
<h2 class="center">简易通讯录</h2>
<p class="center">总共有 个联系人，当前显示-个联系人</p>
<?php
if($rows==0){
	echo "<p>暂无任何联系人</p>";
}else{
	echo '<p class="center">'.$page->fpage(0,1,2,3)."</p>";
   while($one=mysql_fetch_assoc($result)){
?>
<table class="one" width="90%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">用户名：<?=$one['name']?></td>
  </tr>
  <tr>
    <td width="71%">电话：<?=$one['telephone']?></td>
    <td width="29%" align="center"><a href="detail.php?id=<?=$one['id']?>">查看详情</a></td>
  </tr>
</table>
<?php
}
?>

<p class="center yema"> <?=$page->fpage(4,5,6,7)?></p>
<?php

}
?>
<p class="center"><a href="add.html" id="xinjian">+新建联系人</a></p>
</div>
</body>
</html>