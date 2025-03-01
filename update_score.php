<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit('Unauthorized');
}

// Database connection
$conn = new mysqli("localhost", "root", "", "gaming_dashboard");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from POST request
$userId = intval($_POST['user_id']);
$score = 10; // Fixed score for winning
$gameId = 1; // Game ID (e.g., 1 for Rock Paper Scissors)
$date = date("Y-m-d H:i:s"); // Current timestamp

// Update user total_points and win_count in users table and insert into scores table
$stmt1 = $conn->prepare("UPDATE users SET total_points = total_points + ?, win_count = win_count + 1 WHERE id = ?");
$stmt1->bind_param("ii", $score, $userId);
$stmt1->execute();
$stmt1->close();

// Insert score into the scores table
$stmt2 = $conn->prepare("INSERT INTO scores (user_id, game_id, score, date) VALUES (?, ?, ?, ?)");
$stmt2->bind_param("iiis", $userId, $gameId, $score, $date);
$stmt2->execute();
$stmt2->close();

$conn->close();
?>
