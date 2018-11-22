/*

App usage data are kept in the following table:

TABLE sessions
  id INTEGER PRIMARY KEY,
  userId INTEGER NOT NULL,
  duration DECIMAL NOT NULL
Write a query that selects userId and average session duration for each user who has more than one session.

See the example case for more details.

-- Suggested testing environment: 
-- http://sqlite.online/

-- Example case create statement:
CREATE TABLE sessions (
  id INTEGER NOT NULL PRIMARY KEY,
  userId INTEGER NOT NULL,
  duration DECIMAL NOT NULL
);

INSERT INTO sessions(id, userId, duration) VALUES(1, 1, 10);
INSERT INTO sessions(id, userId, duration) VALUES(2, 2, 18);
INSERT INTO sessions(id, userId, duration) VALUES(3, 1, 14);

-- Expected output:
-- UserId  AverageDuration
-- -----------------------
-- 1       12

*/

SELECT userId as UserId, AVG(duration) as AverageDuration FROM sessions GROUP BY userId HAVING (count(*) > 1);