/*format of our SQL database */

CREATE TABLE members
(
email VARCHAR(40) NOT NULL PRIMARY KEY,
psswrd VARCHAR(50) NOT NULL,
points INT NOT NULL
);

INSERT INTO members (email, psswrd, points)
VALUES ('gaben@valvesoftware.com', 'gaben', 1337);

UPDATE members
SET email = newEmail, psswrd = newPsswrd, points = newPoints
WHERE email = 'gaben@valvesoftware.com';