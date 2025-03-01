<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "gaming_dashboard");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$query = "SELECT * FROM users WHERE id=" . $_SESSION['user_id'];
$result = $conn->query($query);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gaming Dashboard</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f6fa;
        }


        .sidebar-wrapper {
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            align-items: flex-start;
            height: 100%;
            z-index: 100;
        }

        .sidebar {
            width: 60px; /* Initial collapsed width */
            height: 100%;
            background-color: #2c3e50;
            transition: width 0.3s ease;
            overflow: hidden;
            position: relative; /* Position relative for button positioning */
        }
        
        .sidebar:hover:not(.open) {
            width: 200px; /* Expanded width on hover if not manually toggled open */
        }

        .sidebar.open {
            width: 200px; /* Expanded width when open */
        }
        .sidebar .profile {
            display: flex;
            align-items: center;
            padding: 20px 0;
            color: white;
            transition: padding 0.3s ease;
            width: 100%;
        }

        .sidebar img {
            position: relative;
            left: 18px;
            opacity: 1;
            border-radius: 50%;
            width: 48px; 
            height: 48px;
            transition: width 0.3s ease, height 0.3s ease;
        }

        .sidebar .profile span {
            margin-left: 30px;
            opacity: 0;
            transition: opacity 0.3s ease;
            white-space: nowrap;
        }

        .sidebar.open img,
        .sidebar:hover img
        {
            width: 55px;
            height: 55px;
        }

        .sidebar.open .profile span,
        .sidebar:hover .profile span
        {
            opacity: 1;
        }

        .sidebar ul {
            position: relative;
            left: -13px;
            list-style-type: none;
            padding: 20px 0;
            position: relative;
        }

        .sidebar ul li {
            display: flex;
            align-items: center;
            padding: 20px 20px;
            color: white;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .sidebar ul li:hover {
            background-color: #34495e;
        }

        .sidebar ul li i {
            position: relative;
            left: 4px;
            font-size: 24px;
            margin-right: 20px;
            transition: opacity 0.3s ease;
        }

        .sidebar ul li span {
            margin-left: 15px;
            display: flex;
            justify-content: flex-start;
            text-align: left;
            opacity: 0;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }

        .sidebar.open ul li span,
        .sidebar:hover ul li span {
            opacity: 1;
        }

        .sidebar .indicator {
            position: absolute;
            left: 15px;
            width: 4px;
            height: 60px;
            background-color: #0d6efd;
            transition: top 0.3s ease;
            pointer-events: none; /* Prevent the indicator from interfering with mouse events */
        }

        .toggle-btn {
            position: absolute;
            top: 10px;
            right: -15px; /* Position the button half outside the sidebar */
            width: 30px;
            height: 30px;
            background-color: #0d6efd;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border-radius: 50%; /* Make the button circular */
            z-index: 1000; /* Ensure the button stays on top */
        }
        .toggle-btn i{
            position: relative;
            top: 1px;
        }
        .toggle-btn:hover {
            background-color: #0950ba;
        }

.sidebar a{
    text-decoration: none;
    color : white;

}


        .content {
            width: 100%;
            padding: 30px;
            box-sizing: border-box;
            background-color: #ecf0f1;
            overflow-y: auto;

            padding-left: 88px;
        }
        .profile, .games-dashboard {
            display: none;
        }
        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        } 
        h3 {
            color: #2980b9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f7f7f7;
        }
        .show {
            display: block;
        }
        .games-dashboard.show {
            display: block;
        }
        .profile.show {
            display: block;
        }

/* 
scrollable row */

/* recolor the link in black */
.poster a{
    text-decoration: none;
    color: black;
    
}
/* Poster Resize  */
img{
    width: 210px;
    height: 290px; 
}
/* poster container managment */
 .poster {
 	width: 210px;
 	height: 320px;
 	background-color: white;
 	flex: 0 0 auto;
     transition: transform 0.3s ease, background-color 0.3s ease;
 	position: relative;
 	overflow: hidden;
 	cursor: pointer;
 	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
     text-align: center;
     font-size: 18px;
    
 }
 /* poster hover transition */
 .poster:hover {
    transform: scale(1.05);
}


