<?php
ob_start();
session_start();
if($_SESSION['name']!='snchousebd')
{
header('location: login.php');
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to php-mysql database</title>
</head>
<body>
<h2>Select Your Option</h2>
	<ul>
	    <li><a href="insert.php">Insert Data</a></li>
	    <li><a href="view.php">Show Data</a></li>
		<li><a href="changepassword.php">Change Password</a></li>
		<li><a href="logout.php">Log Out</a></li>
	</ul>
</body>
</html>
