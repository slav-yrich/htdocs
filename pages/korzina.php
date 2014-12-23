<?php
if (!(isset($_SESSION['login']))) {
	header("Location:/index.php?p=category");
}
$id = $_SESSION['login'];
$query="SELECT * FROM reader WHERE id = $id";
$sql=pg_query($query);
$row=pg_fetch_array($sql);
$query1="SELECT * FROM organization WHERE id = ".$row['organization'];
$sql1=pg_query($query1);
$row1=pg_fetch_array($sql1);
$query2="SELECT * FROM department WHERE id = ".$row['department'];
$sql2=pg_query($query2);
$row2=pg_fetch_array($sql2);?>


			<div class="row-fluid">
				<div class="span6">
					<h1>Список книг в корзине</h1>
						<table  class="tabl" border="2" width="650">
					 <th>Автор</th><th>Наименование</th><th>Штрих-код</th>
     <?php $query3="SELECT * FROM event WHERE status = 3 AND barcode_reader = ".$row['barcode'];
$sql3=pg_query($query3) or die('<tr><td>-</td><td>-</td><td>-</td></tr>' );

if (pg_num_rows($sql3)>0){
for ($i=1; $i <= pg_num_rows($sql3) ; $i++)
  {
$row3=pg_fetch_array($sql3);

$query4="SELECT * FROM book WHERE  barcode_book = ".$row3['barcode_book'];
$sql4=pg_query($query4) or die(pg_error());
$row4=pg_fetch_array($sql4);
$query5="SELECT * FROM author WHERE id=".$row4['author'];
$sql5=pg_query($query5) or die(pg_error());
$row5=pg_fetch_array($sql5);
echo '<tr><td>'.$row5['author_fio'].'</td><td>'.$row4['title'].'</td><td>'.$row3['barcode_book'].'</td></tr>';
}}else{
	echo('<tr><td colspan=3 align=center>Пусто</td></tr>');
}
?>
				</table></div>

