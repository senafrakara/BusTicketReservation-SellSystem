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
            <li><a href="contactUs_visitor.php">Contact Us</a></li>
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


    <div>

        <?php
        error_reporting(0);
        session_start();

        include("connection.php");

        if ($_POST && isset($_POST['ccn'])) {

            $ccn = mysqli_query($connection, "SELECT Balance FROM Bank WHERE CreditCardNumber='" . $_POST['ccn'] . "'");
            if ($ccn) {
                while ($row2 = mysqli_fetch_array($ccn)) {
                    $balance = $row2['Balance'];
                    if ($row2['Balance'] < $_SESSION['Price']) {
                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'view_trip_RegUser.php\', \'windowname1\'); windowname.focus();void(0) ">Your balance at the bank is not enough, please try again!</a>';
                    }
                }
            } else {
                
                echo '<a class="goBackButton" href="javascript:windowname=window.open(\'view_trip_RegUser.php\', \'windowname1\'); windowname.focus();void(0) ">Wrong credit card number!</a>';
            }

            $seatNum = $_SESSION["Seat"];
            $gender = $_SESSION["Gender"];
            $email = $_SESSION['buyerMail'];
            $name = $_SESSION['name'];
            $surname = $_SESSION['surname'];
            $tripID = $_SESSION["tripID"];
            $ccn = $_POST['ccn'];
        } else {
            echo 'No post';
        }


        if ($_POST) {

            $dateQuery = mysqli_query($connection, "SELECT * FROM Trip WHERE TripID = '$tripID'");
            if ($dateQuery) {
                while ($row = mysqli_fetch_array($dateQuery)) {
                    $alreadyReservedQuery = mysqli_query($connection, "SELECT * FROM Reservation WHERE TripID = '$tripID' && SeatID = '$seatNum' && isCancelled=0");
                    $alreadyBoughtQuery = mysqli_query($connection, "SELECT * FROM Ticket WHERE TripID = '$tripID' && SeatID = '$seatNum' && isCancelled=0");
                    if (($alreadyReservedQuery && (mysqli_num_rows($alreadyReservedQuery) == 0)) && ($alreadyBoughtQuery && (mysqli_num_rows($alreadyBoughtQuery) == 0))) {
                        $price = $row['Price'];
                        if ($price) {
                            $add = mysqli_query($connection, "INSERT INTO ticket SET TripID = '$tripID',name = '$name',surname = '$surname', emaillOwner= '$email', SeatID = '$seatNum', gender = '$gender'");
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
								<label style="border-style:solid;border-width:1px;margin:10px;">' . $row['Price'] . '</label>
								<label style="border-style:solid;border-width:1px;margin:10px;">' . $row['TripDate'] . '</label>
								</span>
								</span>';
                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'viatorem.php\', \'windowname1\'); windowname.focus();void(0) ">Ticket was purchased successfully!</a>';
                                    }
                                } else {
                                    echo "Couldn't issue database query";
                                    echo mysqli_error($connection);
                                }
                            } else {
                                echo '<a class="goBackButton" href="javascript:windowname=window.open(\'viatorem.php\', \'windowname1\'); windowname.focus();void(0) ">Ticket was not purchased! Please check it from View Ticket Detail page. If you could not buy the ticket please try again</a>';
                            }
                        } else {
                            //echo "price olmadı";
                        }
                    } else {
                        echo '<a class="goBackButton" href=" viatorem.php ">Someone bought or reserved this seat before you!</a>';
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