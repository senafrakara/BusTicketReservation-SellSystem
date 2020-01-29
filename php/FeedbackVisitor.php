
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


    <div style="margin:50px 150px 50px;">
        <h2 style="border-style:solid; border-width:2px;">You need to be <a href="loginpage.php" target="_top">logged!</a> in for writing FeedBack.</h2>
        <?php
        include("connection.php");
        $query = mysqli_query($connection, "SELECT * FROM FeedBack WHERE isApproved='1'");

        if ($query) {
            while ($row = mysqli_fetch_array($query)) {
               
                    echo '<p style="background-color:white;color:black;margin:2px;padding:10px;border-radius:5px;font-size:18px;border:2px solid black;">FROM:' .$row['emaill']. '<br>Comment:' .$row['Content']. '<br></p>';
                
            }
        } else {
            echo "Connection down";
            echo mysqli_error($connection);
        }

        mysqli_close($connection);
        ?>
        <button class="goBackButton" onclick="goBack()">Go Back</button>
    </div>


</body>
</html>