<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function dbConnector() {
    $serverNaam = "localhost";
    $Uid = "root";
    $pwd = "";
    $dbNaam = "nyp";

    $conn = mysqli_connect($serverNaam, $Uid, $pwd, $dbNaam);

    if (!$conn) {
        die("Connection failed".mysqli_connect_error());
    } else {
        return $conn;
    }
}

function emptyInputSignup($naam, $email, $wachtwoord) {
    if (empty($naam) || empty($email) || empty($wachtwoord)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function addUser($username, $email, $password) {
    $conn = dbConnector();
    $sql = "INSERT INTO users (usr, pwd, email) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return true;
}