document.addEventListener("DOMContentLoaded", function() {
    // Check if the user is logged in
    fetch('../backend/check-session.php')
        .then(response => response.json())
        .then(data => {
            console.log('Session data:', data); // Log session data
            if (!data.loggedIn) {
                // Redirect to login page if the user is not logged in
                window.location.href = 'login.html';
            } else {
                // Load match details if the user is logged in
                loadMatchDetails(data.userId);
            }
        });

    // Add an event listener for the bet form
    document.getElementById('bet-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const matchId = document.getElementById('match_id').value;
        const team = document.getElementById('team-select').value;
        const amount = document.getElementById('amount').value;

        fetch('../backend/place-bet.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `match_id=${matchId}&team=${team}&amount=${amount}`
        })
        .then(response => response.json())
        .then(data => {
            console.log('Place bet response:', data); // Log place bet response
            if (data.error) {
                document.getElementById('error-message').textContent = data.error;
            } else {
                alert('Bet placed successfully!');
                // Redirect or update the page after success
                window.location.href = 'user-space.html';
            }
        })
        .catch(error => {
            console.error('Error placing the bet:', error);
        });
    });

    // Add an event listener for the update button
    document.getElementById('update-button').addEventListener('click', function() {
        const matchId = document.getElementById('match_id').value;
        const team = document.getElementById('team-select').value;
        const amount = document.getElementById('amount').value;

        fetch('../backend/update-bet.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `match_id=${matchId}&team=${team}&amount=${amount}`
        })
        .then(response => response.json())
        .then(data => {
            console.log('Update bet response:', data); // Log update bet response
            if (data.error) {
                document.getElementById('error-message').textContent = data.error;
            } else {
                alert('Bet updated successfully!');
                // Redirect or update the page after success
                window.location.href = 'user-space.html';
            }
        })
        .catch(error => {
            console.error('Error updating the bet:', error);
        });
    });
});

function loadMatchDetails(userId) {
    const urlParams = new URLSearchParams(window.location.search);
    const matchId = urlParams.get('match_id');

    if (!matchId) {
        alert('Match ID is missing');
        return;
    }

    document.getElementById('match_id').value = matchId;

    fetch(`../backend/match-details.php?match_id=${matchId}`)
        .then(response => response.json())
        .then(data => {
            console.log('Match details:', data); // Log match details
            if (data.error) {
                alert(data.error);
                return;
            }

            const matchTeamsElement = document.getElementById('match-teams');
            const oddsTeam1Element = document.getElementById('odds-team1');
            const oddsTeam2Element = document.getElementById('odds-team2');
            const teamSelectElement = document.getElementById('team-select');

            matchTeamsElement.innerHTML = `${data.match.team1} vs ${data.match.team2}`;
            oddsTeam1Element.innerHTML = `Odds for ${data.odds[0].team}: ${data.odds[0].odds}`;
            oddsTeam2Element.innerHTML = `Odds for ${data.odds[1].team}: ${data.odds[1].odds}`;

            teamSelectElement.innerHTML = `
                <option value="${data.odds[0].team}">${data.odds[0].team}</option>
                <option value="${data.odds[1].team}">${data.odds[1].team}</option>
            `;

            // Check if a bet already exists
            fetch(`../backend/check-bet.php?match_id=${matchId}&user_id=${userId}`)
                .then(response => response.json())
                .then(betData => {
                    console.log('Bet data:', betData); // Log bet data
                    if (betData.exists) {
                        document.getElementById('amount').value = betData.amount;
                        document.getElementById('team-select').value = betData.team;
                        document.getElementById('bet-button').style.display = 'none';
                        document.getElementById('update-button').style.display = 'block';
                    }
                });
        })
        .catch(error => {
            console.error('Error retrieving match details:', error);
        });
}
