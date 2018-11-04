<?php
header("Content-type: text/html; charset=utf-8"); 
class member{
   private $error='';
   private $uid;
   function __construct($uid){
   	$this->uid=$uid;
   	mysql_connect('localhost','root','');
   	mysql_select_db('jytxl');
   	mysql_query('set names utf8');
   }
   function __get($value){
    if ($value=='error') {
    	return $this->error;
    }
   }
   //插入联系人
  function insert(){
  $arr=$_POST;
  if ($arr['name']==null or $arr['telephone']==null) {
  	$this->error='缺少必填项，请检查';
  	return false;
  }else{
  	$rs=mysql_query("insert into member values(NULL,'{$arr[name]}','{$arr[telephone]}','{$arr[address]}','{$arr[Email]}','{$arr[QQ]}',{$this->uid})");
    if ($rs && mysql_affected_rows()==1) {
    	return true;
    }else{
    	$this->error="该联系人已经存在，请重新添加";
    	return false;
    }
  }
  }
  function findbyid($id){
  $rs=mysql_query("select * from member where id={$id} and uid=$this->uid");
  return $rs;
  }
  function total(){
$rs=mysql_query("select * from member where uid=$this->uid");
return mysql_num_rows($rs);
  }
  //做分页处理
function selectLimit($limit){
$rs = mysql_query("select * from member where uid = {$this->uid} {$limit}") or die(mysql_error());
  if (mysql_num_rows($rs)==0) {
                return false;
  } else {
                return $rs;
            }            
        }
  function update(){
    $arr=$_POST;
   if ($arr['telephone']==NULL) {
     $this->error="电话号码不能为空";
     return false;
   }
     $rs=mysql_query("update member set telephone='{$arr[telephone]}',address='{$arr[address]}',Email='{$arr[Email]}',QQ='{$arr[QQ]}' where id='{$arr[id]}'") or die(mysql_error());
    return $rs;

  }
  function del(){
  $id=$_GET[id];
  $rs=mysql_query("Delete from member where id={$id} and uid=$this->uid")or die(
    mysql_error());
  return $rs;
  }
  function selectall(){
  	$result=mysql_query("select * from member where uid=$this->uid") or die(mysql_error());
  	return $result;
  }

}




?>