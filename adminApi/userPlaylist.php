<?php
    include '../connect.php';
    $conn = getDatabaseConnection("QuickTube");
    
    // $sql = "SELECT userId FROM user WHERE 1";
    
    // $stmt = $conn->prepare($sql);
    // $stmt ->execute();
    // $record=$stmt->fetchAll(PDO::FETCH_ASSOC);
    // echo json_encode($record);
    
    $sql = "SELECT user.userId, playlist.userId FROM `user` LEFT JOIN `playlist` on user.userId = playlist.userId";
    
    $stmt = $conn->prepare($sql);
    $stmt ->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>