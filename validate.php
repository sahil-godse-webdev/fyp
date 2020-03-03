<?php

    if(isset($_REQUEST['validate'])){
        $name= $_REQUEST['uname'];
        $pwd= $_REQUEST['vitpwd'];

        $con = mysqli_connect('localhost','root','','aeva_credentials');
        if($con){
            $q = "select * from professors where p_uname='$name' and p_pwd='$pwd'";
            $result = mysqli_query($con,$q);

            $res= mysqli_num_rows($result);
            if($res>=1){
                session_start();
                $_SESSION['uname']= $name;
                $_SESSION['typ']= 'prof';
                header('location: http://localhost/fyp/FYP/p_dashboard.php');
            }
            else{
                $q = "select * from students where s_uname='$name' and s_pwd='$pwd'";
                $result = mysqli_query($con,$q);

                $res = mysqli_num_rows($result);
                if($res >=1){
                    $_SESSION['uname']= $name;
                    $_SESSION['typ']= 'stud';
                    header('location: http://localhost/fyp/FYP/s_dashboard.html');
                }
                else{
                    echo "Invalid username or password";
                }
            }
        }
    }
?>
