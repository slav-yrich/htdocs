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
    echo '<HTML>
     <HEAD>
     <TITLE>Редирект через 5 секунд</TITLE>
     <META HTTP-EQUIV="Refresh" CONTENT="5; URL=avtoriz.html">
     </HEAD>
     <BODY>
     Пароль успешно изменен!
     </BODY>
     </HTML>';

   } else {
   	echo '<HTML>
     <HEAD>
     <TITLE>Редирект через 5 секунд</TITLE>
     <META HTTP-EQUIV="Refresh" CONTENT="5; URL=changepassword.html">
     </HEAD>
     <BODY>
     Пользователя с данным номером телефона не существует. Подождите 5 секунд и попробуйте еще раз...
     </BODY>
     </HTML>';
   }
 ?>