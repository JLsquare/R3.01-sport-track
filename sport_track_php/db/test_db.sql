/*
SportTrack - Test de table
Mellion Jean-Loup
INFO1B2
*/


-- Enable the foreign keys
PRAGMA foreign_keys=on;


-- Testing Users table
-- Valid insert
INSERT INTO Users(email, password, firstName, lastName, birthdate, gender, height, weight)
VALUES ('jeanloup.mellion@proton.me', 'password123', 'Jean-Loup', 'Mellion', '2004-07-12', 'male', 1.70, 55);

-- Invalid inserts
-- Invalid email format
INSERT INTO Users(email, password, firstName, lastName, birthdate, gender, height, weight)
VALUES ('jl', 'password123', 'Jean-Loup', 'Mellion', '2004-07-12', 'male', 1.70, 70.5);

-- Invalid password length
INSERT INTO Users(email, password, firstName, lastName, birthdate, gender, height, weight)
VALUES ('jeanloup.mellion@proton.me', 'pass', 'Jean-Loup', 'Mellion', '2004-07-12', 'male', 1.70, 55);

-- Invalid firstName length
INSERT INTO Users(email, password, firstName, lastName, birthdate, gender, height, weight)
VALUES ('jeanloup.mellion@proton.me', 'password123', '', 'Mellion', '2004-07-12', 'male', 1.70, 55);

-- Invalid lastName length
INSERT INTO Users(email, password, firstName, lastName, birthdate, gender, height, weight)
VALUES ('jeanloup.mellion@proton.me', 'password123', 'Jean-Loup', '', '2004-07-12', 'male', 1.70, 55);

-- Invalid gender
INSERT INTO Users(email, password, firstName, lastName, birthdate, gender, height, weight)
VALUES ('jeanloup.mellion@proton.me', 'password123', 'Jean-Loup', 'Mellion', '2004-07-12', 'Alien', 1.70, 55);

-- Invalid height
INSERT INTO Users(email, password, firstName, lastName, birthdate, gender, height, weight)
VALUES ('jeanloup.mellion@proton.me', 'password123', 'Jean-Loup', 'Mellion', '2004-07-12', 'male', -1, 55);

-- Invalid weight
INSERT INTO Users(email, password, firstName, lastName, birthdate, gender, height, weight)
VALUES ('jeanloup.mellion@proton.me', 'password123', 'Jean-Loup', 'Mellion', '2004-07-12', 'male', 1.70, -1);


-- Testing Activities table
-- Valid insert
INSERT INTO Activities(userEmail, activityDate, startTime, endTime, duration, description, distance, cardioFrequencyMin, cardioFrequencyMax, cardioFrequencyAverage)
VALUES ('jeanloup.mellion@proton.me', '2022-09-01', '08:00:00', '09:00:00', 1.0, 'IUT -> RU', 5.0, 60, 80, 70);

-- Invalid inserts
-- Invalid description length
INSERT INTO Activities(userEmail, activityDate, startTime, endTime, duration, description, distance, cardioFrequencyMin, cardioFrequencyMax, cardioFrequencyAverage)
VALUES ('jeanloup.mellion@proton.me', '2022-09-01', '08:00:00', '09:00:00', 1.0, '', 5.0, 60, 80, 70);

-- Invalid distance
INSERT INTO Activities(userEmail, activityDate, startTime, endTime, duration, description, distance, cardioFrequencyMin, cardioFrequencyMax, cardioFrequencyAverage)
VALUES ('jeanloup.mellion@proton.me', '2022-09-01', '08:00:00', '09:00:00', 1.0, 'IUT -> RU', -1, 60, 80, 70);

-- User does not exist
INSERT INTO Activities(userEmail, activityDate, startTime, endTime, duration, description, distance, cardioFrequencyMin, cardioFrequencyMax, cardioFrequencyAverage)
VALUES ('', '2022-09-01', '08:00:00', '09:00:00', 1.0, 'IUT -> RU', 5.0, 60, 80, 70);


-- Testing ActivityEntry table
-- Valid insert
INSERT INTO Data(activityId, dataTime, cardioFrequency, latitude, longitude, altitude)
VALUES (1, '08:00:00', 70, 40.7128, -74.0060, 10.0);

-- Invalid inserts
-- Invalid cardioFrequency
INSERT INTO Data(activityId, dataTime, cardioFrequency, latitude, longitude, altitude)
VALUES (1, '13:00:00', 0, 40.7128, -74.0060, 10.0);

-- Invalid latitude
INSERT INTO Data(activityId, dataTime, cardioFrequency, latitude, longitude, altitude)
VALUES (1, '13:00:00', 70, 100, -74.0060, 10.0);

-- Invalid longitude
INSERT INTO Data(activityId, dataTime, cardioFrequency, latitude, longitude, altitude)
VALUES (1, '13:00:00', 70, 40.7128, -200, 10.0);

-- Activity does not exist
INSERT INTO Data(activityId, dataTime, cardioFrequency, latitude, longitude, altitude)
VALUES (2, '13:00:00', 70, 40.7128, -74.0060, 10.0);


-- Deleting all content from tables
DELETE FROM Data;
DELETE FROM Activities;
DELETE FROM Users;
