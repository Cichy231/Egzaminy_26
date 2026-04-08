<?php
$conn = mysqli_connect("localhost", "root", "", "pogoda");
if(!$conn) {
    echo "Błąd połączenia";
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pogoda</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header class="h_left">
        <img src="slonce.png" alt="Słonecznie">
    </header>

    <header class="h_right">
        <h1>Pogoda w Europie</h1>
    </header>

    <main class="main">
        <section class="s_left">
            <h2>Temperatury w lipcu</h2>

            <table>
                <tr>
                    <th>Miasto</th>
                    <th>Kraj</th>
                    <th>Temperatura</th>
                    <th>Pogoda</th>
                </tr>
                <!-- Skrypt 1 -->
                <?php
                $sql1 = "SELECT miejscowosc.nazwa, miejscowosc.kraj, pomiary.temperatura FROM miejscowosc 
                         JOIN pomiary ON miejscowosc.id = pomiary.id_miejscowosc WHERE pomiary.id_miesiac = 7;";
                $res = mysqli_query($conn, $sql1);
                while($row = mysqli_fetch_assoc($res)) {
                    $temp = $row['temperatura'];
                    echo "<tr>";
                    echo "<td>" . $row['nazwa'] . "</td>";
                    echo "<td>" . $row['kraj'] . "</td>";
                    echo "<td>" . $row['temperatura'] . "</td>";
                    if($temp > 30) {
                        echo "<td><img src='slonce.png'></td>";
                    } else if ($temp < 26) {
                        echo "<td><img src='deszcz.png'></td>";
                    } else {
                        echo "<td><img src='chmury.png'></td>";
                    }
                    echo "</tr>";
                } 
                ?>
            </table>
        </section>

        <section class="s_right">
            <h2>Średnie temperatury w roku</h2>
            <a href="index.php?id_miesiac=1">Styczeń</a>
            <a href="index.php?id_miesiac=2">Luty</a>
            <a href="index.php?id_miesiac=3">Marzec</a>
            <a href="index.php?id_miesiac=4">Kwiecień</a>
            <a href="index.php?id_miesiac=5">Maj</a>
            <a href="index.php?id_miesiac=6">Czerwiec</a>
            <a href="index.php?id_miesiac=7">Lipiec</a>
            <a href="index.php?id_miesiac=8">Sierpień</a>
            <a href="index.php?id_miesiac=9">Wrzesień</a>
            <a href="index.php?id_miesiac=10">Paźdźiernik</a>
            <a href="index.php?id_miesiac=11">Listopad</a>
            <a href="index.php?id_miesiac=12">Grudzień</a>

            <p>Średnia temperatura dla wybranego miesiąca wynosi</p>
            <!-- Skrypt 2 -->
            <?php
            if(isset($_GET['id_miesiac'])) {
                $miesiac = $_GET['id_miesiac'];

                $sql = "SELECT ROUND(AVG(pomiary.temperatura), 2) FROM pomiary WHERE id_miesiac = $miesiac;";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<h3>" . $row['ROUND(AVG(pomiary.temperatura), 2)'] . "</h3>";
                }
            }

            ?>
        </section>
    </main>

    <footer class="footer">
        <p>Numer zdającego: Jarosław Bania</p>
    </footer>
    
</body>
</html>