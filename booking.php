<?php
    include 'dbconnect.php';
    include 'server.php';


	if (!isset($_SESSION['cust_id']))
    {
       // header("location: ../index.php");
    }
    else{ //Continue to current page
        header( 'Content-Type: text/html; charset=utf-8' );
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com -->
  <title>Jaiswal holidays</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="assets/css/index.css" type="text/css" rel="stylesheet" />
    <link href="assets/css/seat.css" type="text/css" rel="stylesheet" />
    <style>
.switch {
  position: relative;
  display: inline-block;
  width: 22px;
  height: 18px;
  background:#000;
}

input { 
  opacity: 0!important;
  width: 0!important;
  height: 0!important;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #fff;
  -webkit-transition: .4s;
  transition: .4s;
  border:1px solid gray;
}



.booked-seat + .slider {
  background-color: gray!important;
}
input:checked + .slider {
  background-color: green;
}
table td{
    padding: 1px 4px;
}
.sleeper td .switch{
width:47px;
}
#holder {
    height: auto;
    width: auto;
    background-color: #F5F5F5;
    border: 1px solid #A4A4A4;
    padding: 7px 10px;
    position: relative;
    margin: 0px 0;
}
.driver{
    position:absolute;
    top: 2px
}
.extra-sheet .switch{
    float:right;
}
@media only screen and (max-width:800px){
  .bus-list-wrap td,.bus-list-wrap th{
    padding:20px 3px!important;
  }
  .container{
    padding:2px!important;
  }
  #content {
   padding: 0px!important;
}
.col-xs-12{
  padding:3px!important;
}
table td {
  padding: 1px 2px;
}
#area {
    background-color: #F5F5F5;
    padding: 15px 6px;
    float: left;
}
.driver {
    position: absolute;
    top: 2px;
    left: -7px;
}
.book-details-wrap {
    width: 100%;
    background: #fff;
    padding: 26px;
    margin: auto;
    border-radius: 5px;
}
.pass-details-wrap {
    background: #fff;
    padding: 30px;
    width: 97%;
    margin: 63px auto;
}
#pass-details-wrap {
    background: #00000063;
    position: fixed;
    top: 0;
    height: 100vh;
    padding-top: 10px;
    display: none;
}
}

</style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a  href="index.php" class="navbar-brand">Jaiswal holidays</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">HOME</a></li>
        
        <li><a href="#portfolio">OUR STORY</a></li>
        <li><a href="#pricing">BLOG</a></li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li><a href="#contact">LOGIN</a></li>
       
      </ul>
    </div>
  </div>
</nav>
        <div id="header">
            <div id="mainmenu">
                <header>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="timetable.php">Time Table</a></li>
                        <?php  if (!isset($_SESSION['cust_name'])) {?>
                            <li><a href="login.php">Login</a></li>
                        <?php }?>
                        <?php  if (isset($_SESSION['cust_name'])) {?>
                            <li> <a href="index.php?logout='1'">Logout</a> </li>
                        <?php }?>
                    </ul>
                </header>
            </div>
        </div>
        <div></div>
        <div></div>
        <div></div>

        <div id="content">
           

            <div id="page_conten">
            <p class="bus-title">From-  <?php
                                echo ($journeyFrom = $_SESSION['journeyFrom']);
                            ?>&nbsp;&nbsp;&nbsp;&nbsp;
                            To-
                             <?php
                                echo ($journeyFrom = $_SESSION['journeyTo']);
                            ?>&nbsp;&nbsp;&nbsp;&nbsp;
                        Booking Date :    
                        <?php
                                echo ($dateOfJourney = $_SESSION['dateOfJourney']);
                            ?>
               </p>
                <h3 style="font-size:1.2em;"> Choose seats by clicking the corresponding seat in the layout below</h3>
                
            </div>
<div class="col-xs-12  col-md-6">

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div id="area">
                 
 <div id="holder">
  <table>
<tr class="sleeper">
<td rowspan=5 style="width:50px">
<label class=" driver">
 <img src="images/driver.png" width=35px style="    transform: rotate(271deg);" />
 <div style="    transform: rotate(270deg);
    position: absolute;
    bottom: -85px;">LOWER</div>
</label>

</td>

<?php $no=0; for($i=0;$i<6;$i++){ 
  $no=$no+2;
  ?>

<td colspan=2>
<label class="switch">
  <input type="checkbox" id="L-S-<?php echo $no ?>" onclick="book_s('L-S-<?php echo $no ?>','sleeper',this.checked)">
  <span class="slider"></span>
</label>

</td>

<?php } ?>
</tr>
<tr class="sleeper">
<?php $no=-1; for($i=0;$i<6;$i++){ 
  $no=$no+2; ?>

<td colspan=2>
<label class="switch">
  <input type="checkbox" id="L-S-<?php echo $no ?>"  onclick="book_s('L-S-<?php echo $no ?>','sleeper',this.checked)">
  <span class="slider"></span>
</label>

</td>

<?php } ?>
</tr>
<tr class="extra-sheet">
<td colspan="12">
<label class="switch">
  <input type="checkbox" id="chair-25" onclick="book_s('chair-25','chair',this.checked)">
  <span class="slider"></span>
