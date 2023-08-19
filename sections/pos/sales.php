<?php


if($action == "sell_service"){
    try{
        $customer =mysqli_real_escape_string($conn, $_POST['customer']);
        $total =mysqli_real_escape_string($conn, $_POST['total']);
        $date =mysqli_real_escape_string($conn, $_POST['date']);
        $payable =mysqli_real_escape_string($conn, $_POST['payable']);
        $discount =mysqli_real_escape_string($conn, $_POST['discount']);
        $rep =mysqli_real_escape_string($conn, $_POST['rep']);
        $bal =mysqli_real_escape_string($conn, $_POST['bal']);
        $payment =mysqli_real_escape_string($conn, $_POST['payment']);
        $book =mysqli_real_escape_string($conn, $_POST['book']);
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);
        $date = date("Y-m-d", strtotime($date));  
                    $cmd = "INSERT INTO `sales`(`total`, `payable`, `rep`, `payment`, `balance`,
                     `discount`, `cid`, `branch`, `book`, `date`) VALUES 
                     ('$total','$payable','$rep','$payment','$bal',
                     '$discount','$customer','$branch','$book','$date');";
                    $query3 = mysqli_query($conn,$cmd);
                    if(!($query3)){
                        echo $false;
                    }else{
                        $cmd = "select MAX(id) as id from sales;";
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
     } catch (Exception $e) {
            mysqli_close($conn);
            echo 'Exception error: ',  $e->getMessage(), "\n";
        }
}


