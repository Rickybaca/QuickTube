<?php
    session_start();
    
    //Auth
    if (!isset($_SESSION['userId'])) {
        http_response_code(401);
        exit();
    }
    
    include '../connect.php';
    $conn = getDatabaseConnection("QuickTube");
    
    $np = array();
    $np[':userId'] = $_SESSION['userId'];
    $sql = "SELECT username, search FROM user NATURAL JOIN history WHERE user.userId = :userId";
    
    //$sql = "SELECT search FROM history where userId = :userId";
    
    $stmt= $conn->prepare($sql);
    $stmt->execute($np);
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>