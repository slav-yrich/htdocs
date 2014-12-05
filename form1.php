<?php session_start()?>
<?php include("pgsql.php") ?>
<?php if(isset($_GET['exit']) || !isset($_SESSION['login'])){
session_destroy();
echo('	<meta http-equiv="refresh" content="0;url=avtoriz.html">');
exit;
} ?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Поиск</title>
	
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
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
						<a href="form1.php?exit=1" role="button" id="authModalBtn" class="btn pull-right" data-toggle="modal">&nbsp;Выход</a>
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
					
				<ul class="thumbnails newBooks">
					<?php
						if ($_POST["avtor"]!='')
						{
							$avtor = $_POST["avtor"];
						}
						else
						{
							$avtor="";
						}

						if ($_POST["nazvanie"]!='')
						{
							$nazvanie = $_POST["nazvanie"];
						}
						else
						{
							$nazvanie="";
						}

						if ($_POST["kategor"]!='')
						{
							$kategor = $_POST["kategor"];
						}
						else
						{
							$kategor="";
						}

						function poisk($avtor, $nazvanie, $kategor)
						{
							if ($avtor=='')
							{
								$avtor='%';
							}
							if ($nazvanie=='')
							{
								$nazvanie='%';
							}
							if ($kategor=='Каталог литературы')
							{
								$kategor='%';
							}

							$result = pg_query("SELECT * FROM book 
												WHERE author IN (SELECT id FROM author WHERE author_fio LIKE '%$avtor%')
													AND category IN (SELECT id FROM category WHERE category_name LIKE '%$kategor%')
													AND title LIKE '%$nazvanie%' ");
							$handle = pg_query("SELECT count(1) FROM book 
												WHERE author IN (SELECT id FROM author WHERE author_fio LIKE '%$avtor%')
													AND category IN (SELECT id FROM category WHERE category_name LIKE '%$kategor%')
													AND title LIKE '%$nazvanie%' ");
							$tmp  = pg_fetch_array($handle);
							$k=$tmp[0];

							echo '<h1>Результаты поиска:</h1>';
							
							if($k>0)
							{
								echo 'По вашему запросу найдены следующие книги:'.'<br>';
								for ($i=0;$i<$k;$i++)
								{
									$book=pg_fetch_array($result);
									//$cur_result= pg_query("SELECT * FROM author WHERE id=$book['author']");
									//$cur_author = pg_fetch_array($cur_result);
									echo "(code: ".$book['barcode_book'].
									 	", название: ".$book['title'].
									 	", автор: ".$book['author']./*$cur_author['author_fio'].*/
									 	")<br>";
								}
								
								echo "Всего найдено:".$k."<br>";	
							}
							else
							{
								Echo "Сожалеем, но в базе нет такой книги. Попробуйте расширить условия поиска.";
							}
						}

		poisk($avtor, $nazvanie, $kategor);
		echo '<form action="poisk.php" method="post">'.
					'<input name="net" type="submit" value="Назад">'.
					'</form>';	
			
	?>
				</div>


					
					
			
				<div class="span6">
					<h3>&nbsp;</h3>
					<div class="well clearfix homeLinks">
						<ul class="thumbnails">
							<li>
								<a href="korzina.html" class="thumbnail">
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

				
				</div>			</div>
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
