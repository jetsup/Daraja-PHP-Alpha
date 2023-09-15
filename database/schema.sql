DROP DATABASE IF EXISTS jack_daniels;
CREATE DATABASE jack_daniels;
USE jack_daniels;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL UNIQUE,
    password VARCHAR(65) NOT NULL -- store the passwords in hashed form SHA256
);

CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL UNIQUE,
    product_price DECIMAL(10, 2) NOT NULL,
    product_previous_price DECIMAL(10, 2) NOT NULL,
    product_description VARCHAR(255) NOT NULL,
    product_image_url VARCHAR(255) NOT NULL
);

INSERT IGNORE INTO products (product_name, product_price, product_previous_price, product_description, product_image_url) VALUES
('Old No. 7 Tennessee Whiskey', 19.99, 24.99, 'Jack Daniel''s Old No. 7 is a premium Tennessee Whiskey. A warm amber colour with aromas of sweet vanilla, this is a smooth, full-bodied whiskey, with flavours of orange, brown sugar and spice, and a long rich finish.', 'https://www.istockphoto.com/resources/images/FreePhotos/Free-Photo-740x492-1644163462.jpg'),
('Tennessee Honey', 19.99, 24.99, 'Jack Daniel''s Tennessee Honey is a delicious, complex Jack. It delivers the bold character of Jack Daniel''s Tennessee whiskey, with the taste of rich honey and a nutty finish.', 'https://www.everypixel.com/i/free/free-fullHD-pic.png'),
('Tennessee Fire', 19.99, 24.99, 'Jack Daniel''s Tennessee Fire is a delicious, complex Jack. It delivers the bold character of Jack Daniel''s Tennessee whiskey, with the taste of rich honey and a nutty finish.', 'https://blog.snappa.com/wp-content/uploads/2022/02/Gratisography-example-image.jpg'),
('Gentleman Jack', 29.99, 34.99, 'Gentleman Jack is charcoal-mellowed twice, before and after the ageing process, resulting in a cleaner, more refined end product. Packaged in a smart monogram-esque bottle.', 'https://www.stockvault.net/data/2020/01/30/272927/thumb16.jpg'),
('Single Barrel', 39.99, 44.99, 'Jack Daniel''s Single Barrel is a richer variation of JD, with less sweetness and more power than the No.7. A favourite in bars, this is a must for aficionados.', 'https://gratisography.com/wp-content/uploads/2023/06/gratisography-toadstool-free-stock-photo-800x525.jpg');
