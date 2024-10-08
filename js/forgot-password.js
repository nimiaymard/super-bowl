function recoverPassword() {
    const form = document.getElementById('forgot-password-form');
    const formData = new FormData(form);

    fetch('../backend/forgot-password.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
    });
}

