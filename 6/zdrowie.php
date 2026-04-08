<?php
$conn = mysqli_connect("localhost", "root", "", "choroby");
if(!$conn) {
    echo "Błąd połączenia";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wykaz chorób</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header class="header">
        <h1>Informacja o chorobach w Polsce</h1>
    </header>

    <nav class="nav">
        <a href="https://szpitale.pl/" target="_blank">Szpitale</a>
        <a href="https://www.przychodnie.pl/" target="_blank">Przychodnie</a>
        <a href="https://www.nfz.gov.pl/" target="_blank">NFZ</a>
    </nav>

    <main class="main">
        <section class="left">
            <h2>Choroby zakaźne</h2>
            <ol>
                <!-- Skrypt 1 -->
                <?php
                $sql = "SELECT choroby.nazwa FROM choroby WHERE choroby.zakazna = 'T' ORDER BY choroby.nazwa ASC;";
                $res = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($res)) {
                    echo "<li>" . $row['nazwa'] . "</li>";
                }
                ?>
            </ol>
        </section>

        <section class="right">
            <h2>Objawy chorób</h2>
            <form action="zdrowie.php" method="post">
                <select name="choroby" id="choroby">
                    <!-- Skrypt 2 -->
                    <?php
                    $sql2 = "SELECT choroby.id, choroby.nazwa FROM choroby;";
                    $res2 = mysqli_query($conn, $sql2);
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        echo "<option value='" . $row2['id'] ."'>" . $row2['nazwa'] . "</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="wyslij">Sprawdź</button>
            </form>
            <div class="blok">
                <!-- Skrypt 3 -->
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['wyslij'])) {
                    $choroba = $_POST['choroby'];
                    $sql3 = "SELECT objawy.nazwa FROM objawy JOIN choroby_objawy ON objawy.id = choroby_objawy.id_objawy 
                            JOIN choroby ON choroby.id = choroby_objawy.id_choroby WHERE choroby.id = $choroba;";
                    $res3 = mysqli_query($conn, $sql3);
                    while($row3 = mysqli_fetch_assoc($res3)) {
                        echo " <span>" . $row3['nazwa'] . "</span> ";
                    }
                }
                ?>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>Stronę opracował: Jarosław Bania</p>
    </footer>
    <img src="Zdrowia.png" alt="Życzymy zdrowia!">
    <?php
    mysqli_close($conn);
    ?>
</body>
</html>