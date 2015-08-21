<?php
ob_start();
session_start();
if($_SESSION['name']!='snchousebd')
{
header('location: login.php');
}
?>
<?php
include('config.php');
if(isset($_REQUEST['id']))
{
      $id=$_REQUEST['id'];
	  //$result=mysql_query("delete from student where std_id='$id'");
	  $statement=$db->prepare("delete from student where std_id=?");
	  $statement->execute(array($id));
	   header('location: view.php');
}
else
{
    header('location: view.php');
}
?>