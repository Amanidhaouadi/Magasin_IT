<?php
include 'db.php'; // Assurez-vous que ce fichier inclut correctement votre connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM produit WHERE category = 'scrap'";
    if ($conn->query($sql) === TRUE) {
        echo "Tous les produits de la catégorie 'scrap' ont été supprimés avec succès.";
    } else {
        echo "Erreur lors de la suppression des produits : " . $conn->error;
    }
    $conn->close();
    header("Location: index.php"); // Redirige vers la page d'accueil après suppression
    exit();
}
?>
