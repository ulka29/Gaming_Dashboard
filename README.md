# 🎮 Gaming Dashboard

## 📌 Project Overview
```
The **Gaming Dashboard** is a web-based platform where users can register, log in, and play different games. The platform categorizes games into **Scoring** and **Non-Scoring** types. Users can track their scores, view their profiles, and compete with others.

🚀 Built with **HTML, CSS, JavaScript, PHP, and MySQL**, the system runs on **XAMPP (Apache & phpMyAdmin)** and provides a smooth gaming experience.
```
---

## 🛠️ Technologies Used
```
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL (phpMyAdmin)
- **Server:** Apache (XAMPP)
```
---

## 🌟 Features
### 1️⃣ User Authentication
```
- ✅ User Registration
- 🔐 Secure Login & Logout (Hashed Passwords)
```
### 2️⃣ Dashboard
```
- 👤 User Profile with Personal Details
- 🎲 Categorization of Games: **Scoring & Non-Scoring**
```
### 3️⃣ Games Available
#### 🏆 **Scoring Games:**
```
- ✊ Rock Paper Scissors
```
#### 🎮 **Non-Scoring Games:**
```
- 🔠 Word Scramble
- ❌⭕ Tic Tac Toe
- ❓ Guess Word
- 🎨 Color Play
```
### 4️⃣ Score Tracking & Leaderboard
```
- 🏅 Stores game scores in the database
- 📊 Maintains **Win Count** and **Total Points**
- 🕒 Displays Recent Scores
```
---

## 🗄️ Database Schema
### 📌 Tables Structure
#### **1️⃣ `games`**
```
| Column   | Type          | Details             |
|----------|-------------|--------------------|
| game_id  | INT (PK, AI) | Unique Game ID |
| game_name | VARCHAR | Name of the Game |
```
#### **2️⃣ `scores`**
```
| Column    | Type          | Details                                  |
|-----------|-------------|---------------------------------------|
| score_id  | INT (PK, AI) | Unique Score ID                       |
| user_id   | INT (FK)    | References `users.id`                 |
| game_id   | INT (FK)    | References `games.game_id`            |
| score     | INT         | User's Score                           |
| date      | TIMESTAMP   | Time of Game Completion               |
```
#### **3️⃣ `users`**
```
| Column       | Type          | Details                                      |
|--------------|-------------|-------------------------------------------|
| id           | INT (PK, AI) | Unique User ID                            |
| name         | VARCHAR      | Full Name                                 |
| email        | VARCHAR (U)  | User Email (Unique)                      |
| password     | VARCHAR      | Hashed Password                          |
| age          | INT          | User Age                                 |
| gender       | VARCHAR      | User Gender                              |
| win_count    | INT (Default 0) | Number of Wins                        |
| total_points | INT (Default 0) | Total Score Accumulated               |
```
---

## 🛠️ Installation Guide
### **1️⃣ Install XAMPP**
```
- 🔗 [Download XAMPP](https://www.apachefriends.org/index.html)
- Install & Start **Apache** and **MySQL** in XAMPP Control Panel.
```
### **2️⃣ Setup Database**
```
- Open **phpMyAdmin** → `http://localhost/phpmyadmin/`
- Create a new database **`gaming_dashboard`**
- Import `database.sql` file.
```
### **3️⃣ Configure Database Connection**
```
- Open `db/connection.php`
- Update credentials if needed:
```
```php
  $host = 'localhost';
  $user = 'root';
  $password = '';
  $database = 'gaming_dashboard';
```
### **4️⃣ Run the Project**
```
- Move the project folder to `htdocs` (inside XAMPP directory).
- Open the browser and go to: `http://localhost/gaming_dashboard/dashboard.php`
```
---

## 🚀 Future Enhancements
```
✅ Add Multiplayer Support for Some Games  
✅ Implement OAuth Login (Google, Facebook, etc.)  
✅ Improve UI/UX with Animations and Better Design  
✅ Add More Games and Achievements  
```
---

## 📌 Contributing
```
Want to improve the project? Feel free to contribute! Fork the repo, make changes, and submit a pull request.
```
---

## 📄 License
```
This project is **open-source** and free to use.
```
🔥 **Enjoy Gaming!** 🎮

