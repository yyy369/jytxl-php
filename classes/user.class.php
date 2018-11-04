<?php
 header("Content-type: text/html; charset=utf-8"); 
class user{
    public $name;
    public $id;
	private $error;
	function __construct(){
    mysql_connect('localhost','root','');
    mysql_select_db('jytxl');
    mysql_query('set names utf8');
	}
    //输出错误
	function __get($values){
    		if ($values=='error') {
    			return $this->error;
    		}else{
    			return NULL;
    		}
    	}
	function login($logininfo){
     if ($logininfo['name']==NULL or $logininfo['pwd']==NULL) {//问题表示为空时''与NULL有何区别，另已知登录的HTML页面有script的验证，在后台验证是否还有必要
         $this->error='用户名或者密码不能为空';
         return false;
     }else{
        $name=strtolower(trim($logininfo['name']));
        $pwd=md5(trim($logininfo['pwd']));
        $rs=mysql_query("select id,name from user where name='{$name}' and pwd='{$pwd}'");
        if ($one=mysql_fetch_assoc($rs)) {
            return $one;
        }else{
            $this->error='用户名或密码不正确';
            return false;
        }
     }
	}
    //登录
    function reg($reginfo){
    	if ($reginfo['name']==''or $reginfo['pwd']=='') {
    		$this->error='表单元素为空返回失败';
    		return false;//表单元素为空返回失败
    	}else{
    	$name=strtolower(trim($reginfo['name']));
    	$pwd=md5(trim($reginfo['pwd']));
    	mysql_query("insert into user values(NULL,'{$name}','{$pwd}')");}
    	if (mysql_affected_rows()==1) {
    		return true;
    	}else{
    		$this->error='用户名重名导致失败';
    		return false;//用户名重名导致失败
    	}

    }
    //实践中只需要清除seesion中的变量即可实现注销
    function logout(){

    }
}




?>