class PopUp {
    constructor(title, message) {
        this.title = title;
        this.message = message;
    }

    get() {
        let pop =
            `<div class="popup-overlay">
            <div class="popup-window">
                <h2 class="pop-title">${this.title}</h2>
                <div class="pop-message">${this.message}</div>
                <div class="popup-close">
                    <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="0" x2="18" y2="18" stroke="black" stroke-width="3"></line>
                        <line x1="0" y1="18" x2="18" y2="0" stroke="black" stroke-width="3"></line>
                    </svg>
                </div>
            </div>
        </div>`;

        return pop;
    }

    display() {
        let element = document.querySelector('.pop');
        element.innerHTML = this.get();
        element.style.display = 'block';
        element.querySelector(".popup-close").addEventListener('click', this.close, false);
    }

    close() {
        let element = document.querySelector('.pop');
        element.style.display = 'none';
    }
}