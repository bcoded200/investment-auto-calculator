# investment-auto-calculator
A php script that automatically calculates investments , return the exact roi at the right time till the end of the investment period. 



  script to calculate investment plans automatically in php!
 if you are building an investment application such as hypi,trading-mining website, etc... using core php / frameworks, having your clients investment calculate  automatically is actually the best practice! many developers finds it difficult to integrate this techinque in their project. if you have been seraching the             internet on how to achieve this, you are in the right repositories!
       
   <h1> How to install</h1>
  NOTE: To use this script on laravel, you have to convert the queries to eloquent query and create artisan command for the crunjob! 
  basically this code works perfectly on core php applications All you need is to tweek the code to suit your needs. 
  
  git clone this repo to your local machine:
  
              git clone https://github.com/bcoded200/investment-auto-calculator.git
  
  create a database on xampp or webserver and upload the sql file to the database. The sql is saved in the database folder,
  
  set the database configuration file to connect to your database!  then visit
                 
               http://yoururl.com/investment-auto-calculator/
  
  go to crunjob.php and comment out the first line with te below code , e.g remove the trailling double slashes at the begining of the code this will enable the crunjob to run automatically every 3seconds without refreshing the page manually.
                
                header("refresh: 3 url= ./crunjob.php");
  
  navigate to the website homepage in your browser and make a random investment according to the options provided for you.
  
  you can add below line of code under the require "functions.php"; in index.php file for live trading without manually refreshing to see earned profits.
  
                  header("refresh: 4 url= ./crunjob.php");
               
  the database table will give u a clear insight on what to fill in your own datbase tables for investment
  calculations according to your site structure!
 
  if you find it difficult using this simple script,
  i can teach you how to use it on anydesk or zoom with a little token!
  also i can  help you convert the script to laravel eloquent query and
  install it in your laravel application
 
  You can find me on telegram <a href='https://telegram.com/@codedweb' target='__blank'>@codedweb</a>  || Mail <a href='mailto:dakingeorge58@gmail.com'>Mail</a> || call <a href='+2348162791926'>Call</a>
  
  ##    https://www.codedwebltd.com
