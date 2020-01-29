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

    <div style="margin:50px 500px 10px;">

        <?php
        error_reporting(0);
        session_start();
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }


        include("connection.php");


        if ($_POST && isset($_POST['Seat']) && isset($_POST['Gender'])) {
            $_SESSION["Seat"] = $_POST['Seat'];
            $seatNum = $_POST['Seat'];
            $_SESSION["Gender"] = $_POST['Gender'];
            $gender = $_POST['Gender'];
            echo '<form action="regPayment.php" method="POST"> 
	Seat Number:' . $seatNum . ' <br> <br> Gender:' . $gender . ' <br> <br>
	<input type="email" name="buyerMail" id="buyerMail" placeholder="Email" required >
	<input type="text" name="name" id="name" placeholder="Name" required>
	<input type="text" name="surname" id="surname" placeholder="Surname" required>
	<input type="submit" name="submit" id="submit" value="Continue">
	</form>';
        }
        mysqli_close($connection);
        ?>
    </div>
<button class="goBackButton" onclick="goBack()">Go Back</button>
</body>

</html>