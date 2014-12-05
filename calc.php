<html>
<head>
<title>Кредитный калькулятор</title>
<style>
td{text-align:center; border: solid 0.3mm;}
table{border:solid 0.3mm;}
</style>
</head>
<body>
<?php
if($_POST["sum"]>0&&$_POST["percent"]>=0&&$_POST["mounth"]>=1&&$_POST["first"]>=0&&$_POST["sum"]>$_POST["first"]){
echo
    "<table>
        <tr>
            <td>Месяц</td>
            <td>Платеж</td>
            <td>Погашение процентов</td>
            <td>Погашение долга</td>
            <td>Остаток задолженности</td>
        </tr>
    ";
$k=$_POST["sum"]; //сумма кредита и в даьнейшем остаток задолженности
$c=$_POST["percent"]; //процентная ставка
$n=$_POST["mounth"]; //количество месяцев
$first=$_POST["first"];  // первый взнос
$p=$c/1200;
$sumdolg=0;
$sumpercent=0;
$a=($p*pow(1+$p,$n))/(pow(1+$p,$n)-1); // аннуинтентный коэффициент
$k-=$first; //вычитаем первый взнос
$sa=$a*$k; //сумма ежемесячного платежа
for($i=1;$i<=$n;$i++) //рисуем таблицу
{
    $cent=$p*$k; //погашение процентов
    $dolg=$sa-$cent; //погашение долга
    $ost=$k-$dolg;   //остаток долга
    $sumpercent+=$cent;
    $sumdolg+=$dolg;
    echo
        "<tr>
            <td>".$i."</td>
            <td>".round($sa,2)."</td>
            <td>".round($cent,2)."</td>
            <td>".round($dolg,2)."</td>
            <td>".round($ost,2)."</td>
        </tr>";
    $k=$k-$dolg;
}
echo
"
<tr>
    <td>ИТОГО</td>
    <td></td>
    <td>".round($sumpercent,2)."</td>
    <td>".round($sumdolg+$first,2)."</td>
    <td></td>
</tr>
</table>";
}
else
{
    echo("Неправильно введены данные!<br><form method='POST' action='index.php'><input type='submit' name='sub' value='Назад'>");

}

?>
</body>
</html>