.scrollable-row {
	display: flex;
	gap: 15px;
	overflow-x: auto;
	overflow-y: hidden;
	padding: 10px 0;
	scroll-behavior: smooth;
	scrollbar-width: none;
	z-index: 1;
}

.scrollable-row::-webkit-scrollbar {
	display: none;
}

.section {
	margin-bottom: 0;
	position: relative;
}

.section h2 {
	font-size: 1.8rem;
	margin-bottom: 0;
	text-align: left;
}
        
    </style>
</head>
<body>

        <div class="sidebar-wrapper">
        <div class="sidebar" id="sidebar">
            <ul>
                <div class="profile">
                    <img src="https://i.pinimg.com/originals/6d/1f/20/6d1f2038bcf52a4cc496489fcd2139a6.jpg" alt="profile pic">
                    <span><?php echo $user['name']; ?></span>
                </div>

                <div class="indicator" id="indicator"></div>
                <li><i class="icon"><i class="fa-solid fa-house"></i></i><a href="#" onclick="showSection('dashboard')"><span>Home</span></a></li>
                <li><i class="icon"><i class="fa-solid fa-envelope"></i></i><span>Emails</span></li>
                <li><i class="icon"><i class="fa-solid fa-chart-column"></i></i><a href="#" onclick="showSection('profile')"><span>Profile</span></a></li>
                <li><i class="icon"><i class="fa-solid fa-gem"></i></i><span>Premium</span></li>
                <li><i class="icon"><i class="fa-solid fa-right-from-bracket"></i></i><a href="logout.php"><span>Logout</span></a></li>
            </ul>
        </div>
        <button class="toggle-btn" id="toggleBtn">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>
