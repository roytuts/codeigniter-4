CREATE TABLE login (
    id INT unsigned COLLATE utf8mb4_unicode_ci AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    password VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    last_login DATETIME COLLATE utf8mb4_unicode_ci DEFAULT CURRENT_TIMESTAMP
);

insert into login(username,password) values ('user','user');