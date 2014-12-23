			<div class="row-fluid">
				<div class="span6">
					
				<ul class="thumbnails newBooks">
					<form action="index.php?p=poisk_next" method="post">
      					<h1>Поиск по:</h1>
      						Автору<br> 
      						<input  class="well sideNav affix-top"  name="avtor" type="text" 
      						><br>
      						Названию<br>  
      						<input class="well sideNav affix-top" name="nazvanie" type="text" value=
      							<?php
      								if ($_POST["searchTextBox"]!='')
									{
										$searchTextBox = $_POST["searchTextBox"];
									}
									else
									{
										$searchTextBox="";
									}
									echo '"'.$searchTextBox.'"';
      							?>
      						><br>
      						Категории<br>  
      						<select name="kategor">
								<?php
									include 'pgsql.php';
									$handle = pg_query("SELECT count(1) FROM category");
									$tmp  = pg_fetch_array($handle);
									$k=$tmp[0];
									$result=pg_query("SELECT * FROM category");
									
									for($i=1;$i<=$k;$i++){
										$row=pg_fetch_array($result);
										echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>';
									}
								?>
							</select>
    						<br/>
   	 						<input class="login" name="sumbit" type="submit" value="Отправить данные">
  					</form>
				</div>

