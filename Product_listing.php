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
   
    $stmt = $pdo->prepare("SELECT * FROM product");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(!$userId){
        header("Location:Loginuser.php");
    }

    
    

    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order page</title>
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
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
*{
    font-family: 'Roboto';
}
body {
    display: flex;
    align-items: center;
    flex-direction: column;
    height: 100vh; 
    margin: 0; 
    background: #e7e7e7;
}

.categories {
    width: 100%;
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
    width: 93%;
    display: flex;
    align-items: center;
    flex-direction: column;
    gap: 10px;
}
.container2{
    width: 96%;
    background: #e7e7e7;
    display: flex;
    align-items: center;
    flex-direction: column;
    height: 400px;
}
.row{
    display: flex;
    flex-wrap: wrap;
    width: 100%;
    height: 100vh;
    justify-content: space-evenly;
    flex-wrap: nowrap;

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
.product-section{
    background: white;
    display: flex;
}
.img-side{
    flex: 1;
}
.order-side{
    flex: 2;
}
.img-side img{
    aspect-ratio: 1/1;
    width: 100%;
    padding: 20px;
}
.order-side{
   margin: 20px 50px;
}
.order-name h2{
    font-size: 30px;
}
.order-spec{
    margin: 20px 5px;
}
.order-spec h3{
    color: rgb(87, 87, 87);
}
.order-spec p{
    color: rgb(87, 87, 87);
    font-size: 14px;
    margin-top: -10px;
}
.order-spec span{
    color: black;
}
.order-btn .btn{
    margin: 20px 5px;
    padding: 10px 20px;
}
.order-btn .btn.wishlist{
    background: transparent;
    color: rgb(255, 145, 0);
    border: .5px solid rgb(255, 145, 0);
    cursor: pointer;
}
.order-btn .btn.request{
    background: rgb(255, 145, 0);
    color: white;
    border: .5px solid rgb(255, 145, 0);
    cursor: pointer;

}
.order-price{
    width: 92%;
    background: #e7e7e7;
    padding: 2px 20px;
}
.order-price p{
    font-size: 16px;
    font-weight: bold;
}
.order-price span{
    color: rgb(255, 145, 0);
}
.seller-section{
    width: 100%;
    background: white;
    display: flex;
    align-items: center;
    position: relative;
}
.seller-section img{
    aspect-ratio: 1/1;
    width: 50px;
    margin: 10px 20px;
    border-radius: 50%;
}
.seller-name h3{
    margin-bottom: 0;
}
.seller-name p{
    margin-top: 0;
    font-size: 14px;
    color: #777777;
}
.seller-btn{
    margin: 0 20px;
}
.seller-btn button{
    font-size: 12px;
    padding: 5px 2px;
    border-radius: 2px;
}
.btn-one{
    background: transparent;
    color: rgb(255, 145, 0);
    border: .5px solid rgb(255, 145, 0);
    cursor: pointer;
}
.btn-two{
    background: transparent;
    color: rgb(121, 121, 121);
    border: .5px solid rgb(121, 121, 121);
    cursor: pointer;
}
.seller-info{
    position: absolute;
    right: 0;
    margin: 0 20px;
}
.seller-info p{
    margin: 0;
    font-size: 14px;
    color: #777777;
}
.description{
    background: white;
}
.description h2{
    border-bottom: 1px solid #777777;
    padding-bottom: 20px;
    margin-bottom: 0;
    width: 100%;
    text-align: center;
}
.description-box{
    margin: 0 50px;
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
                    <a href="Login.html">Logout</a>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="product-section">











        <?php
    if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM product WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $produtimage = $product['image'];

 
        ?>




            <div class="img-side">
                <img src="<?= $produtimage ?>" alt="">
            </div>
            <div class="order-side">
                


        
<?php
    

?>
                <div class="order-name">
                    <h2><?= $product['product_name'] ?></h2>
                </div>
                <div class="order-price">
                    <p>Price: <span><?= $product['price'] ?></span></p>
                </div>
                <div class="order-spec">
                    <h3>Product Specification</h3>
                    <p>Catergory: <span>Art & Illustration</span></p>
                    <p>Seller ID: <span> <?= $product['seller_id'] ?></span></p>
                    <p>From: <span>Location</span></p>
                </div>
                <div class="order-btn">
                    <form method = "post">
                        <input type = "submit" value = "wishlist"  class="btn wishlist">
                    </form>


                    <button id="myBtn" class="btn request">Request Now</button>
                    <!-- The Modal -->
                        <div id="myModal" class="modal">
                            <!-- Modal content -->
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <h2>Request Order</h2>
                                    <div class="seller-pfl">
                                        <img src="/Images/IMG_20230221_225314.jpg" alt="Seller Profile Picture">
                                        <span>From: User</span>
                                    </div>
                                    <p>share details, add any requirements, or 
                                        ask any questions to make sure this 
                                        service will meet your expectations.
                                    </p>
                                    
                                    <p>If user can deliver what you need, they 
                                        will reply with a custom offer based on your 
                                        request.
                                    </p>
                                    <hr>
                                    <textarea name="request" id="" cols="60" rows="10"
                                    placeholder="ask a question or share details,(requirements, timeline, budget,etc.)"></textarea>
                                    <form method="post">
                                    <input type="submit" value="submit">
                                    </form>
                                    <?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Assuming $userId is defined and contains the user ID
        $userId = $_SESSION['user_id']; // Please ensure this variable is correctly set

        $stmt = $pdo->prepare("SELECT * FROM product");
        $stmt->execute();
        $sellers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($sellers as $seller) {
            $sellerId = $seller['id'];
            $notif =  'Thank you for Purchasing the Product';
            $stmt = $pdo->prepare("INSERT INTO user_notifications (user_id, seller_id, notif) VALUES (?, ?,?)");
            $stmt->execute([$userId, $sellerId,$notif]);

            if ($stmt->rowCount() > 0) {
                echo "Notification sent successfully for seller ID: $sellerId.<br>";
            } else {
                echo "Error sending notification for seller ID: $sellerId.<br>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>



                                </div>
                            </div>
                    <script>
                        // Get the modal
                        var modal = document.getElementById("myModal");
                        
                        // Get the button that opens the modal
                        var btn = document.getElementById("myBtn");
                        
                        // Get the <span> element that closes the modal
                        var span = document.getElementsByClassName("close")[0];
                        
                        // When the user clicks the button, open the modal 
                        btn.onclick = function() {
                          modal.style.display = "block";
                        }
                        
                        // When the user clicks on <span> (x), close the modal
                        span.onclick = function() {
                          modal.style.display = "none";
                        }
                        
                        // When the user clicks anywhere outside of the modal, close it
                        window.onclick = function(event) {
                          if (event.target == modal) {
                            modal.style.display = "none";
                          }
                        }
                        </script>
                        
                    <style>
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 80px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 40%;
  height: 460px;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
.modal-content h2{
        text-align: center;
    }
    .seller-pfl {
        display: flex;
        align-items: center;
    }
    .seller-pfl img {
        width: 15%;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: 50%;
        margin-right: 10px;
    }
    .seller-pfl span{
        top: 50px;
        font-size: 16px;
        font-weight: bold;
    }
    .modal-content p{
        text-align: justify;
        margin: 10px 20px;
    }
    .modal-content textarea{
        width: 90%;
        height: 120px;
        font-size: 16px;
        margin: 5% 5% 0 5%;
        align-items: center;
        border: none;
        resize: none;
        font-family: inherit;
    }
    .modal-content textarea:focus, input:focus
    {
        outline: none;
    }
    .modal-content button{
        float:right;
        border: none;
        background-color: black;
        color: white;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: bold;
    }
                    </style>
                </div>
                <hr>
            </div>
        </div>
        <div class="seller-section">
            <div class="seller-img">
            <?php

if ($product) {

$seller_id = $product['seller_id'];
$stmts = $pdo->prepare("SELECT * FROM sellers WHERE id = ?");
$stmts->execute([$seller_id]);
$sellers = $stmts->fetch(PDO::FETCH_ASSOC);
if($sellers){
$picture = $sellers['profile'];
$email = $sellers['email'];
$username = $sellers['username'];

?>




    <img src="<?= $picture ?>" alt="">


            </div>
            <div class="seller-name">
                <h3><?= $username ?></h3>
                <p><?= $email ?></p>
            </div>
<?php
}
?>
            <div class="seller-btn">
                <button class="btn-one"><i class="fa-regular fa-message"></i>Chat now</button>
                <button class="btn-two"><i class="fa-regular fa-user"></i>View Profile</button>
            </div>
            <div class="seller-info">
                <p>Products: 000</p>
                <p>Joined: 05/05/22</p>
            </div>
        </div>
        <div class="description">
            <h2>Description</h2>
            <div class="description-box">
                <p><?= $product['description'] ?></p>

            </div>
        </div>
        <div class="container2">
            <h2>Discover</h2>
            <div class="row one">
                <div class="card">
                    <div class="card-img">
                        <img src="<?= $productpic = $product['image'] ?>" alt="">
                    </div>
                    <div class="card-details">
                        <div class="card-name">
                            <p><?= $productname = $product['product_name'] ?></p>
                        </div>
                        <div class="card-price">
                            <p><?= $productprice = $product['price'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="<?= $productpic = $product['image'] ?>" alt="">
                    </div>
                    <div class="card-details">
                        <div class="card-name">
                            <p><?= $productname = $product['product_name'] ?></p>
                        </div>
                        <div class="card-price">
                            <p><?= $productprice = $product['price'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="<?= $productpic = $product['image'] ?>" alt="">
                    </div>
                    <div class="card-details">
                        <div class="card-name">
                            <p><?= $productname = $product['product_name'] ?></p>
                        </div>
                        <div class="card-price">
                            <p><?= $productprice = $product['price'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="<?= $productpic = $product['image'] ?>" alt="">
                    </div>
                    <div class="card-details">
                        <div class="card-name">
                            <p><?= $productname = $product['product_name'] ?></p>
                        </div>
                        <div class="card-price">
                            <p><?= $productprice = $product['price'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="<?= $productpic = $product['image'] ?>" alt="">
                    </div>
                    <div class="card-details">
                        <div class="card-name">
                            <p><?= $productname = $product['product_name'] ?></p>
                        </div>
                        <div class="card-price">
                            <p><?= $productprice = $product['price'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
    <style>
        
        
    </style>


<?php
} else {
    echo "Product not found.";
}
} else {
echo "No product ID specified.";
}
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    ?>
</body>
</html>
