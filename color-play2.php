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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Play</title>
</head>
<style>
     body{
        background-image: url('https://www.pngkit.com/png/full/25-257230_dust-cloud-png-dust-cloud-transparent-background.png');
    }
    img{
        display: flex;
        flex-direction: column-reverse;
        float: left;
        
    }
    #color_change{
        justify-content: center;
        margin-top: 30px;
        font-size: 30px;
       background-color: crimson;
width: 100%;
       border-radius: 4px;
    }
</style>
<body>
    <header>
   
       <img src="https://www.pngmart.com/files/3/Vector-Transparent-Background.png" alt="" width="35%" height="30%">
       <img src="https://clipartcraft.com/images/transparent-circle-glowing-9.png" alt="" width="30%">
       
       <img src="https://www.pngmart.com/files/3/Vector-Transparent-Background.png" alt="" width="35%" height="30%">

   </header>
<div>
   <button id="color_change" onclick="change_color()">CLICK and CHANGE</button>
</div>
<!--<img src="http://www.pngall.com/wp-content/uploads/4/Abstract-Running-Transparent-Background.png" alt=""  width="60%">-->
<script>
     function change_color(){
    let x=Math.floor(Math.random()*256);
    let y=Math.floor(Math.random()*256);
    let z=Math.floor(Math.random()*256);
    let color="rgb("+x+","+y+","+z+")";
    document.body.style.backgroundColor=color
    }
</script>
</body>
</html>