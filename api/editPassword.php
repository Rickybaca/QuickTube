<?php
    session_start();
    
    //Auth
    if (!isset($_SESSION['userId'])) {
        http_response_code(401);
        exit();
    }

    include '../connect.php';
    $conn = getDatabaseConnection("QuickTube");
    
    $userId = $_SESSION['userId'];
    $password = $_POST['password'];
    
    
    //UPDATE user SET `password`= "bokek" where userId = 15
    $sql = "UPDATE user SET `password`= '$password' where `userId` = '$userId'";
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    
    // Allow any client to access
    header("Access-Control-Allow-Origin: *");
    // Let the client know the format of the data being returned
    header("Content-Type: application/json");

    echo(json_encode(array()));
?>