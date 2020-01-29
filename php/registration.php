<?php
session_start();
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="viatorem.css"></link>
    <script src="viatorem.js"></script>
    <title>REGISTRATION</title>
</head>

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
<center><h1>REGISTRATION</h1></center>
<center>
    <h2><em>WE ALWAYS HAVE THE BEST BUS SELL / RESERVATION SYSTEM.</em></h2>
    <h2><i>IF YOU WANT TO BENEFIT FROM OUR CAMPAIGNS, PLEASE LOGIN. <br>IF YOU ARE NOT A REGISTERED MEMBER PLEASE REGISTER. </i></h2>

</center>

<center>
    <form id="formregistration" name="formregistration" action="" method="post">
        <table  align="center">
            <tbody>
                <tr>
                    <td class="required">Name:</td>
                    <td ><input type="text" name="name" id="name" required></td>
                </tr>
                <tr>
                    <td class="required">Surname:</td>
                    <td><input type="text" name="surname" id="surname" required></td>
                    </tr>
                    <tr>
                        <td class="required">Email Adress:</td>
                        <td ><input type="email" name="email" id="email" placeholder="Enter an email address" required></td>
                        </tr>
                        <tr>
                            <td class="required">Password:</td>
                            <td ><input type="password" name="password" id="password" required></td>
                            </tr>
                            <tr>
                                <td class="required" >Gender:</td>
                                <td ><select name ="gender" required>
                                        <option value="F" name="F">Female</option>
                                        <option value="M" name="M">Male</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td  class="required">Cellphone Number:</td>
                                <td ><input type="tel" name="phonenmb" id="phonenmb" placeholder="Format: 0123-436-5689" required></td>
                                </tr>
                                <p id="date"></p>
                                <tr>
                                    <td class="required">BirthDate:</td>


                                    <td ><input type="date" name="birthdate" id="birthdate"   min="1940-12-31" required></td>
                                    <script>

                                        birthdate.max = new Date().toISOString().split("T")[0];

                                    </script>
                                    </tr>
                                    <tr>
                                        <td class="required">SECURITY QUESTION</td>
                                        <td><select name="questions"  style="width:330px; height: 25px" required>
                                                <option value="1" name="question1">Your favorite fruit</option>
                                                <option value="2" name="question2">Name of your favorite teacher in high school</option>
                                                <option value="3" name="question3">Second letter of your mother's maiden name</option>
                                                <option value="4" name="question4">Your favorite vegatables</option>
                                                <option value="5" name="question5">Your favorite color</option>
                                            </select></td>
                                    </tr>

                                    <tr>
                                        <td class="required">Your answer:</td>
                                        <td class="required"><input type="text" name="answer"  required></td>

                                        </tr>

                                        <tr>
                                            <td>&nbsp;</td>
                                            <td><input type="submit" name="submit" id="submit" value="SIGN UP"></td>
                                            </tr>
                                            </tbody>

                                            </table>
                                            <input  type="checkbox" onclick="getPassword()" >Show Password

                                                </form>
                                                </center>
                                                <center>
                                                    <p>&nbsp;</p>
                                                    <p><a href="loginpage.php"><h2>Have Already An Account?</h2></a></p>
                                                </center>
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
                                                    $name = $_POST['name'];
                                                    $surname = $_POST['surname'];
                                                    $email = $_POST['email'];
                                                    $password = $_POST['password'];
                                                    $gender = $_POST['gender'];
                                                    $phonenmb = $_POST['phonenmb'];
                                                    $birthdate = $_POST['birthdate'];

                                                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                        echo "Invalid email format";
                                                    }

                                                    $password = md5($password);
                                                    $question = $_POST['questions'];
                                                    $answer = $_POST['answer'];



                                                    if ($question == 1) {
                                                        $registration = "INSERT INTO users(emaill,pwd,name,surname,userType,birtDate,gender,phoneNumber, Question, AnswerToQuestion) 
                         VALUES ('$email','$password','$name','$surname','registered','$birthdate','$gender','$phonenmb', 'question1', '$answer')";
                                                    } else if ($question == 2) {
                                                        $registration = "INSERT INTO users(emaill,pwd,name,surname,userType,birtDate,gender,phoneNumber, Question, AnswerToQuestion) 
                         VALUES ('$email','$password','$name','$surname','registered','$birthdate','$gender','$phonenmb', 'question2', '$answer')";
                                                    } else if ($question == 3) {
                                                        $registration = "INSERT INTO users(emaill,pwd,name,surname,userType,birtDate,gender,phoneNumber, Question, AnswerToQuestion) 
                         VALUES ('$email','$password','$name','$surname','registered','$birthdate','$gender','$phonenmb', 'question3', '$answer')";
                                                    } else if ($question == 4) {
                                                        $registration = "INSERT INTO users(emaill,pwd,name,surname,userType,birtDate,gender,phoneNumber, Question, AnswerToQuestion) 
                         VALUES ('$email','$password','$name','$surname','registered','$birthdate','$gender','$phonenmb', 'question4', '$answer')";
                                                    } else {
                                                        $registration = "INSERT INTO users(emaill,pwd,name,surname,userType,birtDate,gender,phoneNumber, Question, AnswerToQuestion) 
                         VALUES ('$email','$password','$name','$surname','registered','$birthdate','$gender','$phonenmb', 'question5', '$answer')";
                                                    }
                                                    $result = mysqli_query($connection, $registration);
                                                    if ($result) {
                                                        echo "<script>window.location.href='loginpage.php';</script>";
                                                        exit;
                                                        //  echo '<a href="javascript:windowname=window.open(\'loginpage.php\', \'windowname1\'); windowname.focus();void(0) "><h2>Your registration was successfully completed!</h2></a>';
                                                    } else {
                                                        echo '<a class="goBackButton" href="javascript:windowname=window.open(\'registration.php\', \'windowname1\'); windowname.focus();void(0) ">There is something wrong. Please register with another email address!</a>';
                                                    }
                                                }
                                                ?>
