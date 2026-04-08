<?php 
$conn = mysqli_connect("localhost", "root", "", "matura");
if(!$conn) {
    echo "BŁąd połączenia";
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
        <h3>Wybierz ucznia z listy</h3>
        <!-- Skrypt 2 -->
        <?php
        $sql1 = "SELECT maturzysta.id, maturzysta.imie, maturzysta.nazwisko FROM maturzysta WHERE maturzysta.szkola = 'T3';";
        $res1 = mysqli_query($conn, $sql1);
        while($row1 = mysqli_fetch_assoc($res1)) {
            $id = $row1['id'];
            $imie = $row1['imie'];
            $nazwisko = $row1['nazwisko'];

             echo '<a href="wynik.php?id=' . $id .'&imie=' . $imie .'&nazwisko=' . $nazwisko . '">' . $id . '. ' . $imie . ' ' . $nazwisko .'</a><br>';
        }
        ?>
    </section>
    <a href=""></a>
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