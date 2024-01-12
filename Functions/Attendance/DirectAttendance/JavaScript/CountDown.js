let time = 3;

function printCount() {
    var element = document.getElementById("countdown");
    element.textContent = time;
}

function redirect() {
    location.href = './DirectAttendance.php';
}

function Count() {
    time--;

    if (time >= 1) {
        timer = setTimeout(Count, 1000);
        printCount();
    }
    else {
        clearTimeout(timer);
        redirect();
    }
}

let timer = setTimeout(Count, 1000);

window.onload = function () {
    printCount();
}