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
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Ajouter un produit</title>
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
      return confirm("Êtes-vous sûr de vouloir ajouter ce produit ?");
    }
  </script>
</head>
<body>
<style>.logo {
  height: 50px;
}</style>

<div class="container">
<img src="logo.png" alt="Logo" class="logo">
  <h1>Ajouter un produit</h1>

  <form method="post" action="create.php" onsubmit="return validateForm() && confirmSubmit()">
    <input type="text" name="id" id="id" placeholder="Asset Number" required>
    <input type="text" name="description" placeholder="Description" required>
    <input type="text" name="inv" placeholder="Inventory Method" required>
    <input type="text" name="sn" placeholder="Serial Number">
    <input type="text" name="loc" placeholder="Location" required>
    <input type="text" name="user" placeholder="User">
    <input type="date" name="pur" placeholder="Purchase Date" required>
    <input type="text" name="war" placeholder="Warranty" required>
    <input type="text" name="cat" placeholder="Category" required>
    <input type="submit" value="Ajouter" class="button button-add">
  </form>
</div>
</body>
</html>
