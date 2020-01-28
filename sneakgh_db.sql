/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 100411
 Source Host           : localhost:3306
 Source Schema         : sneakgh_db

 Target Server Type    : MySQL
 Target Server Version : 100411
 File Encoding         : 65001

 Date: 28/01/2020 09:27:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(19) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `amount` int(5) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (1, 'Cap', 'assets/images/products/big/1.jpg', 20);
INSERT INTO `products` VALUES (2, 'Puma Watch', 'assets/images/products/big/2.jpg', 30);
INSERT INTO `products` VALUES (3, 'Shades', 'assets/images/products/big/3.jpg', 10);
INSERT INTO `products` VALUES (4, 'Calvin Klein Shoe', 'assets/images/products/big/4.jpg', 80);
INSERT INTO `products` VALUES (5, 'Back Pack', 'assets/images/products/big/5.jpg', 15);
INSERT INTO `products` VALUES (6, 'Adidas Vintage', 'assets/images/products/big/6.jpg', 40);
INSERT INTO `products` VALUES (7, 'Zara Bag', 'assets/images/products/big/7.jpg', 70);
INSERT INTO `products` VALUES (8, 'Lacoste SidePack', 'assets/images/products/big/8.jpg', 26);

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `invoice_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int(3) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `amount` int(10) NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT NULL,
  `product_id` int(19) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES (14, 'olNZSbrX7gEim30IY6Ddzf8vh', 4, '2020-01-28 06:05:58', 20, 1, 1);
INSERT INTO `transactions` VALUES (15, 'FJjqB5DIs36zVLdwcMikC1xhO', 4, '2020-01-28 06:06:09', 20, 1, 1);
INSERT INTO `transactions` VALUES (16, 'LkwnoIYd0GMlyqK2VsfaJHpZF', 4, '2020-01-28 06:09:04', 30, -1, 2);
INSERT INTO `transactions` VALUES (17, 'wTAP5ME0nGCKigXpz9oYmkQFR', 4, '2020-01-28 09:15:33', 20, -1, 1);

-- ----------------------------
-- Table structure for user_cat
-- ----------------------------
DROP TABLE IF EXISTS `user_cat`;
CREATE TABLE `user_cat`  (
  `cat_id` int(19) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_on` datetime(0) NULL DEFAULT NULL,
  `created_by` int(19) NULL DEFAULT NULL,
  PRIMARY KEY (`cat_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_cat
-- ----------------------------
INSERT INTO `user_cat` VALUES (1, 'Administrator', 'He is the owner of the app', 'Active', '2019-05-21 18:54:19', 1);
INSERT INTO `user_cat` VALUES (2, 'User', 'Student', 'Active', '2019-05-21 18:55:03', 1);

-- ----------------------------
-- Table structure for user_cat_links
-- ----------------------------
DROP TABLE IF EXISTS `user_cat_links`;
CREATE TABLE `user_cat_links`  (
  `id` int(19) NOT NULL AUTO_INCREMENT,
  `link_id` int(19) NOT NULL,
  `cat_id` int(19) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_cat_links
-- ----------------------------
INSERT INTO `user_cat_links` VALUES (13, 7, 2);
INSERT INTO `user_cat_links` VALUES (14, 8, 2);
INSERT INTO `user_cat_links` VALUES (15, 9, 2);
INSERT INTO `user_cat_links` VALUES (16, 10, 1);
INSERT INTO `user_cat_links` VALUES (17, 7, 1);
INSERT INTO `user_cat_links` VALUES (18, 11, 1);
INSERT INTO `user_cat_links` VALUES (19, 12, 1);
INSERT INTO `user_cat_links` VALUES (20, 13, 2);
INSERT INTO `user_cat_links` VALUES (21, 14, 2);
INSERT INTO `user_cat_links` VALUES (22, 15, 2);

-- ----------------------------
-- Table structure for user_links
-- ----------------------------
DROP TABLE IF EXISTS `user_links`;
CREATE TABLE `user_links`  (
  `link_id` int(19) NOT NULL AUTO_INCREMENT,
  `link_url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `link_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `link_image` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link_parent` int(19) NULL DEFAULT NULL,
  `page_id` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `page_id_sub` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`link_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_links
-- ----------------------------
INSERT INTO `user_links` VALUES (7, '../transactions', 'Transactions', 'Active', 'ti-credit-card', 0, 'transactions', NULL);
INSERT INTO `user_links` VALUES (9, '../transactions?curpage=my_transactions', 'My Transactions', 'Active', 'ti-plus', 7, 'transactions', NULL);
INSERT INTO `user_links` VALUES (10, '../applications?curpage=list_all_deposits', 'List Deposits', 'Active', 'ti-plus', 7, 'transactions', NULL);
INSERT INTO `user_links` VALUES (13, '../products?curpage=list_products', 'Products', 'Active', 'ti-package', 0, 'products', NULL);
INSERT INTO `user_links` VALUES (14, '../products?curpage=list_products', 'List Products', 'Active', 'ti-plus', 13, 'products', NULL);
INSERT INTO `user_links` VALUES (15, '../transactions?curpage=my_account', 'My Account', 'Active', 'ti-plus', 7, 'accounts', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(19) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dob` date NULL DEFAULT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `user_cat` int(1) NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `serial_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `created_by` int(19) NULL DEFAULT NULL,
  `updated_at` datetime(0) NOT NULL,
  `updated_by` int(19) NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (4, 'tom', 'doe', '2020-01-15', 'dansoman', 2, 'tomdoe@gmail.com', '5e2cdb487b', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2020-01-26 00:20:24', 500, '0000-00-00 00:00:00', 0, '0244151506');
INSERT INTO `users` VALUES (5, 'John ', 'Doe', '2020-01-08', 'Tesano', 1, 'admin@gmail.com', '5e2da6ce85', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2020-01-26 14:48:46', 500, '0000-00-00 00:00:00', 0, '0244151506');

SET FOREIGN_KEY_CHECKS = 1;
