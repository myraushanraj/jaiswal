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
      include_once '../dbconnect.php';

     if(isset($_GET['order_id'])){
        $order_id=$_GET['order_id'];
        	$query = "SELECT * FROM book_detail,time_table where order_id='$order_id' AND book_detail.route_id = time_table.route_id";
			$result = mysqli_query($con, $query);
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

        <?php }
        
        else{
            echo "Invalid Request";
        }
        ?>