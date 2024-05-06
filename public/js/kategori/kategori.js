setTimeout(function () {
    var addFormModal = document.getElementById("success");
    addFormModal.style.display = "none";
}, 2500);

var progressBar = document.getElementById("progressBar");
var totalTime = 2500;
var currentTime = 0;

var intervalId = setInterval(function () {
    currentTime += 22;
    var progress = (currentTime / totalTime) * 100;
    progressBar.style.width = progress + "%";
    if (currentTime >= totalTime) {
        clearInterval(intervalId);
    }
}, 20);

function openForm() {
    document.getElementById("addForm").style.display = "flex";
}

function closeForm() {
    document.getElementById("addForm").style.display = "none";
}

function opendelete(id) {
    document.getElementById("delete").style.display = "flex";
    document.getElementById("deleteForm").action =
        "/dashboard/kategori/" + id + "/destroy";
}

function closedelete() {
    document.getElementById("delete").style.display = "none";
}

const inputSearch = document.getElementById('search');
inputSearch.addEventListener('input', () => {
    const searchValue = inputSearch.value.toLowerCase();

    const rows = document.querySelectorAll('#table-kategori tbody tr');
    let matchFound = false;

    rows.forEach(function(row) {
        const kategori = row.querySelector('td:nth-child(2)').innerText.toLowerCase();

        if (kategori.includes(searchValue)) {
            row.style.display = '';
            matchFound = true;
        } else {
            row.style.display = 'none';
        }
    });

    const message = document.getElementById('noMatchMessage');
    if (!matchFound && searchValue.length > 0) {
        message.style.display = 'block';
    } else {
        message.style.display = 'none';
    }
});
