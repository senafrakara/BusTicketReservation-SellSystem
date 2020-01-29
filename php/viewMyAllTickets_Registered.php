<?php
session_start();
?>
<!doctype html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>
        <meta charset="utf-8">
        <title>My Ticket History</title>
    </head>
    <br><br><br><br>
    <body>
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
    <h1>My Ticket History:</h1>
    <br>
    <div style="background-color:white;color:black;margin:10px;padding:2px;border-radius:8px;font-size:12px;border:2px solid black;">
        <h2 style="color:#330066; ">Ticket History shows <u>all tickets you have ever purchased</u><br>
            If you want to see your current tickets, see the View Ticket Detail page.</h2></div>


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

            $query = mysqli_query($connection, "SELECT * FROM ticket WHERE emaillUser='$userID' && isCancelled='0'");

            if ($query) {
                while ($row = mysqli_fetch_array($query)) {
                    $trip_id = $row['TripID'];
                    $trip = mysqli_query($connection, "SELECT * FROM Trip WHERE TripID='$trip_id'");
                    if ($trip) {
                        while ($row2 = mysqli_fetch_array($trip)) {

                            echo '<div style="background-color:white;color:black;margin:10px;padding:10px;border-radius:5px;font-size:15px;border:2px solid black;">PNR:' . $row['PNR'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: ' . $row2['TripDate'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Time: ' . $row2['TripTime'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; From: ' . $row2['StartLocation'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: ' . $row2['EndLocation'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Price: ' . $row2['Price'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Seat Number: ' . $row['SeatID'] . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SOLD</div>';
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