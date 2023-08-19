<?php
$server = 'localhost';
$username = 'bistech3_root';
$password = '0542089814kessie';
$database = 'bistech3_super';

$conn = mysqli_connect($server,$username,$password,$database) or die("cannot connect to database");
 
$failed =  json_encode("Sql statement failed");
$true = json_encode("true");
$false = json_encode("false");
$duplicate = json_encode("duplicate");
function generateRandomString($length = 6) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function sanitize($dirty){
    return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}
function getDateFromDay($y,$m,$day){
    return date('Y-m-d', strtotime($y."-".$m."-".$day));
}

function weekOfMonth($when =null){
  $week = date('W',$when);
  $fWeek = date('W', strtotime(date('Y-m-01',$when)));
  return 1+ ($week<$fWeek? $week: $week- $fWeek);
}

function getMondays($y, $m)
{
  return new DatePeriod(
      new DateTime("first monday of $y-$m"),
      DateInterval::createFromDateString('next monday'),
      new DateTime("last day of $y-$m")
  );
}


// foreach (getMondays(2010, 11) as $monday) {
//     echo $monday->format("Y-m-d\n");
// }
?>