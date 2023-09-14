CREATE DATABASE jack_daniels;
USE jack_daniels;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL UNIQUE,
    password VARCHAR(65) NOT NULL -- store the passwords in hashed form SHA256
);

