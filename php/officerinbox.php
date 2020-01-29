<?php 
session_start();
if(!isset($_SESSION['email'])) {
	$loginError="You are not logged in";
	include("loginpage.php");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="viatorem.css">
    <script src="viatorem.js"></script>

</head>
<body>

<h2 style="color:black;text-align:center;">Officer Homepage</h2> <br><br>
<div class="preference">
    
    <br><br><br>
    
</div>
<br>
<br>
<br>
<ul  style="width:10%; float:left;" >
  <li><a href="officerinbox.php">InBox</a></li>
  <li><a href="officersendbox.php">SendBox</a></li>
  <li><a href="officersendmessage.php">Send Message</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<br><br><br><br><br><br>

<?php
error_reporting(0);
session_start();


include('connection.php');


if($connection -> connect_error){
	die("Connection failed: " .$connection -> connect_error);
}
	$user_email =$_SESSION["email"];

$user =mysqli_query($connection,"SELECT * FROM Users WHERE emaill='$user_email'") ;

if($user){
	
	while($row2 =mysqli_fetch_array($user)){
		$userID = $row2["UserID"];
		
		$query= mysqli_query($connection, "SELECT * FROM message WHERE ToID=".$userID);
		if($query){
			while($row= mysqli_fetch_array($query)){
				echo '<div style="background-color:white;color:black;margin:10px;padding:10px;border-radius:5px;font-size:20px;border:2px solid black;">To:Officer <br> Message: '.$row['Content'].'<br> From: '.$row['FromID'].' <br></div>';
			}
		}
	}
}


?>


<button class="goBackButton" onclick="goBack()">Go Back</button>


</body>
</html>
