var element = document.getElementById("cardID");

window.onload = function () {
    element.focus();
};

document.addEventListener('DOMContentLoaded', function () {
    element.focus();
})

document.addEventListener('click', function (event) {
    if (event.target !== element)
        element.focus();
})