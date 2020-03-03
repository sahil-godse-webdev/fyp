<?php
	$from_date= $_REQUEST['from_date'];
	$to_date= $_REQUEST['to_date'];
	$roll_no= $_REQUEST['roll_no'];
	$year= $_REQUEST['yearr'];

	  //echo $branchyear;

	  $con= mysqli_connect('localhost','root','','aeva_attendance');

	  if($con){
	      $q= "select * from $year where roll_no='$roll_no' AND date BETWEEN '$from_date' AND '$to_date'";
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