let input_element = document.getElementById('createAccount-readCard-form').cardID;

input_element.addEventListener('input', function () {
    input_element.value = convertToHalfWidth(input_element.value);
});

/**
 * 全角入力を半角に戻す
 *
 * @param {string} str
 * @returns
 */
function convertToHalfWidth(str) {
    return str.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function (s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
}