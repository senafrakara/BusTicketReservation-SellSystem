
<?php
error_reporting(0);
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
     
    <div class="preference">
    
        <br><br><br>

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
    <?php
    include("connection.php");

    $query = mysqli_query($connection, "SELECT * FROM FeedBack WHERE isApproved='0'");

    if ($query) {
        echo "<h2>Feedback waiting for approval:</h2><br>";
        while ($row = mysqli_fetch_array($query)) {
            echo '<div style="background-color:white;color:black;margin:2px;padding:10px;border-radius:5px;font-size:18px;border:2px solid black;""><p>FROM:' .$row['emaill']. ' <br> Comment: ' .$row['Content']. '</p><br>
			<form action="adminApproveFeedback.php" method="POST"><button type="submit" name="ApproveButton" value=' . $row['FeedbackID'] . '>Approve</button></form>
			<form action="adminRejectFeedback.php" method="POST"><button type="submit" name="RejectButton" value=' . $row['FeedbackID'] . '>Reject</button></form></div>';
          /*  $query2 = mysqli_query($connection, "SELECT * FROM users WHERE emaill=".$row['emaill']);
            while ($row2 = mysqli_fetch_array($query2)) {
                echo '<div style="border-style:solid; border-width:1px;"><p>FROM:' .$row2['emaill']. ' <br> Comment: ' . $row['Content'] . '</p><br>
			<form action="adminApproveFeedback.php" method="POST"><button type="submit" name="ApproveButton" value=' . $row['FeedbackID'] . '>Approve</button></form>
			<form action="adminRejectFeedback.php" method="POST"><button type="submit" name="RejectButton" value=' . $row['FeedbackID'] . '>Reject</button></form></div>';
            } */
        }
    } else {
        echo "Couldn't issue database query";
        echo mysqli_error($connection);
    }
    ?>
    <button class="goBackButton" onclick="goBack()">Go Back</button>
</body>
</html>