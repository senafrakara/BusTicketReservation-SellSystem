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


    <center><h1>My Profile</h1></center>
    <center>
        <form id="form1" name="profile_info" action="" method="post">
            <table  align="center">
                <tbody>
                <h3>Profile Information</h3>
                <tr>
                    <td >Name:</td>
                    <td ><?php
            include('connection.php');
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
            $user_email = $_SESSION["email"];

            $user = mysqli_query($connection, "SELECT * FROM Users WHERE emaill='$user_email'");

            if ($user) {

                while ($row2 = mysqli_fetch_array($user)) {
                    $name = $row2["name"];

                    echo '<div style="widht:200%;padding:10px 20px; border:1px solid black; border-radius:4px;box-sizin:border-box;font-size:15px;"> ' . $name . '<br></div>';
                }
            }
            ?></td>
                </tr>
                <tr>
                    <td>Surname:</td>
                    <td><?php
                        include('connection.php');
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }
                        $user_email = $_SESSION["email"];

                        $user = mysqli_query($connection, "SELECT * FROM Users WHERE emaill='$user_email'");

                        if ($user) {

                            while ($row2 = mysqli_fetch_array($user)) {
                                $surname = $row2["surname"];

                                echo '<div style="widht:200%;padding:10px 20px; border:1px solid black; border-radius:4px;box-sizin:border-box;font-size:15px;"> ' . $surname . '<br></div>';
                            }
                        }
            ?></td<>
                </tr>

                <tr>
                    <td >Gender:</td>
                    <td ><?php
                        include('connection.php');
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }
                        $user_email = $_SESSION["email"];

                        $user = mysqli_query($connection, "SELECT * FROM Users WHERE emaill='$user_email'");

                        if ($user) {

                            while ($row2 = mysqli_fetch_array($user)) {
                                $gender = $row2["gender"];

                                echo '<div style="widht:200%;padding:10px 20px; border:1px solid black; border-radius:4px;box-sizin:border-box;font-size:15px;"> ' . $gender . '<br></div>';
                            }
                        }
            ?></td>
                </tr>
                <tr>
                    <td >BirthDate:</td>
                    <td ><?php
                        include('connection.php');
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }
                        $user_email = $_SESSION["email"];

                        $user = mysqli_query($connection, "SELECT * FROM Users WHERE emaill='$user_email'");


                        if ($user) {
                            while ($row2 = mysqli_fetch_array($user)) {

                                $birthDate = $row2["birtDate"];

                                echo '<div style="widht:200%;padding:10px 20px; border:1px solid black; border-radius:4px;box-sizin:border-box;font-size:15px;"> ' . $birthDate . '<br></div>';
                            }
                        }
                        ?></td>
                </tr>

                </tbody>

            </table>

        </form>
    </center>
    <center>
        <form id="form1" name="contact_info" action="" method="post">
            <table  align="center">
                <tbody>
                <h3>Contact Information</h3>
                <tr>
                    <td >Email Adress:</td>
                    <td ><?php
                        include('connection.php');
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }
                        $user_email = $_SESSION["email"];

                        $user = mysqli_query($connection, "SELECT * FROM Users WHERE emaill='$user_email'");

                        if ($user) {

                            echo '<div style="widht:200%;padding:10px 20px; border:1px solid black; border-radius:4px;box-sizin:border-box;font-size:15px;"> ' . $user_email . '<br></div>';
                        }
                        ?></td>
                </tr>
                <tr>
                    <td >Cellphone Number:</td>
                    <td ><?php
                        include('connection.php');
                        if ($connection->connect_error) {
                            die("Connection failed: " . $connection->connect_error);
                        }
                        $user_email = $_SESSION["email"];

                        $user = mysqli_query($connection, "SELECT * FROM Users WHERE emaill='$user_email'");

                        if ($user) {

                            while ($row2 = mysqli_fetch_array($user)) {
                                $phone_number = $row2["phoneNumber"];

                                echo '<div style="widht:200%;padding:10px 20px; border:1px solid black; border-radius:4px;box-sizin:border-box;font-size:15px;"> ' . $phone_number . '<br></div>';
                            }
                        }
                        ?></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                <a href="edit_Contact.php" target="_blank">Edit Contact Information</a>
                </tr>

                </tbody>

            </table>


        </form>
    </center>
    <center>
        <form id="form1" name="membership_info" action="" method="post">
            <table  align="center">
                <tbody>

                    <tr>
                        <td>&nbsp;</td>
                <a href="edit_Membership.php" target="_blank">Edit Membership Information</a>
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