<?php
session_start();
include('connection.php');
if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in";
    include("loginpage.php");
    exit();
}

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>
        <h2 style="color:blue;text-align:center;">Admin Homepage</center></h2>

    </head>
    <body>
        <br><br><br><br><br>

        </div>
        <ul>


            <li><a href="logout.php">Log Out</a></li>
            <li><a href="adminFeedback.php">FeedBack Management</a></li>
            <li><a href="view_trip_Admin.php">View Trip</a></li>
            <li><a href="admincancelticket.php">Cancel Ticket</a></li>
            <li><a href="addcampaign.php">Add/Remove Campaign</a></li>
            <li><a href="canceltrip.php">Cancel Trip</a></li>
            <li><a href="addtrip.php">Add Trip</a></li>

        </ul>



    </body>
</html>


