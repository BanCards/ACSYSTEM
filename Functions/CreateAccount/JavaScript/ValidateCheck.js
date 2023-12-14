var form = document.getElementById('createAccount-form');
var pop;

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
    if (form.name.value.length < 2 || form.name.value.length > 16) {
        pop = new PopUp("記入エラー", "名前は2文字以上32文字以内で収めてください。");
        return false;
    }

    if (form.password.value.length < 8 || form.password.value.length > 32) {
        pop = new PopUp("記入エラー", "パスワードは8文字以上32文字以内で収めてください。");
        return false;
    }

    if (form.password.value != form.confirm_password.value) {
        pop = new PopUp("パスワードが一致しません", "パスワードをご確認の上、再度記入してください。");
        return false;
    }

    return true;
}