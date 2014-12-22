<?php
$id=$_SESSION['login'];
$query="SELECT * FROM reader WHERE id=$id";
$sql=pg_query($query);
$row=pg_fetch_array($sql);
$query1="SELECT * FROM organization WHERE id=".$row['organization'];
$sql1=pg_query($query1);
$row1=pg_fetch_array($sql1);
$query2="SELECT * FROM department WHERE id=".$row['department'];
$sql2=pg_query($query2);
$row2=pg_fetch_array($sql2);
?>
<a class="hiddenanchor" id="tosubscribe"></a>
    <a class="hiddenanchor" id="tologin"></a>
    <div id="wrapper">
        <div id="login" class="animate form">
            <form  action="index.php?p=edit_next" method="post">
                <h1>Редактирование данных</h1>

                <p>
                    <label for="username" class="uname"  > Фамилия </label>
                     <p>   <input id="username" name="sur" value="<?php echo $row['surname'];?>" type="text" />    </p>
                </p> <p>
                    <label for="username" class="uname"  >   Имя </label>
                 <p>   <input id="username" name="name" value="<?php echo $row['name'];?>" type="text" /></p>
                </p>

                <p>
                    <label for="username" class="uname" > Отчество </label>
                     <p>   <input id="username" name="otch" value="<?php echo $row['patronymic'];?>"  type="text" />    </p>
                </p>
                <p>
                    <label for="username" class="uname"  > Дата рождения: </label>
                	   <p> <input  class="tr2" type="text" value="<?php echo $row['datebirth'];?>" name="bday">   </p>
                </p>






                 <input type="hidden" name="qw" value="<?php echo $_SESSION['login'];?>">
                <p class="login button">
                    <input type="submit" value="Отправить форму" />
                </p>

            </form>
        </div>

    </div>