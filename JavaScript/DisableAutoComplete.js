document.addEventListener('DOMContentLoaded', function() {
    let form = document.querySelectorAll('form');
    form.forEach((element) => element.setAttribute('autocomplete', 'off'));
})