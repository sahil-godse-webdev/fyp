<?php
    session_start();
    $tbl= $_REQUEST['year'];

    //$batch= $_SESSION['batch'];
    
    $con= mysqli_connect('localhost','root','','aeva_subjects');

    if($con){
        $q= "select * from $tbl";
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