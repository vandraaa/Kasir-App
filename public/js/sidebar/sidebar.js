function showOut() {
    document.getElementById("out").style.display = "block";
}

function closeout() {
    document.getElementById("out").style.display = "none";
}

const logoutButton = document.getElementById('logout');
logoutButton.addEventListener('click', () => {
    localStorage.removeItem("hideStatus");
})
