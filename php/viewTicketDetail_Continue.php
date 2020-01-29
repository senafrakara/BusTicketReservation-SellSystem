<?php
session_start();
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
        <h2>Your Ticket(s)</h2>

        <?php
        error_reporting(0);
        session_start();


        include('connection.php');


        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }




        if ($_POST) {
            $pnr = $_POST['pnr'];
        }

        $query = mysqli_query($connection, "SELECT * FROM ticket WHERE PNR=" . $pnr);

        if ($query) {
            while ($row = mysqli_fetch_array($query)) {
                $trip_id = $row['TripID'];
                $trip = mysqli_query($connection, "SELECT * FROM Trip WHERE TripID='$trip_id'");
                if ($trip) {
                    while ($row2 = mysqli_fetch_array($trip)) {
                        $date = date('Y-m-d');
                        $date_trip = $row2['TripDate'];
                        $date = strtotime($date);
                        $date_trip = strtotime($date_trip);
                        $fark = ($date_trip - $date);
                        $fark = $fark / (60 * 60 * 24);

                        if ($fark > 0) {
                            echo '<div style="background-color:white;color:black;margin:10px;padding:10px;border-radius:5px;font-size:15px;border:2px solid black;">PNR:' . $row['PNR'] . ' <br> Date: ' . $row2['TripDate'] . '<br> Time: ' . $row2['TripTime'] . ' <br> From: ' . $row2['StartLocation'] . ' <br> To: ' . $row2['EndLocation'] . ' <br> Price: ' . $row2['Price'] . ' <br> Seat Number: ' . $row['SeatID'] . ' </div>';
                        } else {
                            
                        }
                    }
                }
            }
        }
        ?>
        <button class="goBackButton" onclick="goBack()">Go Back</button>
    </body>
</html>