#Create the database (if it has not already been created) and use it
CREATE DATABASE IF NOT EXISTS db_web_app;
USE db_web_app;

#Create a table to store the app user information provided
CREATE TABLE IF NOT EXISTS tbl_app_users (
user_id			INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
first_name		VARCHAR(25) NOT NULL,
last_name		VARCHAR(25) NOT NULL,
email_addr		VARCHAR(50),
user_location	VARCHAR(50),
skill_set		VARCHAR(100)
);