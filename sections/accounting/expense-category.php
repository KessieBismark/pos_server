<?php

if($action == "add_exp_category"){
try{
    $name =mysqli_real_escape_string($conn, $_POST['name']);
    $des =mysqli_real_escape_string($conn, $_POST['des']);

    $cmd2 = "SELECT * FROM `exp_category` WHERE  name='$name'";
    $query = mysqli_query($conn,$cmd2);
    $rows = mysqli_num_rows($query);
        if($rows >0){
            echo $duplicate;
        }else{         
                $cmd = "INSERT INTO `exp_category`(`name`,`description`)
                 VALUES ('$name','$des');";
                $query3 = mysqli_query($conn,$cmd);
                if(!($query3)){
                    echo $failed;
                }else{
                    echo $true;
                }   
    }
 } catch (Exception $e) {
        mysqli_close($conn);
        echo 'Exception error: ',  $e->getMessage(), "\n";
    }
}

if($action =="update_exp_category"){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $des = mysqli_real_escape_string($conn, $_POST['des']);

        $cmd = "UPDATE `exp_category` SET `name`='$name',`description`='$des'
         WHERE `id`='$id';";
        $query = mysqli_query($conn,$cmd);
        if($query){
            echo $true;
        }else{
            echo $false;
        }
     } catch (Exception $e) {
        mysqli_close($conn);
        echo 'Exception error: ',  $e->getMessage(), "\n";
    }
}


if($action =="delete_exp_category" ){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $cmd = "delete from `exp_category` WHERE `id`='$id';";
        $query = mysqli_query($conn,$cmd);
        if($query){
            echo $true;
        }else{
            echo $false;
        }
     } catch (Exception $e) {
        mysqli_close($conn);
        echo 'Exception error: ',  $e->getMessage(), "\n";
    }
}

if($action == "view_exp_category"){
    $cmd = "SELECT * FROM `exp_category`";
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