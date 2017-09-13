<?php
include "spoj.php";
include "pwgenerator.php";
session_start();

$gen= new PassMaker;
$gen->setPass();
$gen->storePass($host, $db, $user, $pass);

if(isset($_POST['retag']))
{
	$retagid=md5($_POST['retag']);
	try
	{
		$sql="SELECT * FROM tags WHERE password='$retagid'";
		$prep=$dbcon->prepare($sql);
		$prep->execute();
		$count=$prep->rowCount();
		if($count==1)
		{
			if(isset($_SESSION['tempToken']))
			{
				echo "Temporary token is: " . $_SESSION['tempToken'];
			}
		}
		else
		{
			echo "Use NFC which is registered to this site!";
		}
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
}
else
{
	$tokenObj=new \stdClass();
	$tokenObj->temp=$_SESSION['tempToken'];
	$jsonToken=json_encode($tokenObj);
	echo $jsonToken;
}
$dbcon=NULL;	
?>