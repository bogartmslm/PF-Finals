CREATE DATABASE IF NOT EXISTS `jellskie`;

USE `jellskie`;

CREATE TABLE IF NOT EXISTS `users`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `profile` VARCHAR(300) NOT NULL,
    `description` VARCHAR(300) NOT NULL,
    `password` VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS `sellers`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `profile` VARCHAR(300) NOT NULL,
    `description` VARCHAR(300) NOT NULL,
    `password` VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS `product`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `seller_id` INT NOT NULL,
    `product_name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    `price` INT NOT NULL,
    `image` VARCHAR(300) NOT NULL,
    `category` VARCHAR(300) NOT NULL
);


CREATE TABLE IF NOT EXISTS `wishlist`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `product_id` INT NOT NULL
);



CREATE TABLE IF NOT EXISTS `user_notifications`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `seller_id` INT NOT NULL,
    `notif` VARCHAR(300) NOT NULL
);



CREATE TABLE IF NOT EXISTS `user_messages`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `seller_id` INT NOT NULL,
    `message` INT NOT NULL
);

CREATE TABLE IF NOT EXISTS `seller_messages`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `seller_id` INT NOT NULL,
    `user_id` INT NOT NULL,
    `message` INT NOT NULL
);


INSERT INTO users(username, email, profile, description, password)
VALUES
('a', 'a@email1', 'images/magnifying-glass.png', 'adada', 'a'),
('b', 'b@email1', 'images/magnifying-glass.png', 'adada', 'b'),
('c', 'c@email1', 'images/magnifying-glass.png', 'adada', 'c'),
('d', 'd@email1', 'images/magnifying-glass.png', 'adada', 'd');



INSERT INTO sellers(username, email, profile, description, password)
VALUES
('s', 's@email1', 'images/magnifying-glass.png', 'adada', 's'),
('b', 'b@email1', 'images/magnifying-glass.png', 'adada', 'b'),
('c', 'c@email1', 'images/magnifying-glass.png', 'adada', 'c'),
('d', 'd@email1', 'images/magnifying-glass.png', 'adada', 'd');





ALTER TABLE `product` ADD FOREIGN KEY (`seller_id`) REFERENCES `sellers`(`id`);

ALTER TABLE `wishlist` ADD FOREIGN KEY (`product_id`) REFERENCES `product`(`id`);
ALTER TABLE `wishlist` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);


ALTER TABLE `user_notifications` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `user_notifications` ADD FOREIGN KEY (`seller_id`) REFERENCES `sellers`(`id`);


ALTER TABLE `seller_messages` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `seller_messages` ADD FOREIGN KEY (`seller_id`) REFERENCES `sellers`(`id`);

ALTER TABLE `user_messages` ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);
ALTER TABLE `user_messages` ADD FOREIGN KEY (`seller_id`) REFERENCES `sellers`(`id`);

