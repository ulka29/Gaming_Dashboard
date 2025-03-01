<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "gaming_dashboard");

// Increment game count when the game page is loaded
$userId = $_SESSION['user_id'];
$conn->query("UPDATE users SET game_count = game_count + 1 WHERE id = $userId");

// Record the score as 0 for this non-scoring game
$conn->query("INSERT INTO scores (user_id, score) VALUES ($userId, 0)");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .container{
    display: none;

}
     body{
        background-image:url("https://www.onlygfx.com/wp-content/uploads/2018/03/grey-polygonal-background-fade-2.png") ;
    }
h1{
        line-height: 1.25;
        margin: 1em 0 0;
        overflow: hidden;
    }
    nav li{
        list-style-type: none;
        float: left;
        width: 30px;
        height: 30px;
        margin: 0 15px 15px 0;
        border-radius: 50%;
        border: 3px black solid;
    }
   
    #yellow{
        color: yellow;
        background-color: yellow;
    }
    .back_yellow{
        background-color: yellow;
    }
    #blue{
        color: blue;
       background-color: blue
    }
    .back_blue{
        background-color: blue;
    }
    #white{
        color: white;
         background-color: white;
    }
    .back_white{
        background-color: white;
        color: black;
    }
    #grey{
        color: grey;
        background-color: grey;}
    .back_grey{
        background-color: grey;
    }
    
</style>
<body id="main">
    <h1>CLICK THE BUTTON AND SWITCH THE COLOR</h1>
    <br><hr>
    <nav>
    <li id="yellow" class="button" onclick="yellow()"></li>
    <li id="blue" class="button" onclick="blue()"></li>
    <li id="white" class="button" onclick="white()"></li>
    <li id="grey" class="button" onclick="grey()"></li>
    </nav>

</body>
<script>
    function yellow(){
        var yellow=document.getElementById('main')
        yellow.setAttribute('class','back_yellow')
    }
    function blue(){
        var blue=document.getElementById('main')
        blue.setAttribute('class','back_blue')
    }
    function white(){
        var white=document.getElementById('main')
        white.setAttribute('class','back_white')
    }
    function grey(){
        var grey=document.getElementById('main')
        grey.setAttribute('class','back_grey')
    }
</script>
</html>