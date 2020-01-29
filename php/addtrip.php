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
        <h2 style="color:blue;text-align:center;">Admin Homepage</center></h2>

        <body>
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
        <center><h2>Add Trip</h2></center>

        <div>	
            <form id="form1" name="form1" action="" method="post">
                <table align="left">
                    <tbody>
                        <tr>
                            <td>From:</td>
                            <td><select style="width: 200%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid black;border-radius: 4px;box-sizing: border-box;font-size: 15px;" name="from" id="from"  required>
                                    <option value="Ankara">Ankara</option>
                                    <option value="İstanbul">İstanbul</option>
                                    <option value="İzmir">İzmir</option>
                                    <option value="Konya">Konya</option>
                                    <option value="Sakarya">Sakarya</option>
                                </select></td>

                        </tr>
                        <tr>
                            <td>To:</td>
                            <td><select style="width: 200%;padding: 12px 20px;margin: 8px 0;display: inline-block;border: 1px solid black;border-radius: 4px;box-sizing: border-box;font-size: 15px;" name="to" id="to"  required>
                                    <option value="Ankara">Ankara</option>
                                    <option value="İstanbul">İstanbul</option>
                                    <option value="İzmir">İzmir</option>
                                    <option value="Konya">Konya</option>
                                    <option value="Sakarya">Sakarya</option>
                                </select></td>

                        </tr>
                        <tr>
                            <td >Date:</td>
                            <td ><input type="date" name="date" id="date"></td>
                        </tr>
                        <tr>
                            <td>Time:</td>
                            <td ><input type="text" name="time" id="time"  required ></td>

                            </tr>
                            <tr>
                                <td>Price:</td>
                                <td ><input type="text" name="price" id="price"  required ></td>

                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" name="submit" id="submit" value="Add Trip"></td>
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

                                    include('connection.php');
//include('view_trip_RegUser.php');

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
                                        $time = $_POST['time'];
                                        $price = $_POST['price'];

                                        $campaignQuery = mysqli_query($connection, "SELECT * FROM trip");
                                        if ($campaignQuery) {
                                            while ($row = mysqli_fetch_array($campaignQuery)) {
                                                $campaignID = $row['CampaignID'];
                                            }
                                        }

                                        $date = date("Y-m-d", $date);
                                        $query = mysqli_query($connection, "INSERT INTO trip (StartLocation , EndLocation , TripDate, TripTime, Price,CampaignID)VALUES ('$from','$to', '$date','$time' ,'$price', '$campaignID' )");
                                        if ($query) {
                                            echo '<a class="goBackButton" href="adminHomepage.php">Trip Added!</a>';
                                        }
                                    }
                                    ?>