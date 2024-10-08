CREATE DATABASE superbowl;

-- Use the database
USE superbowl_db;

-- Create the users table if it doesn't exist
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255)
);

-- Insert test users
INSERT INTO users (firstname, lastname, email, password) VALUES
('John', 'Doe', 'john@example.com', 'password1'),
('Jane', 'Smith', 'jane@example.com', 'password2'),
('Alice', 'Johnson', 'alice@example.com', 'password3'),
('Bob', 'Brown', 'bob@example.com', 'password4'),
('Charlie', 'Davis', 'charlie@example.com', 'password5'),
('David', 'Wilson', 'david@example.com', 'password6'),
('Eve', 'Miller', 'eve@example.com', 'password7'),
('Frank', 'Moore', 'frank@example.com', 'password8'),
('Grace', 'Taylor', 'grace@example.com', 'password9'),
('Hank', 'Anderson', 'hank@example.com', 'password10');

-- Create the matches table if it doesn't exist
CREATE TABLE IF NOT EXISTS matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team1 VARCHAR(50),
    team2 VARCHAR(50),
    date DATE,
    time TIME,
    status ENUM('Upcoming', 'Ongoing', 'Finished'),
    score VARCHAR(20)
);

-- Insert test matches
INSERT INTO matches (team1, team2, date, time, status, score) VALUES
('Team A', 'Team B', '2024-07-05', '15:00:00', 'Upcoming', NULL),
('Team C', 'Team D', '2024-07-06', '18:00:00', 'Ongoing', '1-0'),
('Team E', 'Team F', '2024-07-07', '12:00:00', 'Upcoming', NULL),
('Team G', 'Team H', '2024-07-08', '16:00:00', 'Upcoming', NULL),
('Team I', 'Team J', '2024-07-09', '14:00:00', 'Upcoming', NULL),
('Team K', 'Team L', '2024-07-10', '17:00:00', 'Upcoming', NULL),
('Team M', 'Team N', '2024-07-11', '13:00:00', 'Upcoming', NULL),
('Team O', 'Team P', '2024-07-12', '15:00:00', 'Upcoming', NULL),
('Team Q', 'Team R', '2024-07-13', '11:00:00', 'Upcoming', NULL),
('Team S', 'Team T', '2024-07-14', '10:00:00', 'Upcoming', NULL),
('Team U', 'Team V', '2024-07-15', '16:00:00', 'Upcoming', NULL),
('Team W', 'Team X', '2024-07-16', '14:00:00', 'Upcoming', NULL),
('Team Y', 'Team Z', '2024-07-17', '18:00:00', 'Upcoming', NULL),
('Team AA', 'Team BB', '2024-07-18', '12:00:00', 'Upcoming', NULL),
('Team CC', 'Team DD', '2024-07-19', '15:00:00', 'Upcoming', NULL),
('Team EE', 'Team FF', '2024-07-20', '13:00:00', 'Upcoming', NULL),
('Team GG', 'Team HH', '2024-07-21', '17:00:00', 'Upcoming', NULL),
('Team II', 'Team JJ', '2024-07-22', '14:00:00', 'Upcoming', NULL),
('Team KK', 'Team LL', '2024-07-23', '12:00:00', 'Upcoming', NULL),
('Team MM', 'Team NN', '2024-07-24', '16:00:00', 'Upcoming', NULL),
('Team OO', 'Team PP', '2024-07-25', '13:00:00', 'Upcoming', NULL),
('Team QQ', 'Team RR', '2024-07-26', '17:00:00', 'Upcoming', NULL),
('Team SS', 'Team TT', '2024-07-27', '14:00:00', 'Upcoming', NULL);

-- Create the bets table if it doesn't exist
CREATE TABLE IF NOT EXISTS bets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    match_id INT,
    amount DECIMAL(10, 2),
    team VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (match_id) REFERENCES matches(id) ON DELETE CASCADE
);

-- Insert test bets
INSERT INTO bets (user_id, match_id, amount, team) VALUES
(1, 1, 50.00, 'Team A'),
(1, 2, 30.00, 'Team D'),
(2, 1, 20.00, 'Team B'),
(2, 3, 40.00, 'Team E'),
(3, 4, 60.00, 'Team G'),
(3, 5, 70.00, 'Team I'),
(4, 6, 10.00, 'Team K'),
(4, 7, 15.00, 'Team M'),
(5, 8, 25.00, 'Team O'),
(5, 9, 35.00, 'Team Q'),
(6, 10, 45.00, 'Team S'),
(6, 11, 55.00, 'Team U'),
(7, 12, 65.00, 'Team W'),
(7, 13, 75.00, 'Team Y'),
(8, 14, 85.00, 'Team AA'),
(8, 15, 95.00, 'Team CC'),
(9, 16, 105.00, 'Team EE'),
(9, 17, 115.00, 'Team GG'),
(10, 18, 125.00, 'Team II'),
(10, 19, 135.00, 'Team KK');

-- Add weather column to matches table
ALTER TABLE matches ADD weather VARCHAR(255);

-- Create the players table
CREATE TABLE players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_id INT,
    team VARCHAR(255),
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    FOREIGN KEY (match_id) REFERENCES matches(id)
);

-- Create the team_odds table
CREATE TABLE team_odds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_id INT,
    team VARCHAR(255),
    odds DECIMAL(5, 2),
    FOREIGN KEY (match_id) REFERENCES matches(id)
);

-- Create the comments table
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    match_id INT,
    commentator VARCHAR(255),
    comment TEXT,
    score VARCHAR(50),
    FOREIGN KEY (match_id) REFERENCES matches(id)
);

-- Insert players data
INSERT INTO players (match_id, team, first_name, last_name) VALUES
-- Match 1 - Team A
(1, 'Team A', 'John', 'Doe'),
(1, 'Team A', 'James', 'Smith'),
(1, 'Team A', 'David', 'Johnson'),
-- Match 1 - Team B
(1, 'Team B', 'Robert', 'Brown'),
(1, 'Team B', 'Michael', 'Davis'),
(1, 'Team B', 'James', 'Miller');

-- Insert team odds
INSERT INTO team_odds (match_id, team, odds) VALUES
(1, 'Team A', 1.5),
(1, 'Team B', 2.5);

-- Insert comments
INSERT INTO comments (match_id, commentator, comment, score) VALUES
(1, 'Commentator A', 'A close match so far.', '0-0'),
(1, 'Commentator B', 'Team A is dominating the field.', '1-0');

-- Update weather for matches
UPDATE matches SET weather = 'Sunny' WHERE id = 1;
UPDATE matches SET weather = 'Rainy' WHERE id = 2;
UPDATE matches SET weather = 'Cloudy' WHERE id = 3;
