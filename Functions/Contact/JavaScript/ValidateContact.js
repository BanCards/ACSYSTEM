let form = document.getElementById('contact-form');
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
    if(form.contactTitle.value.length < 1 || form.contactTitle.value.length > 30)
    {
        pop = new PopUp("記入エラー","タイトルは1文字以上30文字以内に収めてください。");
        return false;
    }

    if(form.contactContents.value.length < 1 || form.contactContents.value.length > 400)
    {
        pop = new PopUp("記入エラー","メッセージは1文字以上400文字以内に収めてください。");
        return false;
    }

    return true;
}