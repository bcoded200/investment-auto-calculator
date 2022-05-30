<?php
require "functions.php";

 //investment information

 echo $date;
 echo "<br />";

 if(isset($_POST['submit']))
 {
     $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
     $plan = isset($_POST['plan']) ? $_POST['plan'] : '';

     //fetch the investment plan selected by the user
     $query = $conn->prepare("SELECT * FROM plans WHERE bundle= :bundle");
     $query->execute(['bundle'=>$plan]);
     $stmt = $query->fetchAll(PDO::FETCH_OBJ);
     foreach ($stmt as $data) {}


     //get the investment number of days

     $duration = $data->duration;
     $duration = str_replace("Days"," ",$duration,);

     //calculate the investment duration  date-time
     $days = "+$duration days";
     $strt_date = $date;
     $calc_strtdate = date_create($strt_date);
     $frmt_date = date_format($calc_strtdate, "m/d/Y");
     $new_date = strtotime($days, strtotime($frmt_date));
     echo "stoppage date:". $finaldate =  date("Y-m-d h:i:s", $new_date);

     //check if the maturity date is reached and end the investment trading
     if($date > $finaldate)
     {
         echo "<br />";
         echo "investment has expired -";

     }else
     {
        echo "<br />";
         echo "<span style='color:green;'>investment is ongoing +</span>";
     }
     //end



     //check remaining days/year/months/seconds/minuites for investment to end and display to clients
     echo "<br />";
     echo DateDiff($date, $finaldate);

     //get the payout  times dynamically based on selected plan and increment profits according to payout times
     $increment_time = $data->payout;
     $increment_time = str_replace("day", " ",$increment_time);
     echo "<br />";
     echo "increment every".' '.$increment_time .'day/days';
     echo "<br />";
     echo 'next profit day'.' '.$next_profit_date = date('Y-m-d h:i:s',strtotime("+$increment_time day", strtotime($date)));

     //get the amount the user invested
     $invested_amount = $amount;

     //get the percentage amount for each dynamic plan
     $percent = $data->percentage;
     echo "<br />";

     echo "<br />";

     echo 'percentage amount for the selected plan is '.' '.  $percent;

     echo "<br />";
     echo" percentage of the invested amount ".'$'. getPercentage($percent,$invested_amount);
     echo "<br />";
     echo "invested amount is $" . number_format($amount,2);
     echo "<br />";
     $daily_roi = getPercentage($percent,$invested_amount);


     $overall_return = $daily_roi * $duration;

     //increment the profit after 24hours

     if($date == $next_profit_date)
     {
         //increment the users profits with the percentage and wait for next profit date

         $q = $conn->prepare("UPDATE earnings SET earned_amount= :earned_amount WHERE plan_name= :plan_name");
         $q->execute(array('earned_amount'=>$daily_roi,'plan_name'=>$data->bundle));




     }

     $qe = "INSERT INTO earnings(amount_invested,plan_name,earned_amount,date_invested,end_date,total_return,expected_return,nextprofit_date)
     VALUES(:amount_invested,:plan_name,:earned_amount,:date_invested,:end_date,:total_return,:expected_return,:nextprofit_date)";
     $qt = $conn->prepare($qe);
     $qt->execute(['amount_invested'=>$amount,'plan_name'=>$data->bundle,'earned_amount'=>0,'date_invested'=>$date,
     'end_date'=>$finaldate,'total_return'=>0,'expected_return'=>$overall_return,'nextprofit_date'=>$next_profit_date]);

 }

//  header("refresh: 4 url=./");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->
    <title>INVESTMENT CALCULATOR</title>
</head>

<body>



    <form action="" method="post">

        <div class="elem-group">
            <label for="captcha">ENTER AMOUNT TO INVEST</label><i class="fa fa-pencil"></i>
            <!-- <img src="captcha.php" alt="CAPTCHA" class="captcha-image"><b><i class="fa fa-repeat refresh-captcha" aria-hidden="true"></b></i> -->
            <br>

            <input type="number" id="captcha" name="amount"  placeholder="$40">

                         <div class="form-group row">
                            <label for="permissions1" class="col-sm-2 form-control-label">MODERATOR ROLE</label>
                            <div class="col-sm-10">
                                <div class="radio">
                                    <select name="plan" id="permissions_id"
                                        class="form-control c-select" onchange="">
                                        <option value="">- - SELECT INVESTMENT PLAN - -</option>
                                        <?php
                                        $query = $conn->prepare("SELECT * FROM plans");
                                        $query->execute();
                                        $stmt = $query->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($stmt as $row){

                                            ?>
                                             <option value="<?php echo $row->bundle ?>" selected='selected'><?php echo $row->bundle.' ' .'Plan'.' '.'$'.$row->minimium.' - '.'$'.$row->maximium; ?></option>
                                            <?php

                                        }
                                        ?>


                                    </select>
                                </div>
                            </div>
                        </div>
        </div>

        <button type="submit" name="submit">PROCEED</button>


    </form>


    <table class="table table-striped mt-3 table-responsive">
                            <thead>
                                <tr class="nk-tb-item nk-tb-head" style="background-color:silver">
                                <th class="nk-tb-col tb-col-mb"><span class="sub-text">STATUS</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">Amount Invested</span></th>
                                    <th class="nk-tb-col tb-col-mb"><span class="sub-text">PLAN Name</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">EARNED</span></th>
                                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">DATE INVESTED</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">END DATE</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">TOTAL RETURN</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">EXPECTED RETURN</span></th>
                                    <th class="nk-tb-col"><span class="sub-text">NEXT PROFIT DATE</span></th>
                                </tr>
                            </thead>
                            <tbody>

<?php
$quu = $conn->prepare("SELECT * FROM earnings");
$quu->execute();
$stmt = $quu->fetchAll(PDO::FETCH_OBJ);
foreach ($stmt as $value) {
    # code...


?>
                                    <tr class="nk-tb-item">
                                    <td class="nk-tb-col tb-col-mb">
                                            <span
                                                class="tb-amount"><?php
                                                if($date > $value->end_date){
                                                    ?>
                                                    <span style="color:green;">
                                                      Expired & Trading Paused
                                                </span>
                                                    <?php
                                                }
                                                ?>
                                            </span>
                                        </td>

                                        <td class="nk-tb-col tb-col-mb">
                                            <span
                                                class="tb-amount"><?php echo $value->amount_invested; ?>
                                            </span>
                                        </td>

                                        <td class="nk-tb-col tb-col-mb">
                                            <span
                                                class="tb-amount"><?php echo $value->plan_name; ?>
                                            </span>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
                                            <span
                                                class="tb-amount">$<?php echo number_format($value->earned_amount,2); ?>
                                            </span>
                                        </td>

                                        <td class="nk-tb-col tb-col-mb">
                                            <span
                                                class="tb-amount"><?php echo $value->date_invested; ?>
                                            </span>
                                        </td>

                                        <td class="nk-tb-col tb-col-mb">
                                            <span
                                                class="tb-amount"><?php echo $value->end_date;?>
                                            </span>
                                        </td>

                                        <td class="nk-tb-col tb-col-mb">
                                            <span class="tb-amount">
                                            <?php echo $value->total_return; ?>
                                            </span>
                                        </td>
                                        <td class="nk-tb-col tb-col-mb">
                                            <span class="tb-amount">
                                           $<?php echo number_format($value->expected_return,2); ?>
                                            </span>
                                        </td>

                                        <td class="nk-tb-col tb-col-mb">
                                            <span class="tb-amount">
                                           <?php echo $value->nextprofit_date; ?>
                                            </span>
                                        </td>




                                    </tr>
<?php
}

?>

                                <!-- .nk-tb-item  -->
                            </tbody>
                        </table>



    <script>
        var refreshButton = document.querySelector(".refresh-captcha");
        refreshButton.onclick = function () {
            document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
        }
    </script>


</body>

</html>
