<?php
include 'dbconnect.php';


function time_taken($a,$b){
    $date1=date_create($a);
    $date2=date_create($b);
    $interval=date_diff($date1,$date2);
    return $interval->format("%R");;
}
if($_GET['endpoint']=='get_promocode'){
    $user_code=$_GET['code'];
    $query = "SELECT * FROM promocode where `code_name`='$user_code' AND `status`=1";
    
    $result = mysqli_query($db, $query);
    $all_coupon = array();
    while($row = mysqli_fetch_assoc($result)){
      $all_coupon[] = $row;
    }
   $db_coupon=json_encode($all_coupon);
   $today_date=date('Y-m-d');
  // echo $today_date;
  if(sizeof($all_coupon)==1){

    $exp_date=$all_coupon[0]['exp_date'];

   $mydate=time_taken($today_date,$exp_date);
    if($mydate=='+'){
        echo $all_coupon[0]['instant_discount'];
    }
    else{
        header("HTTP/1.1 400 OK");
        echo "Promocode has been expired!";
    }

   
  }
 
  else{
    header("HTTP/1.1 400 OK");
      echo "Invalid Code";
  }
}


?>