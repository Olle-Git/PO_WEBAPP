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

function alreadyTaken($value, $colmn){
    $conn = dbConnector();
    $sql = "SELECT * FROM users WHERE $colmn = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s", $value);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    $row = mysqli_fetch_assoc($result);
    if ($row["$colmn"] == $value) {
        return true;
    } else {
        return false;
    }
}

function addUser($username, $email, $password, $plaats, $straat, $huisnummer) {
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
    $sql2 = "INSERT INTO klanten (usr_id, plaats, straat, huisnummer) VALUES ((SELECT id FROM users WHERE usr=? LIMIT 1), ?, ?, ?);";
    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        header("location: ../signup.php?error=stmt2failed");
        exit();
    }
    mysqli_stmt_bind_param($stmt2, 'ssss', $username, $plaats, $straat, $huisnummer);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);
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
            orders.klant_id = (SELECT id FROM klanten WHERE usr_id = ?)
        ORDER BY orders.id;";
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
        $availeble='available';
        if ($row['beschikbaarheid'] <= 0) {$availeble='empty';}
            if ($i % 3 == 0) { 
                echo "<tr>";
                echo "<td class='".$availeble."'>" . $row["naam"] . "<br>" .  "<img src='img/pizzamenu/" . $row["id"] . ".png' " . " id='".$i."'><br>" . $row["beschrijfing"] . "<br>€" . $row["prijs"]/100 . "<br>" . "<label for='aantal'>Aantal: </label><input type='number' value'0' id='aantal' name='" . $row["id"] . "'>" . "</td>";
            } else if ($i % 3 == 1) {
                echo "<td class='".$availeble."'>" . $row["naam"] . "<br>" .  "<img src='img/pizzamenu/" . $row["id"] . ".png' " . " id='".$i."'><br>" . $row["beschrijfing"] . "<br>€" . $row["prijs"]/100 . "<br>" . "<label for='aantal'>Aantal: </label><input type='number' value'0' id='aantal' name='" . $row["id"] . "'>" . "</td>";
            } else if ($i % 3 == 2) {
                echo "<td class='".$availeble."'>" . $row["naam"] . "<br>" .  "<img src='img/pizzamenu/" . $row["id"] . ".png' " . " id='".$i."'><br>" . $row["beschrijfing"] . "<br>€" . $row["prijs"]/100 . "<br>" . "<label for='aantal'>Aantal: </label><input type='number' value'0' id='aantal' name='" . $row["id"] . "'>" . "</td>";
                echo "</tr>";
            }
        $i++;
    }
}

function addOrder($userID) {
    $conn = dbConnector();
    $sql = "INSERT INTO orders (klant_id, bezorger_id) VALUES ((SELECT id FROM klanten WHERE usr_id=? LIMIT 1), (SELECT id FROM users WHERE pos=1 LIMIT 1))";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../menu.php?error=stmtfailed");
        exit();
    } 
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $sql2 = "SELECT id FROM orders ORDER BY id DESC LIMIT 1;";
    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        header("location: ../menu.php?error=stmtfailed");
        exit();
    } 
    mysqli_stmt_execute($stmt2);
    $result = mysqli_stmt_get_result($stmt2);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt2);
    mysqli_close($conn);
    return $row;
}

function addBestelregels($orderID, $productID, $aantal) {
    $conn = dbConnector();
    $sql = "INSERT INTO bestelregels (order_id, product_id, aantal) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../menu.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param( $stmt,"iii", $orderID, $productID, $aantal);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close( $stmt);
    $sql2 = "UPDATE producten SET beschikbaarheid = beschikbaarheid - ? WHERE id = ?;";
    $stmt2 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
        header("location: ../menu.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt2, "ii", $aantal, $productID);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_get_result($stmt2);
    mysqli_stmt_close($stmt2);
    mysqli_close($conn);
    return true;
}

function bezorger() {
    $conn = dbConnector();
    $sql = "SELECT orders.id, straat, huisnummer, plaats, aantal, naam, email FROM users JOIN klanten ON users.id=klanten.usr_id JOIN orders ON klanten.id=orders.klant_id JOIN bestelregels ON orders.id=bestelregels.order_id JOIN producten ON bestelregels.product_id=producten.id;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../bezorger.php?error=stmtfailed");
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