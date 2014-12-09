<?php

$id=$_POST['qw'];
$query="SELECT * FROM reader WHERE id='$id'";
$sql=pdsql_query($query);
$row=pdsql_fetch_array($sql);

$values = array(
    'surname' => 'sur', 'name' => 'name', 'patronymic' => 'otch',
    'datebirth' => 'bday',
);

$id = isset($_POST['qw']) ? (int) $_POST['qw'] : 0;

if(empty($id))
{
    //qw не ввели, обновлять нечего.
}
else
{
    $query = '';
    foreach($values as $k=>$v)
        if(($_POST[$v]) != $row[$k])
            $query .= '`' . $k . '` = "' . pdsql_real_escape_string($_POST[$v]) . '", ';
    if(empty($query))
    {
        //ничего не заполнили, обновлять нечего.
    }
    else
    {
        $res = pdsql_query('UPDATE `reader` SET ' . rtrim($query, ', ') . ' WHERE `id` = ' . $id);
        if($res && pdsql_affected_rows() > 1)
            echo 'Данные изменены успешно';
    }
}

?>