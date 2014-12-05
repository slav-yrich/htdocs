<?php session_start()?>
<!DOCTYPE html>
<?php if(isset($_GET['exit']) || !isset($_SESSION['login'])){
session_destroy();
echo('	<meta http-equiv="refresh" content="0;url=avtoriz.html">');
exit;
} ?>
<?php include("pgsql.php") ?>
 <?php $num_book = $_GET['num_book'];
  $_SESSION['n_book'] = $num_book;
	$query = "SELECT * FROM book WHERE id_book = $num_book";
	$sql = pg_query($query) or die (pg_error());
	$row = pg_fetch_array($sql);
	$query_q = "SELECT * FROM author WHERE id =". (int)$row['author'];
	$sql_q  = pg_query($query_q);
	$gow = pg_fetch_array($sql_q);
	?>
<!-- saved from url=(0040)http://books.ifmo.ru/catalog/catalog.htm -->

<?php include("pgsql.php") ?>
<html lang="ru">
<head>

		<script type= "text/javascript">
function goToPage()
{
	
	document.location.href = "issuance.php";
}
</script>
	<meta charset="utf-8">
	<title><?php echo $row['title'];?></title>
	
	
	
	
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
						<a href="annot.php?exit=1" role="button" id="authModalBtn" class="btn pull-right" data-toggle="modal">&nbsp;Выход</a>
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
				<?php echo '<p style="font-size:30px;"><b>'.$row['title'].'</b></p>';
				$filename = 'img/'.$row['id_book'].'.jpg';
				if (file_exists($filename)){
				echo '<img src="'.$filename.'" style="width: 300px; heigth: 500px;" class="thumbnail" width="150">';}
				else {
					echo '<img src="img/def.jpg" style="width: 300px; heigth: 500px;"  class="thumbnail" >';
				}
	echo '<p class="green1">'.'<b>Автор:&nbsp</b>' .'<br>'.$gow['author_fio'].'</p>';
	if (strlen($row['discription']) >= 1){
	echo '<p class="green">'.'<b>Описание:&nbsp</b>'.'<br>'.$row['discription'].'</p>';}
	else {
		echo '<p class="green">'.'<b>Описание&nbsp</b>'.' отсутсвует'.'</p>';
	}
	echo '<p class="green1">'.'<b>Страниц:&nbsp</b>' .'<br>'.$row['totalpages'].'</p>';
	if (strlen($row['publish']) >= 1){
	echo '<p class="green1">'.'<b>Издание:&nbsp</b>'.'<br>'.$row['publish'].'&nbsp'.$row['year'].'</p>';}
	else {
		echo '<p class="green1">'.'<b>Издание&nbsp</b>'.'не указано</b>'.'</p>';
	}
		if ($row['status'] == 1) { 
	echo '<button class="btn" onclick="javascript: goToPage()">Взять почитать</button>';}
  else { echo'<p><b>Книга отсутсвует в библиотеке</b></p>';
    echo '<button disabled class="btn" disabled onclick="javascript: goToPage()">Взять почитать</button>';
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