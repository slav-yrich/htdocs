
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


					
