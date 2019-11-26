/*
 Navicat Premium Data Transfer

 Source Server         : Vertrigo
 Source Server Type    : MySQL
 Source Server Version : 50721
 Source Host           : localhost:3306
 Source Schema         : gsm

 Target Server Type    : MySQL
 Target Server Version : 50721
 File Encoding         : 65001

 Date: 26/02/2019 16:13:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for caytrong
-- ----------------------------
DROP TABLE IF EXISTS `caytrong`;
CREATE TABLE `caytrong`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `macaytrong` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tenviettatcaytrong` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tencaytrong` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ghichu` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of caytrong
-- ----------------------------
INSERT INTO `caytrong` VALUES (1, NULL, NULL, 'Bắp', NULL);
INSERT INTO `caytrong` VALUES (2, NULL, NULL, 'Bầu', NULL);
INSERT INTO `caytrong` VALUES (3, NULL, NULL, 'Bí đao', NULL);
INSERT INTO `caytrong` VALUES (4, NULL, NULL, 'Bí đỏ', NULL);
INSERT INTO `caytrong` VALUES (5, NULL, NULL, 'Cà chua', NULL);
INSERT INTO `caytrong` VALUES (6, NULL, NULL, 'Cà tím', NULL);
INSERT INTO `caytrong` VALUES (7, NULL, NULL, 'Cải bắp', NULL);
INSERT INTO `caytrong` VALUES (8, NULL, NULL, 'Cải bông', NULL);
INSERT INTO `caytrong` VALUES (9, NULL, NULL, 'Cải củ', NULL);
INSERT INTO `caytrong` VALUES (10, NULL, NULL, 'Đậu bắp', NULL);
INSERT INTO `caytrong` VALUES (11, NULL, NULL, 'Đậu bắp', NULL);
INSERT INTO `caytrong` VALUES (12, NULL, NULL, 'Đậu cove', NULL);
INSERT INTO `caytrong` VALUES (13, NULL, NULL, 'Đậu đũa', NULL);
INSERT INTO `caytrong` VALUES (14, NULL, NULL, 'Đậu xanh', NULL);
INSERT INTO `caytrong` VALUES (15, NULL, NULL, 'Dưa hấu', NULL);
INSERT INTO `caytrong` VALUES (16, NULL, NULL, 'Dưa hấu (không hạt)', NULL);
INSERT INTO `caytrong` VALUES (17, NULL, NULL, 'Dưa lê', NULL);
INSERT INTO `caytrong` VALUES (18, NULL, NULL, 'Dưa leo', NULL);
INSERT INTO `caytrong` VALUES (19, NULL, NULL, 'Khổ qua', NULL);
INSERT INTO `caytrong` VALUES (20, NULL, NULL, 'Lúa', NULL);
INSERT INTO `caytrong` VALUES (21, NULL, NULL, 'Mồng tơi', NULL);
INSERT INTO `caytrong` VALUES (22, NULL, NULL, 'Mướp hương', NULL);
INSERT INTO `caytrong` VALUES (23, NULL, NULL, 'Mướp khía', NULL);
INSERT INTO `caytrong` VALUES (24, NULL, NULL, 'Ớt cay', NULL);
INSERT INTO `caytrong` VALUES (25, NULL, NULL, 'Ớt ngọt', NULL);
INSERT INTO `caytrong` VALUES (26, NULL, NULL, 'Rau muống', NULL);

-- ----------------------------
-- Table structure for chungloai
-- ----------------------------
DROP TABLE IF EXISTS `chungloai`;
CREATE TABLE `chungloai`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `caytrong_id` int(11) NULL DEFAULT NULL,
  `machungloai` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kyhieuchungloai` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tenchungloai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ghichu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2018_08_31_150059_create_vu_san_xuats_table', 1);
INSERT INTO `migrations` VALUES (4, '2018_08_31_150353_create_chung_loais_table', 1);
INSERT INTO `migrations` VALUES (5, '2018_08_31_150434_create_phan_cap_giongs_table', 1);
INSERT INTO `migrations` VALUES (6, '2018_09_09_071653_create_cay_trongs_table', 2);
INSERT INTO `migrations` VALUES (7, '2018_09_09_124312_create_store_imports_table', 3);
INSERT INTO `migrations` VALUES (8, '2018_09_09_132018_create_store_import_details_table', 4);
INSERT INTO `migrations` VALUES (9, '2018_09_10_085944_create_store_exports_table', 5);
INSERT INTO `migrations` VALUES (10, '2018_09_11_050007_create_store_export_details_table', 6);
INSERT INTO `migrations` VALUES (11, '2018_09_27_014452_create_thoi_gian_trong_ras_table', 7);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for phancapgiong
-- ----------------------------
DROP TABLE IF EXISTS `phancapgiong`;
CREATE TABLE `phancapgiong`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maphancapgiong` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kyhieuphancapgiong` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tenphancapgiong` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ghichu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of phancapgiong
-- ----------------------------
INSERT INTO `phancapgiong` VALUES (1, NULL, '01', 'Tổ hợp lai', NULL, '2018-08-31 22:26:27', '2018-08-31 22:26:29');
INSERT INTO `phancapgiong` VALUES (2, NULL, '02', 'Sưu tập/nhập nội', NULL, '2018-08-31 22:26:42', '2018-08-31 22:26:45');
INSERT INTO `phancapgiong` VALUES (3, NULL, '03', 'Dòng đang rút/chọn lọc', NULL, '2018-08-31 22:26:58', '2018-08-31 22:27:01');
INSERT INTO `phancapgiong` VALUES (4, NULL, '04', 'Dòng thuần (tự thụ, cận giao)', NULL, '2018-08-31 22:27:15', '2018-08-31 22:27:17');
INSERT INTO `phancapgiong` VALUES (5, NULL, '05', 'Siêu nguyên chủng', NULL, '2018-08-31 22:27:36', '2018-08-31 22:27:40');
INSERT INTO `phancapgiong` VALUES (6, NULL, '06', 'Xác nhận', NULL, '2018-08-31 22:27:53', '2018-08-31 22:27:55');
INSERT INTO `phancapgiong` VALUES (7, NULL, '07', 'Bố mẹ (của giống lai kinh doanh)', NULL, '2018-08-31 22:28:09', '2018-08-31 22:28:13');

-- ----------------------------
-- Table structure for storeexport
-- ----------------------------
DROP TABLE IF EXISTS `storeexport`;
CREATE TABLE `storeexport`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `maxuatkho` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tendetaithinghiem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `caytrong_id` int(10) UNSIGNED NOT NULL,
  `vusanxuat_id` int(10) UNSIGNED NOT NULL,
  `ngayxuatkho` date NULL DEFAULT NULL,
  `ghichu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `storeexport_caytrong_id_foreign`(`caytrong_id`) USING BTREE,
  INDEX `storeexport_vusanxuat_id_foreign`(`vusanxuat_id`) USING BTREE,
  CONSTRAINT `storeexport_caytrong_id_foreign` FOREIGN KEY (`caytrong_id`) REFERENCES `caytrong` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `storeexport_vusanxuat_id_foreign` FOREIGN KEY (`vusanxuat_id`) REFERENCES `vusanxuat` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for storeexportdetail
-- ----------------------------
DROP TABLE IF EXISTS `storeexportdetail`;
CREATE TABLE `storeexportdetail`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `storeexport_id` int(10) UNSIGNED NOT NULL,
  `storeimportdetail_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `tendonggiong` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `malo` char(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phancapgiong_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `nguongoc` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `luongdenghi` int(10) UNSIGNED NULL DEFAULT NULL,
  `luongthatxuat` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `storeexportdetail_storeexport_id_foreign`(`storeexport_id`) USING BTREE,
  INDEX `storeexportdetail_chungloai_id_foreign`(`tendonggiong`) USING BTREE,
  INDEX `storeexportdetail_phancapgiong_id_foreign`(`phancapgiong_id`) USING BTREE,
  CONSTRAINT `storeexportdetail_phancapgiong_id_foreign` FOREIGN KEY (`phancapgiong_id`) REFERENCES `phancapgiong` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `storeexportdetail_storeexport_id_foreign` FOREIGN KEY (`storeexport_id`) REFERENCES `storeexport` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for storeimport
-- ----------------------------
DROP TABLE IF EXISTS `storeimport`;
CREATE TABLE `storeimport`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `manhapkho` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tendetaithinghiem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `caytrong_id` int(10) UNSIGNED NOT NULL,
  `vusanxuat_id` int(10) UNSIGNED NOT NULL,
  `ngaythuhoach` date NULL DEFAULT NULL,
  `ngaynhapkho` date NULL DEFAULT NULL,
  `ghichu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `trangthai` tinyint(255) NULL DEFAULT 1 COMMENT '1: Ok; 2: Error',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `storeimport_caytrong_id_foreign`(`caytrong_id`) USING BTREE,
  INDEX `storeimport_vusanxuat_id_foreign`(`vusanxuat_id`) USING BTREE,
  CONSTRAINT `storeimport_caytrong_id_foreign` FOREIGN KEY (`caytrong_id`) REFERENCES `caytrong` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `storeimport_vusanxuat_id_foreign` FOREIGN KEY (`vusanxuat_id`) REFERENCES `vusanxuat` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of storeimport
-- ----------------------------
INSERT INTO `storeimport` VALUES (2, 'NK201811092', 'Thí nghiệm 5', 1, 1, NULL, '2018-11-09', NULL, 1, '2018-11-09 06:54:15', '2018-11-09 06:54:15');

-- ----------------------------
-- Table structure for storeimportdetail
-- ----------------------------
DROP TABLE IF EXISTS `storeimportdetail`;
CREATE TABLE `storeimportdetail`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `storeimport_id` int(10) UNSIGNED NOT NULL,
  `tendonggiong` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `malo` char(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phancapgiong_id` int(10) UNSIGNED NOT NULL,
  `nguongoc` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ngaythuhoachthuthap` date NULL DEFAULT NULL,
  `luong` int(10) UNSIGNED NULL DEFAULT NULL,
  `tylenaymam` double(6, 2) NULL DEFAULT NULL,
  `conhang` tinyint(1) NULL DEFAULT 1 COMMENT '0: Hết hàng; 1: Còn hàng;',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `storeimportdetail_storeimport_id_foreign`(`storeimport_id`) USING BTREE,
  INDEX `storeimportdetail_chungloai_id_foreign`(`tendonggiong`) USING BTREE,
  INDEX `storeimportdetail_phancapgiong_id_foreign`(`phancapgiong_id`) USING BTREE,
  CONSTRAINT `storeimportdetail_phancapgiong_id_foreign` FOREIGN KEY (`phancapgiong_id`) REFERENCES `phancapgiong` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `storeimportdetail_storeimport_id_foreign` FOREIGN KEY (`storeimport_id`) REFERENCES `storeimport` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of storeimportdetail
-- ----------------------------
INSERT INTO `storeimportdetail` VALUES (2, 2, 'Bắp trắng', '20180927', 1, 'Nguyên chủng', '2018-11-06', 150, 95.00, 1, '2018-11-09 06:54:15', '2018-11-09 06:54:15');

-- ----------------------------
-- Table structure for thoigiantrongra
-- ----------------------------
DROP TABLE IF EXISTS `thoigiantrongra`;
CREATE TABLE `thoigiantrongra`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `caytrong_id` int(11) NOT NULL,
  `sothang` tinyint(3) UNSIGNED NOT NULL COMMENT 'Thời gian tính bằng tháng',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of thoigiantrongra
-- ----------------------------
INSERT INTO `thoigiantrongra` VALUES (1, 1, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (2, 2, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (3, 3, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (4, 4, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (5, 5, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (6, 6, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (7, 7, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (8, 8, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (9, 9, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (10, 10, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (11, 11, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (12, 12, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (13, 13, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (14, 14, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (15, 15, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (16, 16, 20, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (17, 17, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (18, 18, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (19, 19, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (20, 20, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (21, 21, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (22, 22, 24, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (23, 23, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (24, 24, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (25, 25, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');
INSERT INTO `thoigiantrongra` VALUES (26, 26, 30, '2018-09-29 09:00:00', '2018-09-29 09:00:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Lý Hậu Giang', 'lhgiang@gmail.com', '$2y$10$K0rqZJ9afnjW5u7sYUvXWuHtx.gAVIuFElfeaDB7NnbOhlUkoscCm', '1fhmTRMTvEvNGsART0ddz7EwFEvmchYUxbC2BukomXQsNAeqQkT6W42vefFa', '2018-09-13 09:52:24', '2018-09-13 09:52:24');

-- ----------------------------
-- Table structure for vusanxuat
-- ----------------------------
DROP TABLE IF EXISTS `vusanxuat`;
CREATE TABLE `vusanxuat`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mavusanxuat` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tenvusanxuat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ghichu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vusanxuat
-- ----------------------------
INSERT INTO `vusanxuat` VALUES (1, 'DX', 'Đông - Xuân', NULL, '2018-08-31 22:28:58', '2018-08-31 22:29:01');
INSERT INTO `vusanxuat` VALUES (2, 'XH', 'Xuân - Hè', NULL, '2018-08-31 22:29:16', '2018-08-31 22:29:19');
INSERT INTO `vusanxuat` VALUES (3, 'HT', 'Hè - Thu', NULL, '2018-08-31 22:29:32', '2018-08-31 22:29:35');
INSERT INTO `vusanxuat` VALUES (4, 'TD', 'Thu - Đông', NULL, '2018-08-31 22:30:13', '2018-08-31 22:30:16');

SET FOREIGN_KEY_CHECKS = 1;
