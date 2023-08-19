<?php
if($action== 'view_income_category'){
$cmd = "SELECT * FROM `in_category`";
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


if($action== 'view_income_entry_total'){
 $category = mysqli_real_escape_string($conn, $_POST['category']);
     $date =mysqli_real_escape_string($conn, $_POST['date']);
     $date = date("Y-m-d", strtotime($date));  
     $branch =mysqli_real_escape_string($conn, $_POST['branch']);
    $cmd = "SELECT 
    COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 1 WEEK) and branch = '$branch' AND
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as first_week, 
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
     WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 2 WEEK) and branch ='$branch' AND 
      sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as sec_week, 
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 3 WEEK) and branch = '$branch' AND  
    sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as third_week, 
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
     WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 4 WEEK) and branch ='$branch'  AND 
      sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as fourth_week, 
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEARWEEK(date) = YEARWEEK('$date' ) and branch ='$branch'   AND 
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as fifth_week 
   ";
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


if($action== 'view_income_entry'){
    $branch =mysqli_real_escape_string($conn, $_POST['branch']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date =mysqli_real_escape_string($conn, $_POST['date']);
    $date = date("Y-m-d", strtotime($date));  
   // $date = "2022-11-30";
    $cmd = "SELECT s.name,
    COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEARWEEK(i.date) = YEARWEEK('$date' - INTERVAL 1 WEEK) and i.branch =
   '$branch' AND s.cat_id = (select id from in_category where name= '$category'))
     ,0) as first_week, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id
     WHERE YEARWEEK(i.date) = YEARWEEK('$date' - INTERVAL 2 WEEK)and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as sec_week, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEARWEEK(i.date) = YEARWEEK('$date' - INTERVAL 3 WEEK)and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as third_week, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id
     WHERE YEARWEEK(i.date) = YEARWEEK('$date' - INTERVAL 4 WEEK)and i.branch =
     '$branch' AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as fourth_week, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEARWEEK(i.date) = YEARWEEK('$date') and i.branch =
    '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as fifth_week 
     FROM `income` i INNER JOIN in_sub_category s on i.sub_id= s.id WHERE s.cat_id= 
     (select id from in_category where name= '$category') GROUP BY s.id;";
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



    if($action== 'view_expenses_category'){
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


//sub expenses
        if($action== 'view_expenses_entry'){
            $branch =mysqli_real_escape_string($conn, $_POST['branch']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $date =mysqli_real_escape_string($conn, $_POST['date']);
         $date = date("Y-m-d", strtotime($date));  
           // $date = "2022-11-30";
            $cmd = "SELECT s.name,
            COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE YEARWEEK(i.date) = YEARWEEK('$date' - INTERVAL 1 WEEK) and i.branch 
            = '$branch' AND s.cat_id = (select id from exp_category where name= '$category'))
             ,0) as first_week, 
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id
             WHERE YEARWEEK(i.date) = YEARWEEK('$date' - INTERVAL 2 WEEK) and i.branch
              ='$branch' AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as sec_week, 
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE YEARWEEK(i.date) = YEARWEEK('$date' - INTERVAL 3 WEEK) and i.branch
             = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as third_week, 
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id
             WHERE YEARWEEK(i.date) = YEARWEEK('$date' - INTERVAL 4 WEEK) and i.branch
              ='$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as fourth_week, 
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE YEARWEEK(i.date) = YEARWEEK('$date') and i.branch = '$branch' AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as fifth_week 
             FROM `expenses` i INNER JOIN exp_sub_category s on i.sub_id= s.id WHERE s.cat_id= 
             (select id from exp_category where name= '$category') GROUP BY s.id;";
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

//     //expenses sub total
    if($action== 'view_expenses_entry_total'){
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);
                $category = mysqli_real_escape_string($conn, $_POST['category']);
                $date =mysqli_real_escape_string($conn, $_POST['date']);
                $date = date("Y-m-d", strtotime($date));  
               // $date = "2022-11-30";
                $cmd = "SELECT 
                COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 1 WEEK) and branch 
                = '$branch' AND
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category  
                 c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as first_week, 
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                 WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 2 WEEK) and branch 
                 ='$branch' AND 
                  sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                   c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as sec_week, 
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 3 WEEK) and branch 
                = '$branch' AND  
                sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                 c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as third_week, 
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                 WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 4 WEEK) and branch 
                 ='$branch' AND 
                  sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category
                    c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as fourth_week, 
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEARWEEK(date) = YEARWEEK('$date') and branch 
                = '$branch'  AND 
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                  c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as fifth_week 
               ";
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
            


