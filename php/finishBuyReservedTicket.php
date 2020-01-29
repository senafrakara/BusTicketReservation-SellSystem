<?php 
session_start();

// make sure user is logged in
if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in.";
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
    <br>
    <br>
    <br>
<ul>
  <li><a class="active" href="FeedbackRegUser.php">FeedBack</a></li>
  <li><a href="Base_contactUs.php">Contact With Officer</a></li>
  <li><a href="HelpRegUser.php">Help</a></li>
  <li><a href="CampaignsReg.php">Campaigns</a></li>
  <li><a href="viewTicketDetail_Registered.php">My Ticket History</a></li>
  <li><a href="regViewTrip.php">View Trip</a></li>
  <li style="float:left"><a href="viatorem_reg.php">VIATOREM</a></li>
</ul>

<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"><?php 
	  error_reporting(0);
	  session_start();


	  include('connection.php');


	  if($connection -> connect_error){
		die("Connection failed: " .$connection -> connect_error);
	  }
		$user_email =$_SESSION["email"];
	  $user =mysqli_query($connection,"SELECT * FROM users WHERE emaill= '$user_email'") ;
	if($user){
		while($row2 =mysqli_fetch_array($user)){
			$name = $row2['name'];
			echo $name;
		}
	}
	
	  ?></button>
  <div id="myDropdown" class="dropdown-content">
    <a href="EditProfile.php">Edit Profile</a>
    <a href="viewMyAllTickets_Registered.php">View My All Ticket</a>
    <a href="Base_messageBox.php">Message Box</a>
    <a href="logout.php">Logout</a>
  </div>
</div>

<br>
<br>
<br>
<br>
<br>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<?php
error_reporting(0);
session_start();

include("connection.php");
$price_ticket = $_SESSION['Price'];
if($_POST && isset($_POST['ccn'])){
	$ccn = mysqli_query($connection, "SELECT Balance FROM Bank WHERE CreditCardNumber='".$_POST['ccn']."'");
	if($ccn){
		while($row2 = mysqli_fetch_array($ccn)){
			$balance = $row2['Balance'] ;
			if($row2['Balance'] < $price_ticket ){
				echo '<a href="javascript:windowname=window.open(\'view_trip_RegUser.php\', \'windowname1\'); windowname.focus();void(0) ">Your balance at the bank is not enpugh, please try again!</a>';
			}
		}
	} else {
            echo '<a href="javascript:windowname=window.open(\'regViewTrip.php\', \'windowname1\'); windowname.focus();void(0) ">Wrong credit card number!</a>';
        }
/*	$seatNum = $_SESSION["Seat"];
	$gender = $_SESSION["Gender"];
	$email = $_SESSION['emailForBuy'];
	$name = $_SESSION['name'];
	$surname = $_SESSION['surname'];
	$tripID = $_SESSION["tripID"]; */
	$ccn = $_POST['ccn'];
    $pnr =$_SESSION['pnr'];
	
	$query3 = mysqli_query($connection,"SELECT emaill FROM users WHERE emaill='".$_SESSION['email']."'");
	if($query3){
	while($row = mysqli_fetch_array($query3)){
	$abc = $row['emaill'];
	}
}
}
	
if($_POST){
	$ticket = mysqli_query($connection, "SELECT * FROM Reservation WHERE ReservationID='$pnr'");
	if($ticket){
		while($row_reserve = mysqli_fetch_array($ticket)){
			$is_Cancelled = $row_reserve['isCancelled'];
			
			if($is_Cancelled  == 0){
			$tripID = $row_reserve['TripID'];
			$name_buyer = $row_reserve['Name'];
			$surname_buyer = $row_reserve['Surname'];
			$email = $row_reserve['emaillOwner'];
			$seatNum = $row_reserve['SeatID'];
			$gender = $row_reserve['gender'];
				
			}
			
		}
		
	}
	
		$dateQuery = mysqli_query($connection,"SELECT * FROM Trip WHERE TripID = '$tripID'");
		if($dateQuery){
			while($row = mysqli_fetch_array($dateQuery)){
				   $price = $price_ticket;
				
					$ekle = mysqli_query($connection,"INSERT INTO ticket SET TripID = '$tripID',name = '$name_buyer',surname = '$surname_buyer', emaillUser= '$abc', emaillOwner = '$email', SeatID = '$seatNum', gender = '$gender'");
					if($ekle){
						$balance = $balance - $price ;
						$set_balance = mysqli_query($connection, "UPDATE bank SET Balance='$balance' WHERE CreditCardNumber='".$_POST['ccn']."'");
						
						$delete_reservation = mysqli_query($connection, "DELETE FROM Reservation WHERE ReservationID='$pnr'");
						if($delete_reservation){
							$query = mysqli_query($connection,"SELECT * FROM Trip WHERE TripID = '$tripID'");
							if($query){
							while($row = mysqli_fetch_array($query)){
								echo '<span>
								<label style="border-style:solid;border-width:1px;">Ticket Detail:</label>
								<span style="border-style:solid;border-width:1px;padding:5px;">
								<label style="border-style:solid;border-width:1px;margin:10px;">'.$row['TripTime'].'</label>
								<label style="border-style:solid;border-width:1px;margin:10px;">'.$row['StartLocation'].'</label>
                                                                <label style="border-style:solid;border-width:1px;margin:10px;">'.$row['EndLocation'].'</label>
								<label style="border-style:solid;border-width:1px;margin:10px;">'.$price_ticket.'</label>
								<label style="border-style:solid;border-width:1px;margin:10px;">'.$row['TripDate'].'</label>
								</span>
								</span>';
								echo '<a href="javascript:windowname=window.open(\'viatorem_reg.php\', \'windowname1\'); windowname.focus();void(0) ">Ticket was purchased successfully!</a>';
							}
						}else {	
							echo "Couldn't issue database query";
							echo mysqli_error($connection);
						}
						}  else{
							echo '<a href="javascript:windowname=window.open(\'viatorem_reg.php\', \'windowname1\'); windowname.focus();void(0) ">Ticket could not purchased!</a>';
						}
						
						
					}else{
						echo '<a href="javascript:windowname=window.open(\'viatorem_reg.php\', \'windowname1\'); windowname.focus();void(0) ">Ticket could not purchased! Please check it</a>';
					}
				
			}
		}
	
}

mysqli_close($dbc);
?>
<button class="goBackButton" onclick="goBack()">Go Back</button>
</body>
</html>
