<?php
error_reporting(0);
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
    

    <br>
    <br>
    <br>
    <br>
    <h1>Campaigns</h1>
    <div style="margin:50px 150px 50px;">
        <?php
        include("connection.php");

        $query = mysqli_query($connection, "SELECT CampaignID FROM Trip");
        if ($query) {
            while ($row = mysqli_fetch_array($query)) {
                $campaign = $row['CampaignID'];
            }
        }
        $query2 = mysqli_query($connection, "SELECT * FROM Campaign WHERE CampaignID = $campaign");
        if ($query2) {
            while ($row = mysqli_fetch_array($query2)) {
                echo '<p  style="background-color:white;color:black;margin:2px;padding:10px;border-radius:5px;font-size:18px;border:2px solid black;"">Campaign Description: <br>' . $row['Content'] . '</p>';
            }
        }

        mysqli_close($connection);
        ?>

    </div>
<button class="goBackButton" onclick="goBack()">Go Back</button>
</body>
</html>