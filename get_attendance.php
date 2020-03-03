<?php
  session_start();
  $name = $_SESSION['uname'];

  $branchyear= $_REQUEST['year'];

  $_SESSION['branchyear']= $_REQUEST['year'];

  //echo $branchyear;

  $con= mysqli_connect('localhost','root','','aeva_attendance');

  if($con){
      $q= "select * from $branchyear where professor_name='$name'";
      $result = mysqli_query($con,$q)or die("Database table might not exist");
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
