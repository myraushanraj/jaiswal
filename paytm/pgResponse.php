<html>
	  <head>
	  <style>
	  table{
		width: 600px;
	border: 1px solid #000000c4;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  margin:auto;
	  }
	  table tr{
border:1px solid #000000c4;
}
	  table td{
		border: 1px solid #000000c4;
		padding:5px;
	  }
	  </style>
	  </head> 
	  <body> 
<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
include '../dbconnect.php';
include '../server.php';
$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	//echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		$order_id=$_POST['ORDERID'];
		$query1="UPDATE `book_detail` SET `payment_status` = '1' WHERE `book_detail`.`order_id` = '$order_id'";
		if(mysqli_query($db, $query1)){
			//echo "Thank you for booking seat";
			$query = "SELECT * FROM book_detail,time_table where order_id='$order_id' AND book_detail.route_id = time_table.route_id";
			$result = mysqli_query($db, $query);
			$data = array();
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			  }
			  
		    // $data=mysqli_fetch_all($result, MYSQLI_ASSOC);
//print_r($data);
		?>
        <h3 style="text-align:center">Congratulations, Your ticket has been booked successfully.</h3>
		<table>
		<tr><td colspan=2><strong>Ticket Details</strong></td></tr>

		<tr><td colspan=2>Jaiswal Holiday</td></tr>
		<tr><td>Date of Journey</td><td><?php echo $data[0]['journey_date']; ?></td></tr>
		<tr><td>Departure (From)</td><td><?php echo $data[0]['departure_station']; ?></td></tr>
		<tr><td>Departure (to)</td><td><?php echo $data[0]['arrival_station']; ?></td></tr>
		<tr><td>Booking Date</td><td><?php echo $data[0]['booking_date']; ?></td></tr>
		<tr><td colspan=2>Passenger Details</td></tr>
		

		<?php for($i=0;$i<sizeof($data);$i++){ ?>
		<tr><td>Passenger <?php echo $i+1; ?></td><td><?php echo $data[$i]['customer_name']; ?></td></tr>
       
		<?php } ?>

		<tr><td colspan=2>Bus Contact Details</td></tr>
		<tr><td>Contact</td><td>+91 72 6788 7922</td></tr>
		<tr><td>Email</td><td>jaiswalholidays24@gmail.com  </td></tr>
		<tr><td>Address</td><td>Shop no. 1, Gausala market front of Saidhari,<br> Nighasan Road, Lakhimpur Kheri (UP) . </td></tr>
		<tr><td colspan=2 style="text-align:center"><button onclick="window.print()">Print</button></td></tr>


		</table>
</body>
</html>
	  <?php
		}
		else{
			echo $errormsg = "Error...!".mysqli_error($db);
			echo "<p style='text-align:center;margin-top:30px'>Sorry, please try after sometime :)</p>";
			return;
		}
		//echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		//echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	// if (isset($_POST) && count($_POST)>0 )
	// { 
	// 	foreach($_POST as $paramName => $paramValue) {
	// 			echo "<br/>" . $paramName . " = " . $paramValue;
	// 	}
	// }
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>