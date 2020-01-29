<?php
session_start();
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
            <li><a class="active" href="FeedbackVisitor.php">FeedBack</a></li>
            <li><a href="contactUs_visitor.php">Contact With Officer</a></li>
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

        <br>
        <br>
        <br>
        <br>
    <center>
        <form id="form1" name="view_ticket" action="viewTicketDetail_Continue.php" method="post">
            <table>
                <tbody>
                    <tr>
                        <td>PNR Number:</td>
                        <td ><input type="text" name="pnr" id="pnr" placeholder="Enter your PNR number of ticket" required ></td>

                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="ticket_detail" id="submit" value="View Ticket Detail"></td>
                        </tr>


                        </table>

                        </form>
                        </center>
                        <button class="goBackButton" onclick="goBack()">Go Back</button>
                        </body>
                        </html>