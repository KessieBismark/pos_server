<?php

if($action=='assign_role'){
    try{
        $id = $_POST['u_id'];
        $per = $_POST['permission'];
        $cmd = "UPDATE `user` SET `access` = '$per' WHERE `user`.`id` = '$id'";
        $query = mysqli_query($conn,$cmd);
        if($query ){
            echo json_encode("true");
        }else{
            echo json_encode("false");
        }
    } catch (Exception $e) {
        mysqli_close($conn);
        echo 'Exception error: ',  $e->getMessage(), "\n";
    }
}


?>
