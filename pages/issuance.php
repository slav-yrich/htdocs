
 <?php
  $num_book =  $_SESSION['n_book'];
	$query = "SELECT * FROM book WHERE id_book = $num_book";
	$sql = pg_query($query) or die (pg_error());
	$row = pg_fetch_array($sql);
	$query_q = "SELECT * FROM author WHERE id =". (int)$row['author'];
	$sql_q  = pg_query($query_q);
	$gow = pg_fetch_array($sql_q);
	?>

<script type= "text/javascript">
function goToPage()
{

	document.location.href = "catalog.php";
}
</script>
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
				<a href="/index.php?p=korzina" class="thumbnail">
				<img src="img/icon-strategy2_64.png" class="pull-left" alt="">
				<h3>Корзина</h3>
				<div class="clearfix"></div>
				</a>
			</li>
			<li>
				<a href="/index.php?p=catalog" class="thumbnail">
				<img src="img/icon-archive_64.png" class="pull-left" alt="">
				<h3>Каталог</h3>
				<div class="clearfix"></div>
				</a>
			</li>
			<li>
				<a href="/index.php?p=poisk" class="thumbnail">
				<img width="55" src="img/icon-search_64.png" class="pull-left" alt="">
				<h3>Поиск</h3>
				<div class="clearfix"></div>
				</a>
			</li>
			<li>
				<a href="/index.php?p=lk&id=<?php echo $_SESSION['login'];?>" target="_blank" class="thumbnail">
				<img src="img/icon-textDocuments_64.png" class="pull-left" alt="">
				<h3>Личный кабинет</h3>
				<p><small>Вход в личный кабинет сотрудника</small></p>
				<div class="clearfix"></div>
				</a>
			</li>
		</ul>
	</div>		
</div>