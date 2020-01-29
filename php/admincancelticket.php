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
        <meta charset="utf-8">
        <title></title>
    </head>

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
                        <td ><input type="text" name="pnr" id="pnr" placeholder="Enter PNR number of ticket" required ></td>

                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="admincancelticket" id="submit" value="Cancel Ticket"></td>
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
                        }
                        $query = mysqli_query($connection, "SELECT * FROM ticket WHERE PNR ='$pnr'");

                        if ($query) {

                            while ($row = mysqli_fetch_array($query)) {

                                //$pnr_nmb = $row['PNR'];
                                if ($row['isCancelled'] == 0) {
                                    $admincancelticket = "UPDATE ticket 
					               SET isCancelled='1' WHERE PNR = '" . $_POST['pnr'] . "'";
                                    $result = mysqli_query($connection, $admincancelticket);
                                } if ($result) {
                                    echo 'Ticket successfully cancelled!';
                                } else {
                                    echo ' Ticket was not cancelled!It should be aldready cancelled or wrong pnr number entry!';
                                }
                            }
                        } else {
                            echo 'There is something wrong!';
                        }
                        ?>
                        <button class="goBackButton" onclick="goBack()">Go Back</button>
                        </body>
                        </html>
