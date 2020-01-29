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

    <div style="margin:50px 600px 10px;">
        <?php
        error_reporting(0);
        session_start();

        include("connection.php");


        if ($_POST && isset($_POST['buyerMail']) && isset($_POST['name']) && isset($_POST['surname'])) {


            $_SESSION['buyerMail'] = $_POST['buyerMail'];
            $name = $_POST['name'];
            $_SESSION['name'] = $_POST['name'];
            $surname = $_POST['surname'];
            $_SESSION['surname'] = $_POST['surname'];
            echo '<form action="visitorBuyFinish.php" method="POST"> 
	<input class="required" type="text" name="ccn" id="ccn" placeholder="Credit Card Number" required>
	<input class="required" type="submit" name="submit" id="submit" value="Continue">
	</form>';
        } else {
            
        }
        mysqli_close($connection);
        ?>
    </div>
<button class="goBackButton" onclick="goBack()">Go Back</button>
</body>
</html>