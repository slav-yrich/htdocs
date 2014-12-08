<?php session_start();?>
<!DOCTYPE HTML>
<?php if(isset($_GET['exit'])){
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

?>
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
					<h1>Регистрация</h1>
						<?php
							if (($_POST['fname']!='')&&($_POST['name']!='')&&($_POST['oname']!='')&&($_POST['datebirds']!='')&&($_POST['org']!='')&&($_POST['deprt']!='')&&($_POST['group']!='')&&($_POST['adress']!='')&&($_POST['login']!='')&&($_POST['pass1']!='')&&($_POST['pass2']!='')&&($_POST['captcha']!='')){
								$arr=pg_fetch_array(pg_query("SELECT * FROM reader WHERE login='".$_POST['login']."'"));
								if(empty($arr)){
									if ($_SESSION['secpic']==$_POST['captcha'])	{
										if ($_POST['pass1']==$_POST['pass2']){
											if (strlen($_POST['login'])<=14){	
												$handle = pg_query("SELECT MAX(id) FROM reader");
												$tmp  = pg_fetch_array($handle);
												$t1=max($tmp)+1;
												$handle = pg_query("SELECT MAX(barcode) FROM reader");
												$tmp  = pg_fetch_array($handle);
												$t2=max($tmp)+1;
												$password=MD5($_POST['pass1']);
												pg_query("INSERT INTO reader (id, barcode,name,password,surname,patronymic,datebirth,position,login,department,organization,address) 
													VALUES 
														('$t1',
														'$t2',
														'".$_POST['fname']."',
														'".MD5($_POST['pass1'])."',
														'".$_POST['name']."',
														'".$_POST['oname']."',
														'".$_POST['datebirds']."',
														'".$_POST['group']."',
														'".$_POST['login']."',
														'".(int)$_POST['depart']."',
														'".(int)$_POST['org']."',
														'".$_POST['adress']."')
												");
												echo("Мои поздравления, ".$_POST['fname'].", Вы зарегистрировались!<br><a href='avtoriz.html'>Авторизация</a>");
											}
											else
											{
												echo('Придумай логин покороче!<br><a href="registr.php">Вернуться на страницу регистрации</a>');
											}
										}
										else
										{
											echo('Пароли не совпадают!<br><a href="registr.php">Вернуться на страницу регистрации</a>');
										}
									}
									else
									{
										echo('Неправильный код с картинки!<br><a href="registr.php">Вернуться на страницу регистрации</a>');
									}
								}
								else
								{
									echo('Данный логин существует!<br><a href="registr.php">Вернуться на страницу регистрации</a>');
								}
							}
							else
							{ 
								echo('Введены не все обязательные поля!<br><a href="registr.php">Вернуться на страницу регистрации</a>');
							}
						?>
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
