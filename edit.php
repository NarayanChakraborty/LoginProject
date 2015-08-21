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
}
else
{
    header('location: view.php');
}

if(isset($_POST['form1'])){
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
	 // $result=mysql_query("update student set std_name='$_POST[name]',
	  //std_roll='$_POST[roll]',std_age='$_POST[age]',std_email='$_POST[email]' 
	  //where std_id='$id'");
	  $statement=$db->prepare("update student set std_name=?,
	  std_roll=?,std_age=?,std_email=? 
	  where std_id=?");
	  $statement->execute(array($_POST['name'],$_POST['roll'],$_POST['age'],$_POST['email'],$id));
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
	<title>Data Edit Page</title>
</head>
<body>
<h2>Edit Data</h2>

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
<?php
//$result=mysql_query("Select * from student where std_id='$id'");
$statement=$db->prepare("Select * from student where std_id=?");
$statement->execute(array($id));

$result=$statement->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row)
{
     $old_std_name=$row['std_name'];
	 $old_std_roll=$row['std_roll'];
	 $old_std_age=$row['std_age'];
	 $old_std_email=$row['std_email'];
}
?>
<form action="" method="POST">
<table>
       <tr>
	         <td>Name:</td>
			 <td><input type="text" name="name"value="<?php echo $old_std_name;?>"></td>
	    </tr>
		<tr>
	         <td>Roll:</td>
			 <td><input type="text" name="roll"value="<?php echo $old_std_roll;?>"></td>
	    </tr>
		<tr>
	         <td>Age:</td>
			 <td><input type="text" name="age"value="<?php echo $old_std_age;?>"></td>
	    </tr>
		       <tr>
	         <td>Email</td>
			 <td><input type="text" name="email"value="<?php echo $old_std_email;?>"></td>
	    </tr>
        <tr>
	         <td></td>
			 <td><input type="submit"value="Update" name="form1" ></td>
	    </tr>		
</table>
<input type="hidden" name="id" value="<?php echo $id;?>">
</form>
<a href="index.php">Back to Previous</a>
</body>
</html>