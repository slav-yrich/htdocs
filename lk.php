<?php include_once("auth.php");?>
<!DOCTYPE HTML>
<?php if(isset($_GET['exit']) || !isset($_SESSION['login'])){
session_destroy();
echo('	<meta http-equiv="refresh" content="0;url=avtoriz.html">');
exit;
} ?>
<html lang="ru">
<head>
	<script language="javascript">
function doPopup(popupPath) {
window.open(popupPath,'name',
'width=850,height=550,scrollbars=YES');
}
</script>
	<?php 
include ('pgsql.php'); // ------------------------------------------------------- ПОДКЛЮЧЕНИЕ К БД
if(isset($_GET['exit']) || !isset($_SESSION['login'])){
session_destroy();
echo('	<meta http-equiv="refresh" content="0;url=avtoriz.html">');
exit;
} 
$id = $_GET['id'];
if ($id != $_SESSION['login']) {session_destroy();
echo 'НЕ ШАЛИТЬ! <a href="avtoriz.html">Войдите в систему</a><br>
	<a href="regis.html">или зарегистрируйтесь</a>';
	exit;}
$query="SELECT * FROM reader WHERE id=$id";
$sql=pg_query($query);
$row=pg_fetch_array($sql);
$query1="SELECT * FROM organization WHERE id=".$row['organization'];
$sql1=pg_query($query1);
$row1=pg_fetch_array($sql1);
$query2="SELECT * FROM department WHERE id=".$row['department'];
$sql2=pg_query($query2);
$row2=pg_fetch_array($sql2);?>
	<meta charset="utf-8">
	<title>Личный кабинет</title>
	
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	
	</head>

<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="nav-collapse collapse">
				<div class="row">
					<div class="span10">
						<ul class="nav">
							
						</ul>
						<form class="navbar-search form-search" action="/search_form/search.htm" method="POST">
							<div class="input-append">
								
<a href="regis.html" role="button" id="authModalBtn" class="btn pull-right" data-toggle="modal">&nbsp;Регистрация</a>
						<a href="avtoriz.html" role="button" id="authModalBtn" class="btn pull-right" data-toggle="modal">&nbsp;Авторизация</a>
							</div>
						</form>
					</div>
					<div class="span2">
						<a href="lk.php?exit=1" role="button" id="authModalBtn" class="btn pull-right" data-toggle="modal">&nbsp;Выход</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="hero-bg">
	<div class="hero-unit">
		<div class="container">
			<div class="row">
				<div class="span8">
					<p>Санкт-Петербургское государственное бюджетное учреждение культуры <strong>"Государственный музей городской скульптуры"</strong></p>
					<h1><a href="/">Библиотека музея</a></h1>
				</div>
				<div class="span4"></div>
			</div>
		</div>
	</div>
</div>

<div class="content clearfix">
	<div class="container">
		<div class="contentIndents">
			<div class="row-fluid">
				<div class="span6">
					<h1>Личный кабинет</h1>
						<table>
				            <colgroup width="230" >
				            <colgroup width="150" >
				            	<tr>
				            		<td rowspan="7"><img src="img/lib_photos/<?php echo $row['barcode'];?>.jpg" alt=""></td>
				            	</tr>
				              	<tr>
				              		<td>Фамилия:</td>
				              		<td class="td"><?php echo $row['surname'];?></td>
				              	</tr>
					            <tr>
					            	<td>Имя:</td>
					            	<td class="td"><?php echo $row['name'];?></td>
					            </tr>
					            <tr>
					            	<td>Отчество:</td>
					            	<td class="td"><?php echo $row['patronymic'];?></td>
					            </tr>
					            <tr>
					            	<td>Дата рождения:</td>
					            	<td class="td"><?php echo $row['datebirth'];?></td>
					            </tr>
					            <tr>
					            	<td>Организация:</td>
					            	<td class="td"><?php echo $row1['organizationname'];?></td>
					            </tr>
				            	<tr>
				            		<td>Отдел:</td>
				            		<td class="td"><?php echo $row2['departmentname'];?></td>
				            	</tr>
				            	<tr>
				            	<td><a href="javascript:doPopup('edit.php');">Редактировать данные</a></td>
				            	
	  							</tr>
	  					</table>

					<h1>Список выданной литературы</h1>
						<table  class="tabl" border="2" width="650">
							<colgroup>            
      							 <th>Дата</th><th>Автор</th><th>Наименование</th><th>Штрих-код</th> 
     <?php $query3="SELECT * FROM event WHERE status = 2 AND barcode_reader=".$row['barcode'];
