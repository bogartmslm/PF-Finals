<?php
session_start();
if (isset($_SESSION['message'])) {
    echo "<p>{$_SESSION['message']}</p>";
    unset($_SESSION['message']);
}

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "jellskie";

if (isset($_POST['logout'])) {
    $_SESSION = array();

    session_destroy();

    header("Location: Loginseller.php");
    exit();
}
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $enteredPassword = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password FROM sellers WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $enteredPassword === $user['password']) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['seller_id'] = $user['id'];
        header("Location: My-Accountseller.php");
        exit();
    } else {
        $errorMessage = "Password verification failed. Invalid username or password.";
    }

}
}catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/Stylesheets/Login_style.css">
    <link rel="stylesheet" href="/Stylesheets/Header_style.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
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
    left: -130px;
}

.dropdown-content a, input[type="submit"]{
    color: black;
    padding: 12px 5px;
    text-decoration: none;
    display: block;
    text-decoration: none;
    color: black;
    width: 100%;
    font-size: 16px;
    border: none;
    text-align: center;
}

.dropdown-content a, input[type="submit"]:hover {
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
}

.login-container {
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    display: flex;
    margin-top: 50px;
    max-width: 800px; 
    width: 100%;
    border-radius: 10px; 
}
.login-image {
    flex: 1;
    height: auto;
    border-radius: 10px 0 0 10px;
    object-fit: cover;
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
.or-text {
    text-align: center;
    margin: 0px 0px 10px 0px;
    font-weight: bold;
}
footer {
    background-color: #333;
    color: #ffffff;
    text-align: center;
    padding: 10px;
    margin-top: 100px;
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
            <div class="dropdown">
                <button class="dropbtn"><img src="/Images/IMG_20230221_225314.jpg" alt=""></button>
                <div class="dropdown-content">
                    <a href="My-Account.html">My Account</a>
                    <?php
				if (isset($_SESSION['user_id'])) {
					?>
				
				<form action="" method="post">
    			    <input type="submit" name="logout" value="Logout">
    			</form>
				<?php
					}
				?>
                </div>
            </div>
        </div>
    </header>
    </header>
    <center>
    <div class="login-container">
        <div class="login-image">
            <img src="IMG_20230221_225314.jpg" alt="Login Image" width="100%" height="auto">
        </div>
        <div class="login-form">
            <h2>Sign in to your Account as a seller</h2>
            <p>Don't have an account yet?<a href="Registrationseller.php"> click here</a></p>
            <form action="#" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>

            </form>
        </div>
    </div>
    </center>
    <footer>
        &copy; 2023 Skill Steam. All rights reserved.
    </footer>
</body>
</html>
