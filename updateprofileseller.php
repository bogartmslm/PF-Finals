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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
        $profilePath = ''; 
    
        if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
            $targetDirectory = "images/"; 
            $profilePath = $targetDirectory . basename($_FILES['profile']['name']);
    
            if (move_uploaded_file($_FILES['profile']['tmp_name'], $profilePath)) {
    
                $stmt = $pdo->prepare("UPDATE sellers SET profile = ? WHERE id = ?");
                $stmt->execute([$profilePath, $userId]);
    
                if ($stmt->rowCount() > 0) {
                    header("Location:My-Accountseller.php");
                } 
            } 
        } 
    }

}catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

?>