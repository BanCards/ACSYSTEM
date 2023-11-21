// イベントリスナーを追加して入力値を半角に変換
document.getElementById('cardID').addEventListener('input', function () {
    var inputValue = this.value;
    var halfWidthValue = convertToHalfWidth(inputValue);
    this.value = halfWidthValue;
});

// 文字列を半角に変換する関数
function convertToHalfWidth(str) {
    return str.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function (s) {
        return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
    });
}