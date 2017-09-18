<?php
include "spoj.php";
include "pwgenerator.php";
session_start();

$gen= new PassMaker;
$gen->setPass();
$gen->storePass($host, $db, $user, $pass);

if(isset($_POST['retag']))
{
	try
	{
		$sql="SELECT * FROM tags WHERE tagid=:retagid";
		$prep=$dbcon->prepare($sql);
		$reid=filter_input(INPUT_POST, 'retag', FILTER_SANITIZE_NUMBER_INT);
		$prep->bindParam(':retagid', $retagid, PDO::PARAM_STR);
		$retagid=md5($reid);
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
			echo $retagid;
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