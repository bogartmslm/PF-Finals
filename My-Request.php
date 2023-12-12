<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Request</title>
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
                <li><a href="My-Account.html"><i class="fa-regular fa-user"></i>  My Account</a></li>
                <li style="background: #c0c0c0;"><a href="My-Request.html"><i class="fa-solid fa-clipboard-list"></i>  My Request</a></li>
                <li><a href="Notifications.html"><i class="fa-regular fa-bell"></i>  Notification</a></li>
                <li><a href="messaging.html"><i class="fa-regular fa-message"></i>  Messages</a></li>
                <li><a href="Wishlist.html"><i class="fa-regular fa-heart"></i>  Wishlist</a></li>
                <li><a href="insertproduct.html"><i class="fa-regular fa-cart-plus"></i>  Post Product</a></li>
                <li><a href="My-products.html">  My Product</a></li>
            </ul>
        </div>
        </div>
        <div class="content-box">
            <div class="tabs">
                <ul>
                    <li data-tab-target="#all" class="active tab">All</li>
                    <li data-tab-target="#pay" class="tab">To Pay</li>
                    <li data-tab-target="#receive" class="tab">To Receive</li>
                    <li data-tab-target="#complete" class="tab">Completed</li>
                    <li data-tab-target="#cancel" class="tab">Cancel</li>

                </ul>
            </div>
            <div class="main-container">
                <div id="all" data-tab-content class="active">
                    <div class="all-cards">
                        <div class="seller-info">
                            <p>Username</p>
                            <button>Chat</button>
                            <button class="view-btn">View Profile</button>
                            <div class="product-status">
                                <p class="stat1">Request has been delivered</p>
                                <p style="color: #b6b4b4;">|</p>
                                <p class="stat2">TO RECEIVE</p>
                            </div>
                        </div>
                        
                        <div class="product-info">
                            <img src="IMG_20230221_225314.jpg" alt="">
                            <div class="product-name">
                                <p id="prod-name">Jell's Famous sabo pipandilwang </p>
                                <p id="variant">variant : Maparas/Maslam</p>
                                <p id="quantity">x 45</p>
                                
                            </div>
                            <div class="price">
                                <p>$$$$$</p>
                            </div>
                        </div>
                        <div class="total-info">
                            <div class="total">
                                <p>Total: </p>
                                <p id="total-price">$$$$$</p>
                            </div>
                        </div>
                        <div class="order-confirm">
                            <p>confirm Receipt after you received your request</p>
                            <div class="btn">
                                <button id="btnrr">Request Received</button>
                                <button id="btncl">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <style>
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
                        .product-name #variant{
                            color: #b6b4b4;
                            font-size: 12px;
                            margin: 2px 10px;
                        }
                        .product-name #quantity{
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
                        .btn button{
                            height: 35px;
                            font-size: 13px;
                            border: none;
                            border-radius: 2px;
                        }
                        .btn #btnrr{
                            color: white;
                            background-color: rgb(224, 53, 1);
                            gap: 10px;
                        }
                        .btn #btncl{
                            border: 1px solid #b6b4b4;
                            width: 100px;
                            color: #444;
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
                </div>
                <div id="pay" data-tab-content>
                    <h2>To Pay</h2>
                    <p>All request are here</p>
                </div>
                <div id="receive" data-tab-content>
                    <h2>to receive</h2>
                    <p>All request are here</p>

                </div>
                <div id="complete" data-tab-content>
                    <h2>completed</h2>
                    <p>All request are here</p>

                </div>
                <div id="cancel" data-tab-content>
                    <h2>cancel</h2>
                    <p>All request are here</p>
                </div>
            </div>
        
            <style>
                .tabs ul {
                    display: flex;
                    list-style: none;
                    justify-content: space-around;
                    align-items: center;
                    padding:0;
                }

                .tabs {
                    background: white;
                }
                .tab {
                    cursor: pointer;
                    padding: 10px;
                    width: 20%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    position: relative;
                    border-bottom: 3px solid rgb(150, 150, 150);
                }
                .tab:hover {
                    color: rgb(255, 145, 0);
                }

                .tab.active {
                    color: rgb(255, 145, 0);
                    border-bottom: 3px solid rgb(255, 145, 0);
                }

                .main-container{
                    background: white;
                    height: 60vh;
                }
                [data-tab-content]{
                    display: none;
                }
                .active[data-tab-content]{
                    display: block;
                }
            </style>
            <script defer>
                document.addEventListener('DOMContentLoaded', function() {
                    const tabs = document.querySelectorAll('[data-tab-target]');
                    
                    tabs.forEach(tab => {
                        tab.addEventListener('click', () => {
                            const target = document.querySelector(tab.dataset.tabTarget);
            
                            // Remove 'active' class from all tabs and tab contents
                            tabs.forEach(t => t.classList.remove('active'));
                            document.querySelectorAll('[data-tab-content]').forEach(content => content.classList.remove('active'));
            
                            // Add 'active' class to the selected tab and tab content
                            tab.classList.add('active');
                            target.classList.add('active');
            
                            // Set the border color of the selected tab to orange
                            tabs.forEach(t => {
                                if (t.classList.contains('active')) {
                                    t.style.color = 'rgb(255, 145, 0)';
                                    t.style.borderBottomColor = 'rgb(255, 145, 0)';
                                } else {
                                    t.style.color = 'black';
                                    t.style.borderBottomColor = 'rgb(150, 150, 150)';
                                }
                            });
                        });
                    });
                });
            </script>
                        
        </div>
    </div>
    
</body>

</html>