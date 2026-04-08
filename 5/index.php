<?php
$conn = mysqli_connect("localhost", "root", "", "zgloszenia");
if(!$conn) {
    echo "Błąd połączenia";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZGŁOSZENIA</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header class="header">
        <h1>Zgłoszenia wydarzeń</h1>
    </header>

    <main class="main">
        <section class="left">
            <h2>Personel</h2>
            <form action="index.php" method="post">
                <input type="radio" value="policjant" name="wybor" checked >Policjant 
                <input type="radio" value="ratownik" name="wybor">Ratownik

                <button type="submit" name="pokaz">Pokaż</button>
            </form>
            <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['wybor'])){
                $wybor = $_POST['wybor'];
            }
            if(isset($wybor)) {
                $sql = "SELECT personel.id, personel.imie, personel.nazwisko 
                        FROM personel WHERE personel.status = '$wybor';";
                $res = mysqli_query($conn, $sql);
                
                echo "<h3>Wybrano opcję: " . $wybor . "</h3>";
            }
            ?>
                <table>
                <tr>
                    <th>Id</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                </tr>
                <!-- Skrypt 1 -->
                <?php
                if(isset($wybor)) {
                    while($row = mysqli_fetch_assoc($res)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] ."</td>";
                        echo "<td>" . $row['imie'] ."</td>";
                        echo "<td>" . $row['nazwisko'] ."</td>";
                        echo "</tr>";
                    
                    }
                }
                ?>
            </table>
        </section>

        <section class="right">
            <h2>Nowe zgłoszenie</h2>
            <ol>
                <!-- Skrypt 2 -->
                <?php
                $sql3 = "SELECT p.id, p.nazwisko FROM personel p LEFT JOIN rejestr r ON p.id = r.id_personel 
                        WHERE r.id_personel IS NULL;";
                $res3 = mysqli_query($conn,$sql3);

                while($row3 = mysqli_fetch_assoc($res3)) {
                    echo "<li>". $row3['id'] . " " . $row3['nazwisko'] . "</li>";
                }

                ?>
            </ol>

            <form action="index.php" method="post">
                <label for="osoba">Wybierz id osoby z listy: </label>
                <input type="number" name="osoba">
                
                <button type="submit" name="zgloszenie">Dodaj zgłoszenie</button>
                <!-- Skrypt 3 -->
                <?php
                if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['zgloszenie'])) {
                    $id = $_POST['osoba'];
                    $sql4 = "INSERT INTO rejestr (data, id_personel, id_pojazd) VALUES (CURRENT_DATE(),$id,14);";
                    mysqli_query($conn, $sql4);
                }
                ?>
            </form>
        </section>
    </main>

    <footer class="footer">
        <p>Stronę wykonał: Jarosław Bania</p>
    </footer>
    
</body>
</html>