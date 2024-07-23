<?php
include 'db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $description = $_POST["description"];
    $inv = $_POST["inv"];
    $sn = $_POST["sn"];
    $loc = $_POST["loc"];
    $user = $_POST["user"];
    $pur = $_POST["pur"];
    $war = $_POST["war"];
    $cat=$_POST["cat"];
    $error = ""; 

    if (strlen($id) != 10 || !is_numeric($id)) {
        $error .= "Erreur : Asset Number doit être un nombre de 10 chiffres.<br>";
    } else {
        // Check for duplicate ID in database (remains unchanged)
        $sql_check_id = "SELECT COUNT(*) AS duplicate_count FROM produit WHERE assets = '$id'";
        $result_id = $conn->query($sql_check_id);

        if ($result_id->num_rows > 0) {
            $row_id = $result_id->fetch_assoc();
            if ($row_id["duplicate_count"] > 0) {
                $error .= "Erreur : Asset Number déjà existant. Veuillez en saisir un nouveau.<br>";
            }
        }
    }

    if (empty($error)) {
        // Check for duplicate serial number
        $sql_check_sn = "SELECT COUNT(*) AS duplicate_count FROM produit WHERE SN = '$sn'";
        $result_sn = $conn->query($sql_check_sn);

        if ($result_sn->num_rows > 0) {
            $row_sn = $result_sn->fetch_assoc();
            if ($row_sn["duplicate_count"] > 0) {
                $error .= "Erreur : Serial Number déjà existant. Veuillez en saisir un nouveau.<br>";
            }
        }
    }

    if (empty($error)) {
        $sql = "INSERT INTO produit (`assets`, `description`, `Inventory-method`, `SN`, `location`, `user`, `Purchase-Date`, `warranty`,`category`) 
                VALUES ('$id', '$description', '$inv', '$sn', '$loc', '$user', '$pur', '$war','$cat')";

        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            $error .= "Erreur : " . $sql . "<br>" . $conn->error;
        }
    }

    // Display error messages if any
    if (!empty($error)) {
        echo $error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Add a product</title>
  <script type="text/javascript">
    function validateForm() {
      var id = document.getElementById("id").value;
      if (id.length != 10 || isNaN(id)) {
        alert("Asset Number doit être un nombre de 10 chiffres.");
        return false;
      }
      return true;
    }

    function confirmSubmit() {
      return confirm("Are you sure you want to add this product ?");
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
                            <a class="nav-link active" aria-current="page" href="home.php"><?php echo htmlspecialchars($username); ?></</a>

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
   
  <h1>Add a product</h1>
  <form method="post" action="create.php" onsubmit="return validateForm() && confirmSubmit()">
    <input type="text" name="id" id="id" placeholder="Asset Number" required>
    <input type="text" name="description" placeholder="Description" required>
    <input type="text" name="inv" placeholder="Inventory Method" required>
    <input type="text" name="sn" placeholder="Serial Number">
    <input type="text" name="loc" placeholder="Location" required>
    <input type="text" name="user" placeholder="User">
    <input type="date" name="pur" placeholder="Purchase Date" required>
    <input type="text" name="war" placeholder="Warranty" required>
    <input type="text" name="cat" placeholder="Status" required>
    <input type="submit" value="Ajouter" class="button button-add">
  </form>
  <footer class="text-center mt-5">
    <p>&copy; 2024 Yazaki IT Store. All rights reserved.</p>
</footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</div>

</body>
</html>
