<?php
    session_start();
    
    //Auto
    if (!isset($_SESSION['userId'])) {
        http_response_code(401);
        exit();
    }
    
    include '../connect.php';
    $conn = getDatabaseConnection("QuickTube");
    
    $userId = $_SESSION['userId'];
    $url = $_POST['url'];
    
    $sql = "INSERT INTO playlist (url,userId) values ('$url','$userId')";
    
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    
    if($_POST['url'] == $records['url']){
        $successful = false;
    }else{
        $successful = true;
    }
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode(array("successful" => $successful));
?>