<?php
include 'db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM produit WHERE 
        `assets` LIKE '%$search%' OR 
        `description` LIKE '%$search%' OR 
        `Inventory-meth` LIKE '%$search%' OR 
        `SN` LIKE '%$search%' OR 
        `location` LIKE '%$search%' OR 
        `user` LIKE '%$search%' OR 
        `purchase-date` LIKE '%$search%' OR 
        `warranty` LIKE '%$search%' OR `category` LIKE '%$search%'";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="button.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Magazain Yazaki IT</title>
    
    
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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>

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
        <form method="GET" action="" class="d-flex mt-3">
        <input type="search" name="search" class="form-control me-2"  placeholder="Search..." value="<?php echo $search; ?>" required>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
    </nav>
    <span class='result-count'><?php echo $result->num_rows; ?> product(s) found</span>
    <h1>Products List</h1>
    <a href="create.php" class="button button-add">Ajouter un produit</a>

    <table>
        <tr>
            <th>Asset Number</th>
            <th>Description</th>
            <th>Inventory Method</th>
            <th>Serial Number</th>
            <th>Location</th>
            <th>User</th>
            <th>Purchase Date</th>
            <th>Warranty</th>
            <th>Status</th>
        </tr>
        
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["assets"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["inventory-meth"] . "</td>";
                echo "<td>" . $row["SN"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["user"] . "</td>";
                echo "<td>" . $row["purchase-date"] . "</td>";
                echo "<td>" . $row["warranty"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>
                        <a href='update.php?id=" . $row["assets"] . "' class='button button-edit'>Edit</a> 
                        <a href='delete.php?id=" . $row["assets"] . "' class='button button-delete' onclick='return confirmDelete()'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Aucun produit trouvé</td></tr>";
        }
        ?>
    </table>
</div>
<footer>
        <p>&copy; 2024 Yazaki IT Store. All rights reserved.</p>
    </footer>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa-solid fa-arrow-up"></i></button>
    <script src="index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
