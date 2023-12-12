<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jellskie";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sellerId = $_SESSION['seller_id']; // Assuming the session variable contains the seller ID
    if(!$sellerId){
        header("Location:Loginseller.php");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['message']) && isset($_POST['user_id'])) {
            $userId = $_POST['user_id'];
            $message = $_POST['message'];

            $stmt = $pdo->prepare("INSERT INTO seller_messages (seller_id, user_id, message) VALUES (?, ?, ?)");
            $stmt->execute([$sellerId, $userId, $message]);

            if ($stmt->rowCount() > 0) {
                echo "Message sent successfully to user ID: $userId.";
            } else {
                echo "Error sending message.";
            }
        } else {
            echo "Incomplete data.";
        }
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

try {
    $stmt = $pdo->prepare("SELECT id, username FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching users: " . $e->getMessage();
}

try {
    $stmt = $pdo->prepare("SELECT id, user_id, message FROM seller_messages WHERE seller_id = ?");
    $stmt->execute([$sellerId]);
    $sentMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching sent messages: " . $e->getMessage();
}
try {
    $stmt = $pdo->prepare("SELECT id, user_id, message FROM seller_messages WHERE seller_id = ?");
    $stmt->execute([$sellerId]);
    $sentMessages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $uniqueUsers = array_unique(array_column($sentMessages, 'user_id'));
} catch (PDOException $e) {
    echo "Error fetching sent messages: " . $e->getMessage();
}
try {
    // Fetch all messages sent by the current seller
    $stmtSent = $pdo->prepare("SELECT id, user_id, message FROM seller_messages WHERE seller_id = ?");
    $stmtSent->execute([$sellerId]);
    $sentMessages = $stmtSent->fetchAll(PDO::FETCH_ASSOC);

    // Fetch all messages received by the current seller from users
    $stmtReceived = $pdo->prepare("SELECT id, seller_id, message FROM seller_messages WHERE user_id = ?");
    $stmtReceived->execute([$sellerId]);
    $receivedMessages = $stmtReceived->fetchAll(PDO::FETCH_ASSOC);

    // Fetch unique user IDs from received messages
    $uniqueUsersReceived = array_unique(array_column($receivedMessages, 'user_id'));
} catch (PDOException $e) {
    echo "Error fetching messages: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Send Message to Seller</title>
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
                <button class="dropbtn"><img src="IMG_20230221_225314.jpg" alt=""></button>
                <div class="dropdown-content">
                    <a href="My-Account.html">My Account</a>
                    <?php
				if (isset($_SESSION['seller_id'])) {
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
    <div class="container">
        <div class="side-nav">
        <div class="profile-info">
            <img src="#" alt="">
            <p>username</p>
        </div>
        <div class="account-nav">
            <ul>
                <li><a href="My-Accountseller.php"><i class="fa-regular fa-user"></i>  My Account</a></li>
                <li style="background: #c0c0c0;"><a href="messagesseller.php"><i class="fa-regular fa-message"></i>  Messages</a></li>
                <li><a href="insertproduct.php"><i class="fa-regular fa-cart-plus"></i>  Post Product</a></li>
                <li><a href="My-products.php">  My Product</a></li>
            </ul>
        </div>
        </div>
        <div class="content-box">
            <div class="main-container">
            <form method="post">
        <select name="user_id">
            <?php foreach ($users as $user) : ?>
                <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
            <?php endforeach; ?>
        </select>
        <textarea name="message" placeholder="Enter your message"></textarea>
        <input type="submit" value="Send Message">
    </form>

    <!-- Filter Sent Messages -->
    <h2>Filter Sent Messages</h2>
    <form method="get">
        <select name="user_filter">
            <option value="">Select User ID</option>
            <?php foreach ($uniqueUsers as $userId) : ?>
                <option value="<?= $userId ?>"><?= $userId ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Filter">
    </form>

    <!-- Sent Messages -->
    <h2>Sent Messages</h2>
    <ul>
        <?php 
        foreach ($sentMessages as $message) {
            if (isset($_GET['user_filter']) && $_GET['user_filter'] !== '' && $message['user_id'] != $_GET['user_filter']) {
                continue;
            }
        ?>
            <li>
                <strong>To User ID <?= $message['user_id'] ?>:</strong>
                <?= $message['message'] ?>
            </li>
        <?php } ?>
    </ul>

    <!-- Received Messages -->
    <h2>Received Messages</h2>
    <!-- Filter Received Messages -->
    <h2>Filter Received Messages</h2>
    <form method="get">
        <select name="sender_filter">
            <option value="">Select Sender ID</option>
            <?php foreach ($uniqueUsersReceived as $senderId) : ?>
                <option value="<?= $senderId ?>"><?= $senderId ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Filter">
    </form>

    <!-- Received Messages -->
    <h2>Received Messages</h2>
    <ul>
        <!-- Display received messages -->
        <?php foreach ($receivedMessages as $message) : ?>
            <?php 
                // Check if filter is applied and skip messages not matching the filter
                if (isset($_GET['sender_filter']) && $_GET['sender_filter'] !== '' && $message['seller_id'] != $_GET['sender_filter']) {
                    continue;
                }
            ?>
            <li>
                <strong>From User ID <?= $message['seller_id'] ?>:</strong>
                <?= $message['message'] ?>
            </li>
        <?php endforeach; ?>
    </ul>        
    
                
        
            <style>
                /* Add these styles to your existing style block */

/* Styling for the messaging form */
form {
    margin-bottom: 20px;
}

.main-container select, textarea, input[type="submit"] {
    margin-bottom: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    box-sizing: border-box;
}

.main-container textarea {
    resize: vertical;
}

/* Styling for the message list */
.main-container ul {
    list-style: none;
    padding: 0;
}

.main-container li {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Styling for the filter form */
.main-container form[method="get"] {
    margin-top: 20px;
}

/* Additional styling for the tabs */
.main-container .tabs {
    margin-top: 20px;
}

.main-container .tabs ul {
    background: #f1f1f1;
    padding: 10px;
}

.main-container .tab {
    background: #ddd;
    border-bottom: 3px solid #ccc;
    margin-bottom: -3px; /* Adjust to overlap the border with the content below */
}

.main-container .tab:hover {
    background: #e0e0e0;
}

.main-container .tab.active {
    background: #fff;
    border-bottom: 3px solid rgb(255, 145, 0);
}

/* Styling for the content box */
.main-container .content-box {
    padding: 20px;
}

/* Styling for the received messages section */
.main-container h2 {
    margin-top: 20px;
    font-size: 18px;
}

/* Styling for the message boxes */
.main-container ul li {
    background-color: #f9f9f9;
}

/* Adjustments for responsiveness */
@media screen and (max-width: 768px) {
    .container {
        flex-direction: column;
        align-items: center;
    }

    .content-box {
        width: 100%;
    }
}

            </style>
                
    

</body>
</html>
