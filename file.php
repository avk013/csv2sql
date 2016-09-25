<?php

//print_r($_REQUEST);
//echo ("__");
//print_r($_POST[]);
//echo ("***<BR>");
//print_r($_FILES['uploadfile']);
//echo ("---<BR>");
//if($_FILES['uploadfile']=='CopyRights.txt') echo("+++<BR>");
//$uploadDir = '/rozklad+/server/';
$uploadFile = $uploadDir . $_FILES['uploadfile']['name'].'.csv';
//	$uploadFile = "rozklad+/server/".$_FILES['uploadfile']['name'];
//echo $uploadFile;
//print "<PRE>123";
if ($_REQUEST['uname']=='uname'&& $_REQUEST['passwd']=='rozklad')
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $uploadFile))
{
    print "File is valid, and was successfully uploaded. ";

	require_once '../../wp-config.php'; // DB_NAME DB_PASSWORD DB_USER DB_HOST//
//echo "_BD_";
$host=DB_HOST; // имя хоста (уточняется у провайдера)
$database=DB_NAME; // имя базы данных, которую вы должны создать
$user=DB_USER; // заданное вами имя пользователя, либо определенное провайдером
$pswd=DB_PASSWORD; // заданный вами пароль
$dbh = mysql_connect($host, $user, $pswd) or die("Не могу соединиться с MySQL.");
mysql_select_db($database) or die("Не могу подключиться к базе.");
$row = 1;$i=0;
$handle = fopen("rozklad.csv", "r");
while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    $num = count($data);
    //echo "<p> $num полей в строке $row: <br /></p>\n";
    $row++;
	$tab_date[$row]=$data[1];
	$mas[$i++]=$data;
    for ($c=0; $c < $num; $c++) {
        //echo $data[$c] . "<br />\n";
		// доступна только 1 строчка из data
		 }}
fclose($handle);
//for($c=0;$c<count($tab_date)-1;$c++)
	//for($d=$c+1;$d<count($tab_date);$d++)
	//{if ($tab_date[$c]!=$tab_date[$c+1]) $tab_date2[$e++]=$tab_date[$c];}
//print_r($tab_date);
$tab_date=array_unique($tab_date);
$i=0;
foreach ($tab_date as $date ) $tab_date2[$i++]=$date;
//print_r($tab_date);
//print_r($data);
for($i=0;$i<count($tab_date2);$i++) 
{  $date0=preg_replace('/[^\d.]/','',$tab_date2[$i]);
	$sql="DELETE FROM `1rozklad` WHERE `dat` = $date0";
//	echo $sql."+<BR>";
	$s     = mysql_query($sql);
}
//удаляем записи с этими датами
//////////////////
// вносим данные
$handle = fopen("rozklad.csv", "r");
while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
    $num = count($data);
    //echo "<p> $num полей в строке $row: <br /></p>\n";
    $row++;
	//$tab_date[$row]=$data[1];
	$gr=preg_replace('/[^\d.]/','',$data[0]);
	$dat=preg_replace('/[^\d.]/','',$data[1]);
	$nomer=preg_replace('/[^\d.]/','',$data[2]);
	$query = "INSERT INTO 1rozklad(gr,dat,nomer,displn,prpd) VALUES('$gr','$dat','$nomer','$data[3]','$data[4]')";
//	echo $query;
	$s     = mysql_query($query);
		 }
fclose($handle);

echo "OK!";
///
/*
// only groups
$query = "SELECT distinct gr FROM 1rozklad order by gr";
$res = mysql_query($query);
while($row = mysql_fetch_array($res))
*/
}
else
{
    print "Possible file upload attack!  Here's some debugging info:\n";
    print_r($_FILES);
}
print "</PRE>";
///



//
?>
