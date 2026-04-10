<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylizacja paznokci</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <aside class="aside">
        <img src="manicure.jpg" alt="Stylizacja paznokci">
    </aside>

    <main class="main">
        <header class="header">
            <h1>Twoje wymarzone paznokcie</h1>
        </header>

        <nav class="nav">
            <button type="button" class="left" id="left" onclick="zmien('pierwszy')">Kolor</button>
            <button type="button" class="center" id="center" onclick="zmien('drugi')">Kształt</button>
            <button type="button" class="right" id="right" onclick="zmien('trzeci')" >Wzór</button>
        </nav>

        <section class="first" id="first">
            <h2>Kolor</h2>
            <img src="kolory.png" alt="Kolory paznokci"><br>
            <input type="color" value="#FF0000">
        </section>

        <section class="second" id="second">
            <h2>Kształt</h2>
            <img src="ksztalt.png" alt="Kształty paznokci"><br>
            <select name="rodzaje" id="rodzaje">
                <option value="migdał">migdał</option>
                <option value="zaokrąglony">zaokrąglony</option>
                <option value="kwadratowy">kwadratowy</option>
                <option value="balerina">balerina</option>
                <option value="zaokrąglony kwadrat">zaokrąglony kwadrat</option>
            </select>
        </section>

        <section class="third" id="third">
            <h2>Wzór</h2>
            <!-- Skrypt 1 -->
            <input type="number" min="1" max="10">
        </section>
    </main>

    <footer class="footer">
        <p>Autor strony: <em>Jarosław Bania</em></p>
    </footer>

    <script>
        function zmien(przycisk) {
           let left = document.getElementById("left");
           let center = document.getElementById("center");
           let right = document.getElementById("right");
           
           let first = document.getElementById("first");
           let second = document.getElementById("second");
           let third = document.getElementById("third");

           if(przycisk == 'pierwszy') {
            first.style.display = "block";
            second.style.display = "none";
            third.style.display = "none";

            left.style.backgroundColor = "Salmon";
            center.style.backgroundColor = "Crimson";
            right.style.backgroundColor = "Crimson";
           } 
           else if (przycisk == 'drugi') {
            first.style.display = "none";
            second.style.display = "block";
            third.style.display = "none";

            left.style.backgroundColor = "Crimson";
            center.style.backgroundColor = "Salmon";
            right.style.backgroundColor = "Crimson";
           } 
           else if (przycisk == 'trzeci') {
            first.style.display = "none";
            second.style.display = "none";
            third.style.display = "block";

            left.style.backgroundColor = "Crimson";
            center.style.backgroundColor = "Crimson";
            right.style.backgroundColor = "Salmon";
           }
        }

        function obrazy() {
            let blok = document.getElementById("third");
            let obrazy = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg'];
            for(let i=0; i<10; i++) {
                let zdjecie = document.createElement("img");
                zdjecie.src = obrazy[i];
                zdjecie.className = 'wzory';
                zdjecie.title = 1 + i;

                blok.appendChild(zdjecie);
            }
            '<br>'
        }
        obrazy();
    </script>
</body>
</html>