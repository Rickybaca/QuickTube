<?php
    session_start();
    
    if(!isset($_SESSION['userId'])){
        header("Location:login.html");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title id="title">Admin Dashboard</title>
        <link rel="shortcut icon" href="quicktubeLogo.ico">
        <link href="styles/accountStyles.css" rel="stylesheet" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <style>
            #historyT, td{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="heading" >
            <div class = "left">
                <div id="logo">
                    <img src="quicktubeLogo.png" width="50" height="50" alt="qt"></img>
                </div>
            </div>
            <div class = "center">
                <div id = "text">
                    <div id = "textCenter">Admin Dashboard</div>
                </div>
            </div>
            <div class ="right">
                <div id="logout">
                    <button type="button" class="btn btn-primary" id="logoutButton">Logout</button>
                </div>
            </div>
        </div>
        <div class ="mainBody">
            <div id = "user"></div>
            <div id = "historyFont">User Search History</div>
            <div id="history"><table id="historyT"></table></div><br>
            <div id= "playlistHeader">Active User</div>
            <div id="activeUser"></div><br>
            <div id = "passHeader"></div>
            <div class = "manage">
                <div id="userHeader"></div>
            </div>
            <h3 id="alert"></h3>
        </div>
    </body>
    <footer class = "bottomPart"><br>QuickTube&copy by Antonio, Daichi, Maximillian, and Ricky</footer>
    <script>
        /* global $ */
        $(document).ready(function(){
            let searches;
            let playlist;
            $.ajax({
               type:"GET",
               url:"adminApi/activeUser.php",
               dataType:"json",
               success:function(data){
                   if (data.length > 1){
                       $("#activeUser").append("Active Users: " + (data.length - 1) + "<br>");
                   }else {
                       $("#activeUser").append("Active User: " + (data.length - 1) + "<br>");
                   }
               }
            });
            
            $.ajax({
               type:"GET",
               url: "adminApi/adminHistory.php",
               dataType: "json",
               success:function(data){
                   $("#activeUser").append("Searches made: " + data.length + "<br>");
                   searches = data.length;
                 for(var i = 0; i < data.length;i++){
                     if(i % 10 == 0){
                         $("#historyT").append("<tr>")
                     }
                    $("#historyT").append("| " + (data[i].search).toUpperCase() + " | ");
                 }
               }
            });
            
            $.ajax({
                type:"GET",
                url: "adminApi/activePlaylist.php",
                dataType : "json",
                success:function(data){
                    $("#activeUser").append("Videos stored in playlist: " + data.length + "<br>");
                }
            });
            
            $("#logoutButton").on('click',function(){
               window.location = "logout.php"; 
            });
            
            console.log(searches);
        });
    </script>
</html>