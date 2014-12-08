<?php  
$host="localhost";
$user="gmgs_9220_book";
$pass="book2014";
$database="gmgs_9220_lib";
$dp=pg_connect("host=$host port=5432 dbname=$database user=$user password=$pass") or die('Wrong CONN_STRING');
//pg_query("SET NAMES 'utf8'");
if (pg_ping($dp))
{
//echo "УДАЧА! ^^";
}
else
{
echo "ОБЛОМАШКИ ;(";
	die();
}

?>