
			<div class="row-fluid">
				<div class="span6">
					
				<ul class="thumbnails newBooks">
					<div class="clearfix">
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
							$avtor='%'.pg_escape_string($avtor).'%'; 
							$nazvanie='%'.pg_escape_string($nazvanie).'%'; 
							if ($kategor=='Каталог литературы') 
								{ $kategor='%'; }
							else 
								{ $kategor=pg_escape_string($kategor);}

							$sql = "SELECT * FROM book 
									WHERE author IN (SELECT id FROM author WHERE author_fio LIKE '%$avtor%')
											AND category IN (SELECT id FROM category WHERE category_name LIKE '%$kategor%')
											AND title LIKE '%$nazvanie%' ";

							$result = pg_query($sql) or die(pg_error());

							echo '<h1>Результаты поиска:</h1>';
							$k=0;

							while ($current_book=pg_fetch_array($result))
							{
								if ($k++==0) echo 'По вашему запросу найдены следующие книги:'.'<br>';
								echo '<li>'.
									'<a href="/index.php?p=annot&amp;num_book='.$current_book['id_book'].'"><p>'.
									$k.'| '.
									'(barcode: '.$current_book['barcode_book'].
									', название: '.$current_book['title'].
									', автор: '.$current_book['author'].
									')</p></a>'.
									'</li>';
							}
							if ($k==0)
							{
								Echo "Сожалеем, но в базе нет такой книги. Попробуйте расширить условия поиска.";
							}
							else
							{
								echo "Всего найдено:".$k."<br>";
							}
						}

		poisk($avtor, $nazvanie, $kategor);
		echo '<form action="index.php?p=poisk" method="post">'.
					'<input name="net" type="submit" value="Назад">'.
					'</form>';	
			
	?>
				</div>
			</ul>
			</div>
			</div>
			


					
