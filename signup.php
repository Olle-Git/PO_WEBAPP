<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
</head>

<body>
    <form action="includes/signupformhandler.php" method="post">
        <input type="text" name="email" id="email" placeholder="email">
        <input type="text" name="username" id="username" placeholder="username">
        <input type="password" name="password" id="password" placeholder="password">
        <input type="submit" name="submit" value="Register">
    </form>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        }
        else if ($_GET["error"] == "stmtfailed") {
            echo "<p>Something went wrong, try again!</p>";
        }
    }
    ?>
</body>

</html>