
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jellskie";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $userId = $_SESSION['user_id'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <script src="https://kit.fontawesome.com/68df3d5144.js" crossorigin="anonymous"></script>
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
.container{
    display: flex;
    margin: 20px 50px;
    height: 500px;
    
}
.side-nav{
    flex: .7; 
    display: flex;
    flex-direction: column;
}
.profile-info img{
    aspect-ratio: 1/1;
    background: red;
    height: 40px;
    margin: 0 10px;
    border-radius: 50%;
}
.profile-info{
    display: flex;
    align-items: center;
}
.profile-info p{
    font-weight: bold;

}
.account-nav{
    display: flex;
    
}
.account-nav ul{
    list-style: none;
}
.account-nav li{
    margin: 20px 0;
    text-decoration: none;
    font-weight: bold;
    font-size: 15px;
    padding: 10px 20px;
    border-radius: 20px;
}
.account-nav li :hover{
    color: rgb(255, 145, 0);
}
.account-nav li a {
    text-decoration: none;
    color: black;
}
.account-nav i{
    color: rgb(85, 85, 255);
    font-size: 25px;
}

.content-box{
    flex: 3;
    background: white;
}
.content-title{
    margin: 0 40px;
    
}
.content-box hr{
    width: 91%;
}
.content-title h2{
    margin-bottom: -10px;
}
.content-title p{
    font-size: 12px;
}
.notifications{
    width: 92%;
    height: 100%;
    display: flex;
    flex-direction: column;
    margin: 0 4%;
}
.notif-card{
    display: flex;
    width: 100%;
    align-items: center;
}
img{
    margin: 10px;
    aspect-ratio: 1/1;
    height: 80px;
    object-fit: cover;
    
}
#notif-title{
    margin: 5px 5px;
}
#notif-id ,#datetime{
    margin: 0 5px;
    font-size: 14px;
    color: #444;
}
button {
    margin: 10px;
    padding: 10px 10px;
    margin-left: auto; 
    background: transparent;
    border: solid 1px #444;
    border-radius: 4px;
    color: #444;
    cursor: pointer;
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
                <li><a href="messaging.html"><i class="fa-regular fa-message"></i></a></li>
                <li><a href="Notifications.html"><i class="fa-regular fa-bell"></i></i></a></li>
                <li><a href="Wishlist.html"><i class="fa-regular fa-heart"></i></a></li>
                <li><a href="My-Request.html">Orders</a></li>
                
            </ul>
        </nav>
        <div class="profile-photo">
            <div class="dropdown">
                <button class="dropbtn"><img src="/Images/IMG_20230221_225314.jpg" alt=""></button>
                <div class="dropdown-content">
                    <a href="My-Account.html">My Account</a>
                    <a href="Login.html">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="side-nav">
        <div class="profile-info">
            <img src="#" alt="">
            <p>username</p>
        </div>
        <div class="account-nav">
            <ul>
            <li style="background: #c0c0c0;"><a href="My-Accountuser.php"><i class="fa-regular fa-user"></i>  My Account</a></li>
                <li><a href="Notifications.php"><i class="fa-regular fa-bell"></i>  Notification</a></li>
                <li><a href="messagesuser.php"><i class="fa-regular fa-message"></i>  Messages</a></li>
                <li><a href="Wishlist.php"><i class="fa-regular fa-heart"></i>  Wishlist</a></li>
            </ul>
        </div>
        </div>
        <div class="content-box">
            <div class="content-title">
                <h2>Wishlist</h2>
                <br>
            </div>
            <hr>
            <div class="edit-form">
                <div class="notifications">
                    <div class="notif-card">
                        <img src="IMG_20230221_225314.jpg" alt="">
                        <div class="notif-info">
<?php
   
    $stmt = $pdo->prepare("SELECT * FROM user_notifications Limit 3");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($products){
        foreach ($products as $product) {
    ?>      
            <h1>Product Details</h1>
            <p>ID: <?= $product['id'] ?></p>
            <p>Seller ID: <?= $product['seller_id'] ?></p>
            <p>Notification: <?= $product['notif'] ?></p>
            








                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <?php
    }
} else {
    echo "No products found.";
}
} catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    ?>
</body>

</html>