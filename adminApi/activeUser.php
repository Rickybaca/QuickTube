<?php
    session_start();
    
    if(!isset($_SESSION['userId'])){
        http_response_code(401);
        exit();
    }
    
    include '../connect.php';
    $conn = getDatabaseConnection("QuickTube");
    
    $sql = "SELECT userId FROM user WHERE 1 ";
    
    $stmt = $conn->prepare($sql);
    $stmt ->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>