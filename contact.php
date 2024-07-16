<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Yazaki IT Store</title>
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
 
        <h1>Contact Us</h1>
        <p>If you have any questions, feel free to reach out to us through any of the methods below:</p>
        
        <h2>Phone Numbers</h2>
        <ul>
            <li>Customer Service: (123) 456-7890</li>
            <li>Technical Support: (098) 765-4321</li>
        </ul>
        
        <h2>Social Media</h2>
        <ul>
            <li><a href="https://www.facebook.com/yazakiitstore" target="_blank">Facebook</a></li>
            <li><a href="https://www.twitter.com/yazakiitstore" target="_blank">Twitter</a></li>
            <li><a href="https://www.instagram.com/yazakiitstore" target="_blank">Instagram</a></li>
            <li><a href="https://www.linkedin.com/company/yazakiitstore" target="_blank">LinkedIn</a></li>
        </ul>
    
</div>
    <footer>
        <p>&copy; 2024 Yazaki IT Store. All rights reserved.</p>
    </footer>
        <!-- Bootstrap Bundle with Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
