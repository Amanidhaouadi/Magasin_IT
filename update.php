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
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Edit a product</title>
    <script>
    function confirmSubmit() {
      return confirm("Are you sure you want to edit this product?");
    }
    </script>
</head>
<body>

<div class="container">
<img src="image/logo.png" alt="Logo" class="logo">
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
</body>
</html>
