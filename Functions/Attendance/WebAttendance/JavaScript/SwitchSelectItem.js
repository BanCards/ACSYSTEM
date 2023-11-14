const parentSelect = document.querySelector(".attendance-item-parent .status");
const childSelect = document.querySelector(".attendance-item-child");

window.onload = function () {
    items = Array.from(childSelect.children);
    items.forEach(element => {
        element.style.display = "none";
        element.name = '';
    });

    items[0].style.display = "inline-block";
    items[0].name = 'reason';
}

parentSelect.addEventListener("change", function () {

    const selectedValue = parentSelect.value;
    items = Array.from(childSelect.children);
    items.forEach(element => {
        element.style.display = "none";
        element.name = '';
    });

    switch (selectedValue) {
        case "absent":
            const absentReason = document.querySelector(".absent-reason");
            absentReason.style.display = "inline-block";
            absentReason.name = 'reason';
            break;
        case "lateness":
            const latenessReason = document.querySelector(".lateness-reason");
            latenessReason.style.display = "inline-block";
            latenessReason.name = 'reason';
            break;
        case "leave_early":
            const leaveEarlyReason = document.querySelector(".leave_early-reason");
            leaveEarlyReason.style.display = "inline-block";
            leaveEarlyReason.name = 'reason';
            break;
        case "official_absence":
            const officialAbsenceReason = document.querySelector(".official_absence-reason");
            officialAbsenceReason.style.display = "inline-block";
            officialAbsenceReason.name = 'reason';
            break;
    }
});
