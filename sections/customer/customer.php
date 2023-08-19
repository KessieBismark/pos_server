<?php

if($action == "add_customer"){
try{
    $name =mysqli_real_escape_string($conn, $_POST['name']);
    $email =mysqli_real_escape_string($conn, $_POST['email']);
    $contact =mysqli_real_escape_string($conn, $_POST['contact']);
    $address =mysqli_real_escape_string($conn, $_POST['address']);
    $discount =mysqli_real_escape_string($conn, $_POST['discount']);

    $cmd2 = "SELECT * FROM `customer` WHERE  name='$name' and contact='$contact'";
    $query = mysqli_query($conn,$cmd2);
    $rows = mysqli_num_rows($query);
        if($rows > 0){
            echo $duplicate;
        }else{         
                $cmd = "INSERT INTO `customer`(`name`, `email`, `contact`,
                 `address`, `discount`) VALUES ('$name',
                 '$email','$contact','$address','$discount');";
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

if($action =="update_customer"){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name =mysqli_real_escape_string($conn, $_POST['name']);
        $email =mysqli_real_escape_string($conn, $_POST['email']);
        $contact =mysqli_real_escape_string($conn, $_POST['contact']);
        $address =mysqli_real_escape_string($conn, $_POST['address']);
        $discount =mysqli_real_escape_string($conn, $_POST['discount']);

        $cmd = "UPDATE `customer` SET `name`='$name',
        `email`='$email',`contact`='$contact',`address`='$address',
        `discount`='$discount'
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


if($action =="delete_customer"){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $cmd = "delete from `customer` WHERE `id`='$id';";
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

if($action == "view_customer"){
    $cmd = "SELECT * FROM `customer`;";
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