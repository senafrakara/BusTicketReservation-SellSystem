<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>
        <h2 style="color:black;text-align:center;">Feedback Reject</center></h2>

    </head>
    <body>
        <br><br><br><br>

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


        <button class="goBackButton" onclick="goBack()">Go Back</button>
    </body>
</html>
<?php
session_start();
include("connection.php");

if ($_POST) {
    $feedback = $_POST['RejectButton'];
    $query = mysqli_query($connection, "DELETE FROM Feedback WHERE FeedbackID=" . $feedback);
    if ($query) {
        header('location: adminFeedback.php');
    } else {
        echo '<a class="goBackButton" href="adminFeedback.php">There is something wrong, try again</a>';
    }
}
?>
