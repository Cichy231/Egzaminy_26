<?php
$conn = mysqli_connect("localhost", "root", "", "bazar");
if(!$conn) {
    echo "Błąd połączenia";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zdrowy bazarek</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header class="header">
        <h1>Zdrowy bazarek</h1>
    </header>

    <nav class="nav">
        <!-- Skrypt 1 -->
        <?php
        $sql = "SELECT towar.nazwa, towar.plik FROM towar LIMIT 10;";
        $res = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($res)) {
            echo "<img src='" . $row['plik'] . "' alt='" . $row['nazwa'] . "'>";
        }
        ?>
    </nav>
    <main class="main">
        <aside class="aside">
            <img src="market.png" alt="bazarek">
        </aside>

        <section class="section">
            <p>Wybierz owoc lub warzywo i podaj jego wagę</p>

            <form action="index.php" method="post">
                <!-- Skrypt 2 -->
                <select id="rosliny" name="rosliny">
                    <?php
                    $sql2 = "SELECT towar.id, towar.nazwa FROM towar;";
                    $res2 = mysqli_query($conn, $sql2);
                    while($row2= mysqli_fetch_assoc($res2)) {
                        echo "<option value='" . $row2['id'] . "'>" . $row2['nazwa'] . "</option>"; 
                    }
                    ?>
                </select>

                <input type="number" name="kilogramy">

                <button type="submit" name="zamow">Zamów</button>
            </form>
            <!-- Skrypt 3 -->
            <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST['zamow'])) {
                $id = $_POST['rosliny'];
                $kilogramy = $_POST['kilogramy'];
                $sql3 = "SELECT towar.rodzaj, towar.nazwa, towar.cena FROM towar WHERE towar.id = $id;";
                $res3 = mysqli_query($conn, $sql3);
                while($row3 = mysqli_fetch_assoc($res3)) {
                    $ogolna = $row3['cena'] * $kilogramy;
                
                echo "<p>" . $row3['rodzaj'] . " " . $row3['nazwa'] . " wartość: " . $ogolna . " zł</p>";
                }    
                $sql4= "INSERT INTO zamowienie (id_towar, id_sklep, liczba_kg) VALUES ('$id', 2, '$kilogramy');";
                mysqli_query($conn, $sql4);
            }
            ?>
        </section>
    </main>

    <footer class="footer">
        <p>Stronę opracował: Jarosław Bania</p>
    </footer>
    <?php
    mysqli_close($conn);
    ?>
</body>
</html>