<?php
include "spoj.php";

$retagid=md5($_POST['retag']);


$sql="SELECT * FROM tags WHERE tagid='$retagid'";
$res=mysqli_query($con,$sql);
if (mysqli_num_rows($res)==1)
{
	for( $i=0; $i<=5; $i++)
	{
		$a=rand(0,35);
		$signs = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
		if($i==1)
		{
			$one=$signs[$a];
		}
		else if($i==2)
		{
			$two=$signs[$a];
		}
		else if($i==3)
		{
			$three=$signs[$a];
		}
		else if($i==4)
		{
			$four=$signs[$a];
		}
		else if($i==5)
		{
			$five=$signs[$a];
		}
	}
}
$pass=$one . $two . $three . $four . $five;
echo $pass;
$pw=md5($pass);
$pwsave="UPDATE tags SET password='$pw' WHERE tagid='$retagid'";
$pwwrite=mysqli_query($con,$pwsave);
?>