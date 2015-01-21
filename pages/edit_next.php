<?php 
pg_set_client_encoding("UTF-8");

$id=$_POST['qw'];
$query="SELECT * FROM reader WHERE id='$id'";
$sql=pg_query($query);
$row=pg_fetch_array($sql);
 
$values = array(
    'surname' => 'sur', 
	'name' => 'name', 
	'patronymic' => 'otch',
    'datebirth' => 'bday'
);
 
$id = isset($_POST['qw']) ? (int) $_POST['qw'] : 0;
 
if(empty($id))
{
    //qw не ввели, обновлять нечего.
	echo "Данные не были введены.";
}
else
{
    $query = '';
    foreach($values as $k=>$v)
        if(($_POST[$v]) != $row[$k]) {
            $query .= $k . ' = \''. pg_escape_string($_POST[$v]) . '\', '; // "name = 'newname' ,"
		}
		
    if(empty($query))
    {
        //ничего не заполнили, обновлять нечего.
		echo "Данные не были введены.";
    }
    else
    {
        $res = pg_query('UPDATE reader SET ' . rtrim($query, ', ') . ' WHERE id = ' . $id . ';');
		if (!$res)
			echo "Ошибка запроса.";
		else
			echo 'Число измененных строк: ' . pg_affected_rows($res) . '. Обновите страницу.';
    }
}
?>
