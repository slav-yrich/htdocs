<?php 
include_once("auth.php");
 include('pgsql.php');
$login=$_POST['login'];
$pass=$_POST['pass'];
$pass=($pass);

 $query="SELECT * FROM reader WHERE login = '$login'";

 $result = pg_query($query);
 $row = pg_fetch_array($result);
 unset($_SESSION['error_auth']);
 if (isset($row)) {
 	if (md5($pass) == $row['password']) {
		header ('Location:index.php?p=lk&id='.$row['id']);
	 	$_SESSION['login']=$row['id']; 	
 		exit()
; 	} else {
 		$_SESSION['error_auth'] = 1;
 		header ('Location:/index.php?p=autherr');
 	}
 }
 else {
	header ('Location:/index.php?p=registr');
 	exit();
 }
 ?>
