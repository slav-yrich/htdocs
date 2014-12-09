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


				</div>