<?php

// function getDatabaseConnection(){
//     $connUrl = getenv('JAWSDB_MARIA_SILVER_URL');
//     $hasConnUrl = !empty($connUrl);
//     $connParts = null;
//     if ($hasConnUrl) {
//         $connParts = parse_url($connUrl);
//     }
    
//     // $host = $hasConnUrl ? $connParts['host']: getenv('IP');
//     // $dbname = $hasConnUrl ? ltrim($connParts['path'],'/') : 'QuickTube';
//     // $username = $hasConnUrl ? $connParts['user'] : getenv('C9_USER');
//     // $password = $hasConnUrl ? $connParts['pass'] : '';
    
//     // $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     //mysql://b7606294bab829:cf7395d4@us-cdbr-iron-east-02.cleardb.net/heroku_573bd42da32009b?reconnect=true
//     $host = "us-cdbr-iron-east-02.cleardb.net";
//     $dbname = "heroku_573bd42da32009b";
//     $username = "b7606294bab829";
//     $password = "cf7395d4";
    
//     $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
//     $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//     return $dbConn;
 
// }

 function getDatabaseConnection($dbname = 'ottermart'){
    
    $host = "localhost";//cloud 9
    $dbname = "QuickTube";
    $username = "dkanasugi";
    $password = "";
    
     if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbname = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 

    
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    return $dbConn;

}

?>