<?php
    include 'dbconnect.php';
    include 'server.php';
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
<form action="booking.php" method="post">
<div class="container bus-list">
<div id="bodyhead">
                <h1>Available Buses</h1>
                <h2>Journey Date - <?php   echo ($dateOfJourney = $_SESSION['dateOfJourney']); ?></h2>
            </div>
     <h3 class="color"> <?php echo $_SESSION['journeyFrom']; ?> To <?php echo $_SESSION['journeyTo']; ?> </h3> 
    <?php
    function time_taken($a,$b){
    $datetime1 = new DateTime('22-11-2019 '.$a);
$datetime2 = new DateTime('23-11-2019 '.$b);
$interval = $datetime1->diff($datetime2);
return $interval->format('%hh %im');
    }
?>
<table class="table table-hover bus-list-wrap">
        <thead>
          <tr>
            <th></th>
            <th>Departure</th>
            <th>Arrival</th>
            <th>Duration</th>
           
            <th>Price</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
         
          <?php

$journeyFrom = $_SESSION['journeyFrom'];
$journeyTo = $_SESSION['journeyTo']; 
$dateOfJourney = $_SESSION['dateOfJourney'];

if (!isset($_SESSION['selected_route_id']))
{
    $selected_route_id = "";
}else{
    $selected_route_id = $_SESSION['selected_route_id'];

}

$sql = "SELECT * from `time_table` WHERE departure_station = '$journeyFrom' AND arrival_station = '$journeyTo'";
$run = mysqli_query($db,$sql);

if(!$run)
    die("Unable to run query".mysqli_error($db));

$rows = mysqli_num_rows($run);
if($rows>0){
    while($data = mysqli_fetch_assoc($run)){

        $departure_station = $data['departure_station'];
        $arrival_station = $data['arrival_station'];


        if(($journeyFrom == $departure_station) && ($journeyTo == $arrival_station)){
          echo "<td> Jaiswal Holiday</td>";
          

            if(empty($data['departure_time'])){
                $departure_time = "--:-- AM";
            }else{
                $departure_time = date('h:i A', strtotime($data['departure_time']));
            }
            echo "<td>".$departure_time."</td>";

            if(empty($data['arrival_time'])){
                $arrival_time = "--:-- PM";
            }else{
                $arrival_time = date('h:i A', strtotime($data['arrival_time']));
            }
            echo "<td>".$arrival_time."</td>"; 
            echo "<td>".time_taken($departure_time,$arrival_time)."</td>"; 
            echo "<td>".$data['rent']."</td>";
            
            // rent Session
            $_SESSION['route_rent'] = $data['rent'];

                $query2 = "SELECT
                    `journey_date`,
                    COUNT(*) AS COUNT
                    FROM
                        book_detail
                    WHERE
                        `journey_date` = '$dateOfJourney' 
                    AND 
                        `route_id` = '$selected_route_id'
                    GROUP BY 
                        journey_date 
                    HAVING
                        COUNT(*) < 32";
                $result2 = mysqli_query($db,$query2) or die('Error: '.mysqli_error ($db));

                $no_rows = mysqli_num_rows($result2);
                //echo $no_rows;
                if($no_rows>0){
                    while($row = mysqli_fetch_assoc($result2)) {
                        $count = $row['COUNT'];
                        if ($count < "32") {
                            $availableNo = 32 - $count;
                            echo "<td>".$availableNo." Seat</td>";
                        } else {
                            echo "<td> Not Available </td>";
                        }
                    }
                }else{
                    echo "<td> 32 </td>";
                }
            echo "<td><input type='submit' class='custom-button' name='bookNow' value='Book Now'></td></tr>";
        }
        else if(($journeyFrom != $departure_station) && ($journeyTo != $arrival_station)) {
            echo ("No data available in table.");
        }
    }
}
else{
        echo "<td colspan='6'> No data found </td> <br/>";
    }
?>
         
        </tbody>
      </table>
    </div>
    </form>
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
