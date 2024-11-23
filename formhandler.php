<?php
// Functie om invoer te testen en schoon te maken
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Functie om verbinding te maken met de database
function connectDatabase($servername = "localhost", $username = "root", $password = "", $dbname = "nyp", $port = 3306) {
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Functie om inloggegevens te controleren
function logincheck($username, $password) {
    $conn = connectDatabase("localhost", "root", "", "nyp");
    $stmt = $conn->prepare("SELECT pwd FROM `users` WHERE usr= ?;");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($dbpassword);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    $dbpassword = test_input($dbpassword);
    
    // if (password_verify($password, $dbpassword)) {
    if ($password == $dbpassword) {
        return true; // Wachtwoord correct
    } else {
        return false; // Wachtwoord incorrect
    }
}

// Controleer of het een POST-verzoek is
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
} else {
    exit("Geen POST request"); // Geen POST-verzoek
}

// Controleer het wachtwoord en stuur de gebruiker door
if (logincheck($username, $password)) {
    header("Location: klant.html"); // Inloggen geslaagd
} else {
    header("Location: index.php?error=1"); // Inloggen mislukt
}