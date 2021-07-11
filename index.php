<?php 

session_start();

if(isset($_SESSION['username'])){

	$_SESSION['msg'] = "You must log in first to viw this page";
	header("location: login.php");

}

if(isset($_GET['logout'])){

	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");

}




 ?>
 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dashboard</title>
</head>
<body>

	<h1>THIS IS THE HOMEPAGE</h1>
	<?php 
	if(isset($_SESSION['success'])) : ?>
		<div>
			<h3>
				<?php 
				echo $_SESSION['success'];
				unset($_SESSION['success']);

				 ?>
			</h3>
		</div>
	<?php  endif  ?>


<?php  if(isset($_SESSION['success'])): ?>

	<h3>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h3>

	<button><a href="index.php?logout='1'"></a></button>

<?php endif ?>


</body>
</html>