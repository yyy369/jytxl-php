<?php
 class vcode{
 	public $num1=0;
 	public $num2=0;
 	public $operator="+-*";
    public $result=0;
function __construct($min,$max){
	$this->num1=rand($min,$max);
	$this->num2=rand($min,$max);
	$i=rand(0,2);
	$this->operator=$this->operator[$i];
	switch ($i) {
		case 0:
		$this->result=$this->num1+$this->num2;
		break;
		case 1:
		$this->result=$this->num1-$this->num2;
		break;
		case 2:
		$this->result=$this->num1*$this->num2;
		break;
	}
}
function getimg($w=100,$h=30){
	$img=imagecreate($w,$h);
	$pxcolor=imagecolorallocate($img,255,255,255);
	$bgcolor=imagecolorallocate($img,rand(0,200),rand(0,200),rand(0,200));
	$red=imagecolorallocate($img,255,0,0);
	$white=imagecolorallocate($img,255,255,255);
	$green=imagecolorallocate($img,0,255,0);
	$blue=imagecolorallocate($img,0,0,255);
	imagefilledrectangle($img, 0, 0, $w, $h, $bgcolor);
	for ($i=0; $i <80; $i++) { 
		imagesetpixel($img, rand(0,$w), rand(0,$h), $pxcolor);
	}
	imagestring($img, 5,5, rand(1,10), $this->num1, $red);
	imagestring($img, 5,30, rand(1,10), $this->operator,$white);
	imagestring($img, 5, 45, rand(1,10), $this->num2, $green);
	imagestring($img, 5, 65, rand(1,10), "=", $blue);
	imagestring($img, 5, 80, rand(1,10), "?", $red);
	header("content-type:img/png");
	imagepng($img);
	imagedestroy($img);
 }
 function getresult(){
 	return $this->result;
 }
}
?>