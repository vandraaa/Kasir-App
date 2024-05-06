function closeNotification() {
    document.getElementById("errorNotification").style.display = "none";
    errorNotification.style.display = "none";

    var modal = document.querySelector(".modal-error");
    modal.style.display = "none";
}

function addAccount() {
    document.getElementById("account").style.display = "block";
}

function closeAccount() {
    document.getElementById("account").style.display = "none";
}

function closeForm() {
    document.getElementById("addForm").style.display = "none";
}
