
<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>
        <meta charset="UTF-8">
        <title>Visitor Buy Ticket</title>


    </head>
    <body>
        <br>
        <br>
        <br>



        <ul>
            <li><a class="active" href="FeedbackVisitor.php">FeedBack</a></li>
            <li><a href="contactUs_visitor.php">Contact With Officer</a></li>
            <li><a href="HelpVisitor.php">Help</a></li>
            <li><a href="CampaignsVisitor.php">Campaigns</a></li>
            <li><a href="viewticketDetail_Visitor.php">View Ticket Detail</a></li>
            <li><a href="visitorViewTrip.php">View Trip</a></li>
            <li style="float:left"><a href="viatorem.php">VIATOREM</a></li>
        </ul>
        <ul>
            <li><a class="active" href="registration.php">Registration</a></li>
            <li><a href="loginpage.php">Login</a></li>
        </ul>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    <div style="margin:50px 500px 10px;">

        <?php
        error_reporting(0);
        session_start();

        include("connection.php");


        if ($_POST && isset($_POST['Seat']) && isset($_POST['Gender'])) {
            $_SESSION["Seat"] = $_POST['Seat'];
            $seatNum = $_POST['Seat'];
            $_SESSION["Gender"] = $_POST['Gender'];
            $gender = $_POST['Gender'];
            echo '<form action="visitorPayment.php" method="POST"> 
	Seat Number:' . $seatNum . ' <br> <br> Gender:' . $gender . ' <br> <br>
	<input type="email" name="buyerMail" id="buyerMail" placeholder="Email" required >
	<input type="text" name="name" id="name" placeholder="Name" required>
	<input type="text" name="surname" id="surname" placeholder="Surname" required>

	<input type="submit" name="submit" id="submit" value="Continue">
	</form>';
        }
        mysqli_close($connection);
        ?>
    </div>

<button class="goBackButton" onclick="goBack()">Go Back</button>
</body>
</html>