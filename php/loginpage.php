<?php
session_start();
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="viatorem.css"></link>
    <script src="viatorem.js"></script>
   
    <title>Login</title>
</head>
<style>

</style>
<body>

    <br>
    <br>
    <ul>
        <li><a class="active" href="FeedbackVisitor.php">FeedBack</a></li>
        <li><a href="contactUs_visitor.php">Contact With Offficer</a></li>
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
<center><h1>LOGIN TO VIATOREM.</h1>
    <h2><em>WE ALWAYS HAVE THE BEST BUS SELL / RESERVATION SYSTEM.</em></h2>


</center>
<center><h2><i>IF YOU WANT TO BENEFIT FROM OUR CAMPAIGNS, PLEASE LOGIN. <br>IF YOU ARE NOT A REGISTERED MEMBER PLEASE REGISTER. </i></h2></center>
<center>	
    <form id="form1" name="form1" action="" method="post">
        <table align="center">
            <tbody>
                <tr>
                    <td class="required">Email Address:</td>
                    <td ><input type="email" name="email" id="email" placeholder="Enter your e-mail address" required ></td>

                </tr>
                <tr>
                    <td class="required">Password:</td>
                    <td><input type="password" name="password" id="password" placeholder="Enter your password" required></td>

                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" id="submit" value="Login"></td>
                        </tr>
                        </tbody>
                        </table>
                        <span class="psw"> <a href="rewrite_email.php">Forgot password?</a> </span>

                        <input type="checkbox" onclick="getPassword()">Show Password
                            </form><center><a href="registration.php"><br>
                                    <h2> REGISTRATION</h2></a></center>
                            <button class="goBackButton" onclick="goBack()">Go Back</button>
                            </center>

                            </body>
                            </html>

                            <?php
                            error_reporting(0);
                            session_start();

                            include('connection.php');


                            if ($_POST) {
                                $email = $_POST["email"];
                                $password = md5($_POST["password"]);
                                $_SESSION["email"] = $_POST["email"];
                                //email control
                                if (empty($email)) {
                                    echo "<center>" . "Email address is required.";
                                } else {

                                    // check if e-mail address is well-formed
                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        echo "<center>" . "Invalid email address format.";
                                    }
                                }



                                $login = mysqli_query($connection, "SELECT * FROM Users WHERE emaill='$email' and pwd='$password'");
                                //$sql = $connection ->query($login);


                                if ($login) {
                                    $_SESSION['email'] = $email;
                                    if (mysqli_num_rows($login) == 0) {
                                        echo '<a href="javascript:windowname=window.open(\'loginpage.php\', \'windowname1\'); windowname.focus();void(0) ">Your password or email is wrong!</a>';
                                    } else {
                                        while ($row = mysqli_fetch_array($login)) {



                                            $_SESSION["userType"] = $row["userType"];

                                            if ($_SESSION["userType"] == "admin") {
                                                $_SESSION["UserID"] = $row = ["UserID"];
                                                header("location: adminHomepage.php");
                                            } else if ($_SESSION["userType"] == "officer") {
                                                $_SESSION["UserID"] = $row = ["UserID"];
                                                header("location: officerhomepage.php");
                                            } else if ($_SESSION["userType"] == "registered") {
                                                $_SESSION["UserID"] = $row = ["UserID"];
                                                header("location: viatorem_reg.php");
                                            }
                                        }
                                    }
                                } else {
                                    echo '<a href="javascript:windowname=window.open(\'loginpage.php\', \'windowname1\'); windowname.focus();void(0) ">Your password or email is wrong!</a>';
                                }
                            }
                            ?>










