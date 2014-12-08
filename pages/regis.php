
			<div class="row-fluid">
				<div class="span6">
					<h1>Регистрация</h1>
						<?php
							if (($_POST['fname']!='')&&($_POST['name']!='')&&($_POST['oname']!='')&&($_POST['datebirds']!='')&&($_POST['org']!='')&&($_POST['deprt']!='')&&($_POST['group']!='')&&($_POST['adress']!='')&&($_POST['login']!='')&&($_POST['pass1']!='')&&($_POST['pass2']!='')&&($_POST['captcha']!='')){
								$arr=pg_fetch_array(pg_query("SELECT * FROM reader WHERE login='".$_POST['login']."'"));
								if(empty($arr)){
									if ($_SESSION['secpic']==$_POST['captcha'])	{
										if ($_POST['pass1']==$_POST['pass2']){
											if (strlen($_POST['login'])<=14){	
												$handle = pg_query("SELECT MAX(id) FROM reader");
												$tmp  = pg_fetch_array($handle);
												$t1=max($tmp)+1;
												$handle = pg_query("SELECT MAX(barcode) FROM reader");
												$tmp  = pg_fetch_array($handle);
												$t2=max($tmp)+1;
												$password=MD5($_POST['pass1']);
												//var_dump($_FILES["picture"]);
												if(is_uploaded_file($_FILES["picture"]["tmp_name"]))
												{
													// Если файл загружен успешно, перемещаем его
													// из временной директории в конечную
													$pic=explode(".",$_FILES["picture"]["name"]);
													if ((mb_strtolower($pic[1])=='jpg')||(mb_strtolower($pic[1])=='jpeg')||(mb_strtolower($pic[1])=='gif')||(mb_strtolower($pic[1])=='bmp')||(mb_strtolower($pic[1])=='png')){
														$addpic=dirname( __DIR__ )."/img/readers/".$t1.".".$pic[1];
														move_uploaded_file($_FILES["picture"]["tmp_name"],$addpic );
													} else {
														echo('Картинка не загружена, так как данный формат не поддерживается!<br>');
														$addpic="img/readers/default.jpg";
													}
												} else {
													$addpic="img/readers/default.jpg";
												}
												pg_query("INSERT INTO reader (id, barcode,name,password,surname,patronymic,datebirth,position,login,department,organization,address) 
													VALUES 
														('$t1',
														'$t2',
														'".$_POST['fname']."',
														'".MD5($_POST['pass1'])."',
														'".$_POST['name']."',
														'".$_POST['oname']."',
														'".$_POST['datebirds']."',
														'".$_POST['group']."',
														'".$_POST['login']."',
														'".(int)$_POST['deprt']."',
														'".(int)$_POST['org']."',
														'".$_POST['adress']."')
												");
												echo("Мои поздравления, ".$_POST['fname'].", Вы зарегистрировались!<br><a href='avtoriz.html'>Авторизация</a>");
											}
											else
											{
												echo('Придумай логин покороче!<br><a href="registr.php">Вернуться на страницу регистрации</a>');
											}
										}
										else
										{
											echo('Пароли не совпадают!<br><a href="registr.php">Вернуться на страницу регистрации</a>');
										}
									}
									else
									{
										echo('Неправильный код с картинки!<br><a href="registr.php">Вернуться на страницу регистрации</a>');
									}
								}
								else
								{
									echo('Данный логин существует!<br><a href="registr.php">Вернуться на страницу регистрации</a>');
								}
							}
							else
							{ 
								echo('Введены не все обязательные поля!<br><a href="registr.php">Вернуться на страницу регистрации</a>');
							}
						?>
				</div>


             <div class="12">
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
		</div>