<?php
session_start();

// make sure user is logged in
if (!isset($_SESSION['email'])) {
    $loginError = "You are not logged in.";
    include("loginpage.php");
    exit();
}
?>
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
    <br>
    <br>
    <br>
    <br>
    <br>

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

    <div style="margin:50px 600px 10px;">

        <?php
        error_reporting(0);
        session_start();


        include("connection.php");


        if ($_POST && isset($_POST['buyerMail']) && isset($_POST['name']) && isset($_POST['surname'])) {


            $_SESSION['buyerMail'] = $_POST['buyerMail'];
            $name = $_POST['name'];
            $_SESSION['name'] = $_POST['name'];
            $surname = $_POST['surname'];
            $_SESSION['surname'] = $_POST['surname'];
            echo '<form class="required" action="regBuyFinish.php" method="POST"> 
	<input  type="text" name="ccn" id="ccn" placeholder="Credit Card Number" required>
	<input type="submit" name="submit" id="submit" value="Continue">
	</form>';
        } else {
            
        }
        mysqli_close($connection);
        ?>
    </div>
<button class="goBackButton" onclick="goBack()">Go Back</button>
</body>

</html>