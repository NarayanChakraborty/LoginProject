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
if(isset($_POST['update'])){
   
    try{
       if(empty($_POST['old_password']))
	  {
	     $error_msg='Old Password can not be empty'.'<br>';
	  }
	   if(empty($_POST['new_password']))
	  {
	     $error_msg .='New password can not be empty'.'<br>';
	  }
	   if(empty($_POST['confirm_password']))
	  {
	     $error_msg .='Confirm Password can not be empty'.'<br>';
	  }
	  $old_password=$_POST['old_password'];
	  $old_password=md5($old_password);
	  $num=0;
	  
	  //$result=mysql_query("select * from admin where password='$old_password'");
       $statement=$db->prepare("select * from admin where password=?");
	   $statement->execute(array($old_password));
	  $num=$statement->rowCount();
	  if($num==0)
	  {
	    throw new Exception('Old Password Doesnot match');
	  }
	  if($_POST['new_password']!=$_POST['confirm_password'])
	  {
	    throw new Exception('New Password and Confirm Password does not match');
	  }
	  $new_password=$_POST['new_password'];
	  $new_password=md5($new_password);
	  //$check=mysql_query("update admin set password='$new_password' where id=1");
	  /*$result=mysql_query("insert into student (std_name,std_roll,std_age,std_email) values('$_POST[name]',
	  '$_POST[roll]','$_POST[age]','$_POST[email]')");
	  */
	  $statement=$db->prepare("update admin set password=? where id=1");
	  $statement->execute(array($new_password));
	  $success_msg='Data has been successfully inserted';
	}
	catch(Exception $e){
	$error_msg=$e->getMessage();
	}
}    	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Change Password</title>
</head>
<body>
<h2>Change Password</h2>

<?php 
if(isset($error_msg))
{
echo $error_msg;
}
if(isset($success_msg))
{
echo $success_msg;
}
?>
<form action="" method="POST">
<table>
       <tr>
	         <td>Old Password:</td>
			 <td><input type="text" name="old_password"></td>
	    </tr>
		<tr>
	         <td>New Password:</td>
			 <td><input type="text" name="new_password"></td>
	    </tr>
		<tr>
	         <td>Confirm Password:</td>
			 <td><input type="text" name="confirm_password"></td>
	    </tr>
        <tr>
	         <td></td>
			 <td><input type="submit" name="update" value="Update"></td>
	    </tr>		
</table>
</form>
<a href="index.php">Back to Previous</a>
</body>
</html>