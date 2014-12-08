			<div class="row-fluid">
				<div class="span6">
					<h1>Регистрация</h1>
						<form method="POST" action="index.php?p=regis" enctype="multipart/form-data">
						<table>
				            <colgroup width="230" >
				            <colgroup width="150" >
				              	<tr>
					            	<td>*Логин:</td>
					            	<td class="td"><input type="text" name="login"></td>
					            </tr>
								<tr>
					            	<td>*Пароль:</td>
					            	<td class="td"><input type="password" name="pass1">
										</td>
					            </tr>
								<tr>
					            	<td>*Подтвердите пароль:</td>
					            	<td class="td"><input type="password" name="pass2"></td>
					            </tr>
								<tr>
				              		<td>*Фамилия:</td>
				              		<td class="td"><input type="text" name="name"></td>
				              	</tr>
					            <tr>
					            	<td>*Имя:</td>
					            	<td class="td"><input type="text" name="fname"></td>
					            </tr>
					            <tr>
					            	<td>*Отчество:</td>
					            	<td class="td"><input type="text" name="oname"></td>
					            </tr>
					            <tr>
					            	<td>*Дата рождения:</td>
					            	<td class="td"><input type="date" name="datebirds"></td>
					            </tr>
					            <tr>
					            	<td>*Организация:</td>
					            	<td class="td"><select name="org">
									<?php
									$handle = pg_query("SELECT count(1) FROM organization");
									$tmp  = pg_fetch_array($handle);
									$k=$tmp[0];
									$result=pg_query("SELECT * FROM organization");
									for($i=1;$i<=$k;$i++){
										$row=pg_fetch_array($result);
										echo '<option value="'.$row['id'].'">'.$row['organizationname'].'</option>';

									}
									?></select></td>
					            </tr>
				            	<tr>
				            		<td>*Отдел:</td>
				            		<td class="td"><select name="deprt">
													<?php
									$handle = pg_query("SELECT count(1) FROM department");
									$tmp  = pg_fetch_array($handle);
									$k=$tmp[0];
									$result=pg_query("SELECT * FROM department");
				
									for($i=1;$i<=$k;$i++){
										$row=pg_fetch_array($result);
										echo '<option value="'.$row['id'].'">'.$row['departmentname'].'</option>';
									}
									?></select>
									</td>
				            	</tr>
													            <tr>
					            	<td>*Группа:</td>
					            	<td class="td"><input type="text" name="group"></td>
					            </tr>
													            <tr>
					            	<td>Телефон:</td>
					            	<td class="td"><input type="text" name="tel"></td>
					            </tr>
													            <tr>
					            	<td>*Электронная почта:</td>
					            	<td class="td"><input type="text" name="adress"></td>
					            </tr>						            
								<tr>
				            		<td>Загрузить фото:</td>
				            		<td class="td"><input type="file" name="picture"></td>
				            	</tr>
								<tr>
				            		<td>*Введите текст с картинки:</td>
									<td></td>
				            	</tr>
								<tr>
									<td><img src="/secpic.php"></td>
									<td><input type="text" name="captcha"></td>
								</tr>
					            <tr><td></td><td></td></tr>
								<tr>
									<td><input type="submit"></td>
									<td></td>
								</tr>
								</colgroup>
								</colgroup>
	  					</table>
						</form>
				</div>

</div>

