<?php
include 'db.php';
session_start(); // Start session to store user authentication status


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    // Prepare SQL statement to fetch user details
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, set session variables and redirect to home page
        $_SESSION['username'] = $username;
        header("Location: home.php"); // Redirect to your home page after successful login
    } else {
        // User not found or invalid credentials, redirect back to login page
        header("Location: index.php?error=InvalidCredentials"); // Redirect with error message
    }
} else {
    header("Location: index.php"); // Redirect to login page if accessed directly without POST data
}

$conn->close();
?>
<?php
session_start(); // Start session to store user authentication status

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configuration de la base de données
    $servername = "localhost";
    $username_db = "root"; // Nom d'utilisateur de la base de données
    $password_db = ""; // Mot de passe de la base de données
    $dbname = "mg"; // Nom de la base de données

    // Connexion à la base de données
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparer et exécuter la requête pour récupérer le mot de passe haché
    $sql = "SELECT * FROM user WHERE username = $'username'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Utilisateur trouvé, vérifier le mot de passe
        $user = $result->fetch_assoc();
        $stored_hashed_password = $user['password'];

        if (password_verify($password, $stored_hashed_password)) {
            // Passwords match, set session variables and redirect to home page
            $_SESSION['username'] = $username;
            header("Location: home.php"); // Rediriger vers la page d'accueil après une connexion réussie
            exit(); // Arrêter l'exécution du script
        } else {
            // Mot de passe invalide, rediriger vers la page de connexion avec un message d'erreur
            header("Location: index.php?error=InvalidCredentials");
            exit();
        }
    } else {
        // Utilisateur non trouvé, rediriger vers la page de connexion avec un message d'erreur
        header("Location: index.php?error=InvalidCredentials");
        exit();
    }

    // Fermer la connexion et libérer les ressources
    $stmt->close();
    $conn->close();
} else {
    // Rediriger vers la page de connexion si l'accès est direct sans données POST
    header("Location: index.php");
    exit();
}
?>
