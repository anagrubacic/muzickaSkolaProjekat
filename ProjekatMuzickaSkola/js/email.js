// Postavljanje event listenera za klik na link
var kontaktirajLink = document.getElementById("kontaktirajLink");
kontaktirajLink.addEventListener("click", function() {
    // Dobijamo referencu na <select> element
    var select = document.getElementById("ucenik");

    // Dobijamo izabrani element
    var selectedOption = select.options[select.selectedIndex];

    // Dobijamo vrednost izabrane opcije
    var selectedValue = selectedOption.value;

    // Provera da li je email adresa definisana
    if (selectedValue) {
        // Sada možete koristiti selectedValue za otvaranje emaila
        window.location.href = "mailto:" + selectedValue;
    } else {
        alert("Molimo izaberite učenika iz liste.");
    }
});