CREATE TABLE user (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(200) NOT NULL,
    password VARCHAR(200) NOT NULL,
    image VARCHAR(200),
    bio TEXT,
    token VARCHAR(200)
);

CREATE TABLE category (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE game (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(100) NOT NULL,
    description TEXT,
    image VARCHAR(200),
    trailer VARCHAR(150),
    category_id INT(11) UNSIGNED,
    user_id INT(11) UNSIGNED,
    
    FOREIGN KEY(category_id) REFERENCES category(id),
    FOREIGN KEY(user_id) REFERENCES user(id)
);

CREATE TABLE review (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    rating INT NOT NULL,
    review TEXT,
    user_id INT(11) UNSIGNED,
    game_id INT(11) UNSIGNED,
    
    FOREIGN KEY(user_id) REFERENCES user(id),
    FOREIGN KEY(game_id) REFERENCES game(id)
);