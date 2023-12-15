var form = document.getElementById('newItem-form');
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

    let input_new = form.querySelector('input[name="new-item-value"]');
    let input_cur = form.querySelector('input[name="current-item-value"]');

    if (input_cur) {
        if (input_cur.value.length < 8 || input_cur.value.length > 32) {
            pop = new PopUp("記入エラー", "パスワードは8文字以上32文字以内で収めてください。");
            return false;
        }

        if (input_new.value.length < 8 || input_new.value.length > 32) {
            pop = new PopUp("記入エラー", "パスワードは8文字以上32文字以内で収めてください。");
            return false;
        }
    }

    return true;
}