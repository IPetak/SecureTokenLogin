<?php
include "spoj.php";

$getAjax = file_get_contents("php://input");
$decodeAjax = json_decode($getAjax);
$token = $decodeAjax->pin;
$encToken=md5($token);
try
{
	$sql="SELECT * FROM tags WHERE password='$encToken'";
	$prep=$dbcon->prepare($sql);
	$prep->execute();
	$res=$prep->rowCount();
	if ($res==1)
	{
		$yes = new \stdClass();
		$yes->access="ACCESS GRANTED";
		$answerYes=json_encode($yes);
		echo $answerYes;
	}
	else
	{
		$no = new \stdClass();
		$no->access="ACCESS DENIED";
		$answerNo=json_encode($no);
		echo $answerNo;
	}
}
catch(PDOException $e)
{
	$getError=$e->getMessage();
	$error=json_encode($getError);
	echo $error;
}
$dbcon=NULL;
?>
