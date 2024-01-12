let form = document.getElementById('attendance-form');

form.addEventListener('submit', function (event) {
    event.preventDefault();

    validate() ? form.submit() : location.href = "./AttendError.php";
})

/**
 * 検証関数
 *
 * @returns 検証結果
 */
function validate() {
    if (form.cardID.value.length < 1) return false
    return true;
}