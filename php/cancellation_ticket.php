<?php
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
        <meta charset="utf-8">
    <title>Cancel Ticket</title>
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>
    </head>
    <br><br><br>
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
    <br>
    <br>
    <center>
        <form id="form1" name="cancel_ticket" action="" method="post">
            <table>
                <tbody>
                    <tr>
                        <td>PNR Number:</td>
                        <td ><input type="text" name="pnr" id="pnr" placeholder="Enter your PNR number of ticket" required ></td>

                    </tr>
                    <tr>
                        <td>Credit Card Number:</td>
                        <td ><input type="text" name="ccn" id="ccn" placeholder="Enter your Credit Card Number" required ></td>

                        </tr>	
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="cancellation_ticket" id="submit" value="Cancel Ticket"></td>
                            </tr>


                            </table>

                            </form>
                            </center>


                            <?php
                            error_reporting(0);
                            session_start();


                            include('connection.php');


                            if ($connection->connect_error) {
                                die("Connection failed: " . $connection->connect_error);
                            }


                            if ($_POST) {
                                $pnr = $_POST['pnr'];
                                $ccn = $_POST['ccn'];
                                $user_email = $_SESSION["email"];

                                $query = mysqli_query($connection, "SELECT * FROM ticket WHERE PNR= '$pnr' && isCancelled='0' && emaillUser='$user_email'");
                                if ($query) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        $trip_id = $row['TripID'];

                                        $cancel_ticket = mysqli_query($connection, "UPDATE ticket 
					               SET isCancelled='1' WHERE PNR = '$pnr'");

                                        $trip_id = mysqli_query($connection, "SELECT Price FROM Trip WHERE TripID='$trip_id'");
                                        if ($trip_id) {
                                            while ($row2 = mysqli_fetch_array($trip_id)) {
                                                $price = $row2['Price'];
                                            }

                                            $query2 = mysqli_query($connection, "SELECT Balance FROM Bank WHERE CreditCardNumber='$ccn'");
                                            if ($query2) {
                                                while ($row3 = mysqli_fetch_array($query2)) {
                                                    $balance = $row3['Balance'];
                                                }

                                                if ($cancel_ticket) {
                                                    $balance = $balance + $price;
                                                    $set_balance = mysqli_query($connection, "UPDATE bank SET Balance='$balance' WHERE CreditCardNumber='$ccn'");
                                                    if ($set_balance) {
                                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'viewTicketDetail_Registered.php\', \'windowname1\'); windowname.focus();void(0) ">Your ticket successfully cancelled!</a>';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    echo '<a class="goBackButton" href="javascript:windowname=window.open(\'viewTicketDetail_Registered.php\', \'windowname1\'); windowname.focus();void(0) ">Wrong PNR number or Credit Card Number!</a>';
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