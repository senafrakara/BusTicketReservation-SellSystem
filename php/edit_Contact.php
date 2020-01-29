<?php
session_start();

// make sure user is logged in
if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in.";
    include("loginpage.php");
    exit();
}
?>
<!doctype html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>
        <meta charset="utf-8">
        <title>Edit Profile</title>
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
    <center><h2>Edit Contact Information</h2></center>

    <center>
        <form id="form1" name="contact_info" action="" method="post">
            <table  align="center">
                <tbody>
                    <tr>
                        <td >Email Adress:</td>
                        <td ><input type="email" name="email" id="email" ></td>
                    </tr>
                    <tr>
                        <td >Cellphone Number:</td>
                        <td ><input type="tel" name="phonenumber" id="phonenmb" placeholder="Format: 0123-436-5689"></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="contact" id="submit" value="Save"></td>
                            </tr>

                            </tbody>

                            </table>


                            </form>
                            </center>
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
                            <?php
                            error_reporting(0);
                            session_start();


                            include('connection.php');

                            if ($connection->connect_error) {
                                die("Connection failed: " . $connection->connect_error);
                            }

                            if ($_POST) {


                                if (!isset($_SESSION['email'])) {
                                    header("Location: loginpage.php");
                                }


                                $user_email = $_SESSION["email"];
                                $emaill = $_POST['email'];
                                $phonenmb = $_POST['phonenumber'];

                                if (!(empty($emaill)) && !(empty($phonenmb))) {


                                    $update = "UPDATE Users 
					   SET emaill='$emaill', phoneNumber='$phonenmb' WHERE emaill='$user_email'";
                                    $result = mysqli_query($connection, $update);
                                    if ($result) {
                                        $_SESSION["email"] = $emaill;
                                        $user_email = $emaill;
                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'EditProfile.php\', \'windowname1\'); windowname.focus();void(0) ">Your email and phone number was succcesfully changed!</a>';
                                    } else {
                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'EditProfile.php\', \'windowname1\'); windowname.focus();void(0) ">You wrote wrong email address or phone number!</a>';
                                    }
                                } else if (!empty($phonenmb)) {

                                    $reset_phonenmb = "UPDATE Users 
					       SET phoneNumber='$phonenmb' WHERE emaill='$user_email'";
                                    $result2 = mysqli_query($connection, $reset_phonenmb);
                                    if ($result2) {
                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'EditProfile.php\', \'windowname1\'); windowname.focus();void(0) ">Your  phone number was succcesfully changed!</a>';
                                    } else {
                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'EditProfile.php\', \'windowname1\'); windowname.focus();void(0) ">Your  phone number was not changed!</a>';
                                    }
                                } else if (!empty($emaill)) {


                                    $reset_email = "UPDATE Users 
					   	SET emaill='$emaill' WHERE emaill='$user_email'";
                                    $result3 = mysqli_query($connection, $reset_email);
                                    if ($result3) {
                                        $_SESSION["email"] = $emaill;
                                        $user_email = $emaill;
                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'EditProfile.php\', \'windowname1\'); windowname.focus();void(0) ">Your email  was succcesfully changed!</a>';
                                    } else {
                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'EditProfile.php\', \'windowname1\'); windowname.focus();void(0) ">You wrote invalid emaill address.!</a>';
                                    }
                                } else {
                                    echo '<a class="goBackButton" href="javascript:windowname=window.open(\'EditProfile.php\', \'windowname1\'); windowname.focus();void(0) ">You did not change any information!</a>';
                                }
                            }
                            ?>