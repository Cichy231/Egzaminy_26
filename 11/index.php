<?php
$conn = mysqli_connect("localhost", "root", "", "kino");
if(!$conn) {
    echo "Błąd połączenia";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista aktorów | KinoTEKA</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header class="header_1">
        <h2><a href="index.php">KinoTEKA</a></h2>
    </header>

    <header class="header_2">
        <p><em>W naszej bazie znajdują się najlepsi aktorzy.</em></p>
    </header>

    <main class="main">
        <h1>Najlepsi aktorzy tylko w naszym kinie</h1>
        <!-- Skrypt 1 -->
        <?php
        $sql = "SELECT * FROM aktorzy ORDER BY aktorzy.nazwisko, aktorzy.imie ASC;";
        $res = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($res)) {
            echo "<a href='aktor.php?id=" . $row['id_aktora'] . "'>";
            echo "<div class='aktor'>";
            echo "<img src='" . $row['plik_awatara'] . "' alt='" . $row['imie'] . " " . $row['nazwisko'] . "' title='" . $row['plik_awatara'] . "' alt='" . $row['imie'] . " " . $row['nazwisko'] . "' >";
            echo "<p>" .  $row['imie'] . " " . $row['nazwisko'] . "</p>";
            echo "</div>";
            echo "</a>";
        }
        ?>
    </main>
    <div><a href=""></a></div>
    <footer class="footer">
        <p>Autor: <strong>Jaroław Bania</strong></p>
    </footer>
    <?php
    mysqli_close($conn);
    ?>
</body>
</html>