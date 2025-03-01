<?php
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    // Establish the connection
    $conn = new mysqli("localhost", "root", "", "gaming_dashboard");

    // Adjusted SQL query: add total_points and win_count, remove game_count
    $query = "INSERT INTO users (name, email, password, age, gender, total_points, win_count) 
              VALUES ('$name', '$email', '$password', '$age', '$gender', 0, 0)";

    // Check if the query was successful
    if ($conn->query($query) === TRUE) {
        header("Location: login.php");
    } else {
        $error = "Registration failed: " . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .register-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .register-container label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            text-align: left;
            color: #555;
        }
        .register-container input, .register-container select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        .register-container button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        .register-container button:hover {
            background-color: #0056b3;
        }
        .register-container a {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        .register-container a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Create Account</h2>
        <form method="POST" action="register.php" onsubmit="return validateForm()">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter a strong password" required>
            <label for="age">Age:</label>
            <input type="number" id="age" name="age" min="18" placeholder="Enter your age" required>
            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <button type="submit" name="register">Register</button>
        </form>
        <?php if(isset($error)) echo "<p class='error-message'>$error</p>"; ?>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>

    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var age = document.getElementById("age").value;
            var error = false;

            // Check for valid email format
            var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
                alert("Please enter a valid email address.");
                error = true;
            }

            // Check for minimum password length
            if (password.length < 6) {
                alert("Password must be at least 6 characters long.");
                error = true;
            }

            // Check for valid age
            if (age < 18 ) {
                alert("You must be at least 18 years old to register.");
                error = true;
            }

            return !error;
        }
    </script>
</body>
</html>
