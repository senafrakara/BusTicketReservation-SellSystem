<?php 

$servername= "localhost";
$username ="root";
$password ="12345";
$db_name="viatoremdb";

$connection= new mysqli($servername,$username,$password,$db_name);
$new=  mysqli_set_charset($connection,"utf8");


if($connection -> connect_error){
	die("Connection failed: " .$connection -> connect_error);
}
$datecheckQuery = mysqli_query($connection,"SELECT * FROM Trip");
if($datecheckQuery){
	while($row = mysqli_fetch_array($datecheckQuery)){
		if(date('Y-m-d',strtoTime(' + 1 days')) >= $row['TripDate']){
			$checkReserve = mysqli_query($connection,"UPDATE Reservation SET isCancelled = '1' WHERE TripID = ".$row['TripID']);
			if($checkReserve){
				
			}
		}
	}
}

?>
    