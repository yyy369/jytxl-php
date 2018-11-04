<?php 
 header("Content-type: text/html; charset=utf-8"); 
    session_start();
    if ($_POST['vcode']!=$_SESSION['vcode']) {
        echo "<script>alert('验证码错误');history.back();</script>";
    } else {
        include "classes/user.class.php";
        $user = new user();
        if($user->reg($_POST)){
            echo "<script>alert('注册成功');location.href='login.html';</script>";
        }else{
            echo "<script>alert('注册失败，错误信息：{$user->error}');history.back();</script>";
        }
    }

    

?>