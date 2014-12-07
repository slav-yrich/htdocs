<?php session_start();?>
<!DOCTYPE HTML>
<?php 
if(isset($_GET['exit'])){
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
						<form method="POST" action="regis.php">
						<table>
				            <colgroup width="230" >
				            <colgroup width="150" >
				              	<tr>
					            	<td>*Логин:</td>
					            	<td class="td"><input type="text" name="login"></td>
					            </tr>
								<tr>
					            	<td>*Пароль:</td>
					            	<td class="td"><input type="password" name="pass1">
										<script language="javascript">	
											document.getElementById('pass1').value = hex_md5(document.getElementById('pass1'));
										</script>
										</td>
					            </tr>
								<tr>
					            	<td>*Подтвердите пароль:</td>
					            	<td class="td"><input type="password" name="pass2"></td>
					            </tr>
								<tr>
				              		<td>*Фамилия:</td>
				              		<td class="td"><input type="text" name="name"></td>
				              	</tr>
					            <tr>
					            	<td>*Имя:</td>
					            	<td class="td"><input type="text" name="fname"></td>
					            </tr>
					            <tr>
					            	<td>*Отчество:</td>
					            	<td class="td"><input type="text" name="oname"></td>
					            </tr>
					            <tr>
					            	<td>*Дата рождения:</td>
					            	<td class="td"><input type="date" name="datebirds"></td>
					            </tr>
					            <tr>
					            	<td>*Организация:</td>
					            	<td class="td"><select name="org">
													<?php
									$handle = pg_query("SELECT count(1) FROM organization");
									$tmp  = pg_fetch_array($handle);
									$k=$tmp[0];
									$result=pg_query("SELECT * FROM organization");
									for($i=1;$i<=$k;$i++){
										$row=pg_fetch_array($result);
										echo '<option value="'.$row['id'].'">'.$row['organizationname'].'</option>';

									}
									?></select></td>
					            </tr>
				            	<tr>
				            		<td>*Отдел:</td>
				            		<td class="td"><select name="deprt">
													<?php
									$handle = pg_query("SELECT count(1) FROM department");
									$tmp  = pg_fetch_array($handle);
									$k=$tmp[0];
									$result=pg_query("SELECT * FROM department");
				
									for($i=1;$i<=$k;$i++){
										$row=pg_fetch_array($result);
										echo '<option value="'.$row['id'].'">'.$row['departmentname'].'</option>';
									}
									?></select>
									</td>
				            	</tr>
													            <tr>
					            	<td>*Группа:</td>
					            	<td class="td"><input type="text" name="group"></td>
					            </tr>
													            <tr>
					            	<td>Телефон:</td>
					            	<td class="td"><input type="text" name="tel"></td>
					            </tr>
													            <tr>
					            	<td>*Электронная почта:</td>
					            	<td class="td"><input type="text" name="adress"></td>
					            </tr>						            
								<tr>
				            		<td>Загрузить фото:</td>
				            		<td class="td"><input type="file" name="picture"></td>
				            	</tr>
								<tr>
				            		<td>*Введите текст с картинки:</td>
									<td></td>
				            	</tr>
								<tr>
									<td><img src="secpic.php"></td>
									<td><input type="text" name="captcha"></td>
								</tr>
					            <tr><td></td><td></td></tr>
								<tr>
									<td><input type="submit"></td>
									<td></td>
								</tr>
	  					</table>
						</form>
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
