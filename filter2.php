<?php
  $date2f= $_REQUEST['date2f'];
  $date2t= $_REQUEST['date2t'];
  $subject2= $_REQUEST['subject2'];
  $fromtime2= $_REQUEST['fromtime2'];
  $totime2= $_REQUEST['totime2'];
  $year2= $_REQUEST['year2'];
  $division2= $_REQUEST['division2'];

  $con= mysqli_connect('localhost','root','','aeva_attendance');

  if($con){
      $q= "select * from $year2 where date BETWEEN '$date2f' AND '$date2t' AND subject LIKE '%$subject2%' AND from_time='$fromtime2' AND to_time='$totime2' AND division='$division2'";
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
