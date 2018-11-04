<?php
include "classes/member.class.php";
session_start();
$id=$_GET['id'];
if ($id==null) {
  header("location:index.php");
}
$member=new member($_SESSION['user']['id']);
$result=$member->findbyid($id);
$one=mysql_fetch_assoc($result);
if (!$one) {
  echo "<script>alert('".$member->error."');location.href='index.php';</script>";
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改联系人</title>
<link href="style/basic.css" rel="stylesheet" type="text/css" />
<link href="style/detail.css" rel="stylesheet" type="text/css" />
<link href="style/update.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="content">
<h2 class="center">修改联系人信息</h2>
<form name="form1" method="POST" id="form1" action="upaction.php">
<ul>
	<li>姓名：
	  <input name="name" type="text" id="name" value="<?=$one[name]?>" disaabled="disaabled" />
	  [必填]
	  <input name="id" type="hidden" id="id" value="<?=$one[id]?>" />
	</li>
    <li>电话：
      <input name="telephone" type="text" id="telephone" value="<?=$one[telephone]?>" />
    [必填]	</li>
    <li>地址：
      <input name="address" type="text" id="address" value="<?=$one[address]?>" />
    </li>
    <li>Email：
      <input name="Email" type="text" id="Email" value="<?=$one[Email]?>" />
    </li>
    <li>QQ：
      <input name="QQ" type="text" id="QQ" value="<?=$one[QQ]?>" />
    </li>
</ul>

<p class="right"><input name="" type="submit"  class="button" value="保存" />
  <input class="button"  type="reset" name="button" id="button" value="重写" />
  <a href="" onclick="history.back();return false;" style="color:#000;text-decoration:none;">取消</a>
</p>
</form>
</div>
</body>
</html>