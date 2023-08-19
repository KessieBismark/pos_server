<?php

if($action == "add_api"){
try{
    $api =mysqli_real_escape_string($conn, $_POST['api']);
    $header =mysqli_real_escape_string($conn, $_POST['header']);


    $cmd2 = "delete  FROM `sms_api` WHERE 1 ";
    $query = mysqli_query($conn,$cmd2);
       
                $cmd = "INSERT INTO `sms_api`( `api`, `header`) 
                VALUES ('$api','$header');";
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


if($action == "view_api"){
    $cmd = "SELECT * FROM `sms_api` WHERE 1;";
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