$sql3=pg_query($query3) or die('<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>'	);
 
for ($i=1; $i <= pg_num_rows($sql3) ; $i++)
  {
$row3=pg_fetch_array($sql3);

$query4="SELECT * FROM book WHERE  barcode_book=".$row3['barcode_book'];
$sql4=pg_query($query4)or die(pg_error() );
$row4=pg_fetch_array($sql4);
$query5="SELECT * FROM author WHERE id=".$row4['author'];
$sql5=pg_query($query5);
$row5=pg_fetch_array($sql5)or die(pg_error() );
echo '<tr><td>'.$row3['date_start'].'</td><td>'.$row5['author_fio'].'</td><td>'.$row4['title'].'</td><td>'.$row3['barcode_book'].'</td></tr>';

}
?>
 						</table><br>
 						<a href="javascript:doPopup('history.php');">История операций</a>
				</div>


             <div class="12">
				<div class="span6">
					<h3>&nbsp;</h3>
					<div class="well clearfix homeLinks">
						<ul class="thumbnails">
							<li>
								<a href="korzina.php" class="thumbnail">
									<img src="img/icon-strategy2_64.png" class="pull-left" alt="">
									<h3>Корзина</h3>
									<div class="clearfix"></div>
								</a>
							</li>
							<li>
								<a href="catalog.php" class="thumbnail">
									<img src="img/icon-archive_64.png" class="pull-left" alt="">
									<h3>Каталог</h3>
									<div class="clearfix"></div>
								</a>
							</li>
							<li>
								<a href="poisk.php" class="thumbnail">
									<img width="55" src="img/icon-search_64.png" class="pull-left" alt="">
									<h3>Поиск</h3>
									<div class="clearfix"></div>
								</a>
							</li>
							<li>
								<a href="lk.php?id=<?php echo $_SESSION['login'];?>" target="_blank" class="thumbnail">
									<img src="img/icon-textDocuments_64.png" class="pull-left" alt="">
									<h3>Личный кабинет</h3>
									<p><small>Вход в личный кабинет сотрудника</small></p>
									<div class="clearfix"></div>
								</a>
							</li>
						</ul>
					</div>

				</div>	</div>		</div>
		</div>
	</div>
</div>


<footer class="clearfix">
	<div class="container">
		<div class="row">
<div class="span4">
				<address>
					<strong>СПб ГБУК "ГМГС"</strong><br>
					197101, Санкт-Петербург,<br>
					Невский проспект 179<br>
					<abbr title="Телефон">тел.</abbr>: +7 (812) 274 26 35
				</address>
				<address>
					<strong>Разработано в Отделе ИТ:</strong><br>
					<i class="icon-envelope icon-white"></i>&nbsp;<a href="mailto:it.gmgs@gmail.com">it.gmgs@gmail.com</a>
				</address>
			</div>

			<div class="span8">
				<ul class="footer-links">
					<li class="pull-right"><a href="#"><i class="icon-arrow-up"></i>&nbsp;Наверх</a></li>
					<li><a href="korzina.php">Корзина</a></li>
					<li><a href="catalog.php">Каталог</a></li>
					<li><a href="lk.php?id=<?php echo $_SESSION['login'];?>" target="_blank">Личный кабинет</a></li>
					
				</ul>
				<hr>

</body>
</html>
