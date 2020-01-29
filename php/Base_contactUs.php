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
    <title>Contact Us</title>
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

    <center>
        <form id="form1" name="form_contact" action="" method="post">

            <br>

            <h2>Your message: </h2>
            <textarea name="message" rows="10" cols="60" placeholder="Your message" required ></textarea>
            <br>
            <input type="submit" name="send_message" id="submit" value="Send">	
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

    $user_email = $_SESSION["email"];

    $message = $_POST["message"];

    $sql = mysqli_query($connection, "SELECT emaill FROM users WHERE emaill='$user_email' ");

    if ($sql) {
        while ($row = mysqli_fetch_array($sql)) {
            $userid = $row['emaill'];
        }
    }


    $sql2 = mysqli_query($connection, "SELECT emaill FROM Users WHERE UserType='officer' ");

    if ($sql2) {
        while ($row2 = mysqli_fetch_array($sql2)) {
            $officerid = $row2['emaill'];
            $receiver_id = $row2['emaill'];
        }
    }



    $send = mysqli_query($connection, "INSERT INTO message(Content, FromEmaill, ToEmaill) 
	       VALUES('$message', '$userid', '$receiver_id')");


    if ($send) {

        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'viatorem.php\', \'windowname1\'); windowname.focus();void(0) ">Your message was sent!</a>';
    } else {
        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'viatorem.php\', \'windowname1\'); windowname.focus();void(0) ">Your message could not be sent!</a>';
    }
}
?>