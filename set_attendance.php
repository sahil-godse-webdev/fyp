<?php
    session_start();

    $roll = $_REQUEST['roll_no'];
    $sub = $_REQUEST['subject'];
    $prof = $_REQUEST['professor_name'];
    $hours = $_REQUEST['no_of_hours'];
    $date = $_REQUEST['date'];
    $from = $_REQUEST['from_time'];
    $to = $_REQUEST['to_time'];
    $marked_by = $_SESSION['uname'];

    $id= $_SESSION['attendance_db'];
    //echo $id;
    $con= mysqli_connect('localhost','root','','aeva_attendance');

    if($con){
        $q= "select * from $id where roll_no='$roll' and subject='$sub' and professor_name='$marked_by' and no_of_hours!=$hours and date='$date' and from_time='$from' and to_time='$to'";
        $res= mysqli_query($con,$q);
        $num= mysqli_num_rows($res);
        $division= $_SESSION['division'];
        if($num>=1){
            //echo "Want to mark absent?";
            $q= "UPDATE $id
                SET no_of_hours= $hours
                WHERE roll_no='$roll' and subject='$sub' and professor_name='$marked_by' and no_of_hours!=$hours and date='$date' and from_time='$from' and to_time='$to'
            ";
            mysqli_query($con,$q);
            echo "Updated Successful!!";
        }
        else{
            $division= $_SESSION['division'];
            $q= "select * from $id where roll_no='$roll' and subject='$sub' and professor_name='$marked_by' and no_of_hours=$hours and date='$date' and from_time='$from' and to_time='$to'";
            $res= mysqli_query($con,$q);
            $num= mysqli_num_rows($res);
            if($num>=1){
                echo "Already Marked!";
            }
            else{
                $q="insert into $id (roll_no,subject, professor_name, no_of_hours, division, date, from_time, to_time) values('$roll','$sub','$marked_by',$hours,'$division','$date','$from','$to')";
                mysqli_query($con,$q);
                echo'added';
            }
        }
    }
?>
