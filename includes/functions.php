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

function emptyInput($naam, $email, $wachtwoord) {
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
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return true;
}
function correctPassword($naam, $wachtwoord) {
    $conn = dbConnector();
    $sql = "SELECT * FROM users WHERE usr = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $naam, $naam);
    mysqli_stmt_execute($stmt);
    $return = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    $row = mysqli_fetch_assoc($return);
    $dbWachtwoord = $row["pwd"];
    if (password_verify($wachtwoord, $dbWachtwoord)) {
        return $row;
    } else {
        return false;
    }
}

function TableHead() {
    echo "<h1 style='color:white; margin-top:10px;'>Uw bestellingen</h1>";
    echo "<th>Ordernummer</th>";
    echo "<th>Datum</th>";
    echo "<th>Details</th>";
}

function tableData($userID) {
    $conn = dbConnector();
    $sql = 
    "   SELECT 
            orders.id, 
            orders.besteldatum, 
            producten.naam, 
            bestelregels.aantal 
        FROM 
            orders 
        JOIN 
            bestelregels ON orders.id = bestelregels.order_id 
        JOIN 
            producten ON bestelregels.product_id = producten.id 
        WHERE 
            orders.klant_id = (SELECT id FROM klanten WHERE usr_id = ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../klant.php?error=stmtfailed");
        exit();
    } 
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    if ($result) {
        return $result;
    } else {
        return false;
    }

}
function menuTable() {
    $conn = dbConnector();
    $sql = "SELECT  * FROM producten;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../menu.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    if ($result) {
        return $result;
    } else {
        return false;
    }
}

function drawMenu($result) {
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($i % 3 == 0) {
            echo "<tr>";
            echo "<td>" . $row["naam"] . "<br>" .  "<img src='img/pizzamenu/" . $row["id"] . ".png' " . "onclick='clickMenu(".$i.")' id='".$i."'><br>" . $row["beschrijfing"] . "<br>" . $row["prijs"] ."</td>";
        } else if ($i % 3 == 1) {
            echo "<td>" . $row["naam"] . "<br>" .  "<img src='img/pizzamenu/" . $row["id"] . ".png' " . "onclick='clickMenu(".$i.")' id='".$i."'><br>" . $row["beschrijfing"] . "<br>" . $row["prijs"] ."</td>";
        } else if ($i % 3 == 2) {
            echo "<td>" . $row["naam"] . "<br>" .  "<img src='img/pizzamenu/" . $row["id"] . ".png' " . "onclick='clickMenu(".$i.")' id='".$i."'><br>" . $row["beschrijfing"] . "<br>" . $row["prijs"] ."</td>";
            echo "</tr>";
        }
        $i++;
    }
}