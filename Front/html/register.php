<?php
	include_once 'registered.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel="stylesheet" href="../styles/styles.css" />
    <script async src="../javascript/main.js"></script>
  </head>
  <body>
  
  <?php 
	if(isset($_POST['Register']))
	{
		$dbserver = "sql.njit.edu"; 
		$user = "jsf25"; $password = "8FJBGgDP";
		$database = "jsf25";
	
		$conn = mysqli_connect($dbserver, $user, $password, $database)
			or die("Could not connect: " . mysql_error());
		mysqli_select_db($conn, $database)
			or die("Could not select database");
		
		$sql = "INSERT INTO USERS (NAME, PASS)
		VALUES (?,?)";

		$stmt = mysqli_prepare($sql);
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		
		$stmt->bind_param("sss", $username, $password);
		$stmt = mysql_query($stmt, $conn);
		
		$stmt->execute();
	}
	?>
	
    <h1>Please Register Below</h1>
    <h4 id='date'></h4> <br />
    <form action="registered.php" method="post" class="register-container">
      <input type="text" placeholder="Username" id="username"><br />
      <input type="password" placeholder="Password" id="password"><br />
      <input type="submit" onclick="registerForm();" value="Register">
    </form>

  </body>
  <footer>
    <p>Credits to: Sammy Faraj, Eddie Tonaco, Junior Figuereo</p>
    <p>Contact information: <a href="mailto:someone@example.com">sf297@njit.edu</a></p>
  </footer>
</html>