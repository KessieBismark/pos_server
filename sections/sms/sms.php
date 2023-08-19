<?php

if($action == "add_sms"){
try{
    $rc =mysqli_real_escape_string($conn, $_POST['receiver']);
    $meg =mysqli_real_escape_string($conn, $_POST['meg']);
         
                $cmd = "INSERT INTO `sms`( `receiver`, `message`) 
                VALUES ('$rc','$meg');";
                $query3 = mysqli_query($conn,$cmd);
                if(!($query3)){
                    echo $failed;
                }else{
                    echo $true;
                }   
   
 } catch (Exception $e) {
        mysqli_close($conn);
        echo 'Exception error: ',  $e->getMessage(), "\n";
    }
}

if($action == "send_sms"){
    try{
        $rc =mysqli_real_escape_string($conn, $_POST['receiver']);
        $meg =mysqli_real_escape_string($conn, $_POST['meg']);
             $cmd2 = "Select * from customer where name = '$rc'";
             $q2 = mysqli_query($conn,$cmd2);
             $view = mysqli_fetch_assoc($q2);
             $contact = $view['contact'];
             
                    $cmd = "INSERT INTO `sms`( `receiver`, `message`) 
                    VALUES ('$rc','$meg');";
                    $query3 = mysqli_query($conn,$cmd);
                    if(!($query3)){
                        echo $failed;
                    }else{
                        echo $true;
                    }   
       
     } catch (Exception $e) {
            mysqli_close($conn);
            echo 'Exception error: ',  $e->getMessage(), "\n";
        }
    }


if($action == "view_sms"){
    $cmd = "SELECT * FROM `sms` WHERE 1;";
   $query = mysqli_query($conn,$cmd);
    if(! $query ){
        echo $failed;
    }else{  
        while($view = mysqli_fetch_assoc($query)){
            $db_data[] = $view;
        }
        echo json_encode($db_data);
    }
}

?>