</label></td>
</tr>
<tr>

<?php $no=0; for($i=0;$i<6;$i++){ 
  $no=$no+2; ?>
    

<td>
<label class="switch">
  <input type="checkbox" id="chair-<?php echo $no ?>" onclick="book_s('chair-<?php echo $no ?>','chair',this.checked)">
  <span class="slider"></span>
</label>

</td>
<?php $no=$no+2; ?>
<td>
<label class="switch">
  <input type="checkbox" id="chair-<?php echo $no ?>" onclick="book_s('chair-<?php echo $no ?>','chair',this.checked)">
  <span class="slider"></span>
</label>

</td>

<?php } ?>
</tr>

<tr>
<?php $no=-1; for($i=0;$i<6;$i++){ 
  $no=$no+2; ?>
    

<td>
<label class="switch">
  <input type="checkbox" id="chair-<?php echo $no ?>" onclick="book_s('chair-<?php echo $no ?>','chair',this.checked)">
  <span class="slider"></span>
</label>

</td>
<?php $no=$no+2; ?>
<td>
<label class="switch">
  <input type="checkbox" id="chair-<?php echo $no ?>"  onclick="book_s('chair-<?php echo $no ?>','chair',this.checked)">
  <span class="slider"></span>
</label>

</td>

<?php } ?>
</tr>
</table>

                                   
                        </ul>
                    </div>


                    <!-- Upper start -->
                    <br>
                    <div id="holder">
  <table>
<tr class="sleeper">
<td rowspan=5 style="width:50px">
<label class=" driver">
 <div style="    transform: rotate(270deg);
    position: absolute;
    bottom: -85px;">UPPER</div>
</label>

</td>
<?php $no=12; for($i=0;$i<6;$i++){ 
  $no=$no+2;
  ?>

<td colspan=2>
<label class="switch">
  <input type="checkbox" id="U-S-<?php echo $no ?>" onclick="book_s('U-S-<?php echo $no ?>','sleeper',this.checked)">
  <span class="slider"></span>
</label>

</td>

<?php } ?>
</tr>
<tr class="sleeper">
<?php $no=11; for($i=0;$i<6;$i++){ 
  $no=$no+2;
  ?>

<td colspan=2>
<label class="switch">
  <input type="checkbox" id="U-S-<?php echo $no ?>" onclick="book_s('U-S-<?php echo $no ?>','sleeper',this.checked)">
  <span class="slider"></span>
</label>

</td>

<?php } ?>
</tr>
<tr class="extra-sheet">
<td colspan="12">
&nbsp;
</td>
</tr>


<tr class="sleeper">

<?php $no=0; for($i=0;$i<6;$i++){ 
  $no=$no+2;
  ?>

<td colspan=2>
<label class="switch">
  <input type="checkbox" id="U-S-<?php echo $no ?>" onclick="book_s('U-S-<?php echo $no ?>','sleeper',this.checked)">
  <span class="slider"></span>
</label>

</td>


<?php } ?>
</tr>

<tr class="sleeper">
<?php $no=-1; for($i=0;$i<6;$i++){ 
  $no=$no+2;
  ?>

<td colspan=2>
<label class="switch">
  <input type="checkbox" id="U-S-<?php echo $no ?>" onclick="book_s('U-S-<?php echo $no ?>','sleeper',this.checked)">
  <span class="slider"></span>
</label>

</td>


<?php } ?>
</tr>
</table>

                                   
                        </ul>
                    </div>
                    <!-- upper end -->
                 

                  
                </div>
            </form>
            </div>
            <div class="col-xs-12  col-md-6">
            <div class="book-details-wrap">
            <label>Boarding Point</label>
            <p>New Delhi (Near Anand vihar Metro Gate no 2)</p>

            <label>Dropping Point</label>
            <p>New Delhi (Near Anand vihar Metro Gate no 2)</p>
            <hr>
            <p>Seat(s) No- <span class="pull-right" id="seat_no"></span></p>
            <p>Base Fare- <span class="pull-right" id="base_fare">0</span></p>
            <p>Discount- <span class="pull-right" id="discount"></span></p>
            <hr>
            <p>Total- <span class="pull-right" id="total">0</span></p>
            <p><button class="book-btn" onclick="continue_click()">CONTINUE BOOKING</button></p>
            </div>
        


            <!-- code wrapper -->
            <br>
            <div class="book-details-wrap">
            <h3 style="margin:0px">Coupon</h3>
          
            <hr>
            <div style="border:1px solid #ccc!important">
            <input type="text" id="coupon" style="width:70%!important;height:35px!important;opacity:1!important;border:none!important;padding-left:5px" />
            <button class="book-btn" onclick="apply_coupon()" id="apply-btn" style="width:28%;margin:0px;border-radius:0px;background: #4CAF50;border:1px solid #4CAF50">APPLY</button>
            </div>
            </div>
           
        </div>

        <!--#contentwrapper-->
        <div class="clear"></div>
        <div id="pass-details-wrap">
        <form class="pass-details-wrap" id="checkout-form" action="paytm/pgRedirect.php" method="post">
          <p style="text-align:right"><span onclick='document.getElementById("pass-details-wrap").style.display = "none";' style="cursor:pointer"> X</span></p>
            <div class="row" id="all-form">
            </div>
            <p style="text-align:center"><button class="book-btn" style="width:300px">CONTINUE BOOKING</button></p>

        </form>
        <div>
       
    </div>
    <script>
    var sleeper_rate=<?php echo $_SESSION['rent']; ?>*2;
    var chair_rate=<?php echo $_SESSION['rent']; ?>;
    var total=0;
    var seat = [];
    function book_s(ticket,ticket_type,action){
      if(action){
        seat.push(ticket);
      if(ticket_type=="sleeper")
      total=total+sleeper_rate
      else
      total=total+chair_rate
      }
      else{
        
        var index = seat.indexOf(ticket);
if (index !== -1) seat.splice(index, 1);




      if(ticket_type=="sleeper")
      total=total-sleeper_rate
      else
      total=total-chair_rate
      }

     


      
      document.getElementById("seat_no").innerHTML=seat;
     
     
    
      document.getElementById("base_fare").innerHTML=total;
      document.getElementById("total").innerHTML=total;
      document.getElementById("discount").innerHTML=0;

      if(total==0){
        document.getElementById("base_fare").innerHTML=0;
        document.getElementById("discount").innerHTML=0;
        document.getElementById("total").innerHTML=0;
      }
      

    }
  
    function apply_coupon(){
      if(total==0){
        alert("please Choose your Seats");
        return
      }
      var coupon_code=document.getElementById("coupon").value;
    
      
      var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
               // alert(this.responseText);
                var promocodes=this.responseText;
                //alert(promocodes);
                total=total-promocodes;
                document.getElementById("total").innerHTML=total;
                document.getElementById("discount").innerHTML='-'+promocodes;
                
                document.getElementById("apply-btn").innerHTML='APPLIED';
                document.getElementById("coupon").style.color="#4caf50";
                document.getElementById("apply-btn").disabled = true;
            }
            else if(this.readyState == 4 && this.status == 400){
              var promocodes=this.responseText;
              document.getElementById("apply-btn").innerHTML='APPLY'
               // alert(promocodes);
            }
        };
        xmlhttp.open("GET", "callscript.php?endpoint=get_promocode&code="+coupon_code, true);
        xmlhttp.send();


    }

    function continue_click(){
     
      if(seat.length>0){
        document.getElementById("pass-details-wrap").style.display = "block";


        var html='';
html+=" <h3>Passenger Information</h3>";
        for(var i=0;i<seat.length;i++){
html+=`
<div class="col-xs-12 col-md-12">
       
        <label>Passenger ${i+1}</label>
        </div>
        <div class="col-xs-6 col-xs-12  col-md-6">
             <input type="text" name="pass_name${i+1}" placeholder="Name" required>
             <input type="hidden" name="pass_seat${i+1}" placeholder="Name" value="${seat[i]}">
        </div>
        <div class="col-xs-3 col-md-3">
            <input type="number" name="pass_age${i+1}" placeholder="Age" required> 
        </div>
        <div class="col-xs-3 col-md-3">
            <select name="pass_gender${i+1}" required>
            <option value='Male'>Male</option>
            <option value='Female'>Female</option>
            </select>
        </div>`;
        }
        html+=`
<div class="col-xs-12 col-md-12">
      
        <label>Contact Information</label>
        </div>
        <div class="col-xs-6 col-xs-12  col-md-6">
             <input type="email" placeholder="Email Address" name="pass_email" required>
        </div>
        <div class="col-xs-6 col-xs-12  col-md-6">
            <input type="number" name="pass_contact" placeholder="Mobile Number" required> 
            <input type="hiden" name="pass_count" placeholder="Mobile Number" value="${seat.length}"> 
            <input type="number" name="pay_amount" placeholder="Mobile Number" value="${total}"> 
        </div>
        `;
        document.getElementById("all-form").innerHTML=html;
      }
      else{
        alert("Please select your seat!")
      }
    }
    </script>
<?php

//get seat status
$route_id=$_SESSION['selected_route_id'];

$query = "SELECT * FROM book_detail where route_id='$route_id' AND journey_date='$dateOfJourney' AND payment_status=1 OR payment_status=2";
			$result = mysqli_query($db, $query);
      
		
      while($row = mysqli_fetch_assoc($result)){
        //echo "id: " . $row["seat_no"];
        ?>
<script>
document.getElementById("<?php echo $row["choice"];?>").disabled = true;
document.getElementById("<?php echo $row["choice"];?>").checked = true;

var element = document.getElementById("<?php echo $row["choice"];?>");
   element.classList.add("booked-seat");

document.getElementById("<?php echo $row["choice"];?>").style.backgroundColor = "lightblue";


</script>
        <?php
      }

     

?>
</body>

</html>
