window.onload = function () {
    input_element.focus();
};

document.addEventListener('DOMContentLoaded', function () {
    input_element.focus();
})

document.addEventListener('click', function (event) {
    if (event.target !== input_element)
        input_element.focus();
})