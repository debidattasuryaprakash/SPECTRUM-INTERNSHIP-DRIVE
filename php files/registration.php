<?php  if($_SERVER["REQUEST_METHOD"] == "POST") {

session_start();

//initializing data

$username = "";
$email = "";

$errors = array();

//connect to db

$db =mysqli_connect('localhost','root','','spectrum') or die("Could not connect MY LORD!");

//register spectrums

$username = mysqli_real_escape_string($db, $_POST['username']);
$email = mysqli_real_escape_string($db, $_POST['email']);
$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);


//form validation

if(empty($username)) {array_push($errors, "username is required");}
if(empty($email)) {array_push($errors, "Email is required");}
if(empty($password_1)){array_push($errors, "Password is required");}
if($password_1!=$password_2){array_push($errors, "Passwords do not match");}


//check db for existing spectrum with same spectrum name 

$spectrum_check_query = "SELECT * FROM spectrum WHERE username ='$username' or email = '$email' LIMIT 1";

$results = mysqli_query($db, $spectrum_check_query);
$spectrum = mysqli_stmt_bind_result($result);

if($spectrum)
{
    if($spectrum['username']=== $username){array_push($errors, "username already exists");}
    if($spectrum['email']=== $username){array_push($errors, "This email ID already exists");}

}

//Registor the spectrum if no error

if(count($errors) == 0){

    $password = md5($password_1); //this will encrypt password
    $query = "INSERT INTO spectrum(username, email, pasword) VALUES('$username', '$email', '$password')";

    mysqli_query($db, $query);
    $_SESSION['username']=$username;
    $_SESSION['success']="You are now logged in";

    header('location: index.php');

}


}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration</title>
</head>
<body>
	<div class="container">
		<div class="header">
			<h2>Register</h2>
		</div>



		<form action="registration.php" method="post">

			<?php include('errors.php') ?>

			<div>
				<label for="username">Username :</label>
				<input type="text" name="username" required>
			</div>


			<div>
				<label for="email">Email :</label>
				<input type="email" name="email" required>
			</div>


			<div>
				<label for="password">Password :</label>
				<input type="password" name="password_1" required>
			</div>



			<div>
				<label for="password">Confirm Password :</label>
				<input type="password" name="password_2" required>
			</div>


			<button type="submit" name="reg_user">SUBMIT</button>

			<p>Already a User?<a href="login.php"><b>Login</b></a></p>




		</form>



	</div>
</body>
</html>