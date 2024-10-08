document.addEventListener("DOMContentLoaded", function() {
    const matchesList = document.getElementById('matches-list');
    const loginButton = document.getElementById('login-button');

    // Always display the "My Space" button
    loginButton.style.display = 'block';

    fetch('../backend/index.php')
        .then(response => response.json())
        .then(data => {
            if (data.matches && data.matches.length > 0) {
                data.matches.forEach(match => {
                    const matchElement = document.createElement('div');
                    matchElement.className = 'match';
                    matchElement.innerHTML = `
                        <h3>${match.team1} vs ${match.team2}</h3>
                        <p>Time: ${match.time}</p>
                        <p>Status: ${match.status}</p>
                    `;
                    matchesList.appendChild(matchElement);
                });
            } else {
                matchesList.innerHTML = '<p>No matches available for today.</p>';
            }
        })
        .catch(error => {
            console.error('Error retrieving data:', error);
            matchesList.innerHTML = '<p>Error retrieving data.</p>';
        });

    fetch('../backend/check-session.php')
        .then(response => response.json())
        .then(data => {
            if (data.loggedIn) {
                loginButton.innerHTML = '<a href="logout.php">Logout</a>';
            } else {
                loginButton.innerHTML = '<a href="login.html">My Space</a>';
            }
        })
        .catch(error => {
            console.error('Error checking session:', error);
        });
});
