<?php
    session_start();
    
    if(!isset($_SESSION['userId'])){
        header("Location:login.html");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title id="title"> </title>
        <link rel="shortcut icon" href="quicktubeLogo.ico">
        <link href="styles/accountStyles.css" rel="stylesheet" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
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
                    <div id = "textCenter">Account Settings</div>
                </div>
            </div>
            <div class ="right">
                <div id="main">
                    <button type="button" class="btn btn-primary" id="mainButton">Home</button>
                </div>
                &nbsp
                <div id="logout">
                    <button type="button" class="btn btn-primary" id="logoutButton">Logout</button>
                </div>
            </div>
        </div>
        <div class ="mainBody">
            <div id = "user"></div>
            <div id = "historyFont">History</div>
            <div id="history"></div><br>
            <div id= "playlistHeader">Playlist</div>
            <div><table id="playlist"></table></div><br>
            <div id = "passHeader">Edit Password</div>
            <div class = "changePass">
                <input type="text" id="newPass" placeholder=" enter new password"></input> &nbsp
                <button type="button" class="btn btn-primary" id="passButton">Change</button>
            </div>
            <h3 id="alert"></h3>
        </div>
    </body>
    <footer class = "bottomPart"><br>QuickTube&copy by Antonio, Daichi, Maximillian, and Ricky</footer>
    <script>
    
        //Need an AJAX call to retrieve data from php to the database
        var userName = document.getElementById("user");
        var titleName = document.getElementById("title");
        
         $(document).on('click','#passButton',function(){
             console.log("button clicked");
            $.ajax({
                type:"POST",
                url:"api/editPassword.php",
                dataType:"json",
                data:{
                    'password': $("#newPass").val(),
                },
                success:function(data){
                    console.log("Success"); 
                    $("#alert").append("Password changed");
                },
                error:function(data){
                    console.log("Error");
                    console.log(data);
                }
               });
           });
        
        document.getElementById("mainButton").onclick = function(){
            location.href = "home.php";
        }
        
        $("#logoutButton").on('click',function(){
           window.location = "logout.php"; 
        });
        
        $(document).ready(function(){
            $.ajax({
                type:"GET",
                url:"api/accountSetting.php",
                dataType:"json",
                success:function(data,status){
                    data.forEach(function(key){
                        userName.innerHTML = "Welcome back, " + key['username'];
                        titleName.innerHTML = (key['username']).toUpperCase() + "'s ACCOUNT"; 
                   });
               }
           });
           
           $.ajax({
               type:"GET",
               url:"api/getSearch.php",
               dataType:"json",
               success:function(data,status){
                   $("#history").append("Previous Searches: " + " ");
                   data.forEach(function(key){
                       $("#history").append(key['search'] + " | ");
                   });
               }
           });
           
           var count = 0;
           $.ajax({
               type:"GET",
               url:"api/getPlaylists.php",
               dataType:"json",
               success:function(data,status){
                   data.forEach(function(key){
                       if(count  == 5){
                           $("#playlist").append(`<tr>`);
                           count = 0;
                       }
                       $("#playlist").append(`<td><iframe height="auto" src="${key['url']}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                       </iframe><br><button type="button" class="deleteBttn" id="${key['url']}">Remove from playlist</button></td>`);
                       count+=1;
                   });
                }
           })
        });
        
        $(document).on('click',".deleteBttn",function(){
            console.log($(this).attr("id"))
           $.ajax({
              type:"POST",
              url:"api/deleteVideo.php",
              dataType: "json",
              data:{'url': $(this).attr("id")},
              success:function(data,status){
                  if(data.delete){
                      console.log("complete");
                      location.href = "account.php";
                  }else{
                      console.log("error");
                  }
              }
           });
        });
    </script>
</html>