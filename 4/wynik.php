<?php
$conn = mysqli_connect("localhost", "root", "", "matura");
if(!$conn) {
    echo "Błąd połączenia";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matura</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header class="header">
        <h1>System informacji dla maturzystów</h1>
    </header>

    <aside class="aside">
        <img src="ma.jpg" alt="Matura">
        <img src="tu.jpg" alt="Matura">
        <img src="ra.jpg" alt="Matura">
    </aside>

    <section class="first">
        <!-- Skrypt 3 -->
        <?php
        $id = $_GET['id'];
        $imie = $_GET['imie'];
        $nazwisko = $_GET['nazwisko'];

        echo "<h2>" . $imie . " " . $nazwisko . "</h2>";

        $sql5 = "SELECT arkusz.rok, arkusz.sesja, arkusz.przedmiot, wynik.punkty FROM arkusz 
                JOIN wynik ON arkusz.symbol = wynik.symbol JOIN maturzysta ON 
                wynik.maturzysta_id = maturzysta.id WHERE maturzysta.id = '$id';";
        $res5 = mysqli_query($conn, $sql5);
        while($row5 = mysqli_fetch_assoc($res5)) {
            echo "<h3>" . $row5['rok'] . " " . $row5['sesja'] . "</h3>";
            echo "<p>" . $row5['przedmiot'] . ": " . $row5['punkty'] . "</p>";
        }


        ?>
    </section>

    <section class="second">
        <!-- Skrypt 1 -->
        <div class="block">
            <h4>Przedmioty</h4>
            <?php
            $sql = "SELECT DISTINCT arkusz.przedmiot FROM arkusz;";
            $res = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($res)) {
                echo " " . $row['przedmiot'];
            }
            ?>
        </div>

        <div class="block">
            <h4>Lata</h4>
            <?php
            $sql2 = "SELECT MAX(arkusz.rok), MIN(arkusz.rok) FROM arkusz;";
            $res2 = mysqli_query($conn, $sql2);
            while($row2 = mysqli_fetch_assoc($res2)) {
                echo $row2['MIN(arkusz.rok)'] . " - " . $row2['MAX(arkusz.rok)'];
            }
            ?>
        </div>

        <div class="block">
            <h4>Najlepszy wynik</h4>
            <?php
            $sql3 = "SELECT maturzysta.id, AVG(wynik.punkty) AS 'Wynik' FROM maturzysta JOIN wynik ON 
                    maturzysta.id = wynik.maturzysta_id GROUP BY maturzysta.id ORDER BY AVG(wynik.punkty) DESC LIMIT 1;";
            $res3 = mysqli_query($conn, $sql3);
            while($row3 = mysqli_fetch_assoc($res3)) {
                echo $row3['Wynik'] . "%";
            }
            ?>
        </div>

        <div class="block">
            <h4>Najgorszy wynik</h4>
            <?php
            $sql4 = "SELECT maturzysta.id, AVG(wynik.punkty) AS 'Wynik' FROM maturzysta JOIN wynik ON 
                    maturzysta.id = wynik.maturzysta_id GROUP BY maturzysta.id ORDER BY AVG(wynik.punkty) ASC LIMIT 1;";
            $res4 = mysqli_query($conn, $sql4);
            while($row4 = mysqli_fetch_assoc($res4)) {
                echo $row4['Wynik'] . "%";
            }
            ?>
        </div>
    </section>

    <footer class="footer">
        <p>Stronę wykonał: Jarosław Bania</p>
    </footer>
    
</body>
</html>