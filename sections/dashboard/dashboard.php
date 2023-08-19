<?php

if($action == "dash_sales"){
    $cmd = "SELECT SUM(payment - balance) as sales,(SELECT Count(*) 
    from sales where book = 0 and MONTH(date)=MONTH(CURRENT_DATE)) 
    as instant ,(SELECT Count(*) from sales where book = 1 and 
    MONTH(date)=MONTH(CURRENT_DATE)) as booking FROM `sales`";
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

if($action == "view_fast_selling"){
    $cmd = "SELECT s.name, (SELECT COUNT(*) from sales_details 
    where service_id = s.id) as count FROM services s INNER JOIN 
    sales_details sd on s.id = sd.service_id GROUP by s.id order by COUNT DESC;";
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

if($action == "view_net_profit"){
    $period = mysqli_real_escape_string($conn, $_POST['period']);
    if($period =="day"){
        $cmd = "SELECT t.name,(CASE WHEN t.name = 'income' THEN 
        (COALESCE((SELECT SUM(amount) from income WHERE `sub_id` != 4 and DATE(date) = DATE(CURRENT_DATE)),0.0) + 
        COALESCE((SELECT SUM(payment- balance) FROM sales WHERE DATE(date) = DATE(CURRENT_DATE)),0.0)) 
        ELSE COALESCE((SELECT SUM(amount)
          from expenses WHERE DATE(date) = DATE(CURRENT_DATE)),0.0) END) as value from transactions t";
    }elseif($period == "week"){
        $cmd = "SELECT t.name,(CASE WHEN t.name = 'income' THEN 
        (COALESCE((SELECT SUM(amount) from income WHERE `sub_id` != 4 and YEARWEEK(date) = YEARWEEK(NOW())),0.00) + 
        COALESCE((SELECT SUM(payment- balance) FROM sales WHERE YEARWEEK(date) = YEARWEEK(NOW())),0.0) )
        ELSE COALESCE((SELECT SUM(amount)
        from expenses WHERE YEARWEEK(date) = YEARWEEK(NOW())),0.0) END) as value from transactions t
";
    }elseif($period == "month"){
        $cmd = "SELECT t.name,(CASE WHEN t.name = 'income' THEN 
        (COALESCE((SELECT SUM(amount) from income WHERE `sub_id` != 4 and MONTH(date) = MONTH(CURRENT_DATE)),0.0) + 
        COALESCE((SELECT SUM(payment- balance) FROM sales WHERE MONTH(date) = MONTH(CURRENT_DATE)),0.0))
        ELSE COALESCE((SELECT SUM(amount)
          from expenses WHERE MONTH(date) = MONTH(CURRENT_DATE)),0.0) END) as value from transactions t
";
    }else{
        $cmd = "SELECT t.name,(CASE WHEN t.name = 'income' THEN 
        (COALESCE((SELECT SUM(amount) from income WHERE `sub_id` != 4 and  YEAR(date) = YEAR(CURRENT_DATE)),0.0) + 
        COALESCE((SELECT SUM(payment- balance) FROM sales WHERE  YEAR(date) = YEAR(CURRENT_DATE)),0.0) )
        ELSE COALESCE((SELECT SUM(amount)
          from expenses WHERE  YEAR(date) = YEAR(CURRENT_DATE)),0.0) END) as value from transactions t
        ";
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
}


    
if($action=='casflow_main'){
    try{
                  $fcmd ="SELECT month, amount from cash_balance WHERE YEAR(CURRENT_DATE) order by month asc"; 
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