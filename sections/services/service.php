<?php

if($action == "add_service"){
try{
    $name =mysqli_real_escape_string($conn, $_POST['name']);
    $des =mysqli_real_escape_string($conn, $_POST['des']);
    $qty =mysqli_real_escape_string($conn, $_POST['quantity']);
    $cost =mysqli_real_escape_string($conn, $_POST['cost']);
    $price =mysqli_real_escape_string($conn, $_POST['price']);
    $sub =mysqli_real_escape_string($conn, $_POST['sub']);
    $branch =mysqli_real_escape_string($conn, $_POST['branch']);

    $cmd2 = "SELECT * FROM `services` WHERE  name='$name'";
    $query = mysqli_query($conn,$cmd2);
    $rows = mysqli_num_rows($query);
        if($rows >0){
            echo $duplicate;
        }else{         
                $cmd = "INSERT INTO `services`(`name`, `sub_category`, `description`, `unit_price`, `quantity`, `cost`,branch) 
                VALUES ('$name',(select id from sub_category where name='$sub'),'$des','$price',' $qty','$cost','$branch');";
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

if($action =="update_service"){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $name =mysqli_real_escape_string($conn, $_POST['name']);
        $des =mysqli_real_escape_string($conn, $_POST['des']);
        $qty =mysqli_real_escape_string($conn, $_POST['quantity']);
        $cost =mysqli_real_escape_string($conn, $_POST['cost']);
        $price =mysqli_real_escape_string($conn, $_POST['price']);
        $sub =mysqli_real_escape_string($conn, $_POST['sub']);
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);

        $cmd = " UPDATE `services` SET `name`='$name',`sub_category`=(select id from sub_category where name='$sub'),
        `description`='$des',`unit_price`='$price',`quantity`='$qty',`cost`='$cost', branch='$branch' WHERE `id`='$id';";
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

if($action =="delete_service" ){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $cmd = "delete from `services` WHERE `id`='$id';";
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

if($action == "view_service"){
    $branch =mysqli_real_escape_string($conn, $_POST['branch']);
    if($branch == 0){
        $cmd = "SELECT s.`id`, s.`name`, sc.name as sub_category,c.name as category,s.`description`,b.name as branch, b.id as bid,
        COALESCE(( (s.`quantity`)-COALESCE((select sum(quantity) from sales_details WHERE MONTH(date) =MONTH( CURRENT_DATE) 
        and service_id = s.id  ),0)),0) as quantity, s.`unit_price`, s.`cost` FROM `services` s
         INNER JOIN sub_category 
         sc INNER JOIN category c INNER JOIN branches b on s.sub_category = sc.id and sc.cat_id =c.id and b.id= s.branch ";
         $query = mysqli_query($conn,$cmd);
    }else{
        $cmd = "SELECT s.`id`, s.`name`, sc.name as sub_category,c.name as category,s.`description`,b.name as branch ,b.id as bid,
        COALESCE(( (s.`quantity`)-COALESCE((select sum(quantity) from sales_details WHERE MONTH(date) =MONTH( CURRENT_DATE) 
        and service_id = s.id and branch = '$branch' ),0)),0) as quantity, s.`unit_price`, s.`cost` FROM `services` s
         INNER JOIN sub_category 
         sc INNER JOIN category c  INNER JOIN branches b  on s.sub_category = sc.id and sc.cat_id =c.id and b.id= s.branch  where s.branch ='$branch'";
         $query = mysqli_query($conn,$cmd);
    }

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