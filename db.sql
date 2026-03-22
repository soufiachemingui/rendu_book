CREATE DATABASE IF NOT EXISTS slouma;

USE slouma;

CREATE TABLE IF NOT EXISTS category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS book (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    publication_date DATE NOT NULL,
    language VARCHAR(50) NOT NULL,
    status BOOLEAN DEFAULT 1,
    number_of_copies INT DEFAULT 0,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE SET NULL
);

INSERT INTO category (title, description) VALUES 
('Science-Fiction', 'Livres sur la technologie, le futur, et l''espace.'),
('Roman', 'Fictions narratives en prose.'),
('Informatique', 'Livres dedies a la programmation et a l''ingenierie logicielle.');
