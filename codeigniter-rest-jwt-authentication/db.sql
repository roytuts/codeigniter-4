CREATE TABLE user (
    id INT unsigned COLLATE utf8mb4_unicode_ci AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(45) COLLATE utf8mb4_unicode_ci NOT NULL,
    password VARCHAR(255) COLLATE utf8mb4_unicode_ci NOT NULL
);

CREATE TABLE `teacher` (
  `id` int unsigned COLLATE utf8mb4_unicode_ci NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expertise` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert  into `teacher`(`id`,`name`,`expertise`)
values (1,'Bibhas Chandra Dhara','Statistics'),
(2,'UKR','System Programming'),(3,'New','Expert');
