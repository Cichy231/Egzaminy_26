<?php
$conn = mysqli_connect("localhost", "root", "", "przepisy");
if(!$conn) {
    echo "Błąd połączenia";
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog kulinarny</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <aside class="aside">
        <a href="przepisy.php?id=1">Sernik</a><br>
        <a href="przepisy.php?id=2">Sałatka</a><br>
        <a href="przepisy.php?id=3">Pankejki</a><br>
        <a href="przepisy.php?id=4">Nugetsy</a><br>
        <a href="przepisy.php?id=5">Łosoś</a><br>
        <a href="przepisy.php?id=6">Kociołek</a><br>
        <a href="przepisy.php?id=7">Jagnięcina</a><br>
        <a href="przepisy.php?id=8">Hamburgery</a><br>
        <a href="przepisy.php?id=9">Eklerki</a><br>
        <a href="przepisy.php?id=10">Churros</a><br>

        <p>Autor: Jarosław Bania</p>
    </aside>

    <main class="main">
        
        <!-- Skrypt 1 -->
        <?php

        if(isset($_GET['id'])) {
            $ID = $_GET['id'];
        } else {
            $ID = 7;
        }

        $sql = "SELECT p.nazwa, r.rodzaj FROM potrawy p JOIN rodzaje r ON p.idRodzaje = r.idRodzaje WHERE p.idPotrawy= $ID;";
        $result = mysqli_query($conn, $sql);
        
        ?>
        <h1><?php while ($row = mysqli_fetch_assoc($result)) { echo $row['rodzaj']; } ?></h1>
        
        
        <!-- Skrypt 2 -->
        <?php

        $sql2 = "SELECT potrawy.nazwa, potrawy.trudnosc, potrawy.kalorie FROM potrawy WHERE potrawy.idPotrawy = $ID;";
        $result2 = mysqli_query($conn, $sql2);
        while($row2 = mysqli_fetch_assoc($result2)) {
            echo "<h2>" . $row2["nazwa"] . "</h2>";
            echo "<p>Trudność: " . $row2['trudnosc'] . ", Kalorie: " . $row2['kalorie'] . "</p>";
        }

        ?>
        <img src="separator.png" alt="przepis">

        <!-- Skkrypt 3 -->
        <?php
        $sql3 = "SELECT p.nazwa, a.alergen FROM potrawy p JOIN lista_alergenow lis ON p.idPotrawy = lis.idPotrawy 
                 JOIN alergeny a ON a.idAlergeny = lis.idAlergeny WHERE p.idPotrawy = $ID;";
        $result3 = mysqli_query($conn, $sql3);

        ?>
        <p>Alergeny:<?php while($row3 = mysqli_fetch_assoc($result3)) {echo " " . $row3['alergen'] . " "; } ?> </p>

        <h2>Składniki</h2>
        <ol>
            <li>Lorem 1 kg</li>
            <li>Ipsum 2 szt.</li>
            <li>Dolor 200 g</li>
            <li>Sit amet (szczypta)</li>
        </ol>

        <!-- Skrypt 4 -->
        <?php
        $sql4 = "SELECT potrawy.przepis, potrawy.plik FROM potrawy WHERE potrawy.idPotrawy = $ID;";
        $result4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_assoc($result4);
        ?>
        <p><?php echo $row4['przepis'];  ?></p>
    </main>

    <section class="section" style="background-image: url(<?php echo $row4['plik']; ?>);">

        <h1>Blog kulinarny</h1>
    </section>
    <?php
    mysqli_close($conn);
    ?>
</body>
</html>