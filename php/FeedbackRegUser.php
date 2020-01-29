
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

    <div style="margin:50px 150px 50px;">
        <?php
        include("connection.php");

        $query = mysqli_query($connection, "SELECT * FROM FeedBack WHERE isApproved='1'");

        if ($query) {
            while ($row = mysqli_fetch_array($query)) {

                echo '<p  style="background-color:white;color:black;margin:2px;padding:10px;border-radius:5px;font-size:18px;border:2px solid black;">FROM:' . $row2['emaill'] . '<br>Comment:' . $row['Content'] . '<br></p>';
            }
        } else {
            echo "Connection down";
            echo mysqli_error($connection);
        }
        $user_email = $_SESSION['email'];

        $query3 = mysqli_query($connection, "SELECT * FROM users WHERE emaill='$user_email'");
        if ($query3) {
            while ($row = mysqli_fetch_array($query3)) {
                $abc = $row['emaill'];
            }
        }

        if (isset($_POST["comment"])) {
            $comment = $_POST["comment"];
        }

        if ($_POST) {
            if (!$comment) {
                echo 'Missing Information';
            } else {
                $ekle = mysqli_query($connection, "INSERT INTO feedback SET emaill ='$abc', Content = '$comment' ");
                if ($ekle) {
                    echo '<a class="goBackButton" href="FeedBackRegUser.php">your feedback was sent, it is waiting to approve!</a>';
                } else {
                    echo '<a class="goBackButton" href="FeedBackRegUser.php">There is something wrong, your feedback was not sent!</a>';
                }
            }
        }



        mysqli_close($connection);
        ?>
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

        <form action="" method="POST">
            <input type="text" id="comment" name="comment" placeholder="Enter comment" required>
                <input type="submit" id='submit' value="Send" /><br>
                </form>
                </div>
                <button class="goBackButton" onclick="goBack()">Go Back</button>

                </body>
                </html>