function toggleInput() {
    var menu = document.getElementById("menu");
    var textInput = document.getElementById("new_conso");

    if (menu.value === "option1") {
        textInput.style.display = "block";
    } else {
        textInput.style.display = "none";
    }
}