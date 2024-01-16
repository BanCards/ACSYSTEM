let form = document.getElementById('new-item-form');
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
    let input = document.querySelectorAll('input');
    let result = true;

    input.forEach((x) => {
        if (x.value.length < 1) {
            pop = new PopUp("記入エラー", "記入されていない欄があります。");
            result = false;
            return;
        }

        if (input.length >= 2) {
            if (x.value.length < 8 || x.value.length > 32) {
                pop = new PopUp("記入エラー", "パスワードは8文字以上32文字以内で収めてください。");
                result = false;
                return;
            }
        }
    });

    return result;
}