<?php
session_start();

// make sure user is logged in
if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in.";
    include("loginpage.php");
    exit();
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>
        <title>View Ticket Detail</title>
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
            <li><a href="viewTicketDetail_Registered.php">View Ticket Detail</a></li>
            <li><a href="regViewTrip.php">View Trip</a></li>
            <li style="float:left"><a href="viatorem_reg.php">VIATOREM</a></li>
        </ul>

    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn"><?php
            error_reporting(0);
            session_start();


            include('connection.php');


            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            $user_email = $_SESSION["email"];
            $user = mysqli_query($connection, "SELECT * FROM users WHERE emaill= '$user_email'");
            if ($user) {
                while ($row2 = mysqli_fetch_array($user)) {
                    $name = $row2['name'];
                    echo $name;
                }
            }
            ?></button>
        <div id="myDropdown" class="dropdown-content">
            <a href="EditProfile.php">Edit Profile</a>
            <a href="viewMyAllTickets_Registered.php">My Ticket History</a>
            <a href="Base_messageBox.php">Message Box</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <br>
    <br>
    <input type="button" id="cancelTicket" onClick="location.href = 'cancellation_ticket.php'" value="Cancel Ticket" />
    <h2>SOLD TICKET:</h2>
    <br>


    <?php
    error_reporting(0);
    session_start();


    include('connection.php');


    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $user_email = $_SESSION["email"];

    $pricenew = $_SESSION['Price'];


    $user = mysqli_query($connection, "SELECT * FROM Users WHERE emaill='$user_email'");

    if ($user) {
        while ($row2 = mysqli_fetch_array($user)) {
            $userID = $row2["emaill"];


            $query = mysqli_query($connection, "SELECT * FROM ticket WHERE isCancelled='0' and emaillUser='$userID'");


            if ($query) {


                while ($row = mysqli_fetch_array($query)) {
                    $trip_id = $row['TripID'];

                    $trip = mysqli_query($connection, "SELECT * FROM trip WHERE isCancelled='0' and TripID =" . $trip_id);
                    if ($trip) {

                        while ($row2 = mysqli_fetch_array($trip)) {
                            $date = date('Y-m-d'); //today date
                            $date_trip = $row2['TripDate']; //trip date

                            $date = strtotime($date); //strotime of today
                            $date_trip = strtotime($date_trip); // strtotime of trip date


                            if ($date_trip > $date) {
                                echo '<div style="background-color:white;color:black;margin:10px;padding:10px;border-radius:5px;font-size:15px;border:2px solid black;">PNR:' . $row['PNR'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: ' . $row2['TripDate'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Time: ' . $row2['TripTime'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; From: ' . $row2['StartLocation'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: ' . $row2['EndLocation'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Price: ' . $pricenew . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Seat Number: ' . $row['SeatID'] . ' </div>';
                            } else {
                                
                            }
                        }
                    }
                }
            }
        }
    }
    ?>
    <h2>RESERVED TICKET:</h2>
    <br>
    <input type="button" id="buyReserve" onClick="location.href = 'buyReserveTicket.php'" value="Buy Reserved Ticket" />
    <?php
    error_reporting(0);
    session_start();

    include('connection.php');


    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $user_email = $_SESSION["email"];

    $user = mysqli_query($connection, "SELECT * FROM Users WHERE emaill='$user_email'");

    if ($user) {

        while ($row2 = mysqli_fetch_array($user)) {
            $userID = $row2["emaill"];

            $query = mysqli_query($connection, "SELECT * FROM reservation WHERE emaillUser='$userID'");

            if ($query) {
                while ($row = mysqli_fetch_array($query)) {
                    $trip_id = $row['TripID'];
                    $trip = mysqli_query($connection, "SELECT * FROM Trip WHERE TripID='$trip_id'");
                    if ($trip) {
                        while ($row2 = mysqli_fetch_array($trip)) {
                            echo '<div style="background-color:white;color:black;margin:10px;padding:10px;border-radius:5px;font-size:15px;border:2px solid black;">PNR:' . $row['ReservationID'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: ' . $row2['TripDate'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Time: ' . $row2['TripTime'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; From: ' . $row2['StartLocation'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: ' . $row2['EndLocation'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Price: ' . $row2['Price'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Seat Number: ' . $row['SeatID'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div>';
                        }
                    }
                }
            }
        }
    }
    ?>


    <script>
        /* When the user clicks on the button, 
         toggle between hiding and showing the dropdown content */
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function (event) {
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
    <button class="goBackButton" onclick="goBack()">Go Back</button>
</body>
</html>