// // all income total
    if($action == 'income_total'){
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);
        $date =mysqli_real_escape_string($conn, $_POST['date']);
        $date = date("Y-m-d", strtotime($date));  
        $cmd = "SELECT 
        COALESCE( 
        (SELECT SUM(`amount`) FROM income 
        WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 1 WEEK) 
        and branch = '$branch' )
         ,0) as first_week, 
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
         WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 2 WEEK) 
         and branch = '$branch')
         ,0) as sec_week, 
         COALESCE( 
        (SELECT SUM(`amount`) FROM income 
        WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 3 WEEK) 
        and branch ='$branch' )
         ,0) as third_week, 
         COALESCE( 
        (SELECT SUM(`amount`) FROM income 
         WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 4 WEEK)
          and branch ='$branch' )
         ,0) as fourth_week, 
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
        WHERE YEARWEEK(date) = YEARWEEK('$date') and branch 
        ='$branch' )
         ,0) as fifth_week 
        ;";
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

//     //income + cash balance
    if($action == 'income_cash_total'){
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);
        $date =mysqli_real_escape_string($conn, $_POST['date']);
        $year =mysqli_real_escape_string($conn, $_POST['year']);
        $month =mysqli_real_escape_string($conn, $_POST['month']);
        $date = date("Y-m-d", strtotime($date));  
        $cmd = "SELECT 
        ( COALESCE( 
         (SELECT SUM(`amount`) FROM income 
         WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 1 WEEK) 
         and branch ='$branch' )
          ,0) + COALESCE((SELECT amount FROM cash_balance_month WHERE 
           year='$year' and month= '$date'  and week =1 and branch 
           ='$branch'),0.0)) as first_week, 
          (COALESCE( 
         (SELECT SUM(`amount`) FROM income
          WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 2 WEEK) 
          and branch = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance_month WHERE 
           year='$year' and month= '$month'  and week =2  and branch 
           ='$branch' ),0.0)) as sec_week, 
         ( COALESCE( 
         (SELECT SUM(`amount`) FROM income 
         WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 3 WEEK) 
         and branch ='$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance_month WHERE 
           year='$year' and month= '$month'  and week =3 and branch 
           ='$branch' ),0.0)) as third_week, 
          (COALESCE( 
         (SELECT SUM(`amount`) FROM income 
          WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 4 WEEK) 
          and branch = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance_month WHERE 
           year='$year' and month= '$month'  and week =4 and branch
            ='$branch' ),0.0)) as fourth_week, 
         ( COALESCE( 
         (SELECT SUM(`amount`) FROM income
         WHERE YEARWEEK(date) = YEARWEEK('$date') and branch 
         = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance_month 
          WHERE  year='$year'  and week =4 and month= '$month' 
          and branch ='$branch' ),0.0)) as fifth_week 
         ;";
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
    
    //all expenses total
        if($action == 'expenses_total'){
            $branch =mysqli_real_escape_string($conn, $_POST['branch']);
            $date =mysqli_real_escape_string($conn, $_POST['date']);
            $date = date("Y-m-d", strtotime($date));  
            $cmd = "SELECT 
            COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
            WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 1 WEEK)
             and branch ='$branch')
             ,0) as first_week, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
             WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 2 WEEK)
              and branch ='$branch' )
             ,0) as sec_week, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
            WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 3 WEEK) 
            and branch =(select id from branches where name = '$branch') )
             ,0) as third_week, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
             WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 4 WEEK)
              and branch =(select id from branches where name = '$branch') )
             ,0) as fourth_week, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEARWEEK(date) = YEARWEEK('$date') and branch
             =(select id from branches where name = '$branch') )
             ,0) as fifth_week 
            ;";
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

     if($action == 'end_cash'){
                $branch =mysqli_real_escape_string($conn, $_POST['branch']);
                $date =mysqli_real_escape_string($conn, $_POST['date']);
                $date = date("Y-m-d", strtotime($date));  
                $year =mysqli_real_escape_string($conn, $_POST['year']);
                $month =mysqli_real_escape_string($conn, $_POST['month']);
                $cmd = "SELECT 
               ( 
                COALESCE( 
         (SELECT SUM(`amount`) FROM income 
         WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 1 WEEK) 
         and branch ='$branch' )
          ,0) + COALESCE((SELECT amount FROM cash_balance_month WHERE 
           year='$year' and month= '$date'  and week =1 and branch 
           ='$branch' ),0.0)
                 
                  - COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
            WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 1 WEEK) 
            and branch ='$branch' )
             ,0)) as first_week, 
                 (
                    COALESCE( 
         (SELECT SUM(`amount`) FROM income
          WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 2 WEEK) 
          and branch = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance_month WHERE 
           year='$year' and month= '$month'  and week =2  and branch 
           ='$branch'),0.0)
                 
                 -  COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
             WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 2 WEEK) 
             and branch ='$branch' )
             ,0)) as sec_week, 
                ( 
                    
                    COALESCE( 
         (SELECT SUM(`amount`) FROM income 
         WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 3 WEEK) 
         and branch ='$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance_month WHERE 
           year='$year' and month= '$month'  and week =3 and branch 
           ='$branch'),0.0)
                 
                 - COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
            WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 3 WEEK) 
            and branch = = '$branch' )
             ,0)) as third_week, 
                 (
                    COALESCE( 
         (SELECT SUM(`amount`) FROM income 
          WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 4 WEEK) 
          and branch = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance_month WHERE 
           year='$year' and month= '$month'  and week =4 and branch
            = '$branch' ),0.0)
                 
                 - COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
             WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 4 WEEK) 
             and branch = '$branch' )
             ,0)) as fourth_week, 
                ( COALESCE( 
         (SELECT SUM(`amount`) FROM income
         WHERE YEARWEEK(date) = YEARWEEK('$date') and branch 
         ='$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance_month 
          WHERE  year='$year'  and week =4 and month= '$month' 
          and branch = '$branch'),0.0) - COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEARWEEK(date) = YEARWEEK('$date') and 
            branch = '$branch' )
             ,0)) as fifth_week 
                ;";
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



