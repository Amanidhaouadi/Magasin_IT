<?php 
session_start(); // Start session to access user information

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to login page if user is not logged in
    header("Location: index.php");
    exit();
}?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
           <img src="image/logo.png" alt="logo" class="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><?php echo htmlspecialchars($username); ?></</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Home</a>

                        </li>
                        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Products
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="products.php">Product List</a></li>
              <li><a class="dropdown-item" href="scrap.php">Scrap List</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="product.php">Products Catalog</a></li>
            </ul>
          </li>
        
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">contact</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php">User Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>     
</ul>
                    <form class="d-flex mt-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    
        <section class="about-section">
            <h2>Welcome to Yazaki IT Store</h2>
            <p>At Yazaki, we are dedicated to providing top-quality tech products to our customers. Our store offers a wide range of electronic gadgets, from switchs and hubs to high-performance laptops and accessories. We believe in innovation, quality, and customer satisfaction.</p>
        </section>
        <section class="history-section">
            <h2>Our History</h2>
            <p>Yazaki was founded with the vision of bringing the best technology to the market. Over the years, we have grown to become a trusted name in the tech industry, known for our commitment to excellence and our extensive product range. Our journey has been fueled by a passion for technology and a desire to make cutting-edge products accessible to everyone.</p>
        </section>
        <section class="mission-section">
            <h2>Our Mission</h2>
            <p>Our mission is to enhance the lives of our customers by providing innovative and reliable tech products. We strive to be at the forefront of technology, offering products that meet the highest standards of quality and performance. Customer satisfaction is our top priority, and we are committed to delivering exceptional service and support.</p>
        </section>
        <section class="values-section">
            <h2>Our Values</h2>
            <ul>
                <li><strong>Innovation:</strong> We embrace innovation and are always on the lookout for the latest advancements in technology.</li>
                <li><strong>Quality:</strong> We are committed to providing products that meet the highest standards of quality and reliability.</li>
                <li><strong>Customer Satisfaction:</strong> Our customers are at the heart of everything we do. We strive to exceed their expectations with every interaction.</li>
                <li><strong>Integrity:</strong> We conduct our business with the utmost integrity, honesty, and transparency.</li>
            </ul>
        </section>
    
</div>
    <footer>
        <p>&copy; 2024 Yazaki IT Store . All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
