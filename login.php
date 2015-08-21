<?php 
include('config.php');
if(isset($_POST['login']))
{
    try{
	   if(empty($_POST['password']))
	   {
	    throw new Exception('Password can not be empty');
	   }
	   if(empty($_POST['username']))
	   {
	    throw new Exception('Username can not be empty');
	   }
	   $num=0;
	   $password=$_POST['password'];
	   $password=md5($password);
	  
	  $statement=$db->prepare("select * from admin where username=? and password=?");
	  $statement->execute(array($_POST['username'],$password));
	  $num=$statement->rowCount();

	  if($num>0)
	  {
	     session_start();
		 
		 $_SESSION['name']="snchousebd";
		 header('location: index.php');
	  }
	  else
	  {
	   throw new Exception('Invalid Username and/or password');
	   }
	}
	catch(Exception $e)
	{
	$error_msg=$e->getMessage();
	}
}
?>

<!doctype html>
<html lang="en">
<head>
     <meta charset="UTF-8">
	 <title>login-simple Blog with PHP</title>
	 <link rel="stylesheet" href="../styleadmin.css">
</head>
<body>
<div id="wrapper-login">
        <h1>Admin Login</h1>
		<?php
		if(isset($error_msg))
		{
		  echo $error_msg;
		}
		?>
      <form action="" method="post">
       <table>
            <tr>
                 <td>User name:</td>
                 <td><input type="text" name="username"></td>
            </tr>
            <tr>
                  <td>Password:</td>
                   <td><input type="password" name="password"></td>
             </tr>
			 <tr>
                  <td></td>
                   <td><input type="submit" value="Login" name="login"></td>
             </tr>
        </table>
      </form>
	  </div>
</body>
</html>	  