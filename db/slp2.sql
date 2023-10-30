/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : slp2

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 06/09/2021 17:57:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for comment_logs
-- ----------------------------
DROP TABLE IF EXISTS `comment_logs`;
CREATE TABLE `comment_logs`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NULL DEFAULT NULL,
  `is_comment` bit(1) NULL DEFAULT b'0' COMMENT 'true => comment đc , false => là ko comment',
  `comment_id` int(11) NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for comments
-- ----------------------------
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `keywwords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_date` datetime(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for items
-- ----------------------------
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items`  (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `type` int(3) NOT NULL COMMENT 'fanpage,group,profile',
  `created_post_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'current_timestamp()',
  `content` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `craw_date` datetime(0) NULL DEFAULT NULL,
  `from` bigint(200) NOT NULL,
  `updated_date` datetime(0) NOT NULL DEFAULT current_timestamp(),
  `total_share` int(10) NOT NULL DEFAULT 0,
  `total_like` int(10) NOT NULL DEFAULT 0,
  `total_comment` int(10) NOT NULL DEFAULT 0,
  `count_comment` int(20) NOT NULL DEFAULT 0 COMMENT 'data comment',
  `author` bigint(20) NOT NULL DEFAULT 0,
  `count_like_share` int(11) NULL DEFAULT NULL COMMENT 'data like share',
  `image_url` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `from_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `image_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `key_craw` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `status` int(2) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `post_owner_id` bigint(20) NULL DEFAULT NULL,
  `keywords_check` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keyword_in` int(3) NULL DEFAULT NULL COMMENT '1 in Post Content ; 2 in Post Comment ; 3 in Both',
  `keyword_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `count_d` int(20) NULL DEFAULT NULL,
  `count` int(20) NULL DEFAULT NULL,
  `social_item_id` bigint(20) NULL DEFAULT NULL,
  `for_qualified_ihz` bit(1) NULL DEFAULT b'0',
  `channel_type` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `post_id`(`post_id`) USING BTREE,
  INDEX `update_date`(`updated_date`) USING BTREE,
  INDEX `craw_date`(`craw_date`) USING BTREE,
  INDEX `for_qualified_ihz`(`for_qualified_ihz`) USING BTREE,
  FULLTEXT INDEX `keywords`(`keywords`),
  FULLTEXT INDEX `keyword_comments`(`keyword_comments`),
  INDEX `post_owner_id`(`post_owner_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of items
-- ----------------------------
INSERT INTO `items` VALUES (1, 3081054748784324, 1, '16 tháng 6 lúc 20:00', 'Tin được không? \r\n PROPZY có “BÁN NHÀ MANG VỀ”, mà lại còn “FREESHIP”…\r\n️\r\n Đúng rồi đấy, bạn không nghe nhầm đâu. Ai nói chỉ có quần áo, đồ ăn,... mới có thể “Freeship” nào. Đến với PROPZY, bạn sẽ được trải nghiệm dịch vụ “Bán Nhà Mang Về”. Nhờ vào nền tảng công nghệ hiện đại kết hợp cùng dịch vụ môi giới BĐS 5 \r\n chuyên nghiệp, PROPZY sẽ “ship” toàn bộ thông tin BĐS \r\n mà bạn đang quan tâm đến tận nơi và đặc biệt là hoàn toàn MIỄN PHÍ:\r\n Hình ảnh chân thực, đầy đủ và mô tả “sản phẩm\" THẬT 100%, đi kèm là tính năng xem nhà 3D, có thể ngắm nghía 360 độ, tất cả có trên trang https://propzy.vn/, xua tan nỗi lo “hàng pha-ke” tràn lan trên mạng.\r\n Câu hỏi thắc mắc được nhân viên tư vấn tận tình qua tổng đài *4663, hoặc website: https://propzy.vn/ hoặc tin nhắn Fanpage PROPZY.\r\n Giấy tờ hành chính trong quá trình giao dịch được chuyên gia PROPZY \"đóng gói\" đầy đủ, giúp bạn hoàn thành giao dịch mà không cần ra khỏi nhà nhiều lần.\r\n Còn chờ gì mà không liên hệ ngay, PROPZY sẽ mang căn nhà mơ ước đến tận tay bạn!\r\n#Propzy #BanNhaMangVe\r\n#Dichvubatdongsan5* #NentangbatdongsanTHAT #thatnhupropzy #antoanthattaipropzy #dichvumoigioichokhachthuemuanha\r\n-----------------------------------\r\n Dù khách hàng đang ở bất cứ nơi đâu, hãy liên hệ ngay với PROPZY -  Nền tảng Bất động sản THẬT để trải nghiệm “Mua Nhà Mang Về” bằng một trong ba cách sau:\r\n Truy cập website: https://propzy.vn/\r\n Gọi ngay hotline: *4663 (hoặc)\r\n Đến Trung tâm Giao dịch PROPZY gần nhất để được tư vấn miễn phí về BĐS: https://propzy.vn/diem-giao-dich', '2021-06-20 06:56:51', 0, '2021-06-20 11:56:20', 0, 15, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'bán nhà', 10, NULL, 1647261242163689, 'bán căn hộ,bán nhà,bán đất,bán chung cư,bán căn hộ, bán căn 2pn, bán đất,cho thuê,thuê chung cư,thuê căn hộ,cắt lỗ,đất thổ cư,full nội thất, bán nhanh,chính chủ,cần bán,Eco Green,Sky 89,The Signature,Happy Valley,River Panorama,Riviera Point,Sunshine,La C', 1, '', NULL, NULL, NULL, b'0', 0);
INSERT INTO `items` VALUES (2, 3080305558859243, 1, '15 tháng 6 lúc 18:12', '“BÁN NHÀ MANG VỀ” là gì vậy nhỉ? \r\nHãy cùng theo dõi Fanpage PROPZY để tìm ra câu trả lời nhé.\r\n#Propzy #BanNhaMangVe\r\n#Dichvubatdongsan5* #NentangbatdongsanTHAT #thatnhupropzy #antoanthattaipropzy #dichvumoigioichokhachthuemuanha\r\n-----------------------------------\r\n Dù khách hàng đang ở bất cứ nơi đâu, hãy liên hệ ngay với PROPZY -  Nền tảng Bất động sản THẬT để trải nghiệm “Mua Nhà Mang Về” bằng một trong ba cách sau:\r\n Truy cập website: https://propzy.vn/\r\n Gọi ngay hotline: *4663 (hoặc)\r\n Đến Trung tâm Giao dịch PROPZY gần nhất để được tư vấn miễn phí về BĐS: https://propzy.vn/diem-giao-dich', '2021-06-20 06:56:52', 0, '2021-06-20 11:56:20', 3, 32, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, 'bán nhà', 10, NULL, 1647261242163689, 'bán căn hộ,bán nhà,bán đất,bán chung cư,bán căn hộ, bán căn 2pn, bán đất,cho thuê,thuê chung cư,thuê căn hộ,cắt lỗ,đất thổ cư,full nội thất, bán nhanh,chính chủ,cần bán,Eco Green,Sky 89,The Signature,Happy Valley,River Panorama,Riviera Point,Sunshine,La C', 1, '', NULL, NULL, NULL, b'0', 0);
INSERT INTO `items` VALUES (3, 3079529668936832, 1, '14 tháng 6 lúc 17:23', 'NHÀ MÀ CŨNG “BÁN MANG VỀ” ĐƯỢC SAO? \r\n \r\n  Lần đầu tiên trên thị trường môi giới Bất Động Sản xuất hiện mô hình mới: “BÁN NHÀ MANG VỀ”. PROPZY tự hào là thương hiệu tiên phong trong việc xây dựng và áp dụng mô hình này nhờ kết hợp giữa công nghệ tiên tiến và dịch vụ chuẩn 5 Sao, giúp khách hàng yên tâm giao dịch và tiết kiệm thời gian hơn:\r\n Thoải mái lựa chọn căn nhà ưng ý nhất tại “kho nhà MINH BẠCH” đang có trên Website https://propzy.vn/. Toàn bộ thông tin đều được XÁC THỰC về pháp lý, hình ảnh, thông tin khu vực, thông số nhà, cụ thể như cách bạn lựa chọn mua sắm các sản phẩm trực tuyến khác.\r\n Đội ngũ tư vấn viên của PROPZY luôn túc trực để hỗ trợ và giải đáp MIỄN PHÍ mọi thắc mắc cho khách hàng về vấn đề định giá, quy hoạch, tư vấn vay thế chấp thông qua hotline *4663 (Dấu sao-4-6-6-3), giúp khách hàng chủ động trong việc tìm hiểu mà không cần đi đâu xa*.\r\n PROPZY tự hào là đơn vị tiên phong trong lĩnh vực Proptech cung cấp tính năng XEM NHÀ 3D (áp dụng cho căn hộ chung cư). Với tính năng độc đáo này, người dùng có thể khảo sát thực tế từng ngõ ngách ngay trên ứng dụng PROPZY, giúp tiết kiệm tối đa thời gian và công sức trước khi quyết định đi xem nhà trực tiếp.\r\n Khi đã hoàn toàn hài lòng với BĐS mà mình lựa chọn, quý Khách hàng sẽ được đội ngũ chuyên gia tư vấn của PROPZY HỖ TRỢ TOÀN DIỆN về giấy tờ và thủ tục hành chính, như công chứng, đăng bộ, sang tên cho đến khi hoàn thành giao dịch. Hay nói cách khác, khách hàng có thể yên tâm ủy quyền cho PROPZY và nhận “nhà mang về”, phần còn lại cứ để PROPZY lo. \r\n Dù khách hàng đang ở bất cứ nơi đâu, hãy liên hệ ngay với PROPZY -  Nền tảng Bất động sản THẬT để trải nghiệm “mua nhà mang về” bằng một trong ba cách sau:\r\n Truy cập website: https://propzy.vn/\r\n Gọi ngay hotline: *4663\r\n Đến Trung tâm Giao dịch PROPZY gần nhất để được tư vấn miễn phí về BĐS: https://propzy.vn/diem-giao-dich\r\n*Cước điện thoại khi gọi đến hotline để được tư vấn sẽ tính theo giá cước mạng.\r\n#Propzy #BanNhaMangVe\r\n#Dichvubatdongsan5* #NentangbatdongsanTHAT #thatnhupropzy #antoanthattaipropzy #dichvumoigioichokhachthuemuanha', '2021-06-20 06:57:09', 0, '2021-06-20 11:56:20', 2, 15, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'bán nhà', 10, NULL, 1647261242163689, 'bán căn hộ,bán nhà,bán đất,bán chung cư,bán căn hộ, bán căn 2pn, bán đất,cho thuê,thuê chung cư,thuê căn hộ,cắt lỗ,đất thổ cư,full nội thất, bán nhanh,chính chủ,cần bán,Eco Green,Sky 89,The Signature,Happy Valley,River Panorama,Riviera Point,Sunshine,La C', 1, '', NULL, NULL, NULL, b'1', 0);
INSERT INTO `items` VALUES (4, 3071771323046000, 1, '7 tháng 6 lúc 08:01', ' \"Giá căn hộ cho thuê đang giảm mạnh\" \r\nCụ thể, giá cho thuê chung cư giảm 5%, còn giá cho thuê nhà riêng giảm 6% từ sau Tết đến nay. Các chuyên gia nhận định, dịch bệnh COVID-19 đang tác động rất lớn đến hoạt động cho thuê bất động sản (BĐS) từ văn phòng, căn hộ, trung tâm thương mại cho đến cửa hàng kinh doanh... trên địa bàn TP.HCM.\r\n Liên hệ Chuyên viên tư vấn BĐS của Propzy để biết giá thuê căn hộ từng quận huyện HCM theo nhu cầu của bạn!\r\n#Propzy #nentangbatdongsanthat #giathuecanho #canhohcm\r\n___________________________________\r\n Propzy - Nền tảng Bất động sản THẬT\r\n https://propzy.vn/\r\n *4663\r\n Hệ thống Trung Tâm Giao Dịch tại TP HCM - Tư vấn miễn phí pháp lý - quy hoạch - định giá BĐS của bạn: https://propzy.vn/diem-giao-dich', '2021-06-20 06:57:13', 0, '2021-06-20 11:56:20', 3, 48, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'cho thuê,thuê chung cư,thuê căn hộ', 10, NULL, 1647261242163689, 'bán căn hộ,bán nhà,bán đất,bán chung cư,bán căn hộ, bán căn 2pn, bán đất,cho thuê,thuê chung cư,thuê căn hộ,cắt lỗ,đất thổ cư,full nội thất, bán nhanh,chính chủ,cần bán,Eco Green,Sky 89,The Signature,Happy Valley,River Panorama,Riviera Point,Sunshine,La C', 1, '', NULL, NULL, NULL, b'1', 0);

-- ----------------------------
-- Table structure for keywords
-- ----------------------------
DROP TABLE IF EXISTS `keywords`;
CREATE TABLE `keywords`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_date` datetime(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `status` int(2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of keywords
-- ----------------------------
INSERT INTO `keywords` VALUES (1, 'dân cư Phú Mỹ,Riverpark1,Phú Mỹ Hưng,The Cities & Gardens,Sổ đỏ,VAY MUA NHÀ,Ngân hàng,căn hộ mini,The River Thủ Thiêm,mua nhà,Biệt thự,The Matrix One,mua chung cư,Bất Động Sản,Gem Sky World,full nội thất,thành công,Khách VIP,lướt sóng,MARINA,SUNSHINE,căn hộ cho thuê,cắt lỗ,đất thổ cư', '2021-04-11 22:54:29', NULL, '2021-05-21 11:21:14', NULL, 10);

-- ----------------------------
-- Table structure for social_items
-- ----------------------------
DROP TABLE IF EXISTS `social_items`;
CREATE TABLE `social_items`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `social_id` bigint(20) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT NULL,
  `status` int(2) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `type` int(2) NULL DEFAULT NULL,
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  `channel_type` tinyint(1) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `socaial_id`(`social_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of social_items
-- ----------------------------
INSERT INTO `social_items` VALUES (40, 413093669043121, 'Phi Hổ PMH - batdongsandaiphat.vn', NULL, 'images/posts/60a7c5ed3b9aa_1621607917.jpg', '2021-05-21 11:16:41', 10, NULL, 1, NULL, '2021-05-21 14:38:37', 0);
INSERT INTO `social_items` VALUES (41, 131258820281372, 'Batdongsan.com.vn', NULL, 'images/posts/60a7c68e46bae_1621608078.png', '2021-05-21 11:17:00', 10, NULL, 1, NULL, '2021-05-21 14:41:18', 0);
INSERT INTO `social_items` VALUES (42, 1647261242163689, 'Propzy', NULL, 'images/posts/60a7c6b261116_1621608114.png', '2021-05-21 11:17:19', 10, NULL, 1, NULL, '2021-05-21 14:41:54', 0);
INSERT INTO `social_items` VALUES (43, 1718937841687621, 'Rever', NULL, 'images/posts/60a7c70eda8e6_1621608206.png', '2021-05-21 11:17:36', 10, NULL, 1, NULL, '2021-05-21 14:43:26', 0);
INSERT INTO `social_items` VALUES (44, 300829936671250, 'Chợ Tốt', NULL, 'images/posts/60a7c727d372e_1621608231.png', '2021-05-21 11:17:59', 10, NULL, 1, NULL, '2021-05-21 14:43:51', 0);
INSERT INTO `social_items` VALUES (45, 702198935, 'Huỳnh Như Nguyễn', NULL, 'images/posts/60a7c745dbb7f_1621608261.jpg', '2021-05-21 11:18:20', 10, NULL, 3, NULL, '2021-05-21 14:44:21', 0);
INSERT INTO `social_items` VALUES (46, 100007397705419, 'Lê Trung Lâm', NULL, 'images/posts/60a7c767e5c93_1621608295.png', '2021-05-21 11:18:40', 10, NULL, 3, NULL, '2021-05-21 14:44:55', 0);
INSERT INTO `social_items` VALUES (47, 100013185210987, 'Nguyễn Nga', NULL, 'images/posts/60a7c79e03107_1621608350.jpg', '2021-05-21 11:19:00', 10, NULL, 3, NULL, '2021-05-21 14:45:50', 0);
INSERT INTO `social_items` VALUES (48, 100006495645979, 'Que Nguyen', NULL, 'images/posts/60a7c80e78f99_1621608462.jpg', '2021-05-21 11:19:19', 10, NULL, 3, NULL, '2021-05-21 14:47:42', 0);
INSERT INTO `social_items` VALUES (49, 697913860839803, 'Cộng đồng BẤT ĐỘNG SẢN', NULL, 'images/posts/60a7c835a483d_1621608501.jpg', '2021-05-21 11:19:46', 10, NULL, 2, NULL, '2021-05-21 14:48:21', 0);
INSERT INTO `social_items` VALUES (50, 2458568224213476, 'REVIEW BẤT ĐỘNG SẢN', NULL, 'images/posts/60a7c850394e7_1621608528.jpg', '2021-05-21 11:20:05', 10, NULL, 2, NULL, '2021-05-21 14:48:48', 0);
INSERT INTO `social_items` VALUES (51, 1860848357524586, 'Hội cần mua Bất Động Sản: căn hộ chung cư, nhà phố, đất nền', NULL, 'images/posts/60a7c87216bd9_1621608562.jpg', '2021-05-21 11:20:26', 10, NULL, 2, NULL, '2021-05-21 14:49:22', 0);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `expire_date` datetime(0) NULL DEFAULT NULL,
  `status` smallint(2) NOT NULL,
  `auth_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  `deleted_by` int(11) NULL DEFAULT NULL,
  `deleted_date` datetime(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin@mail.com', 'Administrator', '$2y$10$mNBomqe3.RF93MinM/fZTeTZNxMIVFRj5NuCsDHWTz.xS8zv4Zgxi', NULL, 10, NULL, NULL, '2020-11-19 16:05:34', NULL, NULL, NULL, NULL, 1, '/assets/images/no_avatar.png', NULL);
INSERT INTO `users` VALUES (2, 'dohungmy@gmail.com', 'dohungmy', '$2y$10$RsS0FXaEu7dEMj/f7unzJO9M2p0Gdb4iLkGWff/m/CiCKS64uHwTW', NULL, 10, NULL, NULL, '2020-11-23 16:44:40', '2021-01-17 12:13:26', NULL, NULL, NULL, 2, '/assets/images/no_avatar.png', '0934115315');
INSERT INTO `users` VALUES (5, 'luongbang@gmail.com', 'Bang nguyen', '$2y$10$8uasNji44P8c5bUmpqX/qOk0X8YWhM35cK25bWbpU7CchCzukF0p2', NULL, 10, NULL, NULL, '2020-11-30 03:19:19', NULL, NULL, NULL, NULL, 1, '/assets/images/no_avatar.png', '0908204962');
INSERT INTO `users` VALUES (6, 'admin@esssssmail.com', 'abc', '$2y$10$yckH/jabB.uOn4KOLE6J3.azlZHTVFuvcpeyu92pf2Q0DFFvTMsQu', NULL, 10, NULL, NULL, '2021-01-17 13:00:36', NULL, NULL, NULL, NULL, 2, '/assets/images/no_avatar.png', '');

-- ----------------------------
-- Table structure for v_3071771323046000
-- ----------------------------
DROP TABLE IF EXISTS `v_3071771323046000`;
CREATE TABLE `v_3071771323046000`  (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `is_share` int(10) NOT NULL DEFAULT 0,
  `is_like` int(10) NOT NULL DEFAULT 0,
  `is_comment` int(10) NOT NULL DEFAULT 0,
  `content_comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for v_3079529668936832
-- ----------------------------
DROP TABLE IF EXISTS `v_3079529668936832`;
CREATE TABLE `v_3079529668936832`  (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `is_share` int(10) NOT NULL DEFAULT 0,
  `is_like` int(10) NOT NULL DEFAULT 0,
  `is_comment` int(10) NOT NULL DEFAULT 0,
  `content_comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for v_3080305558859243
-- ----------------------------
DROP TABLE IF EXISTS `v_3080305558859243`;
CREATE TABLE `v_3080305558859243`  (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `is_share` int(10) NOT NULL DEFAULT 0,
  `is_like` int(10) NOT NULL DEFAULT 0,
  `is_comment` int(10) NOT NULL DEFAULT 0,
  `content_comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for v_3081054748784324
-- ----------------------------
DROP TABLE IF EXISTS `v_3081054748784324`;
CREATE TABLE `v_3081054748784324`  (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `is_share` int(10) NOT NULL DEFAULT 0,
  `is_like` int(10) NOT NULL DEFAULT 0,
  `is_comment` int(10) NOT NULL DEFAULT 0,
  `content_comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for xpath
-- ----------------------------
DROP TABLE IF EXISTS `xpath`;
CREATE TABLE `xpath`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `xpath` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `type_tool` int(4) NULL DEFAULT NULL,
  `type` int(4) NULL DEFAULT NULL,
  `created_date` datetime(0) NULL DEFAULT NULL,
  `updated_date` datetime(0) NULL DEFAULT NULL,
  `created_by` int(11) NULL DEFAULT NULL,
  `updated_by` int(11) NULL DEFAULT NULL,
  `status` int(3) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of xpath
-- ----------------------------
INSERT INTO `xpath` VALUES (2, '{\r\n  \"postIdAttribute\": \"\",\r\n  \"postUserIdAttribute\": \"\",\r\n  \"postDateAttribute\": \"\",\r\n  \"postCommentRootIdAttribute\": \"\",\r\n  \"postCommentRootUserIdAttribure\": \"\",\r\n  \"postCommentRootDateAttribute\": \"\",\r\n  \"postCommentReplyIdAttribute\": \"\",\r\n  \"postCommentReplyUserIdAttribute\": \"\",\r\n  \"postCommentReplyDateAttribute\": \"\",\r\n  \"postReactionUserIdAttribute\": \"\",\r\n  \"xPathPostListString\": \"//div[@data-pagelet=\'ProfileTimeline\']//div[@role=\'article\' and not(@tabindex)]\",\r\n  \"xPathPostUserInfoString\": \"./div/div/div/div/div/div[2]/div/div[2]\",\r\n  \"xPathPostDateInfoString\": \"./div//div//span/span/a[@role=\'link\']//*[contains(text(),\'năm\') or contains(text(),\'tháng\') or contains(text(),\'tuần\') or contains(text(),\'ngày\') or contains(text(),\'giờ\') or contains(text(),\'phút\') or contains(text(),\'giây\') or contains(text(),\'lúc\') or contains(text(),\'hôm qua\') or contains(text(),\'year\') or contains(text(),\'month\') or contains(text(),\'week\') or contains(text(),\'day\') or contains(text(),\'hour\') or contains(text(),\'hr\') or contains(text(),\'min\') or contains(text(),\'sec\') or contains(text(),\'yesterday\')]/ancestor::a[@role=\'link\']\",\r\n  \"xPathPostContentInfoString\": \"./div//div[@dir=\'auto\']/div[@data-ad-preview=\'message\']\",\r\n  \"xPathViewMoreContentString\": \"./div//div[@dir=\'auto\']/div[contains(text(),\'Xem thêm\') or contains(text(),\'View more\')]\",\r\n  \"xPathPostString\": \"./div/div/div/div/div/div[2]/div/div[4]\",\r\n  \"xPathViewMoreCommentString\": \"./div/div/div[2]/ul/following::div[1]/div[1]/div[@role=\'button\']/span/span\",\r\n  \"xPathPostReactionInfoString\": \"\",\r\n  \"xPathPostReactionCountInfoString\": \"./div/div/div[1]/div/div[1]/div/div[1]/div/span/div[@role=\'button\']/span[1]\",\r\n  \"xPathPostCommentCountInfoString\": \"./div//div[@role=\'button\']/span[contains(text(),\'bình luận\') or contains(text(),\'comment\') or contains(text(),\'comments\')]\",\r\n  \"xPathPostShareCountInfoString\": \"./div//div[@role=\'button\']/span[contains(text(),\'chia sẻ\') or contains(text(),\'share\') or contains(text(),\'shares\')]\",\r\n  \"xPathPostCommentListInfoString\": \"./div/div/div[2]/ul/li\",\r\n  \"xPathPostCommentRootIdString\": \"\",\r\n  \"xPathPostCommentRootUserInfoString\": \"./div[1]/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[1]/a\",\r\n  \"xPathPostCommentRootContentString\": \"./div[1]/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[2]/span\",\r\n  \"xPathPostCommentRootContentImgString\": \"\",\r\n  \"xPathPostCommentRootDateString\": \"./div[1]/div[@role=\'article\']//ul/li/a[@role=\'link\']//*[contains(text(),\'năm\') or contains(text(),\'tháng\') or contains(text(),\'tuần\') or contains(text(),\'ngày\') or contains(text(),\'giờ\') or contains(text(),\'phút\') or contains(text(),\'giây\') or contains(text(),\'lúc\') or contains(text(),\'hôm qua\') or contains(text(),\'year\') or contains(text(),\'month\') or contains(text(),\'week\') or contains(text(),\'day\') or contains(text(),\'hour\') or contains(text(),\'hr\') or contains(text(),\'min\') or contains(text(),\'sec\') or contains(text(),\'yesterday\')]/ancestor::a[@role=\'link\']\",\r\n  \"xPathPostCommentReplyListString\": \"./div[2]/ul/li\",\r\n  \"xPathPostCommentReplyIdString\": \"\",\r\n  \"xPathPostCommentReplyUserInfoString\": \"./div[1]/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[1]/a\",\r\n  \"xPathPostCommentReplyContentString\": \"./div[1]/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[2]/span\",\r\n  \"xPathPostCommentReplyContentImgString\": \"\",\r\n  \"xPathPostCommentReplyDateString\": \"./div[1]/div[@role=\'article\']/div[2]/ul/li/a[@role=\'link\']\",\r\n  \"xPathGroupOfItemsUserReactedString\": \"\",\r\n  \"xPathListOfItemsUsersReactedString\": \"\",\r\n  \"xPathReactionItemListInfoString\": \"\",\r\n  \"xPathReactionTextInfoString\": \"\",\r\n  \"xPathGroupOfItemsUserSharedString\": \"\",\r\n  \"xPathListOfItemsUsersSharedString\": \"\",\r\n  \"xPathSharingItemListInfoString\": \"\",\r\n  \"xPathSharingTextInfoString\": \"\",\r\n  \"xPathChromeExecMoveoverAllPostIdLinkString\": \"//div[@data-pagelet=\'ProfileTimeline\']/div/div/div/div/div/div[@role=\'article\']//a//b[contains(text(),\'tháng\') or contains(text(),\'ngày\') or contains(text(),\'giờ\') or contains(text(),\'phút\') or contains(text(),\'giây\') or contains(text(),\'lúc\')]//ancestor::a\",\r\n  \"isChromeExecuteMoveoverAllPostIdLinkJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreContentString\": \"var resultContent = document.evaluate(\\\"//div[@data-pagelet=\'ProfileTimeline\']/div/div/div/div/div/div[@role=\'article\']//div[@dir=\'auto\']/div[@data-ad-preview=\'message\']//div[@dir=\'auto\']/div[@role=\'button\']\\\", document, null, XPathResult.ANY_TYPE, null);var node, nodes = [];while (node = resultContent.iterateNext()) nodes.push(node);for(var i=0;i&lt;nodes.length;i++) nodes[i].click();\",\r\n  \"isExecuteOAVMCJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreCommentAndReplyString\": \"var resultCommentReply = document.evaluate(\\\"//div[@data-pagelet=\'ProfileTimeline\']/div/div/div/div/div/div[@role=\'article\']//div[@role=\'button\']/span/span[contains(text(),\'Xem thêm bình luận\') or contains(text(),\'View more comments\') or contains(text(),\'phản hồi\') or contains(text(),\'replies\') or contains(text(),\'reply\')]\\\", document, null, XPathResult.ANY_TYPE, null);var node, nodes = [];while (node = resultCommentReply.iterateNext()) nodes.push(node);for(var i=0;i&lt;nodes.length;i++) nodes[i].click();\",\r\n  \"isExecuteOAVMCARJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreReplyString\": \"\",\r\n  \"isExecuteOAVMReplyJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreCommentString\": \"\",\r\n  \"isExecuteOAVMCommentJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreReactionString\": \"\",\r\n  \"isExecuteOAVMReactionJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreSharingString\": \"\",\r\n  \"isExecuteOAVMSharingJavascript\": \"false\"\r\n}', 1, 2, '2021-05-16 08:16:58', '2021-05-20 13:37:21', NULL, NULL, 10);
INSERT INTO `xpath` VALUES (3, '{\r\n  \"postIdAttribute\": \"\",\r\n  \"postUserIdAttribute\": \"\",\r\n  \"postDateAttribute\": \"\",\r\n  \"postCommentRootIdAttribute\": \"\",\r\n  \"postCommentRootUserIdAttribure\": \"\",\r\n  \"postCommentRootDateAttribute\": \"\",\r\n  \"postCommentReplyIdAttribute\": \"\",\r\n  \"postCommentReplyUserIdAttribute\": \"\",\r\n  \"postCommentReplyDateAttribute\": \"\",\r\n  \"postReactionUserIdAttribute\": \"\",\r\n  \"xPathPostListString\": \"//div[@role=\'main\']//div[@role=\'main\']//div[@role=\'article\' and not(@tabindex)]\",\r\n  \"xPathPostUserInfoString\": \"./div/div/div/div/div/div[2]/div/div[2]\",\r\n  \"xPathPostDateInfoString\": \"./div//div//span/span/a[@role=\'link\']//*[contains(text(),\'năm\') or contains(text(),\'tháng\') or contains(text(),\'tuần\') or contains(text(),\'ngày\') or contains(text(),\'giờ\') or contains(text(),\'phút\') or contains(text(),\'giây\') or contains(text(),\'lúc\') or contains(text(),\'hôm qua\') or contains(text(),\'year\') or contains(text(),\'month\') or contains(text(),\'week\') or contains(text(),\'day\') or contains(text(),\'hour\') or contains(text(),\'hr\') or contains(text(),\'min\') or contains(text(),\'sec\') or contains(text(),\'yesterday\')]/ancestor::a[@role=\'link\']\",\r\n  \"xPathPostContentInfoString\": \"./div//div[@dir=\'auto\']/div[@data-ad-preview=\'message\']\",\r\n  \"xPathViewMoreContentString\": \"./div//div[@dir=\'auto\']/div[contains(text(),\'Xem thêm\') or contains(text(),\'View more\')]\",\r\n  \"xPathPostString\": \"./div/div/div/div/div/div[2]/div/div[4]\",\r\n  \"xPathViewMoreCommentString\": \"./div/div/div[2]/ul/following::div[1]/div[1]/div[@role=\'button\']/span/span\",\r\n  \"xPathPostReactionInfoString\": \"\",\r\n  \"xPathPostReactionCountInfoString\": \"./div/div/div[1]/div/div[1]/div/div[1]/div/span/div[@role=\'button\']/span[1]\",\r\n  \"xPathPostCommentCountInfoString\": \"./div//div[@role=\'button\']/span[contains(text(),\'bình luận\') or contains(text(),\'comment\') or contains(text(),\'comments\')]\",\r\n  \"xPathPostShareCountInfoString\": \"./div//div[@role=\'button\']/span[contains(text(),\'chia sẻ\') or contains(text(),\'share\') or contains(text(),\'shares\')]\",\r\n  \"xPathPostCommentListInfoString\": \"./div/div/div[2]/ul/li\",\r\n  \"xPathPostCommentRootIdString\": \"\",\r\n  \"xPathPostCommentRootUserInfoString\": \"./div[1]/div/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[1]/a\",\r\n  \"xPathPostCommentRootContentString\": \"./div[1]/div/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[2]/span\",\r\n  \"xPathPostCommentRootContentImgString\": \"\",\r\n  \"xPathPostCommentRootDateString\": \"./div[1]/div/div[@role=\'article\']/div[2]/ul/li/a[@role=\'link\']//*[contains(text(),\'năm\') or contains(text(),\'tháng\') or contains(text(),\'tuần\') or contains(text(),\'ngày\') or contains(text(),\'giờ\') or contains(text(),\'phút\') or contains(text(),\'giây\') or contains(text(),\'lúc\') or contains(text(),\'hôm qua\') or contains(text(),\'year\') or contains(text(),\'month\') or contains(text(),\'week\') or contains(text(),\'day\') or contains(text(),\'hour\') or contains(text(),\'hr\') or contains(text(),\'min\') or contains(text(),\'sec\') or contains(text(),\'yesterday\')]/ancestor::a[@role=\'link\']\",\r\n  \"xPathPostCommentReplyListString\": \"./div[2]/ul/li\",\r\n  \"xPathPostCommentReplyIdString\": \"\",\r\n  \"xPathPostCommentReplyUserInfoString\": \"./div[1]/div/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[1]/a\",\r\n  \"xPathPostCommentReplyContentString\": \"./div[1]/div/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[2]/span\",\r\n  \"xPathPostCommentReplyContentImgString\": \"\",\r\n  \"xPathPostCommentReplyDateString\": \"./div[1]/div/div[@role=\'article\']/div[2]/ul/li/a[@role=\'link\']\",\r\n  \"xPathGroupOfItemsUserReactedString\": \"\",\r\n  \"xPathListOfItemsUsersReactedString\": \"\",\r\n  \"xPathReactionItemListInfoString\": \"\",\r\n  \"xPathReactionTextInfoString\": \"\",\r\n  \"xPathGroupOfItemsUserSharedString\": \"\",\r\n  \"xPathListOfItemsUsersSharedString\": \"\",\r\n  \"xPathSharingItemListInfoString\": \"\",\r\n  \"xPathSharingTextInfoString\": \"\",\r\n  \"xPathChromeExecMoveoverAllPostIdLinkString\": \"//div[@data-pagelet=\'page\']/div[@role=\'main\']//div[@role=\'main\']/div/div/div/div/div/div[@role=\'article\']//a//b[contains(text(),\'tháng\') or contains(text(),\'ngày\') or contains(text(),\'giờ\') or contains(text(),\'phút\') or contains(text(),\'giây\') or contains(text(),\'lúc\')]//ancestor::a\",\r\n  \"isChromeExecuteMoveoverAllPostIdLinkJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreContentString\": \"var resultContent = document.evaluate(\\\"//div[@data-pagelet=\'page\']/div[@role=\'main\']//div[@role=\'main\']/div/div/div/div/div/div[@role=\'article\']//div[@dir=\'auto\']/div[@data-ad-preview=\'message\']//div[@dir=\'auto\']/div[@role=\'button\']\\\", document, null, XPathResult.ANY_TYPE, null);var node, nodes = [];while (node = resultContent.iterateNext()) nodes.push(node);for(var i=0;i&lt;nodes.length;i++) nodes[i].click();\",\r\n  \"isExecuteOAVMCJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreCommentAndReplyString\": \"var resultCommentReply = document.evaluate(\\\"//div[@data-pagelet=\'page\']/div[@role=\'main\']//div[@role=\'main\']/div/div/div/div/div/div[@role=\'article\']//div[@role=\'button\']/span/span[contains(text(),\'Xem thêm bình luận\') or contains(text(),\'View more comments\') or contains(text(),\'phản hồi\') or contains(text(),\'replies\') or contains(text(),\'reply\')]\\\", document, null, XPathResult.ANY_TYPE, null);var node, nodes = [];while (node = resultCommentReply.iterateNext()) nodes.push(node);for(var i=0;i&lt;nodes.length;i++) nodes[i].click();\",\r\n  \"isExecuteOAVMCARJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreReplyString\": \"\",\r\n  \"isExecuteOAVMReplyJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreCommentString\": \"\",\r\n  \"isExecuteOAVMCommentJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreReactionString\": \"\",\r\n  \"isExecuteOAVMReactionJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreSharingString\": \"\",\r\n  \"isExecuteOAVMSharingJavascript\": \"false\"\r\n}', 1, 1, '2021-05-18 09:21:23', '2021-05-20 13:36:36', NULL, NULL, 10);
INSERT INTO `xpath` VALUES (4, '{\r\n  \"postIdAttribute\": \"\",\r\n  \"postUserIdAttribute\": \"\",\r\n  \"postDateAttribute\": \"\",\r\n  \"postCommentRootIdAttribute\": \"\",\r\n  \"postCommentRootUserIdAttribure\": \"\",\r\n  \"postCommentRootDateAttribute\": \"\",\r\n  \"postCommentReplyIdAttribute\": \"\",\r\n  \"postCommentReplyUserIdAttribute\": \"\",\r\n  \"postCommentReplyDateAttribute\": \"\",\r\n  \"postReactionUserIdAttribute\": \"\",\r\n  \"xPathPostListString\": \"//div[@data-pagelet=\'GroupFeed\']/div[@role=\'feed\']//div[@role=\'article\' and not(@tabindex)]\",\r\n  \"xPathPostUserInfoString\": \"./div/div/div/div/div/div[2]/div/div[2]\",\r\n  \"xPathPostDateInfoString\": \"./div//div//span/span/a[@role=\'link\']//*[contains(text(),\'năm\') or contains(text(),\'tháng\') or contains(text(),\'tuần\') or contains(text(),\'ngày\') or contains(text(),\'giờ\') or contains(text(),\'phút\') or contains(text(),\'giây\') or contains(text(),\'lúc\') or contains(text(),\'hôm qua\') or contains(text(),\'year\') or contains(text(),\'month\') or contains(text(),\'week\') or contains(text(),\'day\') or contains(text(),\'hour\') or contains(text(),\'hr\') or contains(text(),\'min\') or contains(text(),\'sec\') or contains(text(),\'yesterday\')]/ancestor::a[@role=\'link\']\",\r\n  \"xPathPostContentInfoString\": \"./div//div[@dir=\'auto\']/div[@data-ad-preview=\'message\']\",\r\n  \"xPathViewMoreContentString\": \"./div//div[@dir=\'auto\']/div[contains(text(),\'Xem thêm\') or contains(text(),\'View more\')]\",\r\n  \"xPathPostString\": \"./div/div/div/div/div/div[2]/div/div[4]\",\r\n  \"xPathViewMoreCommentString\": \"./div/div/div[2]/ul/following::div[1]/div[1]/div[@role=\'button\']/span/span\",\r\n  \"xPathPostReactionInfoString\": \"\",\r\n  \"xPathPostReactionCountInfoString\": \"./div/div/div[1]/div/div[1]/div/div[1]/div/span/div[@role=\'button\']/span[1]\",\r\n  \"xPathPostCommentCountInfoString\": \"./div//div[@role=\'button\']/span[contains(text(),\'bình luận\') or contains(text(),\'comment\') or contains(text(),\'comments\')]\",\r\n  \"xPathPostShareCountInfoString\": \"./div//div[@role=\'button\']/span[contains(text(),\'chia sẻ\') or contains(text(),\'share\') or contains(text(),\'shares\')]\",\r\n  \"xPathPostCommentListInfoString\": \"./div/div/div[2]/ul/li\",\r\n  \"xPathPostCommentRootIdString\": \"\",\r\n  \"xPathPostCommentRootUserInfoString\": \"./div[1]/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[1]/a\",\r\n  \"xPathPostCommentRootContentString\": \"./div[1]/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[2]/span\",\r\n  \"xPathPostCommentRootContentImgString\": \"\",\r\n  \"xPathPostCommentRootDateString\": \"./div[1]/div[@role=\'article\']//ul/li/a[@role=\'link\']//*[contains(text(),\'năm\') or contains(text(),\'tháng\') or contains(text(),\'tuần\') or contains(text(),\'ngày\') or contains(text(),\'giờ\') or contains(text(),\'phút\') or contains(text(),\'giây\') or contains(text(),\'lúc\') or contains(text(),\'hôm qua\') or contains(text(),\'year\') or contains(text(),\'month\') or contains(text(),\'week\') or contains(text(),\'day\') or contains(text(),\'hour\') or contains(text(),\'hr\') or contains(text(),\'min\') or contains(text(),\'sec\') or contains(text(),\'yesterday\')]/ancestor::a[@role=\'link\']\",\r\n  \"xPathPostCommentReplyListString\": \"./div[2]/ul/li\",\r\n  \"xPathPostCommentReplyIdString\": \"\",\r\n  \"xPathPostCommentReplyUserInfoString\": \"./div[1]/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[1]/a\",\r\n  \"xPathPostCommentReplyContentString\": \"./div[1]/div[@role=\'article\']/div[2]/div/div[1]/div/div/div/div/div[2]/span\",\r\n  \"xPathPostCommentReplyContentImgString\": \"\",\r\n  \"xPathPostCommentReplyDateString\": \"./div[1]/div[@role=\'article\']/div[2]/ul/li/a[@role=\'link\']\",\r\n  \"xPathGroupOfItemsUserReactedString\": \"\",\r\n  \"xPathListOfItemsUsersReactedString\": \"\",\r\n  \"xPathReactionItemListInfoString\": \"\",\r\n  \"xPathReactionTextInfoString\": \"\",\r\n  \"xPathGroupOfItemsUserSharedString\": \"\",\r\n  \"xPathListOfItemsUsersSharedString\": \"\",\r\n  \"xPathSharingItemListInfoString\": \"\",\r\n  \"xPathSharingTextInfoString\": \"\",\r\n  \"xPathChromeExecMoveoverAllPostIdLinkString\": \"//div[@data-pagelet=\'GroupFeed\']/div/div/div/div/div/div[@role=\'article\']//a//b[contains(text(),\'tháng\') or contains(text(),\'ngày\') or contains(text(),\'giờ\') or contains(text(),\'phút\') or contains(text(),\'giây\') or contains(text(),\'lúc\')]//ancestor::a\",\r\n  \"isChromeExecuteMoveoverAllPostIdLinkJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreContentString\": \"var resultContent = document.evaluate(\\\"//div[@data-pagelet=\'GroupFeed\']/div/div/div/div/div/div[@role=\'article\']//div[@dir=\'auto\']/div[@data-ad-preview=\'message\']//div[@dir=\'auto\']/div[@role=\'button\']\\\", document, null, XPathResult.ANY_TYPE, null);var node, nodes = [];while (node = resultContent.iterateNext()) nodes.push(node);for(var i=0;i&lt;nodes.length;i++) nodes[i].click();\",\r\n  \"isExecuteOAVMCJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreCommentAndReplyString\": \"var resultCommentReply = document.evaluate(\\\"//div[@data-pagelet=\'GroupFeed\']/div/div/div/div/div/div[@role=\'article\']//div[@role=\'button\']/span/span[contains(text(),\'Xem thêm bình luận\') or contains(text(),\'View more comments\') or contains(text(),\'phản hồi\') or contains(text(),\'replies\') or contains(text(),\'reply\')]\\\", document, null, XPathResult.ANY_TYPE, null);var node, nodes = [];while (node = resultCommentReply.iterateNext()) nodes.push(node);for(var i=0;i&lt;nodes.length;i++) nodes[i].click();\",\r\n  \"isExecuteOAVMCARJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreReplyString\": \"\",\r\n  \"isExecuteOAVMReplyJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreCommentString\": \"\",\r\n  \"isExecuteOAVMCommentJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreReactionString\": \"\",\r\n  \"isExecuteOAVMReactionJavascript\": \"false\",\r\n  \"jsExecOpenAllViewMoreSharingString\": \"\",\r\n  \"isExecuteOAVMSharingJavascript\": \"false\"\r\n}', 1, 3, '2021-05-18 09:21:53', '2021-05-20 13:37:01', NULL, NULL, 10);

SET FOREIGN_KEY_CHECKS = 1;
