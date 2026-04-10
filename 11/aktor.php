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
    <title>Informacje o aktorze | KinoTEKA</title>
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
        <!-- Skrypt 2 -->
        <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql2 = "SELECT aktorzy.imie, aktorzy.nazwisko, aktorzy.plik_awatara FROM aktorzy WHERE aktorzy.id_aktora =$id;";
            $result2 = mysqli_query($conn, $sql2);
            while($row2 = mysqli_fetch_assoc($result2)) {
                echo "<div class='p_aktor'>";
                echo "<img src='" . $row2['plik_awatara'] . "' alt='" . $row2['imie'] . " " . $row2['nazwisko'] . "' title='" . $row2['imie'] . " " . $row2['nazwisko'] . "'>";
                echo "<h1>" .  $row2['imie'] . " " . $row2['nazwisko'] . "</h1>";
                echo "</div>";

                $sql4 = "SELECT filmy.id_filmu, filmy.tytul, filmy.rok_produkcji FROM filmy JOIN filmy_aktorzy 
                ON filmy.id_filmu = filmy_aktorzy.id_filmu WHERE filmy_aktorzy.id_aktora = $id;";
                $res4 = mysqli_query($conn, $sql4);
                $zwracane = mysqli_num_rows($res4);
                if($zwracane == 0) {
                    echo $row2['imie'] . " nie znajduje się na listach obsady znanych nam produkcji.";
                } else {
                        echo $row2['imie'] . " znajduje się na listach obsady " .  $zwracane . " znanych nam produkcji.";
                    
                }
                
            }
        
        } 
        ?>

    </main>

    <footer class="footer">
        <p>Autor: <strong>Jaroław Bania</strong></p>
    </footer>
    <?php
    mysqli_close($conn);
    ?>
</body>
</html>