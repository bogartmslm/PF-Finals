<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jellskie";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $userId = $_SESSION['seller_id'];
    if(!$userId){
        header("Location:Loginseller.php");
    }

    if (isset($_POST['logout'])) {
        $_SESSION = array();
    
        session_destroy();
    
        header("Location: Loginseller.php");
        exit();
    }


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $targetDirectory = "images/";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

            $stmt = $pdo->prepare("INSERT INTO product (seller_id,product_name, description, price, image,category) VALUES (?, ?, ?, ?,?,?)");
            $stmt->bindParam(1, $userId);
            $stmt->bindParam(2, $productName);
            $stmt->bindParam(3, $description);
            $stmt->bindParam(4, $price);
            $stmt->bindParam(5, $targetFile);
            $stmt->bindParam(6, $category);

            if ($stmt->execute()) {
                echo "New Product created successfully.";
            } else {
                echo "Error: " . $stmt->errorInfo();
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
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
    display: none;
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
            <li style="background: #c0c0c0;"><a href="My-Accountseller.php"><i class="fa-regular fa-user"></i>  My Account</a></li>
                <li><a href="messagesseller.php"><i class="fa-regular fa-message"></i>  Messages</a></li>
                <li><a href="insertproduct.php"><i class="fa-regular fa-cart-plus"></i>  Post Product</a></li>
                <li><a href="My-products.php">  My Product</a></li>
            </ul>
        </div>
        </div>
        <div class="content-box">
            <div class="content-title">
                <h2>Post Products</h2>
                <br>
            </div>
            <hr>
            <div class="form-container">
                <div class="post-form">
                    <form action="" method = "post"  enctype="multipart/form-data">
                        <label for="">product name</label><br>
                        <input name = "product_name" type="text"><br>
                        <label for="">description</label><br>
                        <textarea name = "description" ></textarea><br>
                        <label for="">price</label><br>
                        <input name = "price" type="number"><br>
                        <label for="category">Catefory</label><br>
                        <label for="">images</label><br>
                        <select name="category" id="">
                            <option value="Programming & Tech">Programming & Tech</option>
                            <option value="Graphic & Design">Graphic & Design</option>
                            <option value="Writing & Translation">Writing & Translation</option>
                            <option value="Video & Animation">Video & Animation</option>
                            <option value="Art & Design">Art & Design</option>
                            <option value="Music & Audio">Music & Audio</option>
                            <option value="Digital Marketing">Digital Marketing</option>
                            <option value="Business">Business</option>
                        </select><br>                       
                        <input name = "image" type="file"><br>
                        <input type="submit">
                    </form>
                </div>    
            </div>
            <style>
                .form-container{
                    width: 100%;
                    height: 100%;
                    display: flex;
                    justify-content: center;
                }
                .post-form select, label, input[type="text"],textarea, input[type="number"], input[type="file"], input[type="submit"]{
                    margin: 10px;
                    width: 400px;
                    font-size: 16px;
                }
                .post-form label{
                    font-weight: bold;
                }

                .post-form textarea{
                    resize: none;
                    outline: none;
                    height: 60px;
                }
                .post-form input[type="submit"]{
                    border: 1px solid #444;
                    color: #444;
                    background: white;
                    border-radius: 4px;
                    height: 30px;
                }
                .post-form input[type="submit"]:hover{
                    color: #333;
                    border: 1px solid #333;
                    background: rgb(220,220,220);
                    
                }
            </style>
        </div>
    </div>
    <?php
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    ?>
</body>

</html>