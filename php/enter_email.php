<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Password Reset</title>
    <link rel="stylesheet" type="text/css" href="viatorem.css">
        <script src="viatorem.js"></script>
    </head>

    <body>
        <br>
        <br>
        <br>
        <form id="form1" name="form1" action="" method="post">
            <center><h2>Reset password</h2></center>
            <center>
                <?php
                error_reporting(0);



                include('connection.php');


                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                $email = $_SESSION['email'];
                $sql = mysqli_query($connection, "SELECT * FROM Users WHERE emaill='$email'");


                if ($sql) {
                    while ($row = mysqli_fetch_array($sql)) {
                        $question = $row['Question'];
                    }
                }

                if ($question == "question1") {
                    print "<h3>Your Security Question is : 'Your favorite fruit '</h3>";
                } else if ($question == "question2") {
                    print "<h3>Your Security Question is : 'Name of your favorite teacher in high school'</h3>";
                } else if ($question == "question3") {
                    print "<h3>Your Security Question is : 'Second letter of your mother's maiden name'</h3>";
                } else if ($question == "question4") {
                    print "<h3>Your Security Question is : 'Your favorite vegatables'</h3>";
                } else if ($question == "question5") {
                    print "<h3>Your Security Question is : 'Your favorite color'</h3>";
                } else {
                    print "Something go wrong";
                }
                ?>
                <table>
                    <tr>
                        <td>Your email address</td>
                        <td><input type="email" id="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td><label>New password</label></td>
                            <td><input type="password" id="new_password" name="new_password" required></td><

                            </tr>
                            <tr>
                                <td><label>Confirm password</label></td>
                                <td><input type="password" id="password_again" name="password_again" required></td>
                                </tr>

                                <br>

                                </table>

                                <textarea name="answerTo" rows="1" cols="40" placeholder="Your answer"></textarea>

                                </center>
                                <input type="checkbox" onclick="getPassword()">Show Password
                                    <br>
                                    <button type="submit" id="submit" name="reset-password" >Reset Password</button>


                                    </form>
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


                                        $email = $_POST["email"];
                                        $new_password = $_POST["new_password"];
                                        $password_again = $_POST["password_again"];
                                        $answerQuestion = $_POST["answerTo"];
                                        $question = $_POST['questions'];

                                        if ($password_again == $new_password) {
                                            echo "New password and confirm password are not the same. Check it.";
                                        }

                                        $sql = "SELECT * FROM Users WHERE emaill='$email'";
                                        $sql = $connection->query($sql);
                                        if ($sql->num_rows > 0) {
                                            while ($row = $sql->fetch_assoc()) {
                                                //$_SESSION["question"]= $row=["Question"];
                                                $_SESSION["answer"] = $row["AnswerToQuestion"];
                                                //	$userid = $row["UserID"];
                                                $new_password = md5($new_password);



                                                if ($_SESSION["answer"] == $answerQuestion) {
                                                    $reset_password = "UPDATE Users 
					                  SET pwd='$new_password' WHERE emaill='$email'";
                                                } else {
                                                    echo "Your security question or answer is wrong, please check it. ";
                                                    header("location:enter_email.php");
                                                }


                                                $result = mysqli_query($connection, $reset_password);
                                                header("location:loginpage.php");
                                            }
                                        }
                                    }
                                    ?>