<?php
  //echo "ready";
  session_start();
  $name = $_SESSION['uname'];

  $con= mysqli_connect('localhost','root','','aeva_attendance');

  if($con){
      $q= "select distinct(year) from subject_faculty where user_name= '$name'";
      $result = mysqli_query($con,$q);
      $arr=[];
      while($res= mysqli_fetch_array($result)){
          array_push($arr,$res);
      }
      echo json_encode($arr);
  }
  else{
      echo 'connection failed!!';
  }
 ?>
