<?php
include "spoj.php";

$digits=md5($_POST['pin']);

$sql="SELECT * FROM tags WHERE password='$digits'";
$res=mysqli_query($con,$sql);
if (mysqli_num_rows($res)==1)
{
	echo "Access Granted";
}
else
{
	echo "Access Denied";
}
?>