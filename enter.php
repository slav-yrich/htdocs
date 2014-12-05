<?php session_start();
 include('pgsql.php');
$login=$_POST['login'];
$pass=$_POST['pass'];
$pass=($pass);

 $query="SELECT * FROM reader WHERE login = '$login'";
 $result = pg_query($query) or die(pg_error());
 $row = pg_fetch_array($result);
 unset($_SESSION['error_auth']);
 if (isset($row)) {
 	if (($pass) == $row['password'])
 		{header ('Location:lk.php?id='.$row['id']);
 	$_SESSION['login']=$row['id'];
 	$_SESSION['pass']=$row['password'];
 	
 	
 	exit();}
 	else {
 		$_SESSION['error_auth'] = 1;
 		header ('Location:avtoriz.html');

 }
 }
 else {
header ('Location:registr.php');
 	exit();
 }
 ?>