<?php
include 'db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM produit WHERE 
        assets LIKE '%$search%' OR 
        description LIKE '%$search%' OR 
        `Inventory-method` LIKE '%$search%' OR 
        SN LIKE '%$search%' OR 
        location LIKE '%$search%' OR 
        user LIKE '%$search%' OR 
        `Purchase-Date` LIKE '%$search%' OR 
        Warranty LIKE '%$search%' OR `category` LIKE '%$search%'";

$result = $conn->query($sql);
session_start(); // Start session to access user information

// Check if user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to login page if user is not logged in
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="button.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Magazain Yazaki IT</title>
    <style>
       
        .alert-icon {
            cursor: pointer;
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
<script>
function confirmDelete() {
    return confirm("Are you sure you want to delete this item?");
}

function showAlert(productName) {
    document.getElementById('alertMessage').innerText = "Le produit " + productName + " a dépassé 4 ans de cycle de vie.";
    var alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
    alertModal.show();
}
</script>
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
                            <a class="nav-link active" aria-current="page" href="home.php"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-box"></i> Products</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="products.php">Product List</a></li>
                                <li><a class="dropdown-item" href="scrap.php">Scrap List</a></li>
                                <li><a class="dropdown-item" href="decharge.php">discharge product</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="product.php">Products Catalog</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="settings.php"><i class="fas fa-cog"></i> User Settings</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>     
                    </ul>
                    <form method="GET" action="" class="d-flex mt-3">
                        <input type="search" name="search" class="form-control me-2" placeholder="Search..." value="<?php echo $search; ?>" required>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <span class='result-count'><?php echo $result->num_rows; ?> product(s) found</span>
    <h1>Products List</h1>
    <a href="create.php" class="button button-add">Add a product</a>
    <button type="button" class="button button-add" data-bs-toggle="modal" data-bs-target="#uploadModal">
        Delete product
    </button>
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">delete product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="image/logo.png" alt="Logo" class="logo">
                    <form action="delete.php" method="get">
                        <label for="asset_number">Asset Number:</label>
                        <input type="text" id="id" name="id" required>
                        <input type="submit" value="Delete" onclick="return confirmDelete()">
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            <th>Alerte</th>
        </tr>
        
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $purchaseDate = new DateTime($row["Purchase-Date"]);
                $currentDate = new DateTime();
                $interval = $purchaseDate->diff($currentDate);
                $years = $interval->y;

                $rowClass = "";
                $alertIcon = "";
                if ($years >= 4) {
                   
                    $alertIcon = "<img src='image/alert.png' class='alert-icon' onclick=\"showAlert('" . $row["description"] . "')\" />";
                }

             
                echo "<td>" . $row["assets"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td>" . $row["Inventory-method"] . "</td>";
                echo "<td>" . $row["SN"] . "</td>";
                echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["user"] . "</td>";
                echo "<td>" . $row["Purchase-Date"] . "</td>";
                echo "<td>" . $row["Warranty"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>$alertIcon</td>";
                echo "<td>
                        <a href='update.php?id=" . $row["assets"] . "' class='button button-edit'>Edit</a> 
</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='12'>Aucun produit trouvé</td></tr>";
        }
        ?>
    </table>
</div>
<!-- Modal for Alert -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Alerte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="alertMessage">
                <!-- Message will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
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
                     
