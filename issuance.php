<?php include_once("auth.php");?>
<!DOCTYPE html>
<?php include("pgsql.php");
if(isset($_GET['exit']) || !isset($_SESSION['login'])){
session_destroy();
echo('	<meta http-equiv="refresh" content="0;url=avtoriz.html">');
exit;
} ?>
 <?php 
  $num_book =  $_SESSION['n_book'];
	$query = "SELECT * FROM book WHERE id_book = $num_book";
	$sql = pg_query($query) or die (pg_error());
	$row = pg_fetch_array($sql);
	$query_q = "SELECT * FROM author WHERE id =". (int)$row['author'];
	$sql_q  = pg_query($query_q);
	$gow = pg_fetch_array($sql_q);
	?>
<!-- saved from url=(0040)http://books.ifmo.ru/catalog/catalog.htm -->

<?php include("pgsql.php");

?>

<html lang="ru">
<head>

		<script type= "text/javascript">
function goToPage()
{
	
	document.location.href = "catalog.php";
}
</script>
	<meta charset="utf-8">
	<title>Выдача литературы</title>
	
	
	
	
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
						<a href="issuance.php?exit=1" role="button" id="authModalBtn" class="btn pull-right" data-toggle="modal">&nbsp;Выход</a>
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
					<p>Санкт-Петербургский национальный исследовательский университет <strong>информационных технологий, механики и оптики</strong></p>
					<h1><a href="index.php">Учебные издания</a></h1>
				</div>
				<div class="span4"><div class="logo"><a href="http://www.ifmo.ru/" target="blank"><img src="img/logo.png" border="0"></a></div></div>
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
					<h1><?php echo $row['title']; ?></h1>
					<ol>
					<?php 
         
  if (isset($_SESSION['login'])) {
  			$query = "SELECT * FROM reader WHERE id=". (int)$_SESSION['login'];
  			$sql = pg_query($query) or die (pg_error());
  			$row = pg_fetch_array($sql);
  			$bar_c_re = $row['barcode'];
  			$query = "SELECT * FROM book WHERE id_book=". (int)$_SESSION['n_book'];
  			$sql = pg_query($query) or die (pg_error());
  			$row = pg_fetch_array($sql);
  			$bar_c_bk = $row['barcode_book'];
  			$today = date("Y-m-d");
  			
  			$query = "SELECT MAX(id) FROM event";
  			$sql = pg_query($query) or die (pg_error());
  			$dp = pg_fetch_object($sql);
  			$last_id = $dp -> id;
  			$new_id = $last_id+1;
  			$query = "INSERT INTO event (id, barcode_book, barcode_reader, date_start, status) VALUES ('$new_id', '$bar_c_bk','$bar_c_re','$today', '3') ";
  			$sql = pg_query($query) or die (pg_error());
        $query = "UPDATE book SET status=3 WHERE id_book=". (int)$_SESSION['n_book'];
        $sql = pg_query($query) or die (pg_error());
  }
  mail("rabotnik@v_biblioteke.com", "My Subject", "Вы ");?>
  <p><b>Вы можете забрать книгу в ближайшем отделении нашей библиотеки</b></p>
 <button class="btn" onclick="javascript: goToPage()">Вернуться в каталог</button>
						

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
									<p><small>Вход в личный кабинет студента</small></p>
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
					<strong>НИУ ИТМО</strong><br>
					197101, Санкт-Петербург,<br>
					пр. Кронверкский, д.49<br>
					<abbr title="Телефон">тел.</abbr>: +7 (812) 232-97-04
				</address>
				<address>
					<strong>Издательская деятельность</strong><br>
					<i class="icon-envelope icon-white" style="opacity: 0.5;"></i>&nbsp;<a href="mailto:izdat@mail.ifmo.ru">izdat@mail.ifmo.ru</a>
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