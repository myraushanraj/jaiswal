<?php
    include 'dbconnect.php';
    include 'server.php';

	if (!isset($_SESSION['cust_id'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
    }
    else{ //Continue to current page
        header( 'Content-Type: text/html; charset=utf-8' );
    }

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['cust_name']);
		header("location: login.php");
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
  <style>
  
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
<!-- Slider start here -->
<div id="bus-input-details" class="container">
    
  <div class="col-md-8">
  <form id="search_buses_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="has-validation-callback">

      <div class="col-md-6">
          <div class="input-wrap">
              <label>From</label>
            
              <select class="select" name="journeyFrom" id="journeyFrom"  data-validation="required">
                		<option value="">Starting City</option>

                        <?php
                            $sql = "select DISTINCT departure_station from `route_detail`";
                            $run = mysqli_query($db,$sql);

                            if(!$run)
                            	die("Unable to run query".mysqli_error());

                            $rows = mysqli_num_rows($run);

                            if($rows>0){
                            	while($data = mysqli_fetch_object($run)){
                                    echo '<option value="' . $data -> departure_station . '">' . $data -> departure_station . '</option>';
                            	}
                            }
                            else{
                            		echo "No data found <br/>";
                            	}
                        ?>

                	</select>
          </div>
      </div>   
      <div class="col-md-6">
          <div class="input-wrap">
              <label>To</label>
              
              <select class="select" name="journeyFrom" id="journeyFrom"  data-validation="required">
                		<option value="">Starting City</option>

                        <?php
                            $sql = "select DISTINCT departure_station from `route_detail`";
                            $run = mysqli_query($db,$sql);

                            if(!$run)
                            	die("Unable to run query".mysqli_error());

                            $rows = mysqli_num_rows($run);

                            if($rows>0){
                            	while($data = mysqli_fetch_object($run)){
                                    echo '<option value="' . $data -> departure_station . '">' . $data -> departure_station . '</option>';
                            	}
                            }
                            else{
                            		echo "No data found <br/>";
                            	}
                        ?>

                	</select>
          </div>
      </div>   
      <br>
      <div class="col-md-6">
          <div class="input-wrap">
              <label>Journey date</label>
              <input type="date">
          </div>
      </div>   
      <div class="col-md-6">
          <div class="input-wrap" type="date">
              <label>Return date</label>
              <input type="date">
          </div>
      </div>  
      <div class="col-md-12">
          <div class="button-wrap">
            <p class="text-center"><input type="submit" valute="Search"></p>
          </div>
      </div>  
                            </form>
    </div>
  <div class="col-md-4 text-left">
     <p class="fff"> Welcome to Jaiswal holidays. Book bus tickets online, check bus schedules and get the best bus booking deals right here, right now. Your memorable bus journey is just a click away.
     <h3 class="fff">Save up to 30% on online Bus Ticket!</h3>
    </div>
 </div> 


<!-- Slider end here -->

<!-- Container (Services Section) -->
<div id="" class="container-fluid text-center">
     
        <h4 class="section-title"><span>Online Booking Offer</span></h4>
        <br>
        <div class="row">
          <div class="col-sm-4">
            <div class="box-wrap">
                <span class=""> <img src="https://s1.rdbuz.com/images/MobileOffers/amazon/offertile..png" class="img-responsive"/></span>
                <p class="product-title">Use code CONTROL to get Up to 12% cashback (Max Rs 175) into redbus wallet on bus tickets depending on your route of travel and bus operator.</p>
              
                
            </div>
          </div>
          <div class="col-sm-4">
              <div class="box-wrap">
                  <span class=""> <img src="https://s1.rdbuz.com/images/MobileOffers/amazon/offertile..png" class="img-responsive"/></span>
                  <p class="product-title">Use code CONTROL to get Up to 12% cashback (Max Rs 175) into redbus wallet on bus tickets depending on your route of travel and bus operator.</p>
                
                  
              </div>
          </div>
          <div class="col-sm-4">
              <div class="box-wrap">
                  <span class=""> <img src="https://s1.rdbuz.com/images/MobileOffers/amazon/offertile..png" class="img-responsive"/></span>
                  <p class="product-title">Use code CONTROL to get Up to 12% cashback (Max Rs 175) into redbus wallet on bus tickets depending on your route of travel and bus operator.</p>
                
                  
              </div>
          </div>
        </div>
        <br><br>
        
      </div>
      
      <!-- Service section end here -->
     
<br>
      <!-- Banner end here -->

      <!-- Testimonial start here -->
      <div class="container-fluid">
          <h4 class="section-title"><span>Testimonials</span></h4>

      </div>
<div id="myCarousel2" class="carousel slide text-center container testi" data-ride="carousel">
 

    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel2" data-slide-to="1"></li>
      <li data-target="#myCarousel2" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <div class="col-md-4 text-center">
          <img src="images/girl1.jpg" alt="slider1" class="user-image" />
          <p>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          </p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>

        </div>
        <div class="col-md-4 text-center">
            <img src="images/girl1.jpg" alt="slider1" class="user-image" />
            <p>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            </p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
  
          </div>
          <div class="col-md-4 text-center">
              <img src="images/girl1.jpg" alt="slider1" class="user-image" />
              <p>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              </p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
    
            </div>
      </div>



      <div class="item">
          <div class="col-md-4 text-center">
            <img src="images/girl1.jpg" alt="slider1" class="user-image" />
            <p>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            </p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
  
          </div>
          <div class="col-md-4 text-center">
              <img src="images/girl1.jpg" alt="slider1" class="user-image" />
              <p>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              </p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
    
            </div>
            <div class="col-md-4 text-center">
                <img src="images/girl1.jpg" alt="slider1" class="user-image" />
                <p>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
      
              </div>
        </div>
        <div class="item">
            <div class="col-md-4 text-center">
              <img src="images/girl1.jpg" alt="slider1" class="user-image" />
              <p>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star"></span>
              <span class="fa fa-star"></span>
              </p>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
    
            </div>
            <div class="col-md-4 text-center">
                <img src="images/girl1.jpg" alt="slider1" class="user-image" />
                <p>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
      
              </div>
              <div class="col-md-4 text-center">
                  <img src="images/girl1.jpg" alt="slider1" class="user-image" />
                  <p>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star checked"></span>
                  <span class="fa fa-star"></span>
                  <span class="fa fa-star"></span>
                  </p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
        
                </div>
          </div>
            
      
    </div>

    
  </div>


<!-- Testimonial end here -->

 <!-- Banner 2 start here -->
 <br> <br>
 <div  class="container-fluid m-z">
    <div class="row m-z">
      <div class="col-sm-12 m-z">
          <img src="images/banner-3.jpg" class="img-responsive" />
      </div>
  </div>
  </div>

  <!-- Banner end here -->
  <br>
  <div class="container-fluid">
      <h4 class="section-title"><span>The vyora blog</span></h4>

  </div>
  <br><br>
  <div class="container">
  <div class="col-md-3 text-center">
      <img src="images/girl1.jpg" alt="slider1" class="blog-image" />
      
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
       <a href="" class="read-more">Read more...</a>
    </div>
    <div class="col-md-3 text-center">
        <img src="images/girl1.jpg" alt="slider1" class="blog-image" />
        
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
        <a href="" class="read-more pull-left">Read more...</a>
      </div>
      <div class="col-md-3 text-center">
          <img src="images/girl1.jpg" alt="slider1" class="blog-image" />
          
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
          <a href="" class="read-more">Read more...</a>
        </div>
        <div class="col-md-3 text-center">
            <img src="images/girl1.jpg" alt="slider1" class="blog-image" />
            
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At itaque debitis praesentium culpa dicta, quia assumenda consectetur quibusdam cupiditate libero. Minus ullam quam blanditiis explicabo. Corrupti sit fuga rem neque.</p>
            <a href="" class="read-more">Read more...</a>
          </div>
    </div>

<br><br><br>



<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top" class="pull-right">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
  
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>

</body>
</html>
