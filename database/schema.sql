DROP DATABASE IF EXISTS jack_daniels;
CREATE DATABASE jack_daniels;
USE jack_daniels;

CREATE TABLE IF NOT EXISTS user_details(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_first_name VARCHAR(50) NOT NULL,
    user_last_name VARCHAR(50) NOT NULL,
    user_email VARCHAR(60) NOT NULL UNIQUE,
    user_phone VARCHAR(20) NOT NULL UNIQUE,
    user_state VARCHAR(50) NOT NULL,
    user_county VARCHAR(20) NOT NULL,
    user_town VARCHAR(50) NOT NULL
);

INSERT IGNORE INTO user_details (user_first_name, user_last_name, user_email, user_phone, user_state, user_county, user_town) VALUES
('John', 'Doe', 'john.doe@email.com', '1234567890', 'State', 'County', 'Town');

CREATE TABLE users (
    user_log_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL UNIQUE,
    user_log_password VARCHAR(65) NOT NULL, -- store the passwords in hashed form SHA256
    user_id INT NOT NULL,
    user_log_role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    
FOREIGN KEY(user_id) REFERENCES user_details(user_id)
);

INSERT IGNORE INTO users (username, user_log_password, user_id) VALUES
('admin', 'admin', 1);

UPDATE users SET user_role = 'admin' WHERE username = 'admin';

-- Genaral overview of the product
CREATE TABLE IF NOT EXISTS products (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL UNIQUE,
    product_price DECIMAL(10, 2) NOT NULL,
    product_previous_price DECIMAL(10, 2) NOT NULL,
    product_discount DECIMAL(3, 2) DEFAULT 0,
    product_description VARCHAR(255) NOT NULL,
    product_image_url VARCHAR(255) NOT NULL
);

INSERT IGNORE INTO products (product_name, product_price, product_previous_price, product_description, product_image_url) VALUES
('Old No. 7 Tennessee Whiskey', 19.99, 24.99, 'Jack Daniel''s Old No. 7 is a premium Tennessee Whiskey. A warm amber colour with aromas of sweet vanilla, this is a smooth, full-bodied whiskey, with flavours of orange, brown sugar and spice, and a long rich finish.', 'https://www.istockphoto.com/resources/images/FreePhotos/Free-Photo-740x492-1644163462.jpg'),
('Tennessee Honey', 19.99, 24.99, 'Jack Daniel''s Tennessee Honey is a delicious, complex Jack. It delivers the bold character of Jack Daniel''s Tennessee whiskey, with the taste of rich honey and a nutty finish.', 'https://www.everypixel.com/i/free/free-fullHD-pic.png'),
('Tennessee Fire', 19.99, 24.99, 'Jack Daniel''s Tennessee Fire is a delicious, complex Jack. It delivers the bold character of Jack Daniel''s Tennessee whiskey, with the taste of rich honey and a nutty finish.', 'https://blog.snappa.com/wp-content/uploads/2022/02/Gratisography-example-image.jpg'),
('Gentleman Jack', 29.99, 34.99, 'Gentleman Jack is charcoal-mellowed twice, before and after the ageing process, resulting in a cleaner, more refined end product. Packaged in a smart monogram-esque bottle.', 'https://www.stockvault.net/data/2020/01/30/272927/thumb16.jpg'),
('Single Barrel', 39.99, 44.99, 'Jack Daniel''s Single Barrel is a richer variation of JD, with less sweetness and more power than the No.7. A favourite in bars, this is a must for aficionados.', 'https://gratisography.com/wp-content/uploads/2023/06/gratisography-toadstool-free-stock-photo-800x525.jpg');

-- Hold the alternative images of the same product for setails
CREATE TABLE IF NOT EXISTS product_images (
    product_image_id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    product_image_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- Hold the cart items by specific user
CREATE TABLE IF NOT EXISTS cart_items (
    cart_item_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_details(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- Table to handle user orders and the location of their deliveries
CREATE TABLE IF NOT EXISTS orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    order_quantity INT NOT NULL,
    order_total DECIMAL(10, 2) NOT NULL,
    order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_details(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

-- Table for the wishlist
CREATE TABLE IF NOT EXISTS wishlist (
    wishlist_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_details(user_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);