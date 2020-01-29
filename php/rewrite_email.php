<?php session_start();  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	
	<link rel="stylesheet" type="text/css" href="viatorem.css">
            <script src="viatorem.js"></script>
</head>

<body>
	<form id="form1" name="form1" action="" method="post">
		<center><h2>Reset password</h2></center>
		<center>
		<table>
			<tr>
				<td>Your email address</td>
				<td><input type="email" id="email" name="email" required></td>
			</tr>
		
			
		<br>
	
		</table>
		

		</center>
		
		<button type="submit" id="submit" name="password_reset" >Reset Password</button>

	
	</form>

	
</body>
<button class="goBackButton" onclick="goBack()">Go Back</button>
</html>
<?php 
error_reporting(0);
session_start();


include('connection.php');


if($connection -> connect_error){
	die("Connection failed: " .$connection -> connect_error);
	
	
}
if($_POST){
	$email = $_POST["email"];
	$_SESSION['email'] = $_POST["email"];
	$sql=mysqli_query($connection,  "SELECT * FROM Users WHERE emaill='$email'" );
	
	
		if($sql){
		while($row = mysqli_fetch_array($sql)){
			$_SESSION["question"]= $row=["Question"];

		/*	if($_SESSION["question"]== "question1"){
				print "<h2>Your Security Question is : 'Your favorite fruit '</h2>";
				header("Location: enter_email.php");
			} else if($_SESSION["question"] == "question2"){
				print "<h2>Your Security Question is : 'Name of your favorite teacher in high school'</h2>";
				header("Location: enter_email.php");
			} else if( $_SESSION["question"]== "question3"){
				print "<h2>Your Security Question is : 'Second letter of your mother's maiden name'</h2>";
				header("Location: enter_email.php");
			} else if($_SESSION["question"] == "question4"){
				print "<h2>Your Security Question is : 'Your favorite vegatables'</h2>";
				header("Location: enter_email.php");
			} else if($_SESSION["question"]== "question5"){
				print "<h2>Your Security Question is : 'Your favorite color'</h2>";
				header("Location: enter_email.php");
			} else {
				print "Something go wrong";
				
			}  */
            header("Location: enter_email.php");
		    			
		}
	}
	
}
	
	
	
	
	?>
