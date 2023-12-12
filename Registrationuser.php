<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "jellskie";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];
    $description = $_POST['description'];

    if ($password !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
        $targetDirectory = "images/";
        $profilePath = $targetDirectory . basename($_FILES['profile']['name']);

        if (move_uploaded_file($_FILES['profile']['tmp_name'], $profilePath)) {
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }

        $sql = "INSERT INTO users (username, email, password, profile, description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([$username, $email, $password, $profilePath, $description]);

        if ($stmt->rowCount()) {
            echo "User registered successfully.";
        } else {
            echo "Error registering user.";
        }
    } else {
        echo "No file uploaded or an error occurred while uploading.";
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="/Stylesheets/Registration_style.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 130vh;
    background: rgb(240, 240, 240);
}

header {
    background-color: #333;
    color: #fff;
    height: 60px;
    padding: 10px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}
.logo {
    display: flex;
    align-items: center;
}

.logo img {
    width: 50px;
    height: 50px;
    border-radius: 10px; 
    background-color: red; 
}

.logo h1 {
    margin-left: 10px;
}

.search-bar {
    flex: 1;
    display: flex;
    align-items: center;
    background-color: #444;
    border-radius: 5px;
    padding: 5px;
    margin: 0 10px;
}

.search-bar input {
    border: none;
    background: transparent;
    color: #fff;
    width: 100%;
    padding: 5px;
    outline: none;
}

.search-bar button {
    background: transparent;
    border: none;
    color: #fff;
    cursor: pointer;
}
nav {
    display: flex;
}

nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

nav li {
    margin: 0 15px;
}

nav a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
}
.profile-photo img{
    width: 30px;
    height: 30px;
    border-radius: 50%; 
    background-color: #fff; 
}
.dropdown {
    position: relative;
    display: inline-block;
}

.dropbtn {
    background-color: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    left: -80px;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 130vh;
}
.container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}
.login-container {
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    display: flex;
    justify-content: center;
    margin-top: 10px;
    max-width: 800px; 
    width: 100%;
    border-radius: 10px; 
}
.login-image {
    flex: 1;
    height: 100%;
    border-radius: 10px 0 0 10px;
}
.login-form {
    flex: 1.5; 
    padding: 20px;
    border-radius: 10px 0 0 10px; 
}
.login-form h2 {  
    margin-bottom: 1px;
}
.login-form form {
    display: flex;
    flex-direction: column;
}
.login-form label {
    font-weight: bold;
    margin-bottom: 5px;
}
.login-form input {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #000000;
    border-radius: 5px;
}
.login-form button {
    padding: 10px;
    font-weight: bold;
    background-color: #d1d1d1;
    color: #000000;
    border:solid 2px #000000;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 10px;
}
.login-form button:hover {
    background-color: #1d1d1d;
    color: #ccc;
}
footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
}
</style>
<body>
    <header>
    <div class="logo">
            <a href = "Homepage.php"><img src="images/Logo.jpg" alt="Logo" width="50" height="50"></a>
            <h1>Skill Steam</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
        <nav>
            <ul>
                <li><a href="#"><i class="fa-regular fa-message"></i></a></li>
                <li><a href="#"><i class="fa-regular fa-bell"></i></i></a></li>
                <li><a href="#"><i class="fa-regular fa-heart"></i></a></li>
                <li><a href="#">Orders</a></li>
            </ul>
        </nav>
        <div class="profile-photo">
            <img src="/Images/IMG_20230221_225314.jpg" alt="">
        </div>
    </header>

    <div class="container">
        <div class="login-container">
            <div class="login-image">
                <img src="IMG_20230221_225314.jpg" alt="Login Image" width="100%" height="auto">
            </div>
            <div class="login-form">
                <h2>Create your Account</h2>
                <p>Fill up your form with your info</p>
                <form action="#" method="post" enctype="multipart/form-data">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <label for="password">Confirm Password:</label>
                    <input type="password" id="confirmpassword" name="confirmpassword" required>
                    <label for="profile-picture">Profile Picture:</label>
                    <input type="file" id="profile-picture" name="profile" accept="image/*" onchange="displayImage(this)">
                    <div class="profile-photo"></div>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" cols="50"></textarea>
                    <button type="submit">submit</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        &copy; 2023 Skill Steam. All rights reserved.
    </footer>
</body>

</html>
