<?php
if($action== 'view_year_income_category'){
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



if($action== 'view_year_income_entry_total'){
 $category = mysqli_real_escape_string($conn, $_POST['category']);
     $year =mysqli_real_escape_string($conn, $_POST['year']);
     $branch =mysqli_real_escape_string($conn, $_POST['branch']);
    $cmd = "SELECT 
    COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 1 and branch = '$branch' AND
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as jan, 
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
     WHERE YEAR(date) = '$year'  AND MONTH(date) = 2 and branch = '$branch' AND 
      sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as feb, 
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 3 and branch =(select id from branches where name = '$branch') AND  
    sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as mar, 
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
     WHERE YEAR(date) = '$year'  AND MONTH(date) = 4 and branch = '$branch'  AND 
      sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as april, 
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 5 and branch = '$branch'   AND 
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as may,
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 6 and branch = '$branch'   AND 
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as june,
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 7 and branch = '$branch'   AND 
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as july,
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 8 and branch = '$branch'   AND 
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as aug,
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 9 and branch = '$branch'   AND 
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as sep,
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 10 and branch = '$branch'   AND 
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as oct,
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 11 and branch = '$branch'   AND 
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as nov,
     COALESCE( 
    (SELECT SUM(`amount`) FROM income 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 12 and branch = '$branch'   AND 
     sub_id = (select s.id from in_sub_category s INNER JOIN in_category  c on c.id = s.cat_id  where c.name= '$category'))
     ,0.0) as decem
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


if($action== 'view_year_income_entry'){
    $branch =mysqli_real_escape_string($conn, $_POST['branch']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $year =mysqli_real_escape_string($conn, $_POST['year']);
    $cmd = "SELECT s.name,
    COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 1 and i.branch =
     '$branch' AND s.cat_id = (select id from in_category where name= '$category'))
     ,0) as jan, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id
     WHERE YEAR(date) = '$year'  AND MONTH(date) = 2 and i.branch =
      '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as feb, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 3 and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as mar, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id
     WHERE YEAR(date) = '$year'  AND MONTH(date) = 4 and i.branch =
      '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as april, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 5 and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as may, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 6 and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as june, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 7 and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as july, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 8 and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as aug, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 9 and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as sep, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 10 and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as oct, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 11 and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as nov, 
     COALESCE( 
    (SELECT SUM(i.`amount`) FROM income i INNER JOIN in_sub_category s on s.id = i.sub_id 
    WHERE YEAR(date) = '$year'  AND MONTH(date) = 12 and i.branch =
     '$branch'  AND s.cat_id= (select id from in_category where name= '$category'))
     ,0) as decem
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



    if($action== 'view_year_expenses_category'){
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
        if($action== 'view_year_expenses_entry'){
            $branch =mysqli_real_escape_string($conn, $_POST['branch']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $year =mysqli_real_escape_string($conn, $_POST['year']);
            $cmd = "SELECT s.name,
            COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE  YEAR(date) = '$year'  AND MONTH(date) = 1 and i.branch 
            = '$branch' AND s.cat_id = (select id from exp_category where name= '$category'))
             ,0) as jan, 
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id
             WHERE  YEAR(date) = '$year'  AND MONTH(date) = 2 and i.branch
              = '$branch' AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as feb, 
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE  YEAR(date) = '$year'  AND MONTH(date) = 3 and i.branch
             = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as mar, 
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id
             WHERE  YEAR(date) = '$year'  AND MONTH(date) = 4 and i.branch
              = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as april, 
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE  YEAR(date) = '$year'  AND MONTH(date) = 5 and i.branch = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as may,
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE  YEAR(date) = '$year'  AND MONTH(date) = 6 and i.branch = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as june,
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE  YEAR(date) = '$year'  AND MONTH(date) = 7 and i.branch = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as july,
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE  YEAR(date) = '$year'  AND MONTH(date) = 8 and i.branch = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as aug,
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE  YEAR(date) = '$year'  AND MONTH(date) = 9 and i.branch = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as sep,
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE  YEAR(date) = '$year'  AND MONTH(date) = 10 and i.branch = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as oct,
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE  YEAR(date) = '$year'  AND MONTH(date) = 11 and i.branch = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as nov,
             COALESCE( 
            (SELECT SUM(i.`amount`) FROM expenses i INNER JOIN exp_sub_category s on s.id = i.sub_id 
            WHERE  YEAR(date) = '$year'  AND MONTH(date) = 12 and i.branch = '$branch'  AND s.cat_id= (select id from exp_category where name= '$category'))
             ,0) as decem
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

    //expenses sub total
    if($action== 'view_year_expenses_entry_total'){
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);
                $category = mysqli_real_escape_string($conn, $_POST['category']);
                $year =mysqli_real_escape_string($conn, $_POST['year']);
                $cmd = "SELECT 
                COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEAR(date) = '$year'  AND MONTH(date) = 1 and branch 
                = '$branch' AND
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category  
                 c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as jan, 
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                 WHERE YEAR(date) = '$year'  AND MONTH(date) = 2 and branch 
                 = '$branch' AND 
                  sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                   c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as feb, 
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEAR(date) = '$year'  AND MONTH(date) = 3 and branch 
                = '$branch' AND  
                sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                 c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as mar, 
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                 WHERE YEAR(date) = '$year'  AND MONTH(date) = 4 and branch 
                 = '$branch' AND 
                  sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category
                    c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as april, 
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEAR(date) = '$year'  AND MONTH(date) = 5 and branch 
                = '$branch'  AND 
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                  c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as may, 
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEAR(date) = '$year'  AND MONTH(date) = 6 and branch 
                = '$branch'  AND 
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                  c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as june,
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEAR(date) = '$year'  AND MONTH(date) = 7 and branch 
                = '$branch'  AND 
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                  c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as july,
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEAR(date) = '$year'  AND MONTH(date) = 8 and branch 
                = '$branch'  AND 
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                  c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as aug,
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEAR(date) = '$year'  AND MONTH(date) = 9 and branch 
                = '$branch'  AND 
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                  c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as sep,
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEAR(date) = '$year'  AND MONTH(date) = 10 and branch 
                = '$branch'  AND 
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                  c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as oct,
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEAR(date) = '$year'  AND MONTH(date) = 11 and branch 
                = '$branch'  AND 
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                  c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as nov,
                 COALESCE( 
                (SELECT SUM(`amount`) FROM expenses 
                WHERE YEAR(date) = '$year'  AND MONTH(date) = 12 and branch 
                = '$branch'  AND 
                 sub_id = (select s.id from exp_sub_category s INNER JOIN exp_category 
                  c on c.id = s.cat_id  where c.name= '$category'))
                 ,0) as decem
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
            


// all income total
    if($action == 'year_income_total'){
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);
        $year =mysqli_real_escape_string($conn, $_POST['year']);
        $cmd = "SELECT 
        COALESCE( 
        (SELECT SUM(`amount`) FROM income 
        WHERE YEAR(date) = '$year'  AND MONTH(date) = 1 
        and branch = '$branch' )
         ,0) as jan, 
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 2 
         and branch = '$branch' )
         ,0) as feb, 
         COALESCE( 
        (SELECT SUM(`amount`) FROM income 
        WHERE YEAR(date) = '$year'  AND MONTH(date) = 3 
        and branch = '$branch' )
         ,0) as mar, 
         COALESCE( 
        (SELECT SUM(`amount`) FROM income 
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 4
          and branch = '$branch' )
         ,0) as april, 
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
        WHERE YEAR(date) = '$year'  AND MONTH(date) = 5 and branch 
        = '$branch' )
         ,0) as may, 
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
        WHERE YEAR(date) = '$year'  AND MONTH(date) = 6 and branch 
        = '$branch' )
         ,0) as june,
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
        WHERE YEAR(date) = '$year'  AND MONTH(date) = 7 and branch 
        = '$branch' )
         ,0) as july,
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
        WHERE YEAR(date) = '$year'  AND MONTH(date) = 8 and branch 
        = '$branch' )
         ,0) as aug,
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
        WHERE YEAR(date) = '$year'  AND MONTH(date) = 9 and branch 
        = '$branch' )
         ,0) as sep,
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
        WHERE YEAR(date) = '$year'  AND MONTH(date) = 10 and branch 
        = '$branch' )
         ,0) as oct,
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
        WHERE YEAR(date) = '$year'  AND MONTH(date) = 11 and branch 
        = '$branch' )
         ,0) as nov,
         COALESCE( 
        (SELECT SUM(`amount`) FROM income
        WHERE YEAR(date) = '$year'  AND MONTH(date) = 12 and branch 
        = '$branch' )
         ,0) as decem
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

    //income + cash balance
    if($action == 'year_income_cash_total'){
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);
        $year =mysqli_real_escape_string($conn, $_POST['year']);
        $cmd = "SELECT 
        ( COALESCE( 
         (SELECT SUM(`amount`) FROM income 
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 1 
         and branch = '$branch' )
          ,0) + COALESCE((SELECT amount FROM cash_balance WHERE 
           year='$year' and month= 1 and branch 
           = '$branch' ),0.0)) as jan, 
          (COALESCE( 
         (SELECT SUM(`amount`) FROM income
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 2
          and branch = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance WHERE 
           year='$year' and month= 2  and branch 
           = '$branch' ),0.0)) as feb, 
         ( COALESCE( 
         (SELECT SUM(`amount`) FROM income 
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 3 
         and branch = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance WHERE 
           year='$year' and month= 3 and branch 
           = '$branch' ),0.0)) as mar, 
          (COALESCE( 
         (SELECT SUM(`amount`) FROM income 
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 4
          and branch = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance WHERE 
           year='$year' and month= 4 and branch
            = '$branch' ),0.0)) as april, 
         ( COALESCE( 
         (SELECT SUM(`amount`) FROM income
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 5 and branch 
         = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance 
          WHERE  year='$year'  and  month= 5 
          and branch = '$branch' ),0.0)) as may, 
          ( COALESCE( 
         (SELECT SUM(`amount`) FROM income
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 6 and branch 
         = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance 
          WHERE  year='$year'  and  month= 6 
          and branch = '$branch' ),0.0)) as june,
          ( COALESCE( 
         (SELECT SUM(`amount`) FROM income
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 7 and branch 
         = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance 
          WHERE  year='$year'  and  month= 7 
          and branch = '$branch' ),0.0)) as july,         ( COALESCE( 
         (SELECT SUM(`amount`) FROM income
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 8 and branch 
         = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance
          WHERE  year='$year'  and  month= 8 
          and branch = '$branch' ),0.0)) as aug,         ( COALESCE( 
         (SELECT SUM(`amount`) FROM income
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 9 and branch 
         = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance 
          WHERE  year='$year'  and  month= 9 
          and branch = '$branch' ),0.0)) as sep,         ( COALESCE( 
         (SELECT SUM(`amount`) FROM income
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 10 and branch 
         = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance
          WHERE  year='$year'  and  month= 10 
          and branch = '$branch' ),0.0)) as oct,         ( COALESCE( 
         (SELECT SUM(`amount`) FROM income
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 11 and branch 
         = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance 
          WHERE  year='$year'  and  month= 11 
          and branch = '$branch' ),0.0)) as nov,         ( COALESCE( 
         (SELECT SUM(`amount`) FROM income
         WHERE YEAR(date) = '$year'  AND MONTH(date) = 12 and branch 
         = '$branch' )
          ,0)+ COALESCE((SELECT amount FROM cash_balance 
          WHERE  year='$year'  and  month= 12 
          and branch = '$branch' ),0.0)) as decem
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
        if($action == 'year_expenses_total'){
            $branch =mysqli_real_escape_string($conn, $_POST['branch']);
            $year =mysqli_real_escape_string($conn, $_POST['year']);
            $cmd = "SELECT 
            COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
            WHERE YEAR(date) = '$year'  AND MONTH(date) = 1
             and branch = '$branch' )
             ,0) as jan, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 2
              and branch = '$branch' )
             ,0) as feb, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
            WHERE YEAR(date) = '$year'  AND MONTH(date) = 3
            and branch = '$branch' )
             ,0) as mar, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses 
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 4
              and branch = '$branch' )
             ,0) as april, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEAR(date) = '$year'  AND MONTH(date) = 5 and branch
             = '$branch' )
             ,0) as may, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEAR(date) = '$year'  AND MONTH(date) = 6 and branch
             = '$branch' )
             ,0) as june, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEAR(date) = '$year'  AND MONTH(date) = 7 and branch
             = '$branch' )
             ,0) as july, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEAR(date) = '$year'  AND MONTH(date) = 8 and branch
             = '$branch' )
             ,0) as aug, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEAR(date) = '$year'  AND MONTH(date) = 9 and branch
             = '$branch' )
             ,0) as sep, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEAR(date) = '$year'  AND MONTH(date) = 10 and branch
             = '$branch' )
             ,0) as oct, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEAR(date) = '$year'  AND MONTH(date) = 11 and branch
             = '$branch' )
             ,0) as nov, 
             COALESCE( 
            (SELECT SUM(`amount`) FROM expenses
            WHERE YEAR(date) = '$year'  AND MONTH(date) = 12 and branch
             = '$branch' )
             ,0) as decem
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

     if($action == 'year_end_cash'){
                $branch =mysqli_real_escape_string($conn, $_POST['branch']);
                $year =mysqli_real_escape_string($conn, $_POST['year']);
                $cmd = "SELECT 
                ( 
                 COALESCE( 
          (SELECT SUM(`amount`) FROM income 
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 1
          and branch = '$branch' )
           ,0) + COALESCE((SELECT amount FROM cash_balance WHERE 
            year='$year' and month= 1 and branch 
            = '$branch' ),0.0)
                  
                   - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses 
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 1
             and branch = '$branch' )
              ,0)) as jan, 
                  (
                     COALESCE( 
          (SELECT SUM(`amount`) FROM income
           WHERE YEAR(date) = '$year'  AND MONTH(date) = 2
           and branch = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance WHERE 
            year='$year' and month= 2  and branch 
            = '$branch' ),0.0)
                  
                  -  COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
              WHERE YEAR(date) = '$year'  AND MONTH(date) = 2
              and branch = '$branch' )
              ,0)) as feb, 
                 ( 
                     
                     COALESCE( 
          (SELECT SUM(`amount`) FROM income 
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 3
          and branch = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance WHERE 
            year='$year' and month= 3 and branch 
            = '$branch' ),0.0)
                  
                  - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses 
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 3
             and branch = '$branch' )
              ,0)) as mar, 
                  (
                     COALESCE( 
          (SELECT SUM(`amount`) FROM income 
           WHERE YEAR(date) = '$year'  AND MONTH(date) = 4
           and branch = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance WHERE 
            year='$year' and month= 4 and branch
             = '$branch' ),0.0)
                  
                  - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses 
              WHERE YEAR(date) = '$year'  AND MONTH(date) = 4
              and branch = '$branch' )
              ,0)) as april, 
                 ( COALESCE( 
          (SELECT SUM(`amount`) FROM income
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 5 and branch 
          = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance 
           WHERE  year='$year'  and month= 5 
           and branch = '$branch' ),0.0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 5 and 
             branch = '$branch' )
              ,0)) as may, 
              ( COALESCE( 
          (SELECT SUM(`amount`) FROM income
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 6 and branch 
          = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance 
           WHERE  year='$year'  and month= 5 
           and branch = '$branch' ),0.0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 6 and 
             branch = '$branch' )
              ,0)) as june, 
              ( COALESCE( 
          (SELECT SUM(`amount`) FROM income
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 7 and branch 
          = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance 
           WHERE  year='$year'  and month= 5 
           and branch = '$branch' ),0.0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 7 and 
             branch = '$branch' )
              ,0)) as july, 
              ( COALESCE( 
          (SELECT SUM(`amount`) FROM income
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 8 and branch 
          = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance 
           WHERE  year='$year'  and month= 5 
           and branch = '$branch' ),0.0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 8 and 
             branch = '$branch' )
              ,0)) as aug, 
              ( COALESCE( 
          (SELECT SUM(`amount`) FROM income
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 9 and branch 
          = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance 
           WHERE  year='$year'  and month= 9 
           and branch = '$branch' ),0.0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 9 and 
             branch = '$branch' )
              ,0)) as sep, 
              ( COALESCE( 
          (SELECT SUM(`amount`) FROM income
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 10 and branch 
          = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance 
           WHERE  year='$year'  and month= 10 
           and branch = '$branch' ),0.0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 10 and 
             branch = '$branch' )
              ,0)) as oct, 
              ( COALESCE( 
          (SELECT SUM(`amount`) FROM income
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 11 and branch 
          = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance
           WHERE  year='$year'  and month= 11 
           and branch = '$branch' ),0.0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 11 and 
             branch = '$branch' )
              ,0)) as nov, 
              ( COALESCE( 
          (SELECT SUM(`amount`) FROM income
          WHERE YEAR(date) = '$year'  AND MONTH(date) = 12 and branch 
          = '$branch' )
           ,0)+ COALESCE((SELECT amount FROM cash_balance
           WHERE  year='$year'  and month= 12 
           and branch = '$branch' ),0.0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE YEAR(date) = '$year'  AND MONTH(date) = 12 and 
             branch = '$branch' )
              ,0)) as decem
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
    
// income - expenses as net cash
            if($action == 'year_net_cash'){
                $branch =mysqli_real_escape_string($conn, $_POST['branch']);
                $year =mysqli_real_escape_string($conn, $_POST['year']);
                $cmd = "SELECT 
                ( 
                 COALESCE( 
                 (SELECT SUM(`amount`) FROM income 
                 WHERE  YEAR(date)='$year'  and MONTH(date)= 1
                  and branch = '$branch' )
                  ,0)
                  
                   - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses 
             WHERE  YEAR(date)='$year'  and  MONTH(date)= 1 
             and branch ='$branch' )
              ,0)) as jan, 
                  (COALESCE( 
                 (SELECT SUM(`amount`) FROM income
                  WHERE  YEAR(date)='$year'  and  MONTH(date)= 2
                   and branch = '$branch' )
                  ,0)-  COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
              WHERE  YEAR(date)='$year'  and  MONTH(date)= 2
              and branch = '$branch' )
              ,0)) as feb, 
                 ( COALESCE( 
                 (SELECT SUM(`amount`) FROM income 
                 WHERE  YEAR(date)='$year'  and  MONTH(date)= 3
                  and branch = '$branch' )
                  ,0)- COALESCE( 
             (SELECT SUM(`amount`) FROM expenses 
             WHERE  YEAR(date)='$year'  and  MONTH(date)= 3
             and branch ='$branch' )
              ,0)) as mar, 
                  (COALESCE( 
                 (SELECT SUM(`amount`) FROM income 
                  WHERE  YEAR(date)='$year'  and  MONTH(date)= 4
                  and branch = '$branch' )
                  ,0)- COALESCE( 
             (SELECT SUM(`amount`) FROM expenses 
              WHERE  YEAR(date)='$year'  and  MONTH(date)= 4 
              and branch = '$branch' )
              ,0)) as april, 
                 ( COALESCE( 
                 (SELECT SUM(`amount`) FROM income
                 WHERE  YEAR(date)='$year'  and  MONTH(date)= 5
                 and branch = '$branch' )
                  ,0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE  YEAR(date)='$year'  and  MONTH(date)= 5 and 
             branch = '$branch' )
              ,0)) as may, 
              ( COALESCE( 
                 (SELECT SUM(`amount`) FROM income
                 WHERE  YEAR(date)='$year'  and  MONTH(date)= 6
                 and branch = '$branch' )
                  ,0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE  YEAR(date)='$year'  and  MONTH(date)= 6 and 
             branch = '$branch' )
              ,0)) as june, 
              ( COALESCE( 
                 (SELECT SUM(`amount`) FROM income
                 WHERE  YEAR(date)='$year'  and  MONTH(date)= 7
                 and branch = '$branch' )
                  ,0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE  YEAR(date)='$year'  and  MONTH(date)= 7 and 
             branch = '$branch' )
              ,0)) as july, 
              ( COALESCE( 
                 (SELECT SUM(`amount`) FROM income
                 WHERE  YEAR(date)='$year'  and  MONTH(date)= 8
                 and branch = '$branch' )
                  ,0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE  YEAR(date)='$year'  and  MONTH(date)= 8 and 
             branch = '$branch' )
              ,0)) as aug, 
              ( COALESCE( 
                 (SELECT SUM(`amount`) FROM income
                 WHERE  YEAR(date)='$year'  and  MONTH(date)= 9
                 and branch = '$branch' )
                  ,0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE  YEAR(date)='$year'  and  MONTH(date)= 9 and 
             branch = '$branch' )
              ,0)) as sep, 
              ( COALESCE( 
                 (SELECT SUM(`amount`) FROM income
                 WHERE  YEAR(date)='$year'  and  MONTH(date)= 10
                 and branch = '$branch' )
                  ,0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE  YEAR(date)='$year'  and  MONTH(date)= 10 and 
             branch = '$branch' )
              ,0)) as oct, 
              ( COALESCE( 
                 (SELECT SUM(`amount`) FROM income
                 WHERE  YEAR(date)='$year'  and  MONTH(date)= 11
                 and branch = '$branch' )
                  ,0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE  YEAR(date)='$year'  and  MONTH(date)= 11 and 
             branch = '$branch' )
              ,0)) as nov, 
              ( COALESCE( 
                 (SELECT SUM(`amount`) FROM income
                 WHERE  YEAR(date)='$year'  and  MONTH(date)= 12
                 and branch = '$branch' )
                  ,0) - COALESCE( 
             (SELECT SUM(`amount`) FROM expenses
             WHERE  YEAR(date)='$year'  and  MONTH(date)=12 and 
             branch = '$branch' )
              ,0)) as decem 
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


    
    if($action=='year_cash_balance'){
      try{
        // $year =mysqli_real_escape_string($conn, $_POST['year']);
        // $branch =mysqli_real_escape_string($conn, $_POST['branch']);
        $branch = 2;
        $year = 2022;
        $cmd3 = "delete from cash_balance where year='$year' 
        and branch = '$branch'";
        $q2 = mysqli_query($conn,$cmd3);
      
        $old_amt = 0.00;
        $new_amt = 0.00;
        for($i=1; $i<=12; $i++){                  
            if($i==1){  
                            $mm = 12;
                            $yy = $year -1;
                            $sql = "select * from cash_balance where year='$yy' and month = '$mm'
                             and branch = '$branch'
                            ";
                            $qSql = mysqli_query($conn,$sql);
                            $rows = mysqli_num_rows($qSql);
                            if($rows > 0 ){
                                 $view = mysqli_fetch_assoc($qSql);
                                $new_amt = $view['amount'];
                                $cmd = "INSERT INTO `cash_balance`(`amount`, `month`, `year`, 
                                `branch`) VALUES ('$new_amt',
                                '$i','$year', '$branch')";
                                $query = mysqli_query($conn,$cmd);
                                $old_amt = $new_amt;
                            }else{
                                        $cmd = "INSERT INTO `cash_balance`(`amount`, `month`,`year`, 
                                        `branch`) VALUES ('0.0',
                                        '$i','$year', '$branch')";
                                    $query = mysqli_query($conn,$cmd);
                                    $old_amt = 0.0;    
                            }
                   
                }else{
                    $month = $i - 1;         
                        $cmd3 = "SELECT COALESCE( (COALESCE(
                            (SELECT (amount) from cash_balance where id= 
                                            (SELECT MAX(id) FROM cash_balance WHERE year='$year' and month ='$month' 
                                            and branch = '$branch')),0.0)
                            +    
                                             COALESCE( 
                                                (SELECT SUM(`amount`) FROM income 
                                                WHERE YEAR(date)='$year'  and MONTH(date)= '$i' and branch = '$branch' )
                                                ,0))                 
                                                -
                                                    COALESCE( 
                                                    (SELECT SUM(`amount`) FROM expenses
                                                    WHERE YEAR(date)='$year'  and MONTH(date)= '$i' and branch = '$branch' )
                                                    ,0),0.0) as amount";
                        $q3 = mysqli_query($conn,$cmd3);
                        $view = mysqli_fetch_assoc($q3); 
                        $new_amt = $view['amount'];  
                        if($new_amt > 0.0){
                            $old_amt = $new_amt;
                         }  
                        $cmd2 = "INSERT INTO `cash_balance`(`amount`, `month`,`year`, 
                        `branch`) VALUES ('$old_amt',
                        '$i','$year', '$branch');
                    ";
                    $query2 = mysqli_query($conn,$cmd2);
                  

                }
              
                    }
                    $fcmd ="SELECT (SELECT amount from cash_balance WHERE year='$year' AND month= 1 and branch ='$branch' ) as jan,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 2 AND branch = '$branch' ) as feb,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 3 and branch = '$branch' ) as mar,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 4 and branch = '$branch' ) as april,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 5 and branch = '$branch' ) as may,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 6 and branch = '$branch' ) as june,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 7 and branch = '$branch' ) as july,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 8 and branch = '$branch' ) as aug,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 9 and branch = '$branch' ) as sep,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 10 and branch = '$branch' ) as oct,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 11 and branch = '$branch' ) as nov,
                    (SELECT amount from cash_balance WHERE year='$year'  and month= 12 and branch = '$branch' ) as decem   
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

    
    
    // if($action=='year_cash_balance'){
    //   try{
    //     $year =mysqli_real_escape_string($conn, $_POST['year']);
    //     $branch =mysqli_real_escape_string($conn, $_POST['branch']);
    //     $cmd3 = "delete from cash_balance where year='$year' 
    //     and branch =(select id from branches where name = '$branch') ";
    //     $q2 = mysqli_query($conn,$cmd3);
      
    //     $old_amt = 0.00;
    //     $new_amt = 0.00;
    //     for($i=1; $i<=12; $i++){                  
    //         if($i==1){  
    //                         $mm = 12;
    //                         $yy = $year -1;
    //                         $sql = "select * from cash_balance where year='$yy' and month = '$mm'
    //                          and branch =(select id from branches where name = '$branch')
    //                         ";
    //                         $qSql = mysqli_query($conn,$sql);
    //                         $rows = mysqli_num_rows($qSql);
    //                         if($rows > 0 ){
    //                              $view = mysqli_fetch_assoc($qSql);
    //                             $new_amt = $view['amount'];
    //                             $cmd = "INSERT INTO `cash_balance`(`amount`, `month`, `year`, 
    //                             `branch`) VALUES ('$new_amt',
    //                             '$i','$year',(select id from branches where name = '$branch'))";
    //                             $query = mysqli_query($conn,$cmd);
    //                             $old_amt = $new_amt;
    //                         }else{
    //                                     $cmd = "INSERT INTO `cash_balance`(`amount`, `month`,`year`, 
    //                                     `branch`) VALUES ('0.0',
    //                                     '$i','$year',(select id from branches where name = '$branch'))";
    //                                 $query = mysqli_query($conn,$cmd);
    //                                 $old_amt = 0.0;    
    //                         }
                   
    //             }else{
    //                 $month = $i - 1;         
    //                     $cmd3 = "SELECT COALESCE( (COALESCE(
    //                         (SELECT (amount) from cash_balance where id= 
    //                                         (SELECT MAX(id) FROM cash_balance WHERE year='$year' and month='$month' 
    //                                         and branch =(select id from branches where name = '$branch') )),0.0)
    //                         +    
    //                                          COALESCE( 
    //                                             (SELECT SUM(`amount`) FROM income 
    //                                             WHERE YEAR(date)='$year'  and MONTH(date)= '$i' and branch =(select id from branches where name = '$branch') )
    //                                             ,0))                 
    //                                             -
    //                                                 COALESCE( 
    //                                                 (SELECT SUM(`amount`) FROM expenses
    //                                                 WHERE YEAR(date)='$year'  and MONTH(date)= '$i' and branch =(select id from branches where name = '$branch') )
    //                                                 ,0),0.0) as amount";
    //                     $q3 = mysqli_query($conn,$cmd3);
    //                     $view = mysqli_fetch_assoc($q3); 
    //                     $new_amt = $view['amount'];  
    //                     if($new_amt > 0.0){
    //                         $old_amt = $new_amt;
    //                      }  
    //                     $cmd2 = "INSERT INTO `cash_balance`(`amount`, `month`,`year`, 
    //                     `branch`) VALUES ('$old_amt',
    //                     '$i','$year',(select id from branches where name = '$branch'));
    //                 ";
    //                 $query2 = mysqli_query($conn,$cmd2);
                  

    //             }
              
    //                 }
    //                 $fcmd ="SELECT (SELECT amount from cash_balance WHERE year='$year' AND month= 1 and branch =(select id from branches where name = '$branch') ) as jan,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 2 AND branch =(select id from branches where name = '$branch') ) as feb,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 3 and branch =(select id from branches where name = '$branch') ) as mar,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 4 and branch =(select id from branches where name = '$branch') ) as april,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 5 and branch =(select id from branches where name = '$branch') ) as may,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 6 and branch =(select id from branches where name = '$branch') ) as june,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 7 and branch =(select id from branches where name = '$branch') ) as july,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 8 and branch =(select id from branches where name = '$branch') ) as aug,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 9 and branch =(select id from branches where name = '$branch') ) as sep,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 10 and branch =(select id from branches where name = '$branch') ) as oct,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 11 and branch =(select id from branches where name = '$branch') ) as nov,
    //                 (SELECT amount from cash_balance WHERE year='$year'  and month= 12 and branch =(select id from branches where name = '$branch') ) as decem   
    //                 "; 
    //                 $query = mysqli_query($conn,$fcmd);
    //                 if(! $query ){
    //                     echo $failed;
    //                 }else{  
    //                     while($view = mysqli_fetch_assoc($query)){
    //                         $db_data[] = $view;
    //                     }
    //                     echo json_encode($db_data);
    //                 }
                
    //     }catch (Exception $e) {
    //         mysqli_close($conn);
    //         echo 'Exception error: ',  $e->getMessage(), "\n";
    //      }
    // }
?>