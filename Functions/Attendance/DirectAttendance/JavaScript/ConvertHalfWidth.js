
document
    .getElementById("cardID")
    .addEventListener("input", function () {
        var inputValue = this.value;
        var halfWidthValue = convertToHalfWidth(inputValue);
        this.value = halfWidthValue;
    });

function convertToHalfWidth(str) {
    return str.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function (s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xfee0);
    });
}