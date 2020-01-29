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


    <?php
    error_reporting(0);
    session_start();
    include("connection.php");
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $price_ticket = $_SESSION['Price'];

    if (isset($_POST['emailForReserve']) && isset($_POST['name']) && isset($_POST['surname'])) {
        $seatNum = $_SESSION["Seat"];
        $gender = $_SESSION["Gender"];
        $emailforReserve = $_POST['emailForReserve'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $tripID = $_SESSION["tripID"];
        $user_email = $_SESSION['email'];
        $query3 = mysqli_query($connection, "SELECT * FROM users WHERE emaill='$user_email'");
        if ($query3) {
            while ($row = mysqli_fetch_array($query3)) {
                $abc = $row['emaill'];
              
            }
        }
    }

    if ($_POST) {
        if (!$seatNum) {
            echo "Select Seat";
            echo $name;
        } else {
            $dateQuery = mysqli_query($connection, "SELECT * FROM Trip WHERE TripID = '$tripID'");
            if ($dateQuery) {
                while ($row = mysqli_fetch_array($dateQuery)) {
                    if (date('Y-m-d', strtoTime(' + 3 days')) < $row['TripDate']) {
                        $alreadyReservedQuery = mysqli_query($connection, "SELECT * FROM Reservation WHERE TripID = '$tripID' && SeatID = '$seatNum' && isCancelled='0'");
                        $alreadyBoughtQuery = mysqli_query($connection, "SELECT * FROM Ticket WHERE TripID = '$tripID' && SeatID = '$seatNum' && isCancelled='0'");
                        if (($alreadyReservedQuery && (mysqli_num_rows($alreadyReservedQuery) == 0)) && ($alreadyBoughtQuery && (mysqli_num_rows($alreadyBoughtQuery) == 0))) {
                            $ekle = mysqli_query($connection, "INSERT INTO reservation SET TripID = '$tripID', emaillUser = '$abc', SeatID = '$seatNum', Name = '$name', Surname = '$surname', emaillOwner='$emailforReserve',  gender = '$gender'");
                            if ($ekle) {
                                $query = mysqli_query($connection, "SELECT * FROM Trip WHERE TripID = '$tripID'");
                                if ($query) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        echo '<span>
									<label style="border-style:solid;border-width:1px;">Reservation Detail:</label>
									<span style="border-style:solid;border-width:1px;padding:5px;">
									<label style="border-style:solid;border-width:1px;margin:10px;">' . $row['TripTime'] . '</label>
									<label style="border-style:solid;border-width:1px;margin:10px;">' . $row['StartLocation'] . '</label>
                                                                        <label style="border-style:solid;border-width:1px;margin:10px;">' . $row['EndLocation'] . '</label>
									<label style="border-style:solid;border-width:1px;margin:10px;">' . $price_ticket . '</label>
									<label style="border-style:solid;border-width:1px;margin:10px;">' . $row['TripDate'] . '</label>
									</span>
									</span>
									<a class="goBackButton" href=" viatorem_reg.php ">Go back to Main Page</a>';
                                    }
                                } else {
                                    echo "Couldn't issue database query";
                                    echo mysqli_error($connection);
                                }
                            } else {
                                echo '<a class="goBackButton" href="regViewTrip.php ">Please try again, there is somethin wrong!</a>';
                            }
                        } else {
                            echo '<a class="goBackButton" href="regViewTrip.php ">Someone bought or reserved this seat before you!</a>';
                        }
                    } else {
                        echo '<a class="goBackButton" href="regViewTrip.php">You can not reserve a seat less than 3 days before the trip!</a>';
                    }
                }
            }
        }
    }

    mysqli_close($connection);
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
