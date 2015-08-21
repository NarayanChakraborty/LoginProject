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
if(isset($_POST['send'])){
    	try{
       if(empty($_POST['name']))
	  {
	     throw new Exception('Name can not be empty');
	  }
	   if(empty($_POST['roll']))
	  {
	     throw new Exception('Roll can not be empty');
	  }
	   if(empty($_POST['age']))
	  {
	     throw new Exception('Age can not be empty');
	  }
	   if(empty($_POST['email']))
	  {
	     throw new Exception('email can not be empty');
	  }
	 // $result=mysql_query("insert into student (std_name,std_roll,std_age,std_email) values('$_POST[name]',
	  //'$_POST[roll]','$_POST[age]','$_POST[email]')");
	  $statement=$db->prepare("insert into student (std_name,std_roll,std_age,std_email) values(?,?,?,?)");
	  $statement->execute(array($_POST['name'],$_POST['roll'],$_POST['age'],$_POST['email']));
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
	<title>Data Insert Page</title>
</head>
<body>
<h2>Inser Data</h2>

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
	         <td>Name:</td>
			 <td><input type="text" name="name"></td>
	    </tr>
		<tr>
	         <td>Roll:</td>
			 <td><input type="text" name="roll"></td>
	    </tr>
		<tr>
	         <td>Age:</td>
			 <td><input type="text" name="age"></td>
	    </tr>
		       <tr>
	         <td>Email</td>
			 <td><input type="text" name="email"></td>
	    </tr>
        <tr>
	         <td></td>
			 <td><input type="submit" name="send" value="GO"></td>
	    </tr>		
</table>
</form>
<a href="index.php">Back to Previous</a>
</body>
</html>