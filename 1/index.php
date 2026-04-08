<?php
$conn = mysqli_connect("localhost", "root", "", "samochody");
if(!$conn) {
    echo "Błąd połączenia";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfigurator samochodów</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header class="header">
        <h1>Serwis konfiguracji samochodów</h1>
    </header>

    <nav class="nav">
        <h2>Samochody</h2>
        <h2>Konfigurator</h2>
        <h2>Kontakt</h2>
    </nav>

    <main class="main">
        <section class="left">
           <?php
            $sql = "SELECT pojazdy.marka, pojazdy.model, pojazdy.cena, kolory.nazwa, kolory.doplata
                    FROM pojazdy JOIN kolory ON pojazdy.kolor = kolory.id WHERE pojazdy.model = 'alfa';";
            $res = mysqli_query($conn, $sql);
           ?>
            <table>
                <?php
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td> ". $row['marka'] ." </td>";
                        echo "<td> ". $row['model'] ." </td>";
                        echo "<td> ". $row['nazwa'] ." </td>";
                        echo "<td> ". $row['cena'] + $row['doplata'] ." </td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </section>

        <section class="center">
            <table>
                <tr>
                    <th colspan="2">Konfiguracja</th>
                    <th>Cena</th>

                </tr>
                <tr>
                    <td colspan="3"><img src="a1.jpg" alt="Konfiguracja 1"></td>
                </tr>
                <?php
                $sql2 = "SELECT pojazdy.marka, pojazdy.model, pojazdy.cena FROM pojazdy ORDER BY RAND() LIMIT 2;";
                $result = mysqli_query($conn, $sql2);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['marka'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['cena'] . "</td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td colspan="3"><img src="a2.jpg" alt="Konfiguracja 2"></td>
                </tr>
                <?php
                $sql2 = "SELECT pojazdy.marka, pojazdy.model, pojazdy.cena FROM pojazdy ORDER BY RAND() LIMIT 2;";
                $result = mysqli_query($conn, $sql2);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['marka'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['cena'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </section>

        <section class="right">
            <h3>111 222 444</h3>
            <img src="a3.png" alt="Samochód">
        </section>
    </main>

    <footer class="footer">
        <p>Stronę wykonał: Jarosław Bania</p>
    </footer>   
</body>
</html>