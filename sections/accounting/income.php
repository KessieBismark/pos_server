<?php

if($action == "add_income"){
try{
    $sub =mysqli_real_escape_string($conn, $_POST['sub']);
    $amnt =mysqli_real_escape_string($conn, $_POST['amount']);
    $date =mysqli_real_escape_string($conn, $_POST['date']);
    $des =mysqli_real_escape_string($conn, $_POST['des']);
    $type =mysqli_real_escape_string($conn, $_POST['type']);
    $chq =mysqli_real_escape_string($conn, $_POST['cheque_no']);
    $branch =mysqli_real_escape_string($conn, $_POST['branch']);
    $date = date("Y-m-d", strtotime($date));
    // $cmd2 = "SELECT * FROM `income` WHERE  name='$name'";
    // $query = mysqli_query($conn,$cmd2);
    // $rows = mysqli_num_rows($query);
    //     if($rows > 0){
    //         echo $duplicate;
    //     }else{         
                $cmd = "INSERT INTO `income`(`sub_id`, `amount`, `date`,
                 `description`, `type`, `cheque_no`,`branch`) VALUES ((select id from in_sub_category where name='$sub'),
                 '$amnt','$date','$des','$type','$chq','$branch');";
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

if($action =="update_income"){
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
        
        $cmd = "UPDATE `income` SET `sub_id`=(select id from in_sub_category where name='$sub'),
        `amount`='$amnt',`date`='$date',`description`='$des',`branch`=(SELECT id FROM branches where name = '$branch'), 
        `type`='$type',`cheque_no`='$chq' WHERE `id`='$id';";
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

if($action =="search_income"){
    try{
        $category =mysqli_real_escape_string($conn, $_POST['category']);
        $sub =mysqli_real_escape_string($conn, $_POST['sub']);
        $sdate =mysqli_real_escape_string($conn, $_POST['sdate']);
        $edate =mysqli_real_escape_string($conn, $_POST['edate']);
        $sdate = date("Y-m-d", strtotime($sdate));
        $edate = date("Y-m-d", strtotime($edate));
        if($category == "All" && $sub =="All"){
            $cmd = "SELECT i.id,c.name as category ,s.name as sub_category 
            ,i.amount,i.date,i.description,i.type,i.cheque_no,i.entry_date, b.name as branch 
            FROM `income` i INNER JOIN in_sub_category s INNER JOIN in_category 
            c INNER JOIN branches b on s.id = i.sub_id and s.cat_id = c.id and i.branch = b.id 
            WHERE i.date BETWEEN '$sdate' and '$edate';";
        }else if($category == "All" && $sub !="All"){
            $cmd = "SELECT i.id,c.name as category ,s.name as sub_category 
            ,i.amount,i.date,i.description,i.type,i.cheque_no,i.entry_date, b.name as branch 
            FROM `income` i INNER JOIN in_sub_category s INNER JOIN in_category 
            c INNER JOIN branches b on s.id = i.sub_id and s.cat_id = c.id and i.branch = b.id 
            WHERE s.name='$sub' and i.date BETWEEN '$sdate' and '$edate';";
        }else if($category != "All" && $sub =="All"){
            $cmd = "SELECT i.id,c.name as category ,s.name as sub_category 
            ,i.amount,i.date,i.description,i.type,i.cheque_no,i.entry_date, b.name as branch 
            FROM `income` i INNER JOIN in_sub_category s INNER JOIN in_category 
            c INNER JOIN branches b on s.id = i.sub_id and s.cat_id = c.id and i.branch = b.id 
            WHERE c.name = '$category'  and i.date BETWEEN '$sdate' and '$edate';";
        }else{
            $cmd = "SELECT i.id,c.name as category ,s.name as sub_category 
            ,i.amount,i.date,i.description,i.type,i.cheque_no,i.entry_date, b.name as branch 
            FROM `income` i INNER JOIN in_sub_category s INNER JOIN in_category 
            c INNER JOIN branches b on s.id = i.sub_id and s.cat_id = c.id and i.branch = b.id 
            WHERE c.name = '$category' and s.name='$sub' and i.date BETWEEN '$sdate' and '$edate';";
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


if($action =="delete_income"){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $cmd = "delete from `income` WHERE `id`='$id';";
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

if($action == "view_income"){
    $cmd = "SELECT i.id,c.name as category ,s.name as sub_category 
    ,i.amount,i.date,i.description,i.type,i.cheque_no,i.entry_date, b.name as branch 
    FROM `income` i INNER JOIN in_sub_category s INNER JOIN in_category 
    c INNER JOIN branches b on s.id = i.sub_id and s.cat_id = c.id and i.branch = b.id;";
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


if($action == "get_income_invoice"){
    $cmd = "SELECT max(id) as id FROM `income`;";
    $stmt = mysqli_stmt_init($conn);
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

if($action == "close_sales"){
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $cmd = "SELECT DISTINCT YEAR(date) as year , 
    MONTH(date) as month from sales where 
     YEAR(date) not in (select year from 
     closed_month WHERE branch =(SELECT id
      from branches WHERE name = '$branch') ) and 
       MONTH(date) not in (select month from
        closed_month WHERE branch =(SELECT 
        id from branches WHERE name = '$branch') )  and branch = (SELECT 
        id from branches WHERE name = '$branch') and YEAR(date) <= YEAR(CURRENT_DATE) and  
    MONTH(date) <> MONTH(CURRENT_DATE) ;";
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

if($action == "view_closed_sales"){
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    $cmd = "select year, month from closed_month where branch = '$branch';";
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



if($action =="calculate_sales"){
    try{
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $month =mysqli_real_escape_string($conn, $_POST['month']);
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);

        $month_name = date("F",mktime(0,0,0,$month,10));
        // $date =   date("Y-m-d", strtotime("$year-$month-28"));
       
            $i= 1;
        foreach (getMondays($year, $month) as $monday) {
            $saveDate= $monday->format("Y-m-d\n");        
                $cmd = "INSERT INTO `income`(`sub_id`, `amount`, `date`,
                `description`, `type`,`branch`) VALUES 
                ('4',
                (SELECT( COALESCE(   (SELECT SUM(payment- balance) from sales WHERE Year(date) = '$year' and MONTH(date)='$month'
            AND branch = (SELECT id from branches WHERE name = '$branch') and YEARWEEK(date) 
            = YEARWEEK('$saveDate')),0.0))),
                '$saveDate','Total sales in week $i of $month_name $year','Cash',(SELECT id
                from branches WHERE name = '$branch'));";
                $query = mysqli_query($conn,$cmd);
          $i = $i+1;
        }
        if($query){
            $cmd2 = "INSERT INTO `closed_month`( `year`, `month`, `branch`) 
            VALUES ('$year','$month',(SELECT id from branches WHERE name = '$branch'))";
            $q2 = mysqli_query($conn,$cmd2);
            echo $true;
        }else{
            echo $query;
        }
     } catch (Exception $e) {
        mysqli_close($conn);
        echo 'Exception error: ',  $e->getMessage(), "\n";
    }
}
?>