// // income - expenses as net cash
            if($action == 'net_cash'){
                $branch =mysqli_real_escape_string($conn, $_POST['branch']);
                $date =mysqli_real_escape_string($conn, $_POST['date']);
                $date = date("Y-m-d", strtotime($date));  
                $year =mysqli_real_escape_string($conn, $_POST['year']);
                $month =mysqli_real_escape_string($conn, $_POST['month']);
                $cmd = "SELECT 
               ( 
                COALESCE( 
                (SELECT SUM(`amount`) FROM income 
                WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 1 WEEK)
                 and branch = '$branch')
                 ,0)
                 
                  - COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
            WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 1 WEEK) 
            and branch = '$branch' )
             ,0)) as first_week, 
                 (COALESCE( 
                (SELECT SUM(`amount`) FROM income
                 WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 2 WEEK)
                  and branch = '$branch' )
                 ,0)-  COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
             WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 2 WEEK) 
             and branch = '$branch' )
             ,0)) as sec_week, 
                ( COALESCE( 
                (SELECT SUM(`amount`) FROM income 
                WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 3 WEEK)
                 and branch ='$branch' )
                 ,0)- COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
            WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 3 WEEK) 
            and branch ='$branch' )
             ,0)) as third_week, 
                 (COALESCE( 
                (SELECT SUM(`amount`) FROM income 
                 WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 4 WEEK) 
                 and branch ='$branch' )
                 ,0)- COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
             WHERE YEARWEEK(date) = YEARWEEK('$date' - INTERVAL 4 WEEK) 
             and branch = '$branch' )
             ,0)) as fourth_week, 
                ( COALESCE( 
                (SELECT SUM(`amount`) FROM income
                WHERE YEARWEEK(date) = YEARWEEK('$date') 
                and branch ='$branch' )
                 ,0) - COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEARWEEK(date) = YEARWEEK('$date') and 
            branch ='$branch' )
             ,0)) as fifth_week 
                ;";
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


    
    if($action=='cash_balance'){
      try{
        $year =mysqli_real_escape_string($conn, $_POST['year']);
        $month =mysqli_real_escape_string($conn, $_POST['month']);
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);
        //  $year =2022;
        // $month = 11;
        //  $branch = 1;
        $i= 1;
        $cmd3 = "delete from cash_balance_month where year='$year' 
        and month='$month' and branch ='$branch'";
        $q2 = mysqli_query($conn,$cmd3);
      
        $old_amt = 0.00;
        $new_amt = 0.00;
        foreach (getMondays($year, $month) as $monday) {
         
            $saveDate= $monday->format("Y-m-d\n"); 
         
            if($i==1){  
                $old_date = $saveDate;
                $mm = $month -1;
                    if($mm <1 ){
                            $mm = 12;
                            $yy = $year -1;
                            $sql = "select * from cash_balance_month where year='$yy' and month='$mm' and week =(select MAX(week)
                             from cash_balance_month where year='$yy' and month='$mm' and branch ='$branch')
                             and branch ='$branch' ";
                            $qSql = mysqli_query($conn,$sql);
                            $rows = mysqli_num_rows($qSql);
                            if($rows > 0 ){
                                 $view = mysqli_fetch_assoc($qSql);
                                $new_amt = $view['amount'];
                                $cmd = "INSERT INTO `cash_balance_month`(`amount`, `week`, `date`, `year`, 
                                `month`,`branch`) VALUES ('$new_amt',
                                '$i','$saveDate','$year','$month','$branch')";
                                $query = mysqli_query($conn,$cmd);
                                $old_amt = $new_amt;
                            }else{
                                        $cmd = "INSERT INTO `cash_balance_month`(`amount`, `week`, `date`, `year`, 
                                        `month`,`branch`) VALUES ('0.0',
                                        '$i','$saveDate','$year','$month', '$branch')";
                                    $query = mysqli_query($conn,$cmd);
                                    $old_amt = 0.0;    
                            }
                    }else{
                        $sql = "select * from cash_balance_month where year='$year' and month='$mm' and week =(select MAX(week)
                        from cash_balance_month where year='$year' and month='$mm' and branch ='$branch')
                        and branch ='$branch' ";
                        $qSql = mysqli_query($conn,$sql);
                        $rows = mysqli_num_rows($qSql);
                        if($rows > 0 ){
                            $view = mysqli_fetch_assoc($qSQL);
                            $new_amt = $view['amount'];
                            $cmd = "INSERT INTO `cash_balance_month`(`amount`, `week`, `date`, `year`, 
                            `month`,`branch`) VALUES ('$new_amt',
                            '$i','$saveDate','$year','$month','$branch')";
                        }else{   
                            $cmd = "INSERT INTO `cash_balance_month`(`amount`, `week`, `date`, `year`, 
                            `month`,`branch`) VALUES ('0.0',
                            '$i','$saveDate','$year','$month','$branch')";
                        }
                    
                        $query = mysqli_query($conn,$cmd);
                        $old_amt = 0.0;
                        }
                        $i = $i +1;

                }else{

            
                        $cmd3 = "SELECT (COALESCE(
                            (SELECT (amount) from cash_balance_month where id= 
                                            (SELECT MAX(id) FROM cash_balance_month WHERE year='$year' and  week= '$i'
                                            and branch ='$branch' )),0.0)
                            +    
                                             COALESCE( 
                                                (SELECT SUM(`amount`) FROM income 
                                                WHERE YEARWEEK(date) = YEARWEEK('$old_date') and branch = '$branch' )
                                                ,0))                 
                                                -
                                                    COALESCE( 
                                                    (SELECT SUM(`amount`) FROM expenses
                                                    WHERE YEARWEEK(date) = YEARWEEK('$old_date')  and branch = '$branch')
                                                    ,0) as amount";
                        $q3 = mysqli_query($conn,$cmd3);
                        $view = mysqli_fetch_assoc($q3);
                        $new_amt = $view['amount'];
                 
                        if($new_amt > 0.00){
                            $old_amt = $new_amt;
                         }  

                        $cmd2 = "INSERT INTO `cash_balance_month`(`amount`, `week`, `date`, `year`, 
                        `month`,`branch`) VALUES ('$old_amt',
                        '$i','$saveDate','$year','$month','$branch'
                    )";
                    $query2 = mysqli_query($conn,$cmd2);
                    $old_date = $saveDate;
                    $i = $i +1;

                    }
              
                    }
                    $fcmd ="SELECT (SELECT amount from cash_balance_month WHERE year = '$year' AND month='$month' AND week = 1 and branch ='$branch' ) as first_week,
                    (SELECT amount from cash_balance_month WHERE year = '$year' AND month='$month' AND week = 2 AND branch = '$branch' ) as sec_week,
                    (SELECT amount from cash_balance_month WHERE year = '$year' AND month='$month' AND week = 3 and branch = '$branch' ) as third_week,
                    (SELECT amount from cash_balance_month WHERE year = '$year' AND month='$month' AND week = 4 and branch ='$branch' ) as fourth_week,
                    (SELECT amount from cash_balance_month WHERE year = '$year' AND month='$month' AND week = 4 and branch ='$branch' ) as fifth_week
                    
                    "; 
                    $query = mysqli_query($conn,$fcmd);
                    if(! $query ){
                        echo $failed;
                    }else{  
                        while($view = mysqli_fetch_assoc($query)){
                            $db_data[] = $view;
                        }
                        echo json_encode($db_data);
                    }
            
        }catch (Exception $e) {
            mysqli_close($conn);
            echo 'Exception error: ',  $e->getMessage(), "\n";
         }
  }
    
?>