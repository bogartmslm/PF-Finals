<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jellskie";

$userId = $_SESSION['seller_id'];
    if(!$userId){
        header("Location:Loginseller.php");
    }

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM product WHERE id = ?");
    $stmt->execute([$deleteId]);
}

if (isset($_POST['logout'])) {
    $_SESSION = array();

    session_destroy();

    header("Location: Loginseller.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM product WHERE seller_id = ?");
$stmt->execute([$userId]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products</title>
    <script src="https://kit.fontawesome.com/68df3d5144.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/Stylesheets/Header_style.css">
    <link rel="stylesheet" href="/Stylesheets/Side-nav.css">
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
                <button class="dropbtn"><img src="/Images/IMG_20230221_225314.jpg" alt=""></button>
                <div class="dropdown-content">
                    <a href="My-Accountseller.php">My Account</a>
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
                <li style="background: #c0c0c0;"><a href="My-Accountseller.php"><i class="fa-regular fa-user"></i>  My Account</a></li>
                <li><a href="messagesseller.php"><i class="fa-regular fa-message"></i>  Messages</a></li>
                <li><a href="insertproduct.php"><i class="fa-regular fa-cart-plus"></i>  Post Product</a></li>
                <li><a href="My-products.php">  My Product</a></li>

            </ul>
        </div>
        </div>
        <div class="content-box">
            <div class="content-title">
                <h2>My Products</h2>
                <br>
            </div>
            <hr>
                <div class="all-cards">                    
    <?php foreach ($products as $product): ?>
            <div class="all-cards">
                    
                    <div class="product-info">
                        <img src="<?= $product['image'] ?>" alt="">
                        <div class="product-name">
                            <p id="prod-name"><?= $product['product_name'] ?> </p>
                            <p id="description"><?= $product['description'] ?></p>
                            <p id="category"><?= $product['category'] ?></p>
                        </div>
                        <div class="price">
                            <p>$$$$$</p>
                        </div>
                    </div>
                    
                    <div class="order-confirm">
                        <div class="btn">
                            <a href="?delete_id=<?= $product['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            <?php endforeach; ?>            
                        </div>
                    </div>
            </div>
            
            <style>
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
                .all-cards{
                            width: 100%;
                        }
                        .seller-info{
                            display: flex;
                            margin: 0 20px;
                            align-items: center;
                            gap: 5px;
                            position: relative;
                        }
                        .seller-info button{
                            height: 24px;
                            font-size: 11px;
                            border: none;
                            border-radius: 3px;
                            background: rgb(224, 53, 1);
                            color: white;
                        }
                        .seller-info .view-btn{
                            background: transparent;
                            border: 1px solid #b6b4b4;
                            color: #b6b4b4;
                        }
                        .product-status{
                            display: flex;
                            position: absolute;
                            right: 0;
                            align-items: center;
                            gap: 10px;
                            height: 40px;
                        }
                        .product-status .stat1{
                            font-size: 12px;
                            color: #02bd85;
                        }
                        .product-status .stat2{
                            font-size: 14;
                            color: rgb(255, 145, 0);
                        }
                        .product-info img{
                            aspect-ratio: 1/1;
                            object-fit: cover;
                            height: 80px;
                            margin: 10px 20px 10px 0px;
                            border: 1px solid #b6b4b4;
                        }
                        .product-info{
                            display: flex;
                            align-items: centers;
                            position: relative;
                            margin: 0 20px;
                            border-top: 1px solid #b6b4b4;
                            border-bottom: 1px solid #b6b4b4;
                        }
                        .product-name #prodname{
                            font-size: 14px;
                            margin: 5px 10px;
                        }
                        .product-name #description{
                            color: #b6b4b4;
                            font-size: 12px;
                            margin: 2px 10px;
                            width: 400px;
                        }
                        .product-name #category{
                            font-size: 12px;
                            margin: 2px 10px;
                        }
                        .product-info .price{
                            position: absolute;
                            right: 0;
                            display: flex;
                            align-items: center;
                            height: 100%;
                            font-size: 14px;
                        }
                        .price p{
                            color: rgb(255, 145, 0);
                        }
                        .total-info{
                            display: flex;
                            justify-content: flex-end;
                            margin: 0 20px;
                        }
                        .total-info .total{
                            display: flex;
                            align-items: center;
                            gap: 5px;
                        }
                        .total p{
                            font-size: 14px;
                        }
                        #total-price{
                            font-size: 16px;
                            color: rgb(255, 145, 0);
                        }
                        .order-confirm{
                            display: flex;
                            position: relative;
                            align-items: center;
                            margin: 0 20px;
                        }
                        .order-confirm p{
                            font-size: 12px;
                            color: #b6b4b4;
                        }
                        .btn{
                            position: absolute;
                            right: 0;
                            gap: 200px;
                        }
                        .btn a{
                            height: 35px;
                            width: 89px;
                            font-size: 13px;
                            border: none;
                            border-radius: 2px;
                            cursor: pointer;
                        }
                        .btn #btnrr{
                            color: white;
                            background-color: rgb(224, 53, 1);
                            gap: 15spx;
                        }
                        .btn a{
                            border: 1px solid #b6b4b4;
                            width: 100px;
                            color: #444;
                            text-align: none;
                        }
            </style>
        </div>
    
</body>

</html>