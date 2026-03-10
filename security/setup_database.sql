DROP DATABASE IF EXISTS security_lesson_db;
CREATE DATABASE security_lesson_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE security_lesson_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, password) VALUES ('admin', 'admin123');
INSERT INTO users (username, password) VALUES ('user1', 'password123');
INSERT INTO users (username, password) VALUES ('victim', 'victim123');

INSERT INTO posts (username, content) VALUES ('admin', 'ようこそ！ここは安全な掲示板ではありません。');
INSERT INTO posts (username, content) VALUES ('user1', 'こんにちは。');
