<?php
    include_once '../dbconnect.php';
    include '../adminfunction.php';

    session_start();

	if (!isset($_SESSION['usr_id']))
    {
        header("location: ../index.php");
    }
    else{ //Continue to current page
        header( 'Content-Type: text/html; charset=utf-8' );
    }
?>

<!DOCTYPE html>
<html lang="en" class="js csstransitions">

<head>
    <title>Admin Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="adminpanel-assets/css/style.css" />
    <link rel="stylesheet" href="adminpanel-assets/css/normalize.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script>
        window.onload = function () {
            document.body.setAttribute("class", document.body.getAttribute('class') + " loaded")
        }

    </script>

    <script type="text/javascript" src="adminpanel-assets/js/adminpanel-function.js"></script>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="red" data-image="../assets/img/sidebar-1.jpg">
            <div class="logo"> <a href="#" class="simple-text">
                    Admin Panel
                    </a>
                    <?php
                        if (isset($_SESSION['usr_id'])) { ?>
                            <span data-hover="Welcome">Welcome - &nbsp;<?php echo $_SESSION['usr_name']; ?>
                            <?php } else { ?>
                            <span data-hover="Welcome">Welcome
                                </span>
                    <?php } ?>
                </span>
            </div>

            <?php
                include 'side-menu.php';

                if(isset($_GET['order_id'])){
                    $order_id=$_GET['order_id'];
                    $sql = "UPDATE `book_detail` SET `payment_status` = '2' WHERE `order_id` = '$order_id'";
echo $sql;
                    $run = mysqli_query($con,$sql);

                    if(!$run)
                    die("Unable to run query".mysqli_error($con));
                    else{
                        echo "<script>alert('Credit Successfully')</script>";
                        ?>
                        <script>
                        var r=confirm("DO you want print ticket");
                        if(r){
                            window.open('ticket.php?order_id=<?php echo $order_id; ?>','_blank');
                            window.location.href = 'booking.php'; 
                        }
                        else{
                            window.location.href = 'booking.php'; 
                        }
                        </script>
                        <?php
                      
                    }


                }
            ?>
            
            <div class="sidebar-background" style="background-image: url(../admin/assets/img/sidebar-1.jpg);"></div>
        </div>
        <div class="main-panel ps-container ps-theme-default ps-active-y">
            <div class="content">
                <div class="container-fluid">
                    <div class="row" style="margin: 25px 0;">
                        <h1 class="text-danger"> Client Booking.</h1>

                        <table border="0" cellpadding="0" cellspacing="20" id="myTable" style="margin: 5px 0;">
                            <thead style="text-align: left;">
                                <tr>
                                    <th>S.N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Travel</th>
                                    <th>Date</th>
                                    <th>Oredr Id</th>
                                    <th>Total Fare</th>
                                    <th>Payment Via</th>
                                    <th>Payment Status</th>

                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>

                            <?php

$sql = "SELECT * FROM book_detail,time_table where book_detail.route_id = time_table.route_id";

                            $run = mysqli_query($con,$sql);

                            if(!$run)
                            die("Unable to run query".mysqli_error($con));

                            $rows = mysqli_num_rows($run);
                            if($rows>0){
                                $sn = 1;
                                while($data = mysqli_fetch_object($run)){
                                    echo "<tr><td>".$sn."</td>";
                                    
                                    echo "<td>".$username = $data -> customer_name."(".$data -> cust_gender.")</td>";
                                    echo "<td>".$data -> cust_email."</td>";
                                    echo "<td>".$data -> cust_contact."</td>";
                                    echo "<td>".$data -> departure_station."-".$data -> arrival_station."(".$data -> choice.")</td>";
                                    echo "<td>".$data -> journey_date."</td>";
                                    echo "<td>".$data -> order_id."</td>";
                                    echo "<td>".$data -> rent."</td>";
                                    echo "<td>".$data -> order_id."</td>";
                                    if($data -> payment_status==0)
                                    echo "<td>N/A <a href='?order_id=".$data -> order_id."'>Collect Offline</a></td>";
                                    else if($data -> payment_status==1)
                                    echo "<td>Online</td>";
                                    else if($data -> payment_status==2)
                                    echo "<td>Offline</td>";
                                    $sn++;
                                }
                            }
                            else{
                                echo "<td colspan='5'> No data found </td><br/>";
                            }

                            
                            ?>
                            </table>

                    </div>
                </div>
            </div>
            
            <?php
                include 'footer.php';
            ?>
            
        </div>
    </div>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
</body>

</html>
