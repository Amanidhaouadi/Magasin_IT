<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
      
body {
    background-color: wheat;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: white; 
    padding: 20px;
    border-radius: 15px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 400px;
}

.logo {
    width: 100px;
    height: auto;
    margin-bottom: 20px;
}

h1 {
    margin-bottom: 20px;
    color: #333;
}

label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

input[type="text"],
input[type="password"] {
    width: 90%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.button-1 {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button-1:hover {
    background-color: #555;
}

    </style>
    <!-- Include Bootstrap or your preferred CSS framework -->
</head>
<body>
    <div class="container">
    <img src="image/logo.png" alt="Logo" class="logo">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            
            <button type="submit" class="button-1">Login</button>
        </form>
    </div>
</body>
</html>
