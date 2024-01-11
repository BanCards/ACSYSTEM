let form = document.getElementById('createAccount-readCard');
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
    if(form.cardID.value.length < 1) {
        pop = new PopUp("読み込みエラー","再度カードを読み込んでください。");
    }

    return true;
}