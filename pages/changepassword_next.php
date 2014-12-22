<?php

include_once("auth.php");
include('pgsql.php');

$passtel=$_POST['passtel'];

$newpass=$_POST['newpass'];

 $query="SELECT * FROM reader WHERE telephone = '$passtel'";
 $result = pg_query($query) or die(pg_error());
 $row = pg_fetch_array($result);
 $id = $row['id'];
 if ($id != "") {
 	$query1 = "UPDATE reader SET password = md5($newpass) WHERE id = $id";
    $result1 = pg_query ($query1)
       or die ('Ошибочка вышла при выполнение запроса: '.pg_error ());
    header ('Location:/index.php?p=main');

   } else {
    header ('Location:/index.php?p=changepassword');
   }
 ?>