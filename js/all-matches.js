document.addEventListener("DOMContentLoaded", function() {
    fetch('http://localhost/projet-superbowl/backend/all-matches.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('The network response was not correct');
            }
            return response.json();
        })
        .then(data => {
            const matchesContainer = document.getElementById('all-matches');
            if (data.matches && data.matches.length > 0) {
                data.matches.forEach(match => {
                    const matchElement = document.createElement('div');
                    matchElement.className = 'match';
                    matchElement.innerHTML = `
                        <h3>${match.team1} vs ${match.team2}</h3>
                        <p>Date: ${match.date}</p>
                        <p>Time: ${match.time}</p>
                        <p>Status: ${match.status}</p>
                        <p>Weather: ${match.weather}</p>
                        <button onclick="viewMatchDetails(${match.id})">View Details</button>
                    `;
                    matchesContainer.appendChild(matchElement);
                });
            } else {
                matchesContainer.innerHTML = '<p>No matches available.</p>';
            }
        })
        .catch(error => {
            console.error('Error retrieving matches:', error);
            document.getElementById('all-matches').innerHTML = '<p>Error retrieving matches.</p>';
        });
});

function viewMatchDetails(matchId) {
    window.location.href = `match-details.html?match_id=${matchId}`;
}
