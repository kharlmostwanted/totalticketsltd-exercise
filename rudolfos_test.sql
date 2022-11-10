/*
 Navicat Premium Data Transfer

 Source Server         : LARAGON
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : rudolfos_test

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 10/11/2022 19:49:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `body` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `parent_id` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comments
-- ----------------------------
INSERT INTO `comments` VALUES (15, 25, 12, 'comment ', NULL, '2022-11-10 18:43:42', NULL);
INSERT INTO `comments` VALUES (16, 26, 12, 'comment 2', NULL, '2022-11-10 18:44:17', NULL);
INSERT INTO `comments` VALUES (17, 26, 12, 'another comment', NULL, '2022-11-10 18:48:21', NULL);
INSERT INTO `comments` VALUES (18, 26, 13, 'first comment', NULL, '2022-11-10 18:49:18', NULL);
INSERT INTO `comments` VALUES (19, 26, 12, 'comment 3', NULL, '2022-11-10 18:49:33', NULL);
INSERT INTO `comments` VALUES (20, 27, 12, 'test', NULL, '2022-11-10 18:50:39', NULL);
INSERT INTO `comments` VALUES (21, 27, 14, 'test comment', NULL, '2022-11-10 18:54:54', NULL);
INSERT INTO `comments` VALUES (22, 27, 15, 'comment', NULL, '2022-11-10 18:55:23', NULL);
INSERT INTO `comments` VALUES (23, 28, 15, 'hi im commenting', NULL, '2022-11-10 18:55:37', NULL);
INSERT INTO `comments` VALUES (24, 28, 15, '', NULL, '2022-11-10 18:55:45', NULL);
INSERT INTO `comments` VALUES (25, 28, 15, '', NULL, '2022-11-10 18:55:48', NULL);
INSERT INTO `comments` VALUES (26, 28, 15, 'will not be ignored', NULL, '2022-11-10 18:59:36', NULL);
INSERT INTO `comments` VALUES (27, 30, 17, 'this is a new comment', NULL, '2022-11-10 19:09:27', NULL);
INSERT INTO `comments` VALUES (28, 34, 18, 'new comment', NULL, '2022-11-10 19:42:10', NULL);
INSERT INTO `comments` VALUES (29, 34, 20, 'new comment on new blog post', NULL, '2022-11-10 19:42:35', NULL);
INSERT INTO `comments` VALUES (30, 34, 21, 'Totam quas est conse', NULL, '2022-11-10 19:43:10', NULL);
INSERT INTO `comments` VALUES (31, 34, 22, 'Tempore cillum expl', NULL, '2022-11-10 19:43:16', NULL);
INSERT INTO `comments` VALUES (32, 34, 23, 'Irure et recusandae', NULL, '2022-11-10 19:43:26', NULL);
INSERT INTO `comments` VALUES (33, 35, 23, 'jixewugu@mailinator.com', NULL, '2022-11-10 19:46:54', NULL);

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `creator_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `body` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `parent_id` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES (15, 27, 'another blog post', 'Dicta dolor reiciend', NULL, '2022-11-10 18:55:14', NULL);
INSERT INTO `posts` VALUES (16, 29, 'test', 'Delectus suscipit q', NULL, '2022-11-10 19:01:39', '2022-11-10 19:02:13');
INSERT INTO `posts` VALUES (17, 30, 'i EDITEd this blog post', 'Saepe explicabo Ver', NULL, '2022-11-10 19:08:12', '2022-11-10 19:09:10');
INSERT INTO `posts` VALUES (18, 31, 'new post', 'with 1 on author name', NULL, '2022-11-10 19:21:17', NULL);
INSERT INTO `posts` VALUES (21, 34, 'Quasi labore est vol', 'In cum sed est ex v', NULL, '2022-11-10 19:42:57', NULL);
INSERT INTO `posts` VALUES (22, 34, 'Velit enim omnis exp', 'Sed ea dolore labori', NULL, '2022-11-10 19:43:02', NULL);
INSERT INTO `posts` VALUES (23, 34, 'Recusandae Laborum', 'Quas veritatis ipsam', NULL, '2022-11-10 19:43:20', NULL);
INSERT INTO `posts` VALUES (24, 35, 'Laboriosam voluptas', 'Adipisci eligendi si', NULL, '2022-11-10 19:46:36', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (20, 'Camden Burton', 'jylamocom@mailinator.com', NULL);
INSERT INTO `users` VALUES (21, 'Donovan Herring', 'vafohyp@mailinator.com', NULL);
INSERT INTO `users` VALUES (22, 'Keegan Hansen', 'rudaqepe@mailinator.com', '$2y$10$/T3NAToKMcZ5WdR0v48eNu9BjyKOzM13ZYWhlmE66rH3UT5PpIrjm');
INSERT INTO `users` VALUES (23, 'Mechelle Greer', 'kyzitol@mailinator.com', '$2y$10$iL1hJmqLuO3Rm/HSYvnMTeheXQiLPb.hi669ND0/aof7pB2vxtmcS');
INSERT INTO `users` VALUES (24, 'Hayfa Decker', 'fafyq@mailinator.com', '$2y$10$2/L4aVxmpBdNE31nonuYKOzjq/r/w7QD/pTFOXGIHQHLiaac21SNm');
INSERT INTO `users` VALUES (25, 'Rudyard Palmer', 'fyva@mailinator.com', '$2y$10$fl9wk04Lr3OXOc/qqi0O9esLy0QkVFF1BFhf9x0cu.glIzBY6zmte');
INSERT INTO `users` VALUES (26, 'Stacy Wise', 'lyvypyt@mailinator.com', '$2y$10$yTB5u0TlenQmHHz7d05qcey9cEgc5L4U3pvBWhLEMB4K5ffl.pTlC');
INSERT INTO `users` VALUES (27, 'Fredericka Meyers', 'user1@mail.com', '$2y$10$Q5etvr9qy404A.Zdnxq1POLkNdvGqQdldFa3WGGcvMHFlEIImoSx6');
INSERT INTO `users` VALUES (28, 'Brady Brennan', 'havah@mailinator.com', '$2y$10$XxW/yNfnuMY1unX4Q5reK.5lYgN2qbxMGGtyrAO2XpYWp2y5tjW2u');
INSERT INTO `users` VALUES (29, 'Lara Tucker', 'babugefy@mailinator.com', '$2y$10$KKoc2bt8croJhS1XtLJOs.gFVhvro23IEd1.E.dJIXHzHdwBiJ676');
INSERT INTO `users` VALUES (30, 'Judith Dean', 'cohorexucu@mailinator.com', '$2y$10$pFreUsBBG6VMn9coYn5cJ.exB1CFvloIYMskpsdt2JAQl4u91TZcK');
INSERT INTO `users` VALUES (31, 'Hadassah Brooks2', 'jekali@test', '$2y$10$HWSNajkgQ2Dmh.C0n5rbGeSpyxTeBI1kPuZsGj0YvZe53FBZsx6/a');
INSERT INTO `users` VALUES (32, 'Sophia Winters', 'hulagu@mailinator.com', '$2y$10$ixwMf.s01DqEJgmxE7yZ3.ucSF7mW31y0oFJHut6Pnmhe35BBXtfi');
INSERT INTO `users` VALUES (33, 'John Reid 1', 'bipozofy@mailinator.com', '$2y$10$tW23Ey3kMGOs3EgKl5QJfu40Cj0c8FPFS/ZZYTG.F2AXBJJVwhvLG');
INSERT INTO `users` VALUES (34, 'Miriam Patel1', 'powa@mailinator.com', '$2y$10$qr44HDcRzMZ.D4Ehwq5kR.ws.3L8JoqrT8LBXA9VGx0lsmg6Cl28S');
INSERT INTO `users` VALUES (35, 'Ulysses Sloan1', 'jixewugu@mailinator.com', '$2y$10$z2ubUYEUIfJaUj2HgYTcMe00RJmBaMVvkxb33JNojKX6JqhBuXAB.');

SET FOREIGN_KEY_CHECKS = 1;
