document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const matchId = urlParams.get('match_id');

    fetch(`http://localhost/projet-superbowl/backend/match-details.php?match_id=${matchId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('match-details').innerHTML = `<p>${data.error}</p>`;
                return;
            }

            const match = data.match;
            const players = data.players;
            const odds = data.odds;
            const comments = data.comments;

            let playersHTML = '<h3>Team Composition</h3><ul>';
            players.forEach(player => {
                playersHTML += `<li>${player.first_name} ${player.last_name} (${player.team})</li>`;
            });
            playersHTML += '</ul>';

            let oddsHTML = '<h3>Team Odds</h3><ul>';
            odds.forEach(odd => {
                oddsHTML += `<li>${odd.team}: ${odd.odds}</li>`;
            });
            oddsHTML += '</ul>';

            let commentsHTML = '<h3>Comments and Score</h3><ul>';
            comments.forEach(comment => {
                commentsHTML += `<li><strong>${comment.commentator}:</strong> ${comment.comment} (Score: ${comment.score})</li>`;
            });
            commentsHTML += '</ul>';

            document.getElementById('match-details').innerHTML = `
                <h2>${match.team1} vs ${match.team2}</h2>
                <p>Date: ${match.date}</p>
                <p>Start Time: ${match.time}</p>
                <p>Status: ${match.status}</p>
                <p>Weather: ${match.weather}</p>
                ${playersHTML}
                ${oddsHTML}
                ${commentsHTML}
                <button onclick="placeBet(${matchId})">Place Bet</button>
            `;
        })
        .catch(error => {
            console.error('Error retrieving match details:', error);
            document.getElementById('match-details').innerHTML = '<p>Error retrieving match details.</p>';
        });
});

function placeBet(matchId) {
    window.location.href = `bet.html?match_id=${matchId}`;
}


