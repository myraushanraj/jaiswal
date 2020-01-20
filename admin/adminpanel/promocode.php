<?php
    include_once '../dbconnect.php';

    session_start();

	if (!isset($_SESSION['usr_id']))
    {
        header("location: ../index.php");
    }
    else{ //Continue to current page
        header( 'Content-Type: text/html; charset=utf-8' );
    }

	if (isset($_POST['insert-bus'])) {
        $error = false;

        $code_name = $_POST['code_name'];
        $instant_discount = $_POST['instant_discount'];
        $exp_date = $_POST['exp_date'];
     

        if (empty($code_name)) { 
            $error = true;
            array_push($errors, "Code Name is required"); 
        }
        if (empty($instant_discount)) { 
            $error = true;
            array_push($errors, "Instant Discount is required"); 
        }
        if (empty($exp_date)) { 
            $error = true;
            array_push($errors, "Exp date is required"); 
        }
        if(!$error){
            $query = "INSERT INTO `promocode` (`s_no`, `code_name`, `instant_discount`, `exp_date`, `created_date`, `max_user`, `status`) VALUES (NULL, '$code_name', '$instant_discount', '$exp_date', current_timestamp(), '500', '1');";
            if(mysqli_query($con, $query)) {
                $successmsg = "Successfully Created New Promo Code!";
            }
            else{
                $errormsg = "Error...!";
            }
        }

	}

    if (isset( $_GET['delete_id'])) {
        $delete_id=$_GET['delete_id'];
        $query = "DELETE FROM `promocode` WHERE `promocode`.`s_no` = $delete_id;";
        if(mysqli_query($con, $query)) {
           echo "<script>alert('Deleted Successfully!')</script>";
           echo "<script>window.location.href = 'promocode.php';</script>";
        }
        else{
            $errormsg = "Error...!";
        }
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
    <script type="text/javascript" src="adminpanel-assets/js/jquery.min.js"></script>

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

            <!-- Side Menu -->
            <?php
                include 'side-menu.php';
            ?>
            
            <div class="sidebar-background" style="background-image: url(../admin/assets/img/sidebar-1.jpg);"></div>
        </div>

        <div class="main-panel ps-container ps-theme-default ps-active-y">
            <div class="content">
                <div class="container-fluid">
                    <div class="row" style="margin: 25px 0;">
                        <span class="text-success">
                            <?php if (isset($_SESSION['updated_success_msg'])) {
                                    echo $_SESSION['updated_success_msg']; 
                                    unset($_SESSION['updated_success_msg']);
                                } 
                            ?>
                        </span>
                        <span class="text-danger">
                            <?php if (isset($_SESSION['updated_error_msg'])) {
                                    echo $_SESSION['updated_error_msg'];  
                                    unset($_SESSION['updated_error_msg']);
                                } 
                            ?>
                        </span>
                    </div>
                    <div class="row" style="margin: 25px 0;">
                        <h1 class="text-danger"> PromoCode</h1>
            <?php
                if (isset( $_SESSION['user_type'] )) {
                    if($_SESSION['user_type'] == 'admin'){
            ?>
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="bus_type">
                        <div class="input-group">
                                <label for="busNo" class="required">Code Name</label>
                                <input type="text" name="code_name" placeholder="Enter Code Name" required="required"/>
                            </div>
                            <div class="input-group">
                                <label for="busNo" class="required">Instant Discount</label>
                                <input type="text" name="instant_discount" placeholder="" required="required"/>
                            </div>
                            
                            <div class="input-group">
                                <label for="busType" class="required">Exp Date</label>
                                <input type="date" name="exp_date" placeholder="" required="required"/>
                            </div>
                            
                            

                            <div class="input-group" style="display: block;">
                                <input type="submit" name="insert-bus"value="Submit">
                               
                            </div>    

                            <br>
 
                            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
                            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

                        </form>
            <?php       
                    }
                }
            ?>
					</div>
                    <div class="row" style="margin: 25px 0;">
                        <table border="0" cellpadding="0" cellspacing="20" style="margin: 5px 0;">

                            <thead style="text-align: left;">
                                <tr>
                                    <th>S.No</th>
                                    <th>Promocode</th>
                                    <th>Instant Discount</th>
                                    <th>Expiry date</th>
                                   
                                    
                                    <?php
                                        if (isset( $_SESSION['user_type'] )) {
                                            if($_SESSION['user_type'] == 'admin'){
                                                echo "<th>Action</th>";
                                            }
                                        }
                                    ?>
                                </tr>
                            </thead>

                        <?php

                            $sql = "SELECT * from `promocode`";
                            $run = mysqli_query($con,$sql);

                            if(!$run)
                                die("Unable to run query".mysqli_error());

                            $rows = mysqli_num_rows($run);
                            if($rows>0){
                                while($data = mysqli_fetch_object($run)){
                                    echo "<td>".$data -> s_no."</td>";
                                    echo "<td>".$data -> code_name."</td>";
                                    echo "<td>".$data -> instant_discount."</td>";
                                    echo "<td>".$data -> exp_date."</td>";
                                   

                                    if (isset( $_SESSION['user_type'] )) {
                                        if($_SESSION['user_type'] == 'admin'){
                                            echo "<td> 
                                            <a href = ?delete_id=".$data -> s_no."> Delete </a></td>";
                                        }
                                    }
                                    echo "</tr>";
                                    
                                }
                            }
                            else{
                                    echo "No data found <br/>";
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
</body>

</html>
