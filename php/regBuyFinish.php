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
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>

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
    <br>
    <br>
    <br>


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

    <div style="margin:100px 100px 10px;">

        <?php
        error_reporting(0);
        session_start();
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }


        include("connection.php");
        $price_ticket = $_SESSION['Price'];
        if ($_POST && isset($_POST['ccn'])) {

            $ccn = mysqli_query($connection, "SELECT Balance FROM Bank WHERE CreditCardNumber='" . $_POST['ccn'] . "'");
            if ($ccn) {
                while ($row2 = mysqli_fetch_array($ccn)) {
                    $balance = $row2['Balance'];
                    if ($row2['Balance'] < $price_ticket) {
                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'view_trip_RegUser.php\', \'windowname1\'); windowname.focus();void(0) ">Your balance at the bank is not enough, please try again!</a>';
                    }
                }
            } else {

                echo '<a class="goBackButton" href="javascript:windowname=window.open(\'regViewTrip.php\', \'windowname1\'); windowname.focus();void(0) ">Wrong credit card number!</a>';
            }
            $seatNum = $_SESSION["Seat"];
            $gender = $_SESSION["Gender"];
            $email = $_SESSION['buyerMail'];
            $name = $_SESSION['name'];
            $surname = $_SESSION['surname'];
            $tripID = $_SESSION["tripID"];
            $ccn = $_POST['ccn'];

            $query3 = mysqli_query($connection, "SELECT emaill FROM users WHERE emaill='" . $_SESSION['email'] . "'");
            if ($query3) {
                while ($row = mysqli_fetch_array($query3)) {
                    $uid = $row['emaill'];
                }
            }
        }


        if ($_POST) {
            $dateQuery = mysqli_query($connection, "SELECT * FROM Trip WHERE TripID = '$tripID'");
            if ($dateQuery) {
                while ($row = mysqli_fetch_array($dateQuery)) {
                    $alreadyReservedQuery = mysqli_query($connection, "SELECT * FROM Reservation WHERE TripID = '$tripID' && SeatID = '$seatNum' && isCancelled=0");
                    $alreadyBoughtQuery = mysqli_query($connection, "SELECT * FROM Ticket WHERE TripID = '$tripID' && SeatID = '$seatNum' && isCancelled=0");
                    if (($alreadyReservedQuery && (mysqli_num_rows($alreadyReservedQuery) == 0)) && ($alreadyBoughtQuery && (mysqli_num_rows($alreadyBoughtQuery) == 0))) {
                        $price = $price_ticket;
                        if ($price) {
                            $add = mysqli_query($connection, "INSERT INTO ticket SET TripID = '$tripID',name = '$name',surname = '$surname', emaillOwner= '$email', emaillUser= '$uid', SeatID = '$seatNum', gender = '$gender'");
                            if ($add) {
                                $balance = $balance - $price;
                                $set_balance = mysqli_query($connection, "UPDATE bank SET Balance='$balance' WHERE CreditCardNumber='" . $_POST['ccn'] . "'");
                                $query = mysqli_query($connection, "SELECT * FROM Trip WHERE TripID = '$tripID'");
                                if ($query) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        echo '<span>
								<label style="border-style:solid;border-width:1px;">Ticket Detail:</label>
								<span style="border-style:solid;border-width:1px;padding:5px;">
								<label style="border-style:solid;border-width:1px;margin:10px;">' . $row['TripTime'] . '</label>
								<label style="border-style:solid;border-width:1px;margin:10px;">' . $row['StartLocation'] . '</label>
                                                                <label style="border-style:solid;border-width:1px;margin:10px;">' . $row['EndLocation'] . '</label>
								<label style="border-style:solid;border-width:1px;margin:10px;">' . $price_ticket . '</label>
								<label style="border-style:solid;border-width:1px;margin:10px;">' . $row['TripDate'] . '</label>
								</span>
								</span>';
                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'viatorem_reg.php\', \'windowname1\'); windowname.focus();void(0) ">Ticket was purchased successfully!</a>';
                                    }
                                } else {
                                    echo "Couldn't issue database query";
                                    echo mysqli_error($connection);
                                }
                            } else {
                                echo '<a class="goBackButton" href="javascript:windowname=window.open(\'viatorem_reg.php\', \'windowname1\'); windowname.focus();void(0) ">Ticket was not purchased!Please check it from myticket detail page.</a>';
                            }
                        } else {
                            //echo "price olmadı";
                        }
                    } else {
                        echo '<a class="goBackButton" href="regViewTrip.php ">Someone bought or reserved this seat before you!</a>';
                    }
                }
            }
        }

        mysqli_close($connection);
        ?>
    </div>
<button class="goBackButton" onclick="goBack()">Go Back</button>
</body>

</html>