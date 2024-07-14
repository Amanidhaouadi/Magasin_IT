<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $loc = $_POST["loc"];
    $user = $_POST["user"];
    $cat=$_POST["cat"];
    $sql = "UPDATE produit SET location='$loc', user='$user',category='$cat' WHERE assets='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET["id"];
    $sql = "SELECT * FROM produit WHERE assets=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $produit = $result->fetch_assoc();
    } else {
        echo "Aucun produit trouvé avec l'ID $id";
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
      return confirm("Êtes-vous sûr de vouloir modifier ce produit ?");
    }</script>
</head>
<body>
<style>.logo {
            height: 50px;
        }</style>
<div class="container">
<img src="image/logo.png" alt="Logo" class="logo">
    <h1>Edit a product</h1>
    <form method="post" action="update.php" onsubmit="return confirmSubmit()">
        <input type="hidden" name="id" value="<?php echo $produit['assets']; ?>">
        <label for="loc">Location:</label>
        <input type="text" name="loc" id="loc" value="<?php echo $produit['location']; ?>" >
        <label for="user">User:</label>
        <input type="text" name="user" id="user" value="<?php echo $produit['user']; ?>" >
        <label for="user">Status:</label>
        <input type="text" name="cat" id="cat" value="<?php echo $produit['category']; ?>" >
        <input type="submit" value="Modifier" class="button button-edit">
    </form>
</div>
</body>
</html>
