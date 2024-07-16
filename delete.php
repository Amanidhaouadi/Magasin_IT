<?php
include 'db.php';

$id = $_GET["id"];
$sql = "DELETE FROM produit WHERE assets=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Erreur : " . $sql . "<br>" . $conn->error;
}
?>
