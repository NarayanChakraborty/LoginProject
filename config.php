<?php
$dbhost='localhost';
$dbname='snchousebd';
$dbuser='root';
$dbpass='';
try{
$db=new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
 echo "Connection Error:".$e->getMessage();
}

//mysql_connect('localhost','root','') or die('Cannot Connect to The Server');
//mysql_select_db('snchousebd') or die('cannot select database');
?>