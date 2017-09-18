<?php
include "spoj.php";
class PassMaker
{	
	private $token;
	public $pw;
	function setPass()
	{
		for( $i=0; $i<=5; $i++)
		{
			$r=rand(0,35);
			$signs = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
			if($i==1)
			{
				$one=$signs[$r];
			}
			else if($i==2)
			{
				$two=$signs[$r];
			}
			else if($i==3)
			{
				$three=$signs[$r];
			}
			else if($i==4)
			{
				$four=$signs[$r];
			}
			else if($i==5)
			{
				$five=$signs[$r];
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
