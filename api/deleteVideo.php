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
    $url = $_POST['url'];
    
    $sql = "SELECT url FROM `playlist` WHERE url = '$url' AND userId = '$userId' ";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $record = $stmt->fetch();
    
    if($_POST['url'] == $record['url']){
        $delete = true;
    }else {
        $delete = false;
    }
  
    $sql = "DELETE FROM  `playlist` WHERE url =  '$url' AND userId =  '$userId'";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    echo json_encode(array("delete" => $delete));
?>