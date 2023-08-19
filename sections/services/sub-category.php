<?php

if($action == "add_sub_category"){
try{
    $name =mysqli_real_escape_string($conn, $_POST['name']);
    $cat =mysqli_real_escape_string($conn, $_POST['sub']);

    $cmd2 = "SELECT * FROM `sub_category` WHERE  name='$name'";
    $query = mysqli_query($conn,$cmd2);
    $rows = mysqli_num_rows($query);
        if($rows >0){
            echo $duplicate;
        }else{         
                $cmd = "INSERT INTO `sub_category`( `name`,`cat_id`) VALUES ('$name',(select id from category where name='$cat'));";
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

if($action =="update_sub_category"){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $cat = mysqli_real_escape_string($conn, $_POST['sub']);

        $cmd = "UPDATE `sub_category` SET `name`='$name',`cat_id`= (select id from category where name='$cat') WHERE `id`='$id';";
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

if($action =="delete_sub_category" ){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $cmd = "delete from `sub_category` WHERE `id`='$id';";
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


if($action == "view_sub_category"){
    $cmd = "SELECT s.id, s.name,c.name as category from sub_category s INNER join category c on s.cat_id = c.id;";
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