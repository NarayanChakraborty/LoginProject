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
  	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Data View Page</title>
	<script>
	  function confirm_delete(){
	  return confirm('Are you sure want to delete');
	}
	</script>
</head>
<body>
<h2>View All Data From Database</h2>

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
<table  border="2" cellspacing="2" cellpadding="5" >
	<tr>
		<th>Serial No</th>
		<th>Student Name</th>
		<th>Student Roll</th>
		<th>Student Age</th>
		<th>Student Email</th>
		<th>Action</th>
	</tr>
	<?php
    $i=0;
	//$result=mysql_query("select * from student");
	$statement=$db->prepare("select * from student");
	$statement->execute();
	$result=$statement->fetchAll(PDO::FETCH_ASSOC);
	foreach($result as $row)
	{
          $i++;
     	?>
	 <tr>
		<td><?php echo $i;?></td>
		<td><?php echo $row['std_name'];?></td>
		<td><?php echo $row['std_roll'];?></td>
		<td><?php echo $row['std_age'];?></td>
		<td><?php echo $row['std_email'];?></td>
		<td><a href="edit.php?id=<?php echo $row['std_id'];?>">Edit</a> &nbsp;|&nbsp;<a onclick="return confirm_delete();" href="delete.php?id=<?php echo $row['std_id'];?>">Delete</a></td> 
	</tr>
    <?php
	}
	?>
</table>
<a href="index.php">Back to Previous</a>
</body>
</html>