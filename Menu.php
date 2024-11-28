<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Adrian Bleeker, Olle van Damme">
    <link rel="stylesheet" href="style_paginas.css">
    <link rel="stylesheet" href="style.css">
    <title>Uw bestellingen</title>
    
    <style>
    table {
        width: 80%;
        border-collapse: collapse; 
        text-align: center; 

    th, td {
        text-align: center;
        padding: 5px; 
    }

    img {
        display: block;
        margin: 0 auto;
        width: 50%;
    }

    td {
        border: 1px solid #ccc; 
    }

    td:hover {
    background-color:#7dd48c; /* Hover effect*/
}
    }
</style>

    </head>

    

<body>

    <nav>   
        <ul class="nav-list">
            <li class="navlogo"><img src="img/NYP.png" height="71px" alt="logo"></li>
            <li class="navitems"><a href="index.php">Home</a></li>
            <li class="navitems"><a href="">Menu</a></li>
            <li class="navitems"><a href="includes/logout.php">Log uit</a></li>
        </ul>
    </nav>
    <br><br>
    <table>

        <th colspan="3">MENU</th>
        <?php 
            require_once "includes/functions.php";
            $result = menuTable();
            drawMenu($result);
        ?>
      </table>
            <br><br><br><br><br>
      <center>
        <h1 style="color: white;">Bestelling</h1>
        <form action="includes/bestellingenhandler.php" method="post">
            <!-- Aantal pizza's -->
            <label for="aantal" style="color:white;">Aantal:</label>
            <input type="text" id="aantal" name="aantal" min="1" max="10" value="1" required>
            <br><br>
    
            <!-- Verzenden -->
            <input type="submit" value="Bestelling plaatsen">
        </form></center>
        <script>
            let productCounter = {};

            function clickMenu(id) {
                alert("U hebt een artikel toegevoegd aan uw bestelling.");
                if (!productCounter[id]) {
                    productCounter[id] = 1;
                }
                productCounter[id]++;
            }
            function toPHP() {
                
            }


        </script>
</body>
</html>