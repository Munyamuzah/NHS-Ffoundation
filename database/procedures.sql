-- Create Database
CREATE DATABASE nhs;
GO

USE nhs;
GO

-- Table creation



CREATE TABLE patients (
  patient_id INT NOT NULL PRIMARY KEY IDENTITY(1,1),
  patient_fname VARCHAR(250) NOT NULL,
  patient_sname VARCHAR(250) NOT NULL,
  patient_dob DATE NOT NULL,
  patient_age INT NOT NULL,
  patient_score int NOT NULL,
  patient_submission_date DATE NOT NULL
);

CREATE TABLE questions (
  q_id INT NOT NULL PRIMARY KEY IDENTITY(1,1),
  q_details TEXT NOT NULL,
  q_highest_mark INT NOT NULL
);
INSERT INTO questions (q_details, q_highest_mark) VALUES 
('How much relief have pain treatments or medications FROM THIS CLINIC provided?', 100),
('Please rate your pain based on the number that best describes your pain at it’s WORST in the past week.', 10),
('Please rate your pain based on the number that best describes your pain at it’s LEAST in the past week.?', 10),
('Please rate your pain based on the number that best describes your pain on the Average.', 10),
('Please rate your pain based on the number that best describes your pain that tells how much pain you have RIGHT NOW.',10),
('Based on the number that best describes how during the past week pain has INTERFERED with your: General Activity.', 10),
('Based on the number that best describes how during the past week pain has INTERFERED with your: Mood.', 10),
('Based on the number that best describes how during the past week pain has INTERFERED with your: Walking ability.', 10),
('Based on the number that best describes how during the past week pain has INTERFERED with your: Normal work (includes work both outside the home and housework).', 10),
('Based on the number that best describes how during the past week pain has INTERFERED with your: RelaTonships with other people.', 10),
('Based on the number that best describes how during the past week pain has INTERFERED with your: Sleep.', 10),
('Based on the number that best describes how during the past week pain has INTERFERED with your: Enjoyment of life.', 10);



CREATE TABLE scores (
  s_id INT NOT NULL PRIMARY KEY IDENTITY(1,1),
  s_patient_id INT NOT NULL,
  s_question_id INT NOT NULL,
  s_question_score INT NOT NULL
);
GO



-- Stored Procedures for Patients Table

-- Create
CREATE PROCEDURE sp_CreatePatient
  @patient_fname VARCHAR(250),
  @patient_sname VARCHAR(250),
  @patient_dob DATE,
  @patient_age INT,
  @patient_score INT,
  @patient_submission_date DATE
AS
BEGIN
  INSERT INTO patients (patient_fname, patient_sname, patient_dob, patient_age, patient_score, patient_submission_date )
  VALUES (@patient_fname, @patient_sname, @patient_dob, @patient_age, @patient_score, @patient_submission_date);
END
GO

-- Read
CREATE PROCEDURE sp_GetPatients
AS
BEGIN
  SELECT * FROM patients;
END
GO

-- Update
CREATE PROCEDURE sp_UpdatePatient
  @patient_id INT,
  @patient_fname VARCHAR(250),
  @patient_sname VARCHAR(250),
  @patient_dob DATE,
  @patient_age INT,
  @patient_score INT,
  @patient_submission_date DATE
AS
BEGIN
  UPDATE patients
  SET patient_fname = @patient_fname, patient_sname = @patient_sname, patient_dob = @patient_dob, patient_age = @patient_age, patient_score = @patient_score, patient_submission_date = @patient_submission_date
  WHERE patient_id = @patient_id;
END
GO

-- Delete
CREATE PROCEDURE sp_DeletePatient
  @patient_id INT
AS
BEGIN
  DELETE FROM patients WHERE patient_id = @patient_id;
END
GO

-- Stored Procedures for Questions Table

-- Create
CREATE PROCEDURE sp_CreateQuestion
  @q_details TEXT,
  @q_highest_mark INT
AS
BEGIN
  INSERT INTO questions (q_details, q_highest_mark)
  VALUES (@q_details, @q_highest_mark);
END
GO

-- Read
CREATE PROCEDURE sp_GetQuestions
AS
BEGIN
  SELECT * FROM questions;
END
GO

-- Update
CREATE PROCEDURE sp_UpdateQuestion
  @q_id INT,
  @q_details TEXT,
  @q_highest_mark INT
AS
BEGIN
  UPDATE questions
  SET q_details = @q_details, q_highest_mark = @q_highest_mark
  WHERE q_id = @q_id;
END
GO

-- Delete
CREATE PROCEDURE sp_DeleteQuestion
  @q_id INT
AS
BEGIN
  DELETE FROM questions WHERE q_id = @q_id;
END
GO

-- Stored Procedures for Scores Table

-- Create
CREATE PROCEDURE sp_CreateScore
  @s_patient_id INT,
  @s_question_id INT,
  @s_question_score INT
AS
BEGIN
  INSERT INTO scores (s_patient_id, s_question_id, s_question_score)
  VALUES (@s_patient_id, @s_question_id, @s_question_score);
END
GO

-- Read
CREATE PROCEDURE sp_GetScores
AS
BEGIN
  SELECT * FROM scores;
END
GO

-- Update
CREATE PROCEDURE sp_UpdateScore
  @s_id INT,
  @s_patient_id INT,
  @s_question_id INT,
  @s_question_score INT
AS
BEGIN
  UPDATE scores
  SET s_patient_id = @s_patient_id, s_question_id = @s_question_id, s_question_score = @s_question_score
  WHERE s_id = @s_id;
END
GO

-- Delete
CREATE PROCEDURE sp_DeleteScore
  @s_id INT
AS
BEGIN
  DELETE FROM scores WHERE s_id = @s_id;
END
GO