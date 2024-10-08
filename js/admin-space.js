function createTeam() {
    const form = document.getElementById('create-team-form');
    const formData = new FormData(form);

    fetch('../backend/admin-space.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
    });
}

function createPlayer() {
    const form = document.getElementById('create-player-form');
    const formData = new FormData(form);

    fetch('../backend/admin-space.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
    });
}

function createMatch() {
    const form = document.getElementById('create-match-form');
    const formData = new FormData(form);

    fetch('../backend/admin-space.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
    });
}
