<?php

    $codeword= $_REQUEST['id'];
    //echo strlen($codeword);

    $word= explode('-',$codeword);
    //print_r($word);
    //console.log($word);
    $branch= $word[0];
    $year= $word[1];
    $semester= $word[2];
    $division= $word[3];
    $batch= $word[4];
    $type_of_lecture= $word[5];
    $id= $branch.$year;
    $id= strtolower($id);
    session_start();
    $_SESSION['attendance_db']=$id;
    $sub_fetch= $branch.$year.$semester;

    $con= mysqli_connect('localhost','root','','aeva_students');
    if($batch!=''){
        //session_start();
        $_SESSION['sub_fetch']= $sub_fetch;
        $_SESSION['batch']= $batch;
        $_SESSION['lorp']= 'P';
        $_SESSION['type_of_lecture']= 'NA';
        $_SESSION['division']= $division;

        $q= "select * from $id where batch=$batch and division='$division'";
        $result= mysqli_query($con,$q);
        if (!$result) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
        }
        $arr=[];
        while($res= mysqli_fetch_array($result)){
            array_push($arr,$res);
        }
        echo json_encode($arr);
    }
    else{
        if($type_of_lecture=='compulsory'){
            //session_start();
            $_SESSION['sub_fetch']= $sub_fetch;
            $_SESSION['lorp']= 'L';
            $_SESSION['division']= $division;

            $q= "select * from $id where division='$division'";
            $result= mysqli_query($con,$q);
            $arr=[];
            while($res= mysqli_fetch_array($result)){
                array_push($arr,$res);
            }
            echo json_encode($arr);
        }
        elseif($type_of_lecture=='DLE'||$type_of_lecture=='ILE'){
            //session_start();
            $_SESSION['type_of_lecture']=$type_of_lecture;
            $_SESSION['sub_fetch']= $sub_fetch;
            $_SESSION['division']= $division;

            //echo $type_of_lecture;
            $q= "select * from $id";
            $result= mysqli_query($con,$q);
            $arr=[];
            while($res= mysqli_fetch_array($result)){
                array_push($arr,$res);
            }
            echo json_encode($arr);
        }

    }
?>
