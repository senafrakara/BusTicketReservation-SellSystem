
<?php
session_start();
//include("config_membershipInfo.php");
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
    <center><h2>Edit Membership Information</h2></center>
    <center>
        <form id="form1" name="membership_info" action="" method="post">
            <table  align="center">
                <tbody>

                    <tr>
                        <td><label>New password</label></td>
                        <td><input type="password" id="new_password" name="new_password" ></td>

                    </tr>
                    <tr>
                        <td><label>Confirm password</label></td>
                        <td><input type="password" id="password_again" name="password_again"></td>
                        </tr>

                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="membership" id="submit" value="Save"></td>
                            </tr>

                            </tbody>

                            </table>
                            <input  type="checkbox" onclick="showPassword()" >Show Password

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
                                    function showPassword() {
                                        var x = document.getElementById("password");
                                        if (x.type === "password") {
                                            x.type = "text";
                                        } else {
                                            x.type = "password";
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

                                if ($_POST['membership']) {


                                    $new_password = $_POST["new_password"];
                                    $password_again = $_POST["password_again"];


                                    if ($password_again != $new_password) {
                                        echo "New password and confirm password are not the same. Check it.";
                                    }

                                    if (!isset($_SESSION['email'])) {
                                        header("Location: loginpage.php");
                                    }
//$res=mysqli_query($connection,"SELECT * FROM users WHERE emaill=".$_SESSION['email']);
//$userRow=mysqli_fetch_array($res);


                                    if (!empty($new_password)) {
                                        $new_password = $_POST["new_password"];
                                        $new_password = md5($new_password);
                                        $user_email = $_SESSION["email"];
                                        //	echo '<p style="border-style:solid; border-width:1px;">FROM:'.$user_email.'<br></p>';


                                        $reset_password = "UPDATE Users 
					          SET pwd='$new_password' WHERE emaill='$user_email'";

                                        $result = mysqli_query($connection, $reset_password);
                                        if ($result) {
                                            echo '<a href="javascript:windowname=window.open(\'EditProfile.php\', \'windowname1\'); windowname.focus();void(0) ">Your password  was succcesfully changed!</a>';
                                        } else {
                                            echo '<a href="javascript:windowname=window.open(\'EditProfile.php\', \'windowname1\'); windowname.focus();void(0) ">There is something wrong. Ypur password coukd not changed. Please try again!</a>';
                                        }
                                    }



//	}


                                    header("location: Registered.php");
                                }
                                ?>