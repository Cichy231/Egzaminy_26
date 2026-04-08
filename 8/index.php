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
        <!-- Skrypt 1 -->
        <?php
        $sql = "SELECT szczyty.id, szczyty.nazwa FROM szczyty ORDER BY szczyty.wysokosc DESC;";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)) {
            echo "<span><a href='szczyty.php?id=" . $row['id']  . "'>" . $row['nazwa'] . "</a></span>";
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
    <img src="" alt="" class="">

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