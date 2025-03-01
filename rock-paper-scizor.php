<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rock Paper Scissors</title>
    <style>
        body { background: #f5f6fa; font-family: Arial, sans-serif; }
        .container { text-align: center; margin-top: 50px; }
        h1 { color: #2980b9; }
        .result { font-size: 24px; margin: 20px 0; color: #e74c3c; }
        .score { font-size: 20px; margin: 20px 0; }
        .game_option { display: inline-block; margin: 10px; cursor: pointer; border: 2px solid transparent; border-radius: 10px; padding: 10px; }
        .user-choice { background-color: #ffeb3b; border-color: #fbc02d; }
        .computer-choice { background-color: #9c27b0; border-color: #7b1fa2; }
        img { width: 80px; display: block; margin: 0 auto; }
        button { margin-top: 20px; padding: 10px 20px; background-color: #2980b9; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #1f6392; }
    </style>
</head>
<body>

<div class="container">
    <h1>Rock Paper Scissors</h1>
    <div class="result" id="resultMessage"></div>
    <div class="score">Your choice: <strong id="your_choice">N/A</strong></div>
    <div class="score">Computer's choice: <strong id="computer_choice">N/A</strong></div>

    <div class="game_option" onclick="chooseOption(1)">
        <img src="https://cdn2.iconfinder.com/data/icons/font-awesome/1792/hand-rock-o-512.png" alt="Rock">
        <span>Rock</span>
    </div>
    <div class="game_option" onclick="chooseOption(2)">
        <img src="https://cdn2.iconfinder.com/data/icons/font-awesome/1792/hand-stop-o-512.png" alt="Paper">
        <span>Paper</span>
    </div>
    <div class="game_option" onclick="chooseOption(3)">
        <img src="https://cdn2.iconfinder.com/data/icons/font-awesome/1792/hand-scissors-o-512.png" alt="Scissors">
        <span>Scissors</span>
    </div>
<br><br>
    <button id="newGameButton" style="display:none;" onclick="newGame()">New Game</button>
    <button onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
</div>

<script>
let gameActive = true;
let userId = <?php echo json_encode($_SESSION['user_id']); ?>; // Get user ID from PHP
let scoreUpdated = false; // Flag to check if the score has been updated

function chooseOption(choice) {
    if (!gameActive) return; // Prevent playing if the game is not active

    const computerChoice = Math.floor(Math.random() * 3) + 1; // Random choice for computer (1-3)
    document.getElementById('your_choice').innerText = choice === 1 ? 'Rock' : (choice === 2 ? 'Paper' : 'Scissors');
    document.getElementById('computer_choice').innerText = computerChoice === 1 ? 'Rock' : (computerChoice === 2 ? 'Paper' : 'Scissors');

    // Highlight user's choice
    document.querySelectorAll('.game_option').forEach(option => option.classList.remove('user-choice'));
    document.querySelectorAll('.game_option')[choice - 1].classList.add('user-choice');

    // Highlight computer's choice
    document.querySelectorAll('.game_option')[computerChoice - 1].classList.add('computer-choice');

    // Determine the result
    let resultMessage = '';
    if (choice === computerChoice) {
        resultMessage = "It's a draw!";
    } else if ((choice === 1 && computerChoice === 3) || 
               (choice === 2 && computerChoice === 1) || 
               (choice === 3 && computerChoice === 2)) {
        resultMessage = "You won!";
        scoreUpdated = true; // Mark that the score should be updated
    } else {
        resultMessage = "You lost!";
    }

    document.getElementById('resultMessage').innerText = resultMessage;

    // If the score is updated, call PHP to update the score
    if (scoreUpdated) {
        updateScore();
    }

    gameActive = false; // Set the game to inactive
    document.getElementById('newGameButton').style.display = 'inline-flex'; // Show new game button
}

function newGame() {
    // Reset the choices and result message for a new game
    document.getElementById('your_choice').innerText = 'N/A';
    document.getElementById('computer_choice').innerText = 'N/A';
    document.getElementById('resultMessage').innerText = '';

    // Clear highlights
    document.querySelectorAll('.game_option').forEach(option => option.classList.remove('user-choice', 'computer-choice'));

    // Reset game state
    gameActive = true; // Allow playing again
    scoreUpdated = false; // Reset score update flag
    document.getElementById('newGameButton').style.display = 'none'; // Hide new game button
}


//AJAX code to run php and update user and score table
function updateScore() {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_score.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Score updated successfully');
        } else {
            console.error('Error updating score');
        }
    };
    xhr.send('user_id=' + userId + '&game_id=1&score=10'); // Assuming game_id = 1 for Rock Paper Scissors and score = 10
}

</script>





</body>
</html>