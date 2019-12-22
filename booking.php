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
    padding: 0px 10px;
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
      <a  href="#myPage" class="navbar-brand">Jaiswal holidays</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">HOME</a></li>
        
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
            <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
            <pre>    
</pre>

            <div id="page_conten">
                <h2 style="font-size:1.2em;"> Choose seats by clicking the corresponding seat in the layout below:</h2>
                <div class="busdataarea">
                    <div class="buswrapper">
                        <label>
                            <b>Booking Date : </b>
                        </label>
                        <label>
                            <?php
                                echo ($dateOfJourney = $_SESSION['dateOfJourney']);
                            ?>
                        </label>
                    </div>
                    <!-- <div class="buswrapper">
                        <label>
                            <b>Bus Number : </b>
                        </label>
                        <label>
                            <?php
                                echo ('...');
                            ?>
                        </label>
                    </div> -->
                    <div class="buswrapper">
                        <label>
                            <b>From : </b>
                        </label>
                        <label>
                            <?php
                                echo ($journeyFrom = $_SESSION['journeyFrom']);
                            ?>
                        </label>
                    </div>
                    <div class="buswrapper">
                        <label>
                            <b>To : </b>
                        </label>
                        <label>
                            <?php
                                echo ($journeyTo = $_SESSION['journeyTo']);
                            ?>
                        </label>
                    </div>
                </div>
            </div>


            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div id="area">
                    <p>Please Select Seat</p>
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
<?php for($i=0;$i<6;$i++){ ?>

<td colspan=2>
<label class="switch">
  <input type="checkbox" onclick="book_s('sleeper-<?php echo $i+1 ?>')">
  <span class="slider"></span>
</label>

</td>

<?php } ?>
</tr>
<tr class="sleeper">
<?php for($i=0;$i<6;$i++){ ?>

<td colspan=2>
<label class="switch">
  <input type="checkbox">
  <span class="slider"></span>
</label>

</td>

<?php } ?>
</tr>
<tr class="extra-sheet">
<td colspan="12">
<label class="switch">
  <input type="checkbox">
  <span class="slider"></span>
</label></td>
</tr>
<tr>

<?php for($i=0;$i<6;$i++){ ?>
    

<td>
<label class="switch">
  <input type="checkbox">
  <span class="slider"></span>
</label>

</td>
<td>
<label class="switch">
  <input type="checkbox">
  <span class="slider"></span>
</label>

</td>

<?php } ?>
</tr>

<tr>
<?php for($i=0;$i<6;$i++){ ?>
    

<td>
<label class="switch">
  <input type="checkbox">
  <span class="slider"></span>
</label>

</td>
<td>
<label class="switch">
  <input type="checkbox">
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
<?php for($i=0;$i<6;$i++){ ?>

<td colspan=2>
<label class="switch">
  <input type="checkbox">
  <span class="slider"></span>
</label>

</td>

<?php } ?>
</tr>
<tr class="sleeper">
<?php for($i=0;$i<6;$i++){ ?>

<td colspan=2>
<label class="switch">
  <input type="checkbox">
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

<?php for($i=0;$i<6;$i++){ ?>
    

<td colspan=2>
<label class="switch">
  <input type="checkbox">
  <span class="slider"></span>
</label>

</td>


<?php } ?>
</tr>

<tr class="sleeper">
<?php for($i=0;$i<6;$i++){ ?>
    
    <td colspan=2>
<label class="switch">
  <input type="checkbox">
  <span class="slider"></span>
</label>

</td>


<?php } ?>
</tr>
</table>

                                   
                        </ul>
                    </div>
                    <!-- upper end -->
                    <div class="submit-container" style="display: inline-block; margin-top: 10px;">
                        <input style="margin:0;" type="submit" name="insert_seat" id="insert" value="Insert">
                    </div>

                    <div style="margin-top: 10px;"> 
                        <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
                    </div>
                </div>
            </form>
        </div>

        <!--#contentwrapper-->
        <div class="clear"></div>

        <div id="footer">
            Copyright © 2018.<br> All Rights Reserved.
        </div>
    </div>
    <script>
    function book_s(ticket){
        alert(ticket)
    }
    </script>
</body>

</html>
