CREATE DATABASE IF NOT EXISTS proyecto_laravel_insta;
USE proyecto_laravel_insta;
CREATE TABLE IF NOT EXISTS users(
    id INT(255) NOT NULL AUTO_INCREMENT,
    ´ role ´ VARCHAR(20) NOT NULL,
    ´ name ´ VARCHAR(100) NOT NULL,
    surname VARCHAR(200),
    nick VARCHAR(100),
    email VARCHAR(255) NOT NULL,
    ´ password ´ VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    remember_token VARCHAR(255),
    CONSTRAINT pk_users PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
) ENGINE = InnoDb;
INSERT INTO USERS
VALUES(
        NULL,
        'user',
        'Alejandro',
        'Muñoz',
        'Alexsfc',
        'ale@mail.com',
        12345,
        NULL,
        CURTIME(),
        CURTIME(),
        NULL
    );
INSERT INTO USERS
VALUES(
        NULL,
        'user',
        'Mario',
        'Díaz',
        'marioD',
        'mario@mail.com',
        12345,
        NULL,
        CURTIME(),
        CURTIME(),
        NULL
    );
INSERT INTO USERS
VALUES(
        NULL,
        'user',
        'Gladis',
        'Loaeza',
        'Gladis',
        'gladis@mail.com',
        12345,
        NULL,
        CURTIME(),
        CURTIME(),
        NULL
    );
CREATE TABLE IF NOT EXISTS images(
    id INT(255) NOT NULL AUTO_INCREMENT,
    user_id INT(255) NOT NULL,
    image_path VARCHAR(255),
    description TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_images PRIMARY KEY(id),
    CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDb;
INSERT INTO IMAGES
VALUES(
        NULL,
        1,
        'test.jpg',
        'prueba',
        CURTIME(),
        CURTIME()
    );
INSERT INTO IMAGES
VALUES(
        NULL,
        1,
        'test2.jpg',
        'prueba2',
        CURTIME(),
        CURTIME()
    );
INSERT INTO IMAGES
VALUES(
        NULL,
        1,
        'test3.jpg',
        'prueba3',
        CURTIME(),
        CURTIME()
    );
INSERT INTO IMAGES
VALUES(
        NULL,
        1,
        'test4.jpg',
        'prueba4',
        CURTIME(),
        CURTIME()
    );
INSERT INTO IMAGES
VALUES(
        NULL,
        3,
        'test5.jpg',
        'prueba5',
        CURTIME(),
        CURTIME()
    );
CREATE TABLE IF NOT EXISTS comments(
    id INT(255) NOT NULL AUTO_INCREMENT,
    user_id INT(255) NOT NULL,
    image_id INT(255) NOT NULL,
    content TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
) ENGINE = InnoDb;
INSERT INTO COMMENTS
VALUES(NULL, 1, 4, 'Holi', CURTIME(), CURTIME());
INSERT INTO COMMENTS
VALUES(NULL, 2, 1, 'Holi X2', CURTIME(), CURTIME());
INSERT INTO COMMENTS
VALUES(NULL, 2, 4, 'Holi X3', CURTIME(), CURTIME());
CREATE TABLE IF NOT EXISTS likes(
    id INT(255) NOT NULL AUTO_INCREMENT,
    user_id INT(255) NOT NULL,
    image_id INT(255) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_likes PRIMARY KEY(id),
    CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
) ENGINE = InnoDb;
INSERT INTO LIKES
VALUES(NULL, 1, 5, CURTIME(), CURTIME());
INSERT INTO LIKES
VALUES(NULL, 1, 4, CURTIME(), CURTIME());
INSERT INTO LIKES
VALUES(NULL, 3, 2, CURTIME(), CURTIME());
INSERT INTO LIKES
VALUES(NULL, 2, 2, CURTIME(), CURTIME());
