<?php
session_start();
if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in";
    include("loginpage.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>
        <h2 style="color:black;text-align:center;">view Trips</center></h2>

    </head>
    <body>
        <br>
        <br>
        <br>
        <ul>
            <li><a href="logout.php">Log Out</a></li>
            <li><a href="adminFeedback.php">FeedBack Management</a></li>
            <li><a href="view_trip_Admin.php">View Trip</a></li>
            <li><a href="admincancelticket.php">Cancel Ticket</a></li>
            <li><a href="addcampaign.php">Add/Remove Campaign</a></li>
            <li><a href="canceltrip.php">Cancel Trip</a></li>
            <li><a href="addtrip.php">Add Trip</a></li>
        </ul>
        <br><br><br><br><br>




    <center><h2>VIEW TRIPS</h2></center>

    <div>	
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
                        </div>
                        <button class="goBackButton" onclick="goBack()">Go Back</button>

                        </body>
                        </html>

                        <?php
                        error_reporting(0);
                        session_start();

// make sure user is logged in
                        if (!isset($_SESSION['email'])) {
                            $loginError = "You are not logged in.";
                            include("loginpage.php");
                            exit();
                        }

                        include('connection.php');


                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }


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
                                            if ($campaign_id == 1) {
                                                $price = $price - ($price * 0.05);
                                                $_SESSION['Price'] = $price;
                                            } else if ($campaign_id == 4) {
                                                $price = $price - ($price * 0.1);
                                                $_SESSION['Price'] = $price;
                                            } else if ($campaign_id == 5) {
                                                $price = $price - ($price * 0.15);
                                                $_SESSION['Price'] = $price;
                                            } else if ($campaign_id == 6) {
                                                $price = $price - ($price * 0.2);
                                                $_SESSION['Price'] = $price;
                                            } else if ($campaign_id == 7) {
                                                $price = $price - ($price * 0.25);
                                                $_SESSION['Price'] = $price;
                                            } else {
                                                $price = $row['Price'];
                                                $_SESSION['Price'] = $price;
                                            }

                                            echo '<div style="background-color:white;color:black;margin:10px;padding:10px;border-radius:5px;font-size:15px;border:2px solid black;">
							TripTime:' . $row['TripTime'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; From: ' . $row['StartLocation'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: ' . $row['EndLocation'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Price: ' . $price . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TripID: ' . $row['TripID'] . '<br>';
                                            echo "
							<form action='regBuyTicket.php' method='POST'><button name = 'buyButton' value =" . $row['TripID'] . " onclick=\"location.href= regBuyTicket.php'\">Buy ticket</button></form>
							<form action='ReserveTicket.php' method='POST'><button name='ReserveButton' type='submit' value=" . $row['TripID'] . ">Reserve ticket</button></form></div>";
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
                                        $_SESSION['TripID'] = $trip_id;
                                        $campaign_id = $row['CampaignID'];

                                        if ($campaign_id == 1) {
                                            $price = $price - ($price * 0.05);
                                            $_SESSION['Price'] = $price;
                                        } else if ($campaign_id == 4) {
                                            $price = $price - ($price * 0.1);
                                            $_SESSION['Price'] = $price;
                                        } else if ($campaign_id == 5) {
                                            $price = $price - ($price * 0.15);
                                            $_SESSION['Price'] = $price;
                                        } else if ($campaign_id == 6) {
                                            $price = $price - ($price * 0.2);
                                            $_SESSION['Price'] = $price;
                                        } else if ($campaign_id == 7) {
                                            $price = $price - ($price * 0.25);
                                            $_SESSION['Price'] = $price;
                                        } else {
                                            $price = $row['Price'];
                                            $_SESSION['Price'] = $price;
                                        }
                                        if ($date == $row['TripDate'] && $is_cancelled == 0 && ($tripTime < $time)) { //trip time is bigger than current time 
                                            echo '<div style="background-color:white;color:black;margin:10px;padding:10px;border-radius:5px;font-size:15px;border:2px solid black;">
							TripTime:' . $row['TripTime'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; From: ' . $row['StartLocation'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To: ' . $row['EndLocation'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Price: ' . $price . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TripID: ' . $row['TripID'] . '<br>';
                                            echo "
							<form action='regBuyTicket.php' method='POST'><button name = 'buyButton' value =" . $row['TripID'] . " onclick=\"location.href= regBuyTicket.php'\">Buy ticket</button></form>
							<form action='ReserveTicket.php' method='POST'><button name='ReserveButton' type='submit' value=" . $row['TripID'] . ">Reserve ticket</button></form></div>";
                                        }
                                    }
                                    }
                                }
                            }
                            if (!$query) {
                                echo '<a class="goBackButton" href="javascript:windowname=window.open(\'regViewTrip.php\', \'windowname1\'); windowname.focus();void(0) ">There is no such that trip!</a>';
                            }
                        }
                        mysqli_close($connection);
                        ?>