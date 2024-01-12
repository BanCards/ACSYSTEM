let form = document.getElementById('login-form');
let pop;

form.addEventListener('submit', function (event) {
    event.preventDefault();

    validate() ? form.submit() : pop.display();
})

/**
 * 検証関数
 *
 * @returns 検証結果
 */
function validate() {
    if (form.email.value.length < 1 || form.password.value.length < 1) {
        pop = new PopUp("記入エラー", "記入されていない欄があります。");
        return false;
    }

    if (form.password.value.length < 8 || form.password.value.length > 32) {
        pop = new PopUp("記入エラー", "パスワードは8文字以上32文字以内で収めてください。");
        return false;
    }

    return true;
}