<?php
session_start();
?>
<!doctype html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>
        <meta charset="utf-8">
        <title>View Trips</title>
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

    <center><h2>VIEW TRIPS</h2></center>

    <center>	
        <form id="form1" name="form1" action="" method="post">
            <table align="left">
                <tbody>
                    <tr>
                        <td>From:</td>
                        <td><select style="width: 200%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid black;border-radius: 4px;box-sizing: border-box;font-size: 15px;" name="from" id="from"  required>
                                <option value="Ankara">Ankara</option>
                                <option value="İstanbul">Istanbul</option>
                                <option value="İzmir">Izmir</option>
                                <option value="Konya">Konya</option>
                                <option value="Sakarya">Sakarya</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>To:</td>
                        <td><select style="width: 200%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid black;border-radius: 4px;box-sizing: border-box;font-size: 15px;" name="to" id="to"  required>
                                <option value="Ankara">Ankara</option>
                                <option value="İstanbul">Istanbul</option>
                                <option value="İzmir">Izmir</option>
                                <option value="Konya">Konya</option>
                                <option value="Sakarya">Sakarya</option>
                            </select></td>	 
                    </tr>
                    <tr>
                        <td >Date:</td>
                        <td ><input type="date" name="date" id="date"></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" id="submit" value="View Trips"></td>
                        </tr>
                        </tbody>
                        </table>

                        </form>
                        </center>

                        <button class="goBackButton" onclick="goBack()">Go Back</button>
                        </body>
                        </html>


                        <?php
                        error_reporting(0);

                        include('connection.php');



                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }
                        $user_email = $_SESSION['email'];

                        if ($_POST) {
                            $from = $_POST['from'];
                            $to = $_POST['to'];
                            $date = $_POST['date'];
                            $date_today = date('Y-m-d');
                            $date_today = strtotime($date_today);
                            $date = strtotime($date); //searched day
                            if ($date > $date_today) { //if searched today is furtheer from today
                                $date = date("Y-m-d", $date);
                                $query = mysqli_query($connection, "SELECT * FROM trip WHERE StartLocation ='$from' and EndLocation ='$to' and TripDate='$date'");
                                if ($query) {
                                    if(mysqli_num_rows($query) == 0){
                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'regViewTrip.php\', \'windowname1\'); windowname.focus();void(0) ">There is no such that trip!</a>';
                                    }else{
                                    while ($row = mysqli_fetch_array($query)) {
                                        $strotime_TripDate = strtotime($row['TripDate']);
                                        $is_cancelled = $row['isCancelled'];
                                        if ($date == $row['TripDate'] && $is_cancelled == 0) {
                                            $trip_id = $row['TripID'];
                                            $price = $row['Price'];
                                            $campaign_id = $row['CampaignID'];
                                            $_SESSION['Price'] = $price;

                                            echo '<div style="background-color:white;color:black;margin:10px;padding:10px;border-radius:5px;font-size:15px;border:2px solid black;">
							TripTime:' . $row['TripTime'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; From: ' . $row['StartLocation'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: ' . $row['EndLocation'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Price: ' . $_SESSION['Price'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TripID: ' . $row['TripID'] . '<br>';
                                            echo "
							<form action='visitorBuyTicket.php' method='POST'><button name = 'buyButton' value =" . $row['TripID'] . " onclick=\"location.href= visitorBuyTicket.php'\">Buy ticket</button></form></div>
							";
                                        }
                                    }
                                    }
                                }
                            } else if ($date == $date_today) { //if searched today is equal today
                                $date = date("Y-m-d", $date);
                                date_default_timezone_set("Europe/Istanbul");
                                $time = date("h:i:s");
                                $time = mktime($time); // current time
                                $query = mysqli_query($connection, "SELECT * FROM trip WHERE StartLocation ='$from' and EndLocation ='$to' and TripDate='$date'");
                                if ($query) {
                                    if(mysqli_num_rows($query) == 0){
                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'regViewTrip.php\', \'windowname1\'); windowname.focus();void(0) ">There is no such that trip!</a>';
                                    }else{
                                    while ($row = mysqli_fetch_array($query)) {
                                        $strotime_TripDate = strtotime($row['TripDate']);
                                        $is_cancelled = $row['isCancelled'];
                                        $tripTime = $row['TripTime']; //trip time
                                        $tripTime = mktime($tripTime);
                                        $trip_id = $row['TripID'];
                                        $price = $row['Price'];
                                        $_SESSION['Price'] = $price;
                                        $_SESSION['TripID'] = $trip_id;

                                        if ($date == $row['TripDate'] && $is_cancelled == 0 && ($tripTime > $time)) { //trip time is bigger than current time 
                                            echo '<div style="background-color:white;color:black;margin:10px;padding:10px;border-radius:5px;font-size:15px;border:2px solid black;">
							TripTime:' . $row['TripTime'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; From: ' . $row['StartLocation'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: ' . $row['EndLocation'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Price: ' . $_SESSION['Price'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TripID: ' . $row['TripID'] . '<br>';
                                            echo "
							<form action='visitorBuyTicket.php' method='POST'><button name = 'buyButton' value =" . $row['TripID'] . " onclick=\"location.href= visitorBuyTicket.php'\">Buy ticket</button></form></div>
							";
                                        }
                                    }
                                    }
                                }
                            } else {
                                echo '<a class="goBackButton" href="javascript:windowname=window.open(\'regViewTrip.php\', \'windowname1\'); windowname.focus();void(0) ">There is no such that trip!</a>';
                            }
                        }
                        mysqli_close($connection);
                        ?>
	

