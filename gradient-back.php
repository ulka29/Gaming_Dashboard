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
    <title>Gradient background</title>
</head>
<style>
    body{
        background: linear-gradient(to right,green, blue);
    }
    .change{
        color: pink;
    }
    #h3{
        font-size: 30px;
    }
    .done{
        text-decoration: line-through;
    }
</style>
<body id="bodydetail">
    <h3 id="h3">Hello</h3>
    <button onclick="changeColor()">change color</button>
    <br>
    <br>
    <input type="color" class="color1" name="color1" id="color1" value="#00ff00">
    <input type="color" class="color2" name="color2" id="color2" value="#00cc00">
    <button id="btn1">random</button>
    <script>
        var h3=document.getElementsByTagName("h3")[0];
        var color1=document.getElementById("color1");
        var color2=document.getElementById("color2");
        var body=document.getElementById("bodydetail");     
        var button=document.getElementById("btn1")   
        function changeColor(){
            h3.style.color="#"+Math.floor(Math.random()*16777215).toString(16);
            // h3.className="change";
        }

        h3.addEventListener("click",function(){
           // h3.classList.add("done");
             h3.classList.toggle("done");
        })
        button.addEventListener("click",function(){
            let r1="#"+Math.floor(Math.random()*16777215).toString(16);
            let r2="#"+Math.floor(Math.random()*16777215).toString(16);
                color1.value=r1;
                color2.value=r2;
            body.style.background= "linear-gradient(to right,"+r1+","+r2+")" ;
        })
    </script>
</body>
</html>
<!-- class name ek class
classlint ek add ek remove -->