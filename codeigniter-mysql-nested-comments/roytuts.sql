CREATE TABLE `blog` (
  `blog_id` int unsigned NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `blog` VALUES (1,'test blog','test-blog','The topic of blogging seems to come up a lot in our social media training workshops. The benefits of a quality blog are obvious - fresh content is good for your readers and your rankings. Blogs are easy to set up and even easier to update. We often tell people that if they can use Microsoft Word? they can update a blog.rnrn                        As easy as they are to set up, they can be difficult to maintain. A good blog is filled with relevant, timely content that is updated on a regular basis. New bloggers often start out with a bang but then fizzle out when they realize that creating content can be challenging.'),(2,'another blog','another-blog','content');

CREATE TABLE `blog_comment` (
  `comment_id` int unsigned NOT NULL AUTO_INCREMENT,
  `comment_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` int unsigned NOT NULL,
  `blog_id` int unsigned NOT NULL,
  PRIMARY KEY (`comment_id`,`blog_id`),
  KEY `fk_blog_comment_blog1_idx` (`blog_id`),
  CONSTRAINT `fk_blog_comment_blog1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `blog_comment` VALUES (17,'First Level Comment','2021-09-14 22:54:10',0,1),(19,'Second Level Comment','2021-09-14 23:08:04',17,1),(20,'Third Level Comment','2021-09-14 23:12:15',19,1),(21,'First Level Second Comment','2021-09-14 23:12:57',0,1),(22,'Second Level Second Comment','2021-09-14 23:13:31',21,1);
