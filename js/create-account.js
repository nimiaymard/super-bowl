function createAccount() {
    const form = document.getElementById('create-account-form');
    const formData = new FormData(form);

    fetch('../backend/create-account.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        const messageDiv = document.getElementById('message');
        messageDiv.textContent = data;
        messageDiv.style.color = 'green';
    })
    .catch(error => {
        const messageDiv = document.getElementById('message');
        messageDiv.textContent = 'Error creating the account. Please try again.'
;
        messageDiv.style.color = 'red';
    });
}
