<?php
session_start();
include "vcode.class.php";
$vcode= new vcode(0,9);
$_SESSION['vcode']=$vcode->getresult();
$vcode->getimg();
?>