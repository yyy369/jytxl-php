
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<script>
if(confirm("确认删除该联系人？")){
    //跳转到delaction.php处理删除操作
	location.href="delaction.php"+location.search;//search 带着？之后的部分传送到下一个网站
}else{
    //返回
	history.back();
}
</script>
</body>
</html>