<!-- 
sidebar ends -->
        <div class="content">
            <!-- Dashboard Section (Default View) -->
            <div id="dashboard" class="games-dashboard show">
                <h3>Available Games</h3>

                <div class="section new-this-week">
		<h2>Scoring Games</h2>
		<div class="scrollable-row">
			<div class="poster" >
            <a href="rock-paper-scizor.php"><img src="image/rock-paper-scizor.jpg" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=1&q=95&w=160&h=240" class="poster-portrait" alt="Portrait Placeholder"><span>Rock-Paper_scissor
				</span></a>
			</div>
			

		</div>
	</div>



    <div class="section new-this-week">
		<h2>Non-Scoring Games</h2>
		<div class="scrollable-row">
			<div class="poster" >
            <a href="color-play.php"><img src="image/color-play.jpeg" class="poster-portrait" alt="Portrait Placeholder"><span>Color-Play1</span>
				</a>
			</div>
            <div class="poster" >
            <a href="color-play2.php"><img src="image/color-play2.jpeg" class="poster-portrait" alt="Portrait Placeholder"><span>Color-Play2</span>
				</a>
			</div>
            <div class="poster" >
            <a href="tic-tac-toe-master/index.php"><img src="image/tic-tac-toe-master.png" class="poster-portrait" alt="Portrait Placeholder"><span>Tic-Tac-Toe</span>
				</a>
			</div>
            <div class="poster" >
            <a href="gradient-back.php"><img src="image/gradient-back.jpg" class="poster-portrait" alt="Portrait Placeholder"><span>Make Your Gradient</span>
				</a>
			</div>
            <div class="poster" >
            <a href="guess.html"><img src="image/guess.jpg" class="poster-portrait" alt="Portrait Placeholder"><span>Guess the number</span>
				</a>
			</div>
            <div class="poster" >
            <a href="Word_Scramble/Wordscramble.html"><img src="image/Wordscramble.png" class="poster-portrait" alt="Portrait Placeholder"><span>Word Scramble</span>
				</a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=4&q=95&w=160&h=240&fit=fill" class="poster-portrait" alt="Portrait Placeholder"><span>Color-Play</span>
				</a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=4&q=95&w=160&h=240&fit=fill" class="poster-portrait" alt="Portrait Placeholder"><span>Color-Play</span>
				</a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=4&q=95&w=160&h=240&fit=fill" class="poster-portrait" alt="Portrait Placeholder"><span>Color-Play</span>
				</a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=4&q=95&w=160&h=240&fit=fill" class="poster-portrait" alt="Portrait Placeholder"><span>Color-Play</span>
				</a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=4&q=95&w=160&h=240&fit=fill" class="poster-portrait" alt="Portrait Placeholder"><span>Color-Play</span>
				</a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=4&q=95&w=160&h=240&fit=fill" class="poster-portrait" alt="Portrait Placeholder"><span>Color-Play</span>
				</a>
			</div>
            <div class="poster" >
            <a href="rock-paper-scizor.php"><img src="https://via.assets.so/movie.png?id=4&q=95&w=160&h=240&fit=fill" class="poster-portrait" alt="Portrait Placeholder"><span>Color-Play</span>
				</a>
			</div>
			

		</div>
	</div>


                <h3>Leaderboard</h3>
                <?php
                // Fetch leaderboard based on total_points
                $leaderboardQuery = "SELECT users.name, users.total_points 
                                     FROM users 
                                     ORDER BY users.total_points DESC LIMIT 10";
                $leaderboardResult = $conn->query($leaderboardQuery);
                ?>
                <table>
                    <tr>
                        <th>User</th>
                        <th>Total Points</th>
                    </tr>
                    <?php while($row = $leaderboardResult->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['total_points']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>

            <!-- Profile Section -->
            <div id="profile" class="profile">
                <h3>Your Profile</h3>
                <div class="card">
                    <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Total Points:</strong> <?php echo $user['total_points']; ?></p>
                    <p><strong>Wins:</strong> <?php echo $user['win_count']; ?></p>
                </div>

                <!-- Score Table for the Latest 5 Games with Game Names -->
                <h3>Recent Scores</h3>
                <?php
                // Fetch the latest 5 scores for the user along with game names
                //Executes the SQL statement with the bound parameter. to save from sql injection.
                $scoresQuery = "SELECT games.game_name, scores.score, scores.date 
                                FROM scores 
                                JOIN games ON scores.game_id = games.game_id 
                                WHERE scores.user_id = ? 
                                ORDER BY scores.date DESC LIMIT 5";
                $stmt = $conn->prepare($scoresQuery);
                $stmt->bind_param("i", $_SESSION['user_id']);
                $stmt->execute();
                $scoresResult = $stmt->get_result();
                ?>
                <table>
                    <tr>
                        <th>Game Name</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                    <?php while($scoreRow = $scoresResult->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $scoreRow['game_name']; ?></td>
                        <td><?php echo $scoreRow['score']; ?></td>
                        <td><?php echo $scoreRow['date']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                <?php $stmt->close(); ?>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleBtn');
        const indicator = document.getElementById('indicator');
        const menuItems = document.querySelectorAll('.sidebar ul li');

        // Toggle sidebar open/close
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            // Adjust button icon based on sidebar state
            if (sidebar.classList.contains('open')) {
                toggleBtn.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
            } else {
                toggleBtn.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
            }
        });

        // Move the indicator line on hover
        menuItems.forEach((item, index) => {
            item.addEventListener('mouseover', () => {
                const itemHeight = item.offsetHeight;
                const offsetTop = item.offsetTop;
                indicator.style.top = `${offsetTop}px`;
                indicator.style.height = `${itemHeight}px`; // Match the height of the current item
            });
        });

        // Show different sections based on user click
        function showSection(section) {
            document.getElementById('profile').classList.remove('show');
            document.getElementById('dashboard').classList.remove('show');

            document.getElementById(section).classList.add('show');
        }
        //scrollable row

    </script>
</body>
</html>
