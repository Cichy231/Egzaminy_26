function zamien(wstaw) {
    let obrazek = document.getElementById('obrazek');
    obrazek.src = wstaw
}

function oblicz() {
    let a = document.getElementById("a").value;
    let b = document.getElementById("b").value;
    let wynik = document.getElementById("wynik");
    let pole;
    let obraz = document.getElementById("obrazek").getAttribute("src");

    if(obraz == "1d.bmp") {
        pole = (a * b)/2
    } else {
        pole = a * b;
    }
    wynik.innerHTML = pole;
}