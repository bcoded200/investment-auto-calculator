<?php

try{
    $username ="root";
    $password = "";
    $dsn = "mysql:dbhost=localhost;dbname=test;";
    $conn = new PDO($dsn,$username,$password);
    // echo "successfully connected";
}catch(PDOException $e)
{
    echo json_encode(array(
        'code' => 500,
        'message' => "".$e->getMessage(),
    ));
}


date_default_timezone_set("Africa/lagos"); //replace with your timezone
$date = date("Y-m-d h:i:s");


function DateDiff($date1, $date2){
 //formulate the difference b/w two dates
$date1 = strtotime($date1);
$date2 = strtotime($date2);

 $diff = abs($date1 - $date2);

 //to get the year, divide the resultant data into total seconds in a year (365*60*60*24)
 $years = floor($diff / (365*60*60*24));

 //to get the month, subtract it with years and divide the resultant date into
 //total seconds in a month (30*60*60*24)
 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));

 //to get the day subtract it with years and months and divide the
 //resultant date into total seconds in a days(60*60*24)
$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 *24) / (60 * 60 * 24));


//to get the hours subtract it with years months and seconds and divide the resultant date into total seconds
// in a hour (60*60)

 $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));

 //to get the minuites subtrat it with years months seconds and hours and
 //divide the resultant date into total seconds i.e (60)

 $minuites = floor(($diff - $years * 365 *60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days*60*60*24-$hours*60*60) /60);

 //to get the minuites , subtract it with  years , month , seconds hours and minuites

 $seconds = floor(($diff - $years * 365*60*60*24 - $months *30*60*60*24 - $days *60*60*24 - $hours*60*60 - $minuites *60));

 //print result

 return printf("%d years, %d months, %d days, %d hours, "."%d minuites, %d seconds", $years, $months, $days, $hours, $minuites, $seconds);



}

/**
    * @param accepts integer
    *  @param int specify the percentage number as the first argument
    *  @param int specify the amountinvested / amount to check as the second argument
    */
function getPercentage($PercentageAmount, $MoneyAmount): int
{

   $count1 = ($PercentageAmount/100*$MoneyAmount/1);
   $count2 = $count1;
   $count = $count2;

    return $count;
}


?>