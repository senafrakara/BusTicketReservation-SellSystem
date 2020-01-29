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
        <h1>Campaigns</h1>
    <div style="margin:50px 150px 50px;">
        <?php
        include("connection.php");
        $query = mysqli_query($connection, "SELECT CampaignID FROM Trip");
        if ($query) {
            while ($row = mysqli_fetch_array($query)) {
                $campaign = $row['CampaignID'];
            }
        }
        $query2 = mysqli_query($connection, "SELECT * FROM Campaign WHERE CampaignID = $campaign");
        if ($query2) {
            while ($row = mysqli_fetch_array($query2)) {
                echo '<p  style="background-color:white;color:black;margin:2px;padding:10px;border-radius:5px;font-size:18px;border:2px solid black;">Campaign Description: <br>' . $row['Content'] . '</p>';
            }
        }

        mysqli_close($connection);
        ?>
        <button class="goBackButton" onclick="goBack()">Go Back</button>

        <p>You need to <a href="loginpage.php" target="_top">Sign in</a> in order to take advantage of the campaigns!</p>
    </div>

</body>
</html>