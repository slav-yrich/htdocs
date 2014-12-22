
<script language="javascript">
function doPopup(popupPath) {
window.open(popupPath,'name',
'width=850,height=550,scrollbars=YES');
}
</script>
	<?php
$id = $_GET['id'];
if ($id != @$_SESSION['login']) {session_destroy();

echo 'Для доступа к личному кабинету, пожалуйста, <a href="#authModal" id="authModalBtn" data-toggle="modal">ВОЙДИТЕ В СИСТЕМУ</a> или 
	<a href="/index.php?p=registr">ЗАРЕГИСТРИРУЙТЕСЬ</a>';
	/* exit; */
	}
	else {
$query="SELECT * FROM reader WHERE id=$id";
$sql=pg_query($query);
$row=pg_fetch_array($sql);
$query1="SELECT * FROM organization WHERE id=".$row['organization'];
$sql1=pg_query($query1);
$row1=pg_fetch_array($sql1);
$query2="SELECT * FROM department WHERE id=".$row['department'];
$sql2=pg_query($query2);
$row2=pg_fetch_array($sql2);

function FormatDate($date)                        {
	   $newDate =  DateTime::createFromFormat('Y-m-d', $date) -> format('d-m-Y');
return $newDate;
	}?>

			<div class="row-fluid">
				<div class="span6">
					<h1>Личный кабинет</h1>
						<table>
				            <colgroup width="230" >
				            <colgroup width="150" >
				            	<tr>
				            		<td rowspan="10" align="center"><img src="img/readers/<?php echo $row['id'];?>.jpg" alt=""></td>
				            	</tr>
				              	<tr>
				              		<td>Фамилия:</td>
				              		<td class="td"><?php echo $row['surname'];?></td>
				              	</tr>
					            <tr>
					            	<td>Имя:</td>
					            	<td class="td"><?php echo $row['name'];?></td>
					            </tr>
					            <tr>
					            	<td>Отчество:</td>
					            	<td class="td"><?php echo $row['patronymic'];?></td>
					            </tr>
					            <tr>
					            	<td>Дата рождения:</td>
					            	<td class="td"><?php echo ($row['datebirth']!='')?FormatDate($row['datebirth']):"";?></td>
					            </tr>
					            <tr>
					            	<td>Организация:</td>
					            	<td class="td"><?php echo $row1['organizationname'];?></td>
					            </tr>
				            	<tr>
				            		<td>Отдел:</td>
				            		<td class="td"><?php echo $row2['departmentname'];?></td>
				            	</tr>
                                <tr>
				            		<td>Группа:</td>
				            		<td class="td"><?php echo $row['position'];?></td>
				            	</tr>
                                <tr>
				            		<td>Телефон:</td>
				            		<td class="td"><?php echo $row['telephone'];?></td>
				            	</tr>
                                 <tr>
				            		<td >Адрес:</td>
				            		<td class="td"><?php echo $row['address'];?></td>
				            	</tr>
				            	<tr>
				            	<td><a href="javascript:doPopup('index.php?p=edit&amp;id=<?php echo $_SESSION['login'];?>');">Редактировать данные</a></td>

	  							</tr>
                                <tr>
                                <td><a href='javascript:doPopup("index.php?p=history");'>История операций</a></td>
                                </tr>
                                </colgroup>
                                </colgroup>
                               
	  					</table>
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

						<div>
					<h1>Список выданной литературы</h1>
						<table  class="tabl" border="2" width="650">
							<colgroup>
      							 <th>Дата</th><th>Автор</th><th>Наименование</th><th>Штрих-код</th>
                                 </colgroup>
                                 
     <?php 
	 $query3="SELECT * FROM event WHERE status = 2 AND barcode_reader=".$row['barcode'];
$sql3=pg_query($query3) /*or die('<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>'	 )*/;
for ($i=1; $i <= pg_num_rows($sql3) ; $i++)
  {
$row3=pg_fetch_array($sql3);
$query4="SELECT * FROM book WHERE  barcode_book=".$row3['barcode_book'];
$sql4=pg_query($query4) /*or die(pg_error() ) */;
$row4=pg_fetch_array($sql4);
$query5="SELECT * FROM author WHERE id=".$row4['author'];
$sql5=pg_query($query5);
$row5=pg_fetch_array($sql5) /*or die(pg_error()  )*/;
echo '<tr><td>'.FormatDate($row3['date_start']).'</td><td>'.$row5['author_fio'].'</td><td>'.$row4['title'].'</td><td>'.$row3['barcode_book'].'</td></tr>';
}

	}
	?>
						
 						</table> <br>
 									</div>
                                  </div>
							
    									
	

						
