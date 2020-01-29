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
        <form id="form1" name="add_campaign" action="" method="post">
            <table>
                <tbody>
                <label> 1 for <b>%5</b>, 4 for <b>%10</b>, 5 for <b>%15</b>, 6 for <b>%20</b> , 7 for <b>%25</b></label>
                <tr>
                    <td>NO:</td>
                    <td ><input type="text" name="discount" id="discount" placeholder="Enter discount no" required ></td>

                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="adminaddcampaign" id="submit" value="Add Campaign"></td>
                        </tr>


                        </table>

                        </form>
                        </center>
<button class="goBackButton" onclick="goBack()">Go Back</button>

                        </body>
                        </html>



                        <?php
                        error_reporting(0);
                        session_start();


                        include('connection.php');


                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }

                        if ($_POST) {
                            $discount = $_POST['discount'];

                            if ($discount == '0') {
                                $query = mysqli_query($connection, "UPDATE trip SET CampaignID= '0' ");
                                if ($query) {
                                    echo 'campaign successfully added!';
                                }
                            }
                            if ($discount == '1') {
                                $query = mysqli_query($connection, "UPDATE trip SET CampaignID= '1' ");
                                if ($query) {
                                    echo 'campaign successfully added!';
                                }
                            }
                            if ($discount == '2') {
                                $query = mysqli_query($connection, "UPDATE trip SET CampaignID= '2' ");
                                if ($query) {
                                    echo 'campaign successfully added!';
                                }
                            }
                            if ($discount == '3') {
                                $query = mysqli_query($connection, "UPDATE trip SET CampaignID= '3' ");
                                if ($query) {
                                    echo 'campaign successfully added!';
                                }
                            }
                            if ($discount == '4') {
                                $query = mysqli_query($connection, "UPDATE trip SET CampaignID= '4' ");
                                if ($query) {
                                    echo 'campaign successfully added!';
                                }
                            }
                            if ($discount == '5') {
                                $query = mysqli_query($connection, "UPDATE trip SET CampaignID= '5' ");
                                if ($query) {
                                    echo 'campaign successfully added!';
                                }
                            }
                        }
                        ?>
