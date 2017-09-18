<?php
include "spoj.php";
class PassMaker
{	
	private $token;
	public $pw;
	function setPass()
	{
		$charFile = fopen("characters.txt", "r") or die("Error!");
		$readFile = fread($charFile,filesize("characters.txt") );
		$chars=explode(",", $readFile);
		fclose($charFile);
		for( $i=0; $i<=5; $i++)
		{
			$r=rand(0,35);
			if($i==1)
			{
				$one=$chars[$r];
			}
			else if($i==2)
			{
				$two=$chars[$r];
			}
			else if($i==3)
			{
				$three=$chars[$r];
			}
			else if($i==4)
			{
				$four=$chars[$r];
			}
			else if($i==5)
			{
				$five=$chars[$r];
			}
		}
		$token=$one.$two.$three.$four.$five;
		$_SESSION['tempToken']=$token;
		$this->pw=md5($token);
	}
	function storePass($host, $db, $user, $pass)
	{
		try
		{
			$dbconn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
			$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pwsave='UPDATE tags SET password=:tk_hash';
			$prepToken=$dbconn->prepare($pwsave);
			$prepToken->bindParam(':tk_hash', $tokenHash, PDO::PARAM_STR, 5);
			$tokenHash=$this->pw;
			$prepToken->execute();
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
}

?>
