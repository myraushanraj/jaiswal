<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
include '../dbconnect.php';
include '../server.php';
date_default_timezone_set("Asia/Kolkata");
print_r($_REQUEST);
if(isset($_POST['pass_email'])){
$pass_count=$_POST['pass_count'];
$ORDER_ID = "or_jswl_".time();
$CUST_ID = "COSTOMER_ID_011";
$INDUSTRY_TYPE_ID = "Retail";
$CHANNEL_ID = "WEB";
$TXN_AMOUNT = $_POST["pay_amount"];
$customer_email=$_POST['pass_email'];
$customer_contact=$_POST['pass_contact'];

$selected_route_id=$_SESSION['selected_route_id'];
$dateOfJourney = $_SESSION['dateOfJourney'];
$booking_date=date("Y-m-d h:i:sa");



//echo $_POST['pass_email']."Amount".$_POST["pay_amount"];
echo "<p style='text-align:center;margin-top:30px'>Redirecting.. Please Wait</p>".$pass_count;



for($i=1;$i<=$pass_count;$i++){
	$selected_seat=$_POST['pass_seat'.$i];
	$pass_name=$_POST['pass_name'.$i];
	$pass_age=$_POST['pass_age'.$i];
	$pass_gender=$_POST['pass_gender'.$i];

	$query1 = "INSERT INTO `book_detail` (
		route_id,
		journey_date,
		booking_date,
		rent,
		bus_type,
		choice,
		customer_name,
		cust_email,
		cust_contact,
		order_id,
		cust_age,
		cust_gender
		) 
		VALUES(
			'$selected_route_id',
			'$dateOfJourney',
			'$booking_date',
			'$TXN_AMOUNT',
			'',
			'$selected_seat',
			'$pass_name',
			'$customer_email',
			'$customer_contact',
			'$ORDER_ID',
			'$pass_age',
			'$pass_gender'
	
		)";
	if(mysqli_query($db, $query1)){
		echo "redirecting to payment gateway..";

		
	}
	else{
		echo $errormsg = "Error...!".mysqli_error($db);
		echo "<p style='text-align:center;margin-top:30px'>Sorry, please try after sometime :)</p>";
		return;
	}
}




}
else{
	echo "<p style='text-align:center;margin-top:30px'>Invalid Input :)</p>";
	return;
}



$checkSum = "";
$paramList = array();

// $ORDER_ID = $_POST["ORDER_ID"];
// $CUST_ID = $_POST["CUST_ID"];
// $INDUSTRY_TYPE_ID = $_POST["INDUSTRY_TYPE_ID"];
// $CHANNEL_ID = $_POST["CHANNEL_ID"];
// $TXN_AMOUNT = $_POST["TXN_AMOUNT"];

// Create an array having all required parameters for creating checksum.
$paramList["MID"] = PAYTM_MERCHANT_MID;
$paramList["ORDER_ID"] = $ORDER_ID;
$paramList["CUST_ID"] = $CUST_ID;
$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
$paramList["CHANNEL_ID"] = $CHANNEL_ID;
$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;


$paramList["CALLBACK_URL"] = "http://localhost/gagan/jaiswal/paytm/pgResponse.php";
$paramList["MSISDN"] = $customer_contact; //Mobile number of customer
$paramList["EMAIL"] = $customer_email; //Email ID of customer
// $paramList["VERIFIED_BY"] = "EMAIL"; //
// $paramList["IS_USER_VERIFIED"] = "YES"; //



//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

?>
<html>
<head>
<title>Merchant Check Out Page</title>
</head>
<body>
	<center><h1>Please do not refresh this page...</h1></center>
		<form method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
		<table border="1">
			<tbody>
			<?php
			foreach($paramList as $name => $value) {
				echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			?>
			<input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>
</body>
</html>