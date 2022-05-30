<?php
// header("refresh: 3 url= ./crunjob.php");
/**
 * script to calculate investment plans automatically in php!
 * NOTE: you can use this script to calculate bitcoin trading && Bitcoin investment plans, all financial investment
 * HYIP investments and so on..
 * All you need is to tweek the code to suit your needs. the sql is saved in the database folder,
 * install it on xampp and set the config files for this script in function.php to match your server config..
 *
 * the database table will give u a clear insight on what to fill in your own datbase tables for investment
 * calculations. if you are using laravel, this script can be converted to eloquent query and crun job should be
 * set using laravel  command schedule...
 *
 * if you find it difficult using this simple script,
 * i can teach you how to use it on anydesk or zoom with a little token!
 * also i can  help you convert the script to laravel eloquent query and
 * install it in your laravel application
 *
 * You can find me on telegram @codedweb  || messanger @codedchris001 || call +2348162791926
 */

require "functions.php";

echo "<br />";
echo $date;
echo "<br />";
    //fetch the investment plan selected by the user
    $query = $conn->prepare("SELECT * FROM earnings");
    $query->execute();
    $stmt = $query->fetchAll(PDO::FETCH_OBJ);
    $oldbalance = 0;
    foreach ($stmt as $data) {

            //extract all from the investment plan where the plans matched with the plans in our earnings table

            $query = $conn->prepare("SELECT * FROM plans WHERE bundle= :bundle");
            $query->execute(['bundle'=>$data->plan_name]);
            $stmt = $query->fetchAll(PDO::FETCH_OBJ);
            foreach ($stmt as $allplans) {

                   //get the investment number of days
                    $duration = $allplans->duration;
                    $duration = str_replace("Days"," ",$duration);

                     //calculate the investment duration  and extract the stoppage time for the investment
                     //ignore starts
                    $days = "+$duration days";
                    $strt_date = $date;
                    $calc_strtdate = date_create($strt_date);
                    $frmt_date = date_format($calc_strtdate, "m/d/Y");
                    $new_date = strtotime($days, strtotime($frmt_date));
                    $stoppage_date =  date("Y-m-d h:i:s", $new_date);//please ignore this block of code
                    //ignore ends

                    //check if the maturity date is reached and end the investment trading
                    if($date > $data->end_date)
                    {
                        echo json_encode(array(
                            'code' => 500,
                            'message'=> $warning = $allplans->bundle.' '. 'plan with investment amount of'.' '.$data->amount_invested.' '
                            .'has expired and no longer trades!!',
                        ));

                    }else
                    {
                        //logic for incrementing the ongoin plans here!!

                        //get the payout  times dynamically based on selected
                        //plan and increment profits according to payout times

                        $increment_time = $allplans->payout;
                        $increment_time = str_replace("day", " ",$increment_time);
                        echo "<pre>";
                       echo  $next_profit_date = date('Y-m-d h:i:s',strtotime("+$increment_time day", strtotime($date)));
                       echo "</pre>";
                        //get the amount the user invested
                        $invested_amount = $data->amount_invested;

                        //get the percentage amount for each dynamic plan
                        $percent = $allplans->percentage;

                        //extract the percentage result for the plan and prepare for database update
                        $daily_roi = getPercentage($percent,$invested_amount);

                        if($date >= $data->nextprofit_date)//change to == for proper calculation
                        {
                          //increment the users profits with the percentage and wait for next profit date

                          //get the old balance and add to the new balance
                          $calcbalance = $oldbalance += $data->earned_amount + $daily_roi;


                          $q = $conn->prepare("UPDATE earnings SET earned_amount= :earned_amount, nextprofit_date= :nextprofit_date WHERE plan_name= :plan_name");
                          $q->execute(array('earned_amount'=>$calcbalance,'nextprofit_date'=>$next_profit_date,'plan_name'=>$allplans->bundle));

                          echo "<pre>";
                          echo json_encode(array(
                              'code' => 200,
                              'message'=> "crun job run successfully! congratulations all account has been traded  we will repeat this action on the next profit day +1 day",
                          ));
                          echo "</pre>";

                          //send email to notify clients about the good news!

                          /** email code goes here!! */

                          //end

                        }




                    }
                    //end


      }

    }


?>


