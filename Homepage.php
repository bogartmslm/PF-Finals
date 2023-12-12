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
    if(!$userId){
        header("Location:Loginuser.php");
    }
   
    
    if (isset($_POST['logout'])) {
        $_SESSION = array();
    
        session_destroy();
    
        header("Location: Loginuser.php");
        exit();
    }

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <script src="https://kit.fontawesome.com/68df3d5144.js" crossorigin="anonymous"></script>
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
    min-height: 130vh;
    background: rgb(240, 240, 240);
    gap: 20px;
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
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
*{
    font-family: 'Roboto';
}
body {
    display: flex;
    align-items: center;
    flex-direction: column;
    height: 100vh; /* This ensures the container is centered vertically */
    margin: 0; /* Remove default margin */
}

.categories {
    width: 100%;
    margin-top: -30px;
    position: -webkit-sticky;
    position: sticky;
}

.categories ul {
    display: flex;
    justify-content: space-evenly;
    padding: 0; /* Remove default padding */
    border-top: 1px solid gray;
    border-bottom: 1px solid gray;
}

.categories li {
    list-style: none;
    width: 80px;
    display: flex;
    align-items: center;
    text-align: center;
    font-size: 16px;
    font-weight: bolder;
    color: rgb(87, 87, 87);
}
.container{
    width: 96%;
    background: #e7e7e7;
    display: flex;
    align-items: center;
    flex-direction: column;
}
.container h1{
    border-bottom: 2px solid black;
    padding-bottom: 20px;
    margin-bottom: 0;
    width: 100%;
    text-align: center;
}
.row{
    display: flex;
    width: 100%;
    justify-content: space-evenly;
}
.card-img img{
    aspect-ratio: 1/1;
    width: 100%;
}
.card{
    width: 200px;
    background: white;
    margin-top: 10px;
    padding: 10px;
}
.card:hover{
    border: 1px solid rgb(255, 145, 0);
}
.card-name{
    text-align: center;
}
.card-name p{
    margin-top: 0;
    font-size: 15px;
}.card-price{
    color: rgb(255, 145, 0);
    margin-left: 10px;
}
html {
  scroll-behavior: smooth;
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
    <div class="categories">
        <ul>
            <li><a href="#section1">Programming & Tech</a></li>
            <li><a href="#section2">Graphic & Design</a></li>
            <li><a href="#section3">Writing & Translating</a></li>
            <li><a href="#section4">Video & Animation</a></li>
            <li><a href="#section5">Art & Illustration</a></li>
            <li><a href="#section6">Music & Audio</a></li>
            <li><a href="#section7">Digital Marketing</a></li>
            <li><a href="#section8">Business</a></li>
        </ul>
        <style>
            .categories li a{
                text-decoration: none;
                color: #444;
            }
            .container a{
                text-decoration: none;
            }
            .container .card-name p{
                color: #333;
            }
        </style>
    </div>
    <div class="container">
        <h1>Discover</h1>
        <div class="row">
            <?php 
            $stmt = $pdo->prepare("SELECT * FROM product");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);        
            foreach ($products as $product): ?>
                <a href="Product_listing.php?id=<?= $product['id'] ?>">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" width="50">
                        </div>
                        <div class="card-details">
                            <div class="card-name">
                                <p><?= $product['product_name'] ?></p>
                            </div>
                            <div class="card-price">
                                <p><?= $product['price'] ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>



    <div class="container" id="section1">
        <h1>Programming & Tech</h1>
        <div class="row">
            <?php 
            $stmt = $pdo->prepare("SELECT * FROM product WHERE category = 'Programming & Tech' ");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);        
            foreach ($products as $product): ?>
                <a href="Product_listing.php?id=<?= $product['id'] ?>">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" width="50">
                        </div>
                        <div class="card-details">
                            <div class="card-name">
                                <p><?= $product['product_name'] ?></p>
                            </div>
                            <div class="card-price">
                                <p><?= $product['price'] ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container" id="section2">
        <h1>Graphic & Design</h1>
        <div class="row">
            <?php 
            $stmt = $pdo->prepare("SELECT * FROM product WHERE category = 'Graphic & Design' ");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);        
            foreach ($products as $product): ?>
                <a href="Product_listing.php?id=<?= $product['id'] ?>">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" width="50">
                        </div>
                        <div class="card-details">
                            <div class="card-name">
                                <p><?= $product['product_name'] ?></p>
                            </div>
                            <div class="card-price">
                                <p><?= $product['price'] ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container" id="section3">
        <h1>Writing & Translating</h1>
        <div class="row">
            <?php 
            $stmt = $pdo->prepare("SELECT * FROM product WHERE category = 'Writing & Translating' ");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);        
            foreach ($products as $product): ?>
                <a href="Product_listing.php?id=<?= $product['id'] ?>">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" width="50">
                        </div>
                        <div class="card-details">
                            <div class="card-name">
                                <p><?= $product['product_name'] ?></p>
                            </div>
                            <div class="card-price">
                                <p><?= $product['price'] ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container" id="section4">
        <h1>Video & Animation</h1>
        <div class="row">
            <?php 
            $stmt = $pdo->prepare("SELECT * FROM product WHERE category = 'Video & Animation' ");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);        
            foreach ($products as $product): ?>
                <a href="Product_listing.php?id=<?= $product['id'] ?>">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" width="50">
                        </div>
                        <div class="card-details">
                            <div class="card-name">
                                <p><?= $product['product_name'] ?></p>
                            </div>
                            <div class="card-price">
                                <p><?= $product['price'] ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container" id="section5">
        <h1>Art & Illustration</h1>
        <div class="row">
            <?php 
            $stmt = $pdo->prepare("SELECT * FROM product WHERE category = 'Art & Illustration' ");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);        
            foreach ($products as $product): ?>
                <a href="Product_listing.php?id=<?= $product['id'] ?>">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" width="50">
                        </div>
                        <div class="card-details">
                            <div class="card-name">
                                <p><?= $product['product_name'] ?></p>
                            </div>
                            <div class="card-price">
                                <p><?= $product['price'] ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container" id="section6">
        <h1>Music & Audio</h1>
        <div class="row">
            <?php 
            $stmt = $pdo->prepare("SELECT * FROM product WHERE category = 'Music & Audio' ");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);        
            foreach ($products as $product): ?>
                <a href="Product_listing.php?id=<?= $product['id'] ?>">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" width="50">
                        </div>
                        <div class="card-details">
                            <div class="card-name">
                                <p><?= $product['product_name'] ?></p>
                            </div>
                            <div class="card-price">
                                <p><?= $product['price'] ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container" id="section7">
        <h1>Digital Marketing</h1>
        <div class="row">
            <?php 
            $stmt = $pdo->prepare("SELECT * FROM product WHERE category = 'Digital Marketing' ");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);        
            foreach ($products as $product): ?>
                <a href="Product_listing.php?id=<?= $product['id'] ?>">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" width="50">
                        </div>
                        <div class="card-details">
                            <div class="card-name">
                                <p><?= $product['product_name'] ?></p>
                            </div>
                            <div class="card-price">
                                <p><?= $product['price'] ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="container" id="section8">
        <h1>Business</h1>
        <div class="row">
            <?php 
            $stmt = $pdo->prepare("SELECT * FROM product WHERE category = 'Business' ");
            $stmt->execute();
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);        
            foreach ($products as $product): ?>
                <a href="Product_listing.php?id=<?= $product['id'] ?>">
                    <div class="card">
                        <div class="card-img">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['product_name'] ?>" width="50">
                        </div>
                        <div class="card-details">
                            <div class="card-name">
                                <p><?= $product['product_name'] ?></p>
                            </div>
                            <div class="card-price">
                                <p><?= $product['price'] ?></p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    ?>
</body>
</html>
