<?php
    include '../connect.php';
    
    $conn = getDatabaseConnection("QuickTube");
    $uName = $_POST['username'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password-repeat'];
    
    $sql = "SELECT username FROM user WHERE username = '$uName'";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt -> fetch(PDO::FETCH_ASSOC);
    
    if($records['username']){
        $usernameCheck = false;
    }else{
        $usernameCheck = true;
    }
    
    if($password == $password_repeat){
        $passwordCheck = true;
    }else{
        $passwordCheck = false;
    }
    
    if($usernameCheck && $passwordCheck){
        $createAccount = true;
    }else{
        $createAccount = false;
    }
    
    if($createAccount){
        $sql = "INSERT INTO  `user` (`username` ,`password`)VALUES ('$uName','$password')";
        $stmt = $conn->prepare($sql);
        $stmt->execute(); 
    }
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode(array("createAccount" => $createAccount,"usernameCheck" => $usernameCheck, "passwordCheck" => $passwordCheck));

?>