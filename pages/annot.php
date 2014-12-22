<?php $num_book = $_GET['num_book'];
  $_SESSION['n_book'] = $num_book;
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

	document.location.href = "index.php?p=issuance";
}
</script>

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
	if (strlen($row['text']) >= 1){
	echo '<p class="green">'.'<b>Описание:&nbsp</b>'.'<br>'.$row['text'].'</p>';}
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
			</div>