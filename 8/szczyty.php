<?php
$conn = mysqli_connect("localhost", "root", "", "korona");
if(!$conn) {
    echo "Błąd połączenia";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korona gór polskich</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header class="h_left">
        <img src="logo.png" alt="Logo">
    </header>

    <header class="h_right">
        <h1>Korona Gór Polskich</h1>
    </header>

    <main class="main">
        <!-- Skrypt 3 -->
        <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql3 = "SELECT szczyty.plik, szczyty.nazwa, szczyty.wysokosc, szczyty.pasmo, opis.opis FROM szczyty 
                    JOIN opis ON szczyty.id = opis.szczyty_id WHERE szczyty.id = $id;";
            $result3 = mysqli_query($conn, $sql3);
            while($row3 = mysqli_fetch_assoc($result3)) {
                echo "<img src='" . $row3['plik'] .  "' alt='szczyt' >";
                echo "<h2>" . $row3['nazwa'] . "</h2>";
                echo "<h3>wysokość: " . $row3['wysokosc'] . " metrów n.p.m</h3>";
                echo "<h3>pasmo górskie: " . $row3['pasmo'] . "</h3>";
                echo "<p>" . $row3['opis'] . "</p>";
            }
        }
        ?>
    </main>

    <aside class="aside">
        <!-- Skrypt 2 -->
        <?php
        $sql2 = "SELECT szczyty.plik, szczyty.nazwa FROM szczyty LIMIT 10;";
        $result2 = mysqli_query($conn, $sql2);
        while($row2 = mysqli_fetch_assoc($result2)) {
            echo "<img src='" . $row2['plik'] . "' alt='" . $row2['nazwa'] . "' class='miniatury'>";
        }
        ?>
    </aside>

    <footer class="f_left">
        <h3>Kontakt</h3>
        <ul>
            <li>Zadzwoń do nas: 111 222 333</li>
            <li><a href="korona@gory.pl">Napisz do nas</a></li>
        </ul>
    </footer>

    <footer class="f_right">
        <h3>&copy; Wykonane przez: Jarosław Bania</h3>
    </footer>
    <?php
        mysqli_close($conn);
    ?>
</body>
</html>