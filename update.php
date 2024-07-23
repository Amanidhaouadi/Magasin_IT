<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $loc = $_POST["loc"];
    $user = $_POST["user"];
    $cat = $_POST["cat"];

    
    if ($cat == 'scrap') {
     
        $sql = "SELECT * FROM produit WHERE assets = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $insert_sql = "INSERT INTO scrap (assets, description, SN, `Scrap-Date`, attachement)
                           VALUES ('" . $row['assets'] . "', '" . $row['description'] . "', '" . $row['SN'] . "', NOW(), '')";
            if ($conn->query($insert_sql) === TRUE) {
                // Delete the product from the product table
                $delete_sql = "DELETE FROM produit WHERE assets = '$id'";
                if ($conn->query($delete_sql) === TRUE) {
                    header("Location: products.php");
                    exit();
                } else {
                    $errorMessage ="Error deleting product: " . $conn->error;
                }
            } else {
                $errorMessage ="Error inserting product into scrap list: " . $conn->error;
            }
        } else {
            $errorMessage= "Product not found";
        }
    } else {
   
        $sql = "UPDATE produit SET location='$loc', user='$user', category='$cat' WHERE assets='$id'";
        if ($conn->query($sql) === TRUE) {
            header("Location: products.php");
            exit();
        } else {
            echo "Erreur : " . $sql . "<br>" . $conn->error;
        }
    }
} else {
    $id = $_GET["id"];
    $sql = "SELECT * FROM produit WHERE assets='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $produit = $result->fetch_assoc();
    } else {
        echo "No products found with ID $id";
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Edit a product</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            flex: 1;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #f6f8fa;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
    <script>
    function confirmSubmit() {
      return confirm("Are you sure you want to edit this product?");
    }
    </script>
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
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="home.php"><?php echo htmlspecialchars($username); ?></a>
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
                                <a class="nav-link" href="contact.php">Contact</a>
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
<div class="container mt-5 pt-5">
    <h1>Edit a product</h1>
    <form method="post" action="update.php" onsubmit="return confirmSubmit()">
        <input type="hidden" name="id" value="<?php echo $produit['assets']; ?>">
        <label for="loc">Location:</label>
        <input type="text" name="loc" id="loc" value="<?php echo $produit['location']; ?>" >
        <label for="user">User:</label>
        <input type="text" name="user" id="user" value="<?php echo $produit['user']; ?>" >
        <label for="cat">Status:</label>
        <input type="text" name="cat" id="cat" value="<?php echo $produit['category']; ?>" >
        <input type="submit" value="Modifier" class="button button-edit">
    </form>
</div>
</div>
<footer class="text-center mt-5">
    <p>&copy; 2024 Yazaki IT Store. All rights reserved.</p>
</footer>
<script>
        // Function to open the modal
        function openModal(message) {
            document.getElementById('error-message').textContent = message;
            $('#errorModal').modal('show');
        }

        // Check for error message from PHP
        <?php if (!empty($errorMessage)) : ?>
            openModal("<?php echo $errorMessage; ?>");
        <?php endif; ?>
    </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
