

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
        $resultat = pg_query("SELECT * FROM reader WHERE login = '$login' AND address = '$email'");
        $array = pg_fetch_array($resultat);
        if (empty($array)){
            echo 'Ошибка! Такого пользователя не существует';
        }
        elseif (pg_num_rows($resultat) > 0){
        $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $max=10; 
        $size=StrLen($chars)-1; 
        $password=null; 
                                               
        while($max--) {
              $password.=$chars[rand(0,$size)]; 
        }
        $newmdPassword = md5($password); 
        $title = 'Востановления пароля пользователю '.$login.' для сайта ymnyashi.ru!';
        $letter = "From:  ymnyashir@.ru  \r\n
    RcptTo: $email \r\n
    Subject: $title \r\n 
    You asked to reset your password for the ymnyashi-account $login \r\n New password is: $password \r\n   Yours sincerely, ymnyashi.ru";
// Отправляем письмо
        if (mail($email, $title, $letter, "Content-type:text/plain; Charset=windows-1251\r\n")) {
             pg_query("UPDATE reader SET password = '$newmdPassword' WHERE login = '$login'  AND address = '$email'");
        echo 'Новый пароль отправлен на ваш e-mail! Если письмо не получено, проверьте папку Спам.';
         }
      }                              
   }
}
pg_close();
?>
