let form = document.getElementById('new-item-form');
var pop;

form.addEventListener('submit', function (event) {
    event.preventDefault();

    validate() ? form.submit() : pop.display();
})

/**
 * パスワード等をハッシュ化する関数
 *
 * @param string ハッシュ化したい文字列
 * @returns ハッシュ化した文字列
 */
function md5(string) {
    var hash = CryptoJS.MD5(string);
    return hash.toString();
}

/**
 * 検証関数
 *
 * @returns 検証結果
 */
function validate() {
    let value;
    let input = document.querySelectorAll('input');
    let result = true;

    input.forEach((x) => {
        value = x.value.trim();

        if (!value) {
            pop = new PopUp("記入エラー", "記入されていない欄があります。");
            result = false;
            return;
        }

        if (x.type == 'text') {
            if (value == current_email) {
                pop = new PopUp("現在のメールアドレスと同一の値です。", "同じ値を登録することはできません。");
                result = false;
                return;
            }
        }

        if (x.type === 'password') {
            if (value.length < 8 || value.length > 32) {
                pop = new PopUp("記入エラー", "パスワードは8文字以上32文字以内で収めてください。");
                result = false;
                return;
            }
        }
    });

    if (document.querySelectorAll('input').length >= 2) {
        let input_old_password = document.getElementById('input_current_password');
        let input_new_password = document.getElementById('input_new_password');
        if (md5(input_old_password.value) != current_password) {
            pop = new PopUp("現在のパスワードと違う値です。", "同じ値を入力してください。");
            result = false;
            return;
        }

        if (md5(input_new_password.value) == current_password) {
            pop = new PopUp("現在のパスワードと同一の値です。", "同じ値を登録することはできません。");
            result = false;
            return;
        }
    }

    return result;
}