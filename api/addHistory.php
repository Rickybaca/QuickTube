<?php
    session_start();
    
    //Auth
    if (!isset($_SESSION['userId'])) {
        http_response_code(401);
        exit();
    }
    
    $httpMethod = strtoupper($_SERVER['REQUEST_METHOD']);
    
    switch($httpMethod) {
      case 'POST':
        include '../connect.php';
        $conn = getDatabaseConnection("QuickTube");
        //$id = $_POST['id'];
        $search = $_POST['search'];
        $userId = $_SESSION['userId'];
        
        //INSERT INTO `QuickTube`.`history` (`search`, `id`, `userId`) VALUES ('chicken', NULL, '1');
        $sql = "INSERT INTO `QuickTube`.`history` (`search`, `userId`) VALUES ('$search', '$userId')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        http_response_code(200);
    
        // Allow any client to access
        header("Access-Control-Allow-Origin: *");
        // Let the client know the format of the data being returned
        header("Content-Type: application/json");
    
        echo(json_encode(array()));
        break;
      
     case 'PUT':
        http_response_code(401);
        echo "Not Supported";
        break;
      
    case 'DELETE':
        http_response_code(401);
        echo "Not Supported";
        break;
    }
?>