if($action == "get_customer_details"){
    $name =mysqli_real_escape_string($conn, $_POST['name']);

    $cmd = "SELECT * FROM `customer` WHERE `name` =  '$name'";
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


if($action == "save_cart"){
    try{
    $name =  $_POST['sql'];
    $cmd  =trim($name,'"');
    $query3 = mysqli_query($conn, $cmd);
    if(!($query3)){
        echo json_encode($cmd);
    }else{
        echo $true;
    }   
    } catch (Exception $e) {
        mysqli_close($conn);
        echo 'Exception error: ',  $e->getMessage(), "\n";
    }
}

if($action == "get_price"){
    $name =mysqli_real_escape_string($conn, $_POST['name']);
    $cmd = "SELECT s.`id`, s.`name`, sc.name as sub_category,c.name as category,s.`description`,
    s.`duration_period`, s.`duration`, s.`duration_cost` FROM `services` s INNER JOIN sub_category 
    sc INNER JOIN category c on s.sub_category = sc.id and sc.cat_id =c.id where s.name = '$name'";
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

if($action == "sales_info"){
    $branch =mysqli_real_escape_string($conn, $_POST['branch']);
    if($branch == 0){
        $cmd = "SELECT IFNULL(SUM(`payment` - `balance`),0.0) sales, COUNT(*) count, 
        (SELECT Count(*) from sales where book = 1) as booked  FROM `sales` WHERE DATE(date) = CURRENT_DATE and book= 0";

    }else{
        $cmd = "SELECT IFNULL(SUM(`payment` - `balance`),0.0) sales, COUNT(*) count,
         (SELECT COUNT(*) FROM sales WHERE book = 1 AND branch= '$branch' AND DATE(date) = CURRENT_DATE) as booked  FROM `sales` 
        WHERE DATE(date) = CURRENT_DATE AND branch= '$branch' and book= 0";
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

if($action == "view_sales_details"){
    $id =mysqli_real_escape_string($conn, $_POST['id']);

    $cmd = "SELECT sd.id,s.name as service, c.name as cat, sd.price,sd.quantity,sub_total
    FROM `sales_details` sd INNER JOIN services s INNER JOIN sub_category c  on s.id = sd.service_id and c.id = s.sub_category
     WHere sd.sales_id = '$id'";
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

if($action =="book_service"){
    try{
    $customer =mysqli_real_escape_string($conn, $_POST['customer']);
        $total =mysqli_real_escape_string($conn, $_POST['total']);
        $date =mysqli_real_escape_string($conn, $_POST['date']);
        $payable =mysqli_real_escape_string($conn, $_POST['payable']);
        $discount =mysqli_real_escape_string($conn, $_POST['discount']);
        $rep =mysqli_real_escape_string($conn, $_POST['rep']);
        $bal =mysqli_real_escape_string($conn, $_POST['bal']);
        $payment =mysqli_real_escape_string($conn, $_POST['payment']);
        $book =mysqli_real_escape_string($conn, $_POST['book']);
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);
        $date = date("Y-m-d", strtotime($date));  
                    $cmd = "INSERT INTO `sales`(`total`, `payable`, `rep`,
                     `discount`, `cid`, `branch`, `book`, `date`,paid) VALUES 
                     ('$total','$payable','$rep',
                     '$discount','$customer','$branch','$book','$date','0');";
                    $query3 = mysqli_query($conn,$cmd);
                    if(!($query3)){
                        echo $false;
                    }else{
                        $cmd = "select MAX(id) as id from sales;";
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
     } catch (Exception $e) {
            mysqli_close($conn);
            echo 'Exception error: ',  $e->getMessage(), "\n";
        }
}

if($action =="pay_booking"){
    try{
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $payment =mysqli_real_escape_string($conn, $_POST['payment']);
        $balance =mysqli_real_escape_string($conn, $_POST['balance']);
        $cmd = "UPDATE `sales` SET `payment`='$payment',`balance`='$balance',`paid`='1' WHERE `id`='$id';";
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


if($action == "view_booked_sales"){
    $cmd = "SELECT s.id, s.total,s.payable,s.payment,s.balance,s.discount,
    s.book,s.date,c.name as customer, u.name as rep ,b.name as branch from 
    sales s INNER JOIN customer c INNER JOIN branches b INNER JOIN user u
     on s.cid = c.id and s.branch = b.id and s.rep = u.id WHERE s.book= 1 order by s.entry_date DESC  ;";
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

if($action == "view_sales"){

    $cmd = "SELECT s.id, s.total,s.payable,s.payment,s.balance,s.discount,
    s.book,s.date,c.name as customer, u.name as rep ,b.name as branch from 
    sales s INNER JOIN customer c INNER JOIN branches b INNER JOIN user u
     on s.cid = c.id and s.branch = b.id and s.rep = u.id WHERE s.paid= 1 order by s.entry_date DESC ;";
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


if($action == "search_sales"){
        $branch =mysqli_real_escape_string($conn, $_POST['branch']);
        $type =mysqli_real_escape_string($conn, $_POST['type']);
        $sdate =mysqli_real_escape_string($conn, $_POST['sdate']);
        $edate =mysqli_real_escape_string($conn, $_POST['edate']);
        $sdate = date("Y-m-d", strtotime($sdate));
        $edate = date("Y-m-d", strtotime($edate));
        $andClause;
        if($type == 'All'){
            $andClause ='';
        }else if($type == 'Direct sales'){
             $andClause = " and s.book = '0'";
        }else{
               $andClause = " and s.book = '1'";
        }
        if($branch != 0 ){
            $cmd = "SELECT s.id, s.total,s.payable,s.payment,s.balance,s.discount,
        s.book,s.date,c.name as customer, u.name as rep ,b.name as branch from 
        sales s INNER JOIN customer c INNER JOIN branches b INNER JOIN user u
         on s.cid = c.id and s.branch = b.id and s.rep = u.id WHERE s.paid= 1 and s.date between '$sdate' and '$edate' and s.branch = '$branch' $andClause order by s.entry_date DESC ;";
        }else{
            $cmd = "SELECT s.id, s.total,s.payable,s.payment,s.balance,s.discount,
    s.book,s.date,c.name as customer, u.name as rep ,b.name as branch from 
    sales s INNER JOIN customer c INNER JOIN branches b INNER JOIN user u
     on s.cid = c.id and s.branch = b.id and s.rep = u.id WHERE s.paid= 1 and s.date between '$sdate' and '$edate'  $andClause order by s.entry_date DESC ;";
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

if($action == "search_proforma_sales"){
    $branch =mysqli_real_escape_string($conn, $_POST['branch']);
    $type =mysqli_real_escape_string($conn, $_POST['type']);
    $sdate =mysqli_real_escape_string($conn, $_POST['sdate']);
    $edate =mysqli_real_escape_string($conn, $_POST['edate']);
    $sdate = date("Y-m-d", strtotime($sdate));
    $edate = date("Y-m-d", strtotime($edate));
    $andClause = ' and s.book = 1 ';
    if($type == 'All'){
        $andClause ='';
    }else if($type == 'Paid'){
         $andClause = " and s.payment >= s.payable ";
    }else{
           $andClause = "  and s.payment < s.payable  ";
    }
    if($branch != 0 ){
        $cmd = "SELECT s.id, s.total,s.payable,s.payment,s.balance,s.discount,
    s.book,s.date,c.name as customer, u.name as rep ,b.name as branch from 
    sales s INNER JOIN customer c INNER JOIN branches b INNER JOIN user u
     on s.cid = c.id and s.branch = b.id and s.rep = u.id WHERE s.book= 1 and s.date between '$sdate' and '$edate' and s.branch = '$branch' $andClause order by s.entry_date DESC ;";
    }else{
        $cmd = "SELECT s.id, s.total,s.payable,s.payment,s.balance,s.discount,
s.book,s.date,c.name as customer, u.name as rep ,b.name as branch from 
sales s INNER JOIN customer c INNER JOIN branches b INNER JOIN user u
 on s.cid = c.id and s.branch = b.id and s.rep = u.id WHERE s.book= 1 and s.date between '$sdate' and '$edate'  $andClause order by s.entry_date DESC ;";
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
?>