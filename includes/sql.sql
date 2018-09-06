CREATE DATABASE kejaport ;

USE kejaport;

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL
);

GRANT ALL PRIVILEGES ON photo_gallery .* TO
'wallacee'@'localhost'
IDENTIFIED BY '2j463YjtEn' ;
