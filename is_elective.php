<?php

    $id= $_REQUEST['id'];
    session_start();
    $db= strtolower($_SESSION['sub_fetch']);

    //$batch= $_SESSION['batch'];
    
    $con= mysqli_connect('localhost','root','','aeva_subjects');

    if($con){
        $q= "select elective from $db where subject_name='$id'";
        $result= mysqli_query($con,$q);
        $arr=[];
        while($res= mysqli_fetch_array($result)){
            array_push($arr,$res);
        }
        echo json_encode($arr);
    }
?>