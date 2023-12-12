<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "jellskie";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
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
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("UPDATE sellers SET username = :username, email = :email, password = :password WHERE id = :id");
    $stmt->bindParam(':username', $newUsername);
    $stmt->bindParam(':email', $newEmail);
    $stmt->bindParam(':id', $userId); 
    $stmt->bindParam(':password', $password); 
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "
        <script>
            alert('Profile Updated Successfuly');
        </script>
        ";
        
    } else {
        echo "No changes were made to the profile.";
    }
}

if (isset($_POST['logout'])) {
	$_SESSION = array();

	session_destroy();

	header("Location: Loginseller.php");
	exit();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
    <script src="https://kit.fontawesome.com/68df3d5144.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/Stylesheets/Side-nav.css">
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
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
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
.profile-photo {
    width: 30px;
    height: 30px;
    border-radius: 50%; 
    background-color: #fff; 
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
    <?php
$stmt = $pdo->prepare("SELECT * FROM sellers WHERE id = :id");
$stmt->bindParam(':id', $userId);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    $username = $user['username'];
    $email = $user['email'];
    $profile_image = $user['profile'];
    $password = $user['password'];

?>
        <div class="side-nav">
        <div class="profile-info">
            <img src="<?= $profile_image ?>" alt="">
            <p><?= $username ?></p>
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
                <h2>My Profile</h2>
                <p>Manage and protect you account</p>
            </div>
            <hr>
            <div class="edit-form">
                <div class="left-side">

                    <h1>Edit Profile</h1>
                    <form action="" method = "post">
                        <label  for="username">Username</label>
                        <input value = "<?= $username ?>" name = "username" type="text"><br>
                        <label  for="email">Email</label>
                        <input  value = "<?= $email ?>" name = "email" type="text"><br>
                        <label  for="password">Password</label>
                        <input  value = "<?= $password ?>" name = "password" type="text"><br>
                        <input type="submit">
                    </form>

<?php
                } else {
                    echo "User not found.";
                }
                                ?>

                </div>
                <div class="right-side">
                    <img src="#" alt="">
                    <br>
                    <form action="updateprofileseller.php" method="post" enctype="multipart/form-data">
                        <label for="fileInput" class="custom-file-label">Select Image</label>
                        <input type="file" id="fileInput" name="profile">
                        <input type="submit" value="Upload">
                    </form>
                    <p>Image must be a JPEG file format</p>
                    
                </div>
            </div>
            <style>
                .edit-form{
                    width: 91%;
                    height: 100px;
                    margin: 0 4.5%;
                    display: flex;
                }
                .left-side{
                    flex: 2;
                    display: flex;
                    flex-direction: column;
                    
                }
                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }
                
                
                .right-side{
                    flex: .8;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column;
                    height: 300px;
                }
                .right-side img{
                    aspect-ratio: 1/1;
                    height: 110px;
                    background-color: #969595;
                    border-radius: 50%;
                }
                /* Hide the default file input */
                input[type="file"] {
                    display: none;
                }
                input[type="text"], input[type="password"]{
                    margin: 10px 20px;
                }
                /* Style the label to resemble a button */
                .custom-file-label {
                    background-color: #ffffff;
                    color: #000000;
                    padding: 10px;
                    display: inline-block;
                    cursor: pointer;
                    border: solid 1px grey;
                    border-radius: 4px;
                    font-size: 14px;
                }
            </style>
        </div>
    </div>
    <?php
    }catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
    ?>
</body>

</html>