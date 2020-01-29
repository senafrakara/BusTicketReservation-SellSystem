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
        <title>Officer Send Message</title>

    </head>
    <body>


        <br>
        <br>

    <center>
        <form id="form1" name="form_contact" action="" method="post">
            <br>
            <h2>TO ID: </h2>
            <textarea name="toid" rows="2" cols="2" placeholder="Enter ID" required ></textarea>
            <br>

            <h2>Your message: </h2>
            <textarea name="message" rows="10" cols="60" placeholder="Your message" required ></textarea>
            <br>


            <input type="submit" name="send_message" id="submit" value="Send">	
        </form>


    </center>

    <?php
    include('connection.php');


    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    if ($_POST) {

        $user_email = $_SESSION["email"];

        $message = $_POST["message"];

        $sql = "SELECT UserID FROM users WHERE emaill='$user_email' ";
        $senderid = $connection->query($sql);

        $row = $senderid->fetch_assoc();
        $userid = $row[UserID];

        $receiver_id = $_POST["toid"];


        //  $return = mysqli_fetch_array($sql);
        //   $from_ID=$return["UserID"];
//	$_SESSION["fromID"] = $return["UserID"];


        $send = "INSERT INTO message(Content, FromID, ToID) 
	       VALUES('$message', '$userid', '$receiver_id')";
        $send_message = $connection->query($send);
        if ($send_message) {

            echo '<a href="javascript:windowname=window.open(\'Registered.php\', \'windowname1\'); windowname.focus();void(0) ">Your message was sent!</a>';
        } else {
            echo '<a href="javascript:windowname=window.open(\'Registered.php\', \'windowname1\'); windowname.focus();void(0) ">Your message could not be sent!</a>';
        }
    }
    ?>
<button class="goBackButton" onclick="goBack()">Go Back</button>

</body>
</html>