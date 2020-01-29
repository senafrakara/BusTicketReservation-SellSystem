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
<br>

<button class="goBackButton" onclick="goBack()">Go Back</button>



</body>
</html>
