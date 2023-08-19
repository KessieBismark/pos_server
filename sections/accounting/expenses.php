<?php

if($action == "add_expenses"){
try{
    $sub =mysqli_real_escape_string($conn, $_POST['sub']);
    $amnt =mysqli_real_escape_string($conn, $_POST['amount']);
    $date =mysqli_real_escape_string($conn, $_POST['date']);
    $des =mysqli_real_escape_string($conn, $_POST['des']);
    $type =mysqli_real_escape_string($conn, $_POST['type']);
    $chq =mysqli_real_escape_string($conn, $_POST['cheque_no']);
    $date = date("Y-m-d", strtotime($date));
    $branch =mysqli_real_escape_string($conn, $_POST['branch']);
    // $cmd2 = "SELECT * FROM `income` WHERE  name='$name'";
    // $query = mysqli_query($conn,$cmd2);
    // $rows = mysqli_num_rows($query);
    //     if($rows > 0){
    //         echo $duplicate;
    //     }else{         
                $cmd = "INSERT INTO `expenses`(`sub_id`, `amount`, `date`,
                 `description`, `type`, `cheque_no`,`branch`) VALUES ((select id from exp_sub_category where name='$sub'),
                 '$amnt','$date','$des','$type','$chq','$branch');
                 ";
                $query3 = mysqli_query($conn,$cmd);
                if(!($query3)){
                    echo $failed;
                }else{
                    echo $true;
                }   
   // }
 } catch (Exception $e) {
        mysqli_close($conn);
        echo 'Exception error: ',  $e->getMessage(), "\n";
    }
}

if($action =="update_expenses"){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $sub =mysqli_real_escape_string($conn, $_POST['sub']);
        $amnt =mysqli_real_escape_string($conn, $_POST['amount']);
        $date =mysqli_real_escape_string($conn, $_POST['date']);
        $des =mysqli_real_escape_string($conn, $_POST['des']);
        $type =mysqli_real_escape_string($conn, $_POST['type']);
        $chq =mysqli_real_escape_string($conn, $_POST['cheque_no']);
        $date = date("Y-m-d", strtotime($date));
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);


        $cmd = "UPDATE `expenses` SET `sub_id`=(select id from exp_sub_category where name='$sub'),
        `amount`='$amnt',`date`='$date',`description`='$des',`branch`=(SELECT id FROM branches where name = '$branch'),
        `type`='$type',`cheque_no`='$chq'
        WHERE `id`='$id';";
        $query = mysqli_query($conn,$cmd);
        if($query){
            echo $true;
        }else{
            echo $query;
        }
     } catch (Exception $e) {
        mysqli_close($conn);
        echo 'Exception error: ',  $e->getMessage(), "\n";
    }
}


if($action =="delete_expenses"){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $cmd = "delete from `expenses` WHERE `id`='$id';";
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


if($action =="search_expenses"){
    try{
        $category =mysqli_real_escape_string($conn, $_POST['category']);
        $sub =mysqli_real_escape_string($conn, $_POST['sub']);
        $sdate =mysqli_real_escape_string($conn, $_POST['sdate']);
        $edate =mysqli_real_escape_string($conn, $_POST['edate']);
        $sdate = date("Y-m-d", strtotime($sdate));
        $edate = date("Y-m-d", strtotime($edate));
        if($category == "All" && $sub =="All"){
            $cmd = "SELECT e.id,c.name as category ,s.name as sub_category 
            ,e.amount,e.date,e.description,e.type,e.cheque_no,e.entry_date ,b.name as branch
            FROM `expenses` e INNER JOIN exp_sub_category s INNER JOIN in_category 
            c INNER join branches b on s.id = e.sub_id and s.cat_id = c.id and e.branch = b.id
            WHERE e.date BETWEEN '$sdate' and '$edate';";
        }else if($category == "All" && $sub !="All"){
            $cmd = "SELECT e.id,c.name as category ,s.name as sub_category 
            ,e.amount,e.date,e.description,e.type,e.cheque_no,e.entry_date ,b.name as branch
            FROM `expenses` e INNER JOIN exp_sub_category s INNER JOIN in_category 
            c INNER join branches b on s.id = e.sub_id and s.cat_id = c.id and e.branch = b.id
            WHERE s.name='$sub' and e.date BETWEEN '$sdate' and '$edate';";
        }else if($category != "All" && $sub =="All"){
            $cmd = "SELECT e.id,c.name as category ,s.name as sub_category 
            ,e.amount,e.date,e.description,e.type,e.cheque_no,e.entry_date ,b.name as branch
            FROM `expenses` e INNER JOIN exp_sub_category s INNER JOIN in_category 
            c INNER join branches b on s.id = e.sub_id and s.cat_id = c.id and e.branch = b.id
            WHERE c.name = '$category'  and e.date BETWEEN '$sdate' and '$edate';";
        }else{
            $cmd = "SELECT e.id,c.name as category ,s.name as sub_category 
            ,e.amount,e.date,e.description,e.type,e.cheque_no,e.entry_date ,b.name as branch
            FROM `expenses` e INNER JOIN exp_sub_category s INNER JOIN in_category 
            c INNER join branches b on s.id = e.sub_id and s.cat_id = c.id and e.branch = b.id
            WHERE c.name = '$category' and s.name='$sub' and e.date BETWEEN '$sdate' and '$edate';";
        }
        $query = mysqli_query($conn,$cmd);
        if(! $query ){
            echo $failed;
        }else{  
            while($view = mysqli_fetch_assoc($query)){
                $db_data[] = $view;
            }
            echo json_encode($db_data);
        }
    }catch(Exception $e){
        mysqli_close($conn);
        echo 'Exception error: ',  $e->getMessage(), "\n";
    }

}

if($action == "view_expenses"){
    $cmd = "SELECT e.id,c.name as category ,s.name as sub_category 
    ,e.amount,e.date,e.description,e.type,e.cheque_no,e.entry_date ,b.name as branch
    FROM `expenses` e INNER JOIN exp_sub_category s INNER JOIN in_category 
    c INNER join branches b on s.id = e.sub_id and s.cat_id = c.id and e.branch = b.id;";
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

if($action == "get_expenses_invoice"){
    $cmd = "SELECT max(id) as id FROM `expenses`;";
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