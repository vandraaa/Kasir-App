const inputSearch = document.getElementById('search');
inputSearch.addEventListener('input', () => {
    const searchValue = inputSearch.value.toLowerCase();

    const rows = document.querySelectorAll('#history tbody tr');
    let matchFound = false;

    rows.forEach(function(row) {
        const idTrx = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
        const nama = row.querySelector('td:nth-child(4)').innerText.toLowerCase();

        if (nama.includes(searchValue) || idTrx.includes(searchValue)) {
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
