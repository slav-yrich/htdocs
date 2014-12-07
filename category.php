<?php 

include_once("auth.php");
include("pgsql.php");

if(isset($_GET['exit'])) {
session_destroy();
echo '<a href="avtoriz.html">Войдите в систему</a><br>
	<a href="regis.html">или зарегистрируйтесь</a>';
	exit;
}?>
<?php $num_cat = $_GET['num_cat'];
if (!isset($_SESSION['login'])) {
	echo '<a href="avtoriz.html">Войдите в систему</a><br>
	<a href="regis.html">или зарегистрируйтесь</a>';
	exit;
}
$query2 ="SELECT category_name FROM category WHERE id=$num_cat";
$sql2  = pg_query($query2);
	$dp = pg_fetch_object($sql2);
	$category_name = $dp -> category_name;
?>

<?php include("pgsql.php") ?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title><?php echo $category_name;?></title>
	
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
						<a href="category.php?exit=1" role="button" id="authModalBtn" class="btn pull-right" data-toggle="modal">&nbsp;Выход</a>
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
					<h1>Каталог</h1>
				<ul class="thumbnails newBooks">
					<div class="clearfix">
				<?php 
						$query3 ="SELECT * FROM book WHERE category =$num_cat";
$sql3 = pg_query($query3) or die(pg_error());
for ($i=1; $i <= pg_num_rows($sql3) ; $i++) { 
	$row3 =pg_fetch_array($sql3);
	
	$query_q = "SELECT * FROM author WHERE id =". (int)$row3['author'];
	$sql_q  = pg_query($query_q);
	$gow = pg_fetch_array($sql_q);

	echo '<li><a href="annot.php?num_book='.$row3['id_book'].'"><p>&nbsp'.$i.' '.$row3['title'].', '.$gow['author_fio'].' - '.$row3['totalpages'].'&nbsp стр., '.$row3['publish'].', '.$row3['year'].'г.</p></a>'.'</li>';
pg_query($query_q) or die(pg_error());
}
	?>

</div>
					</ul>
					
				</div>
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

				
</body></html>