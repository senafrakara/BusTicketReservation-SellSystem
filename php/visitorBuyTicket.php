
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

    <div style="margin:100px 80px 10px;">

        <?php
        error_reporting(0);
        session_start();

        include('connection.php');

        if ($_POST) {
            $_SESSION["tripID"] = $_POST['buyButton'];
            $query = $connection->query("SELECT * FROM Trip WHERE TripID=" . $_SESSION['tripID']);
            if ($query) {
                while ($row = mysqli_fetch_array($query)) {
                    $capacity = $row['Capacity'];
                    echo '<form action="visitorBuyTicketContinue.php" method="POST">';
                    for ($i = 1; $i <= $capacity; $i++) {
                        $query2 = $connection->query("SELECT * FROM reservation WHERE TripID=" . $_SESSION['tripID'] . " && SeatID=$i");
                        $query3 = $connection->query("SELECT * FROM ticket WHERE TripID=" . $_SESSION['tripID'] . " && SeatID=$i && isCancelled=0");
                        if (($query2 && ($query2->num_rows > 0)) || ($query3 && ($query3->num_rows > 0))) {
                            echo '<input type="radio" value="' . $i . '" name="Seat" disabled="disabled"><label style="margin: 0px 25px 0px 0px" for="' . $i . '">' . $i . '</label>';
                        } else {
                            echo '<input type="radio" value="' . $i . '" name="Seat" required><label style="margin: 0px 25px 0px 0px" for="' . $i . '">' . $i . '</label>';
                        }
                    }echo '<br><br><input type="radio" value="M" name="Gender" required>M
		<input type="radio" value="F" name="Gender" required>F
		<br><br><input type="submit" value="Buy"><br></form>';
                }
            }
        } else {
            
        }
        mysqli_close($connection);
        ?>
    </div>
    <button class="goBackButton" onclick="goBack()">Go Back</button>
</body>

</html>