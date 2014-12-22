
<table> 
      <form method="POST">
      <tr>
      <td>Логин:</td>
      <td><input type="text" size="20" name="login"></td>
      </tr>
      <tr>
      <td>E-mail:</td>
      <td><input type="text" size="20" name="email"></td>
      </tr>
      <tr>
       <td></td>
      <td colspan="2">
<input type="submit" value="Восстановить пароль" name="submit"></td>
      </tr>
     <br>
      </form>
</table>



<?php  include_once('pgsql.php'); ?>

<?php
if (isset($_POST['submit'])){     
    $login = $_POST['login'];
    $email = $_POST['email'];
                
    if (empty($login)){
        echo "Введите логин!";
    }
    elseif (empty($email)){
        echo "Введите e-mail!";
    }
   else{
        $resultat = mysql_query("SELECT * FROM users WHERE login = '$login' AND adress = '$email'");
        $array = mysql_fetch_array($resultat);
        if (empty($array)){
            echo 'Ошибка! Такого пользователя не существует';
        }
        elseif (mysql_num_rows($resultat) > 0){
        $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $max=10; 
        $size=StrLen($chars)-1; 
        $password=null; 
                                               
        while($max--) {
              $password.=$chars[rand(0,$size)]; 
        }
        $newmdPassword = md5($password); 
        $title = 'Востановления пароля пользователю '.$login.' для сайта ymnyashi.ru!';
        $letter = 'Вы запросили восстановление пароля для аккаунта '.$login.' на сайте ymnyashi.ru \r\nВаш новый пароль: '.$password.'\r\nС уважением админестрация сайта Site.ru';
// Отправляем письмо
        if (mail($email, $title, $letter, "Content-type:text/plain; Charset=windows-1251\r\n")) {
             mysql_query("UPDATE users SET pass1 = '$newmdPassword' WHERE login = '$login'  AND adress = '$email'");
        echo 'Новый пароль отправлен на ваш e-mail!<br><a ref="index.php">Главная страница</a>';
         }
      }                              
   }
}
pg_close();
?>
