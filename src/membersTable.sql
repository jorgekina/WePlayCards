/*format of our SQL database */

CREATE TABLE members
(
email VARCHAR(40) NOT NULL UNIQUE,
psswrd VARCHAR(50) NOT NULL,
points INT DEFAULT 0
);

INSERT INTO members (email, psswrd, points)
VALUES ('gaben@valvesoftware.com', 'gaben', 1337);

UPDATE members
SET email = 'gab@valve.com', psswrd = 'gabn', points = 13373
WHERE email = 'gaben@valvesoftware.com';