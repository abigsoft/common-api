/*
 Navicat Premium Data Transfer

 Source Server         : 159.75.114.64
 Source Server Type    : MySQL
 Source Server Version : 80023
 Source Host           : 159.75.114.64:3306
 Source Schema         : php.api

 Target Server Type    : MySQL
 Target Server Version : 80023
 File Encoding         : 65001

 Date: 13/05/2022 11:35:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for api
-- ----------------------------
DROP TABLE IF EXISTS `api`;
CREATE TABLE `api`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `type` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'GET' COMMENT '类型，GET,POST,PUT,DELETE',
  `sort` int UNSIGNED NOT NULL DEFAULT 50 COMMENT '排序',
  `desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `ext` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '调用插件位置',
  `result_success_demo` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '成功返回demo',
  `result_error_demo` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '失败返回demo',
  `price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '每月费用',
  `default_day_limit` int NOT NULL DEFAULT 1000 COMMENT '默认日访问次数',
  `status` smallint NOT NULL DEFAULT 1 COMMENT '状态',
  `now_count` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '调用次数',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '接口表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of api
-- ----------------------------
INSERT INTO `api` VALUES (1, '示例Demo', 'PARAM', 1, '示例demo', 'demo', '{\n    \"status\": 200,\n    \"msg\": \"SUCCESS\",\n    \"data\": []\n}', '{\n    \"status\": 201,\n    \"msg\": \"ERROR\",\n    \"data\": []\n}', 0.00, 10000, 1, 1, '2022-05-12 11:17:12', '2022-05-12 11:17:12', NULL);

-- ----------------------------
-- Table structure for api_config
-- ----------------------------
DROP TABLE IF EXISTS `api_config`;
CREATE TABLE `api_config`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `api_id` int NOT NULL DEFAULT 0 COMMENT '接口ID',
  `type` char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Array' COMMENT '取值类型',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '显示标题',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '调用名称',
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '参数值',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `sort` int UNSIGNED NOT NULL DEFAULT 50 COMMENT '排序',
  `status` smallint NOT NULL DEFAULT 1 COMMENT '状态',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '接口配置' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of api_config
-- ----------------------------
INSERT INTO `api_config` VALUES (1, 1, '', '第一个参数', 'str', '123456', '第一个参数', 1, 1, '2022-05-12 11:23:24', '2022-05-12 11:23:24', NULL);

-- ----------------------------
-- Table structure for api_log
-- ----------------------------
DROP TABLE IF EXISTS `api_log`;
CREATE TABLE `api_log`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `api_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '接口ID',
  `member_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员ID',
  `project_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '项目ID',
  `ip` char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '请求IP',
  `request` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '请求参数',
  `result` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '返回参数',
  `status` smallint NOT NULL DEFAULT 0 COMMENT '状态：1成功；0失败；-1拦截',
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '消息',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '接口请求日志' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of api_log
-- ----------------------------
INSERT INTO `api_log` VALUES (1, 1, 2, 1, '123.168.251.64', '...', '...', 1, '这里是消息', '2022-05-13 10:54:50', '2022-05-13 10:54:50', NULL);

-- ----------------------------
-- Table structure for api_request
-- ----------------------------
DROP TABLE IF EXISTS `api_request`;
CREATE TABLE `api_request`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `api_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '接口ID',
  `sort` int NOT NULL DEFAULT 50 COMMENT '排序',
  `type` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '类型：Number,String,Int',
  `field` char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '字段',
  `is_must` tinyint NOT NULL DEFAULT 0 COMMENT '是否必填',
  `default` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '默认值',
  `demo` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '示例',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  `status` smallint NOT NULL DEFAULT 0 COMMENT '状态',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '接口请求参数表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of api_request
-- ----------------------------
INSERT INTO `api_request` VALUES (1, 1, 1, 'Integer', 'id', 1, '', '1', '主键', 1, '2022-05-12 11:18:02', '2022-05-12 11:18:02', NULL);

-- ----------------------------
-- Table structure for api_result
-- ----------------------------
DROP TABLE IF EXISTS `api_result`;
CREATE TABLE `api_result`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `api_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '接口ID',
  `sort` int NOT NULL DEFAULT 50 COMMENT '排序',
  `field` char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '字段',
  `demo` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '示例',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '描述',
  `status` smallint NOT NULL DEFAULT 0 COMMENT '状态',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '接口返回参数表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of api_result
-- ----------------------------
INSERT INTO `api_result` VALUES (1, 1, 1, 'status', '200', '返回状态值,200为成功', 1, '2022-05-12 11:21:37', '2022-05-12 11:21:37', NULL);
INSERT INTO `api_result` VALUES (2, 1, 2, 'msg', 'SUCCESS', '返回信息', 1, '2022-05-12 11:22:21', '2022-05-12 11:22:21', NULL);
INSERT INTO `api_result` VALUES (3, 1, 3, 'data', '{}', '返回数据', 1, '2022-05-12 11:22:49', '2022-05-12 11:22:49', NULL);

-- ----------------------------
-- Table structure for black
-- ----------------------------
DROP TABLE IF EXISTS `black`;
CREATE TABLE `black`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip` char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'IP地址',
  `deadline` datetime NOT NULL COMMENT '截止日期',
  `status` smallint NOT NULL DEFAULT 1 COMMENT '状态',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '黑名单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of black
-- ----------------------------
INSERT INTO `black` VALUES (1, '127.0.0.1', '2022-05-31 00:00:00', 1, '测试', '2022-05-11 12:00:43', '2022-05-11 12:02:59', NULL);

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `cate` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '名称',
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '值',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '系统配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES (0, 'password', 'password', '1f9beffd268a6058819264e391fc3b8a', '登录密码', '2022-05-09 18:13:08', NULL, NULL);
INSERT INTO `config` VALUES (1, 'user', 'open_register', '1', '是否开放注册', '2022-02-25 11:09:24', '2022-02-25 11:09:24', NULL);
INSERT INTO `config` VALUES (2, 'sms', 'sms_type', '0', '短信方式：0关闭；1阿里云', '2022-02-25 11:11:27', '2022-02-25 16:58:48', NULL);
INSERT INTO `config` VALUES (3, 'smtp', 'smtp_status', '0', 'SMTP邮件', '2022-02-25 13:48:36', '2022-02-25 13:48:36', NULL);
INSERT INTO `config` VALUES (4, 'smtp', 'smtp_address', '', 'SMTP邮箱地址', '2022-02-25 13:48:36', '2022-02-25 13:48:36', NULL);
INSERT INTO `config` VALUES (5, 'smtp', 'smtp_host', '', 'SMTP邮箱服务器', '2022-02-25 13:48:36', '2022-02-25 13:48:36', NULL);
INSERT INTO `config` VALUES (6, 'smtp', 'smtp_port', '587', 'SMTP邮箱端口', '2022-02-25 13:48:36', '2022-02-25 13:48:36', NULL);
INSERT INTO `config` VALUES (7, 'smtp', 'smtp_username', '', 'SMTP邮箱账号', '2022-02-25 13:48:36', '2022-02-25 13:48:36', NULL);
INSERT INTO `config` VALUES (8, 'smtp', 'smtp_password', '', 'SMTP邮箱密码', '2022-02-25 13:48:36', '2022-02-25 13:48:36', NULL);
INSERT INTO `config` VALUES (9, 'sms', 'sms_ali_key', '', '阿里云短信accessKeyId', '2022-02-25 14:49:08', '2022-02-25 14:50:09', NULL);
INSERT INTO `config` VALUES (10, 'sms', 'sms_ali_secret', '', '阿里云短信accessKeySecret', '2022-02-25 14:49:31', '2022-02-25 14:50:15', NULL);
INSERT INTO `config` VALUES (11, 'sms', 'sms_ali_code_temp', '', '阿里云短信验证码模板', '2022-02-25 14:50:42', '2022-03-08 14:38:25', NULL);
INSERT INTO `config` VALUES (12, 'sms', 'sms_ali_appsign', '', '阿里云短信签名', '2022-02-25 14:51:52', '2022-03-08 14:51:04', NULL);
INSERT INTO `config` VALUES (13, 'sms', 'sms_temp_param_key', '0', '短信验证码数组Key,阿里云为参数,如code', '2022-02-25 15:10:43', '2022-02-25 15:10:49', NULL);
INSERT INTO `config` VALUES (14, 'site', 'site_title', '夜公子API', '系统标题', '2022-05-09 17:58:07', NULL, NULL);
INSERT INTO `config` VALUES (15, 'site', 'site_keyword', '夜公子API', 'SEO关键字', '2022-05-09 17:58:32', NULL, NULL);
INSERT INTO `config` VALUES (16, 'site', 'site_description', '夜公子API', 'SEO描述', '2022-05-09 17:59:00', NULL, NULL);
INSERT INTO `config` VALUES (17, 'site', 'site_temp', '1', '前台模板', '2022-05-09 17:59:25', NULL, NULL);
INSERT INTO `config` VALUES (18, 'pay', 'pay_epay_url', 'https://epay.abigsoft.com/', '易支付地址，结尾加/', '2022-05-09 18:01:18', NULL, NULL);
INSERT INTO `config` VALUES (19, 'pay', 'pay_epay_mchid', '', '易支付商户ID', '2022-05-09 18:01:20', NULL, NULL);
INSERT INTO `config` VALUES (20, 'pay', 'pay_epay_key', '', '易支付商户密钥', '2022-05-09 18:01:23', NULL, NULL);
INSERT INTO `config` VALUES (21, 'site', 'icp_str', '鲁ICP备', 'ICP备案号', '2022-05-09 18:11:06', NULL, NULL);
INSERT INTO `config` VALUES (22, 'site', 'cnzz', '', '统计代码', '2022-05-09 18:11:31', NULL, NULL);
INSERT INTO `config` VALUES (23, 'login', 'login_status', '1', '聚合登录', '2022-05-10 11:57:00', NULL, NULL);
INSERT INTO `config` VALUES (24, 'login', 'login_url', 'https://login.by.abigsoft.com/', '聚合登录接口地址', '2022-05-10 11:57:03', NULL, NULL);
INSERT INTO `config` VALUES (25, 'login', 'login_appid', '', '聚合登录应用ID', '2022-05-10 11:57:05', NULL, NULL);
INSERT INTO `config` VALUES (26, 'login', 'login_appkey', '', '聚合登录应用秘钥', '2022-05-10 11:57:07', NULL, NULL);
INSERT INTO `config` VALUES (27, 'site', 'index_about', '关于我们  关于我们', '关于我们', '2022-05-12 12:01:35', NULL, NULL);
UPDATE `config` SET `id` = 0 WHERE `name` = 'password';

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `app` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `ip` char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '请求IP',
  `ua` varchar(2000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `param` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '请求参数',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '请求日志' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES (1, 'admin', '123.168.251.64', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36 Core/1.77.106.400 QQBrowser/10.9.4626.400', '/admin/config/index', '[]', '2022-05-12 11:12:05', '2022-05-12 11:12:05', NULL);

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;
CREATE TABLE `member`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `account` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '账号',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '密码',
  `status` smallint NOT NULL DEFAULT 1 COMMENT '状态',
  `wx_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '聚合登录微信ID',
  `qq_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '聚合登录QQID',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '会员表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of member
-- ----------------------------
INSERT INTO `member` VALUES (1, 'smallchen', '883e158cfca621a4219a039e44daccd0', 1, '', '', '2022-05-12 17:06:16', '2022-05-12 17:06:16', NULL);
INSERT INTO `member` VALUES (2, 'nVIjviWJSIrL', 'd64e45f58a30cbfe7e60430eee4df9af', 1, '', 'B7099812C33E6C8F16CE08062ADB2489', '2022-05-12 17:25:21', '2022-05-12 17:25:21', NULL);

-- ----------------------------
-- Table structure for pay_order
-- ----------------------------
DROP TABLE IF EXISTS `pay_order`;
CREATE TABLE `pay_order`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `order_sn` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '订单编号',
  `member_id` int UNSIGNED NOT NULL COMMENT '用户ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `order_type` tinyint NOT NULL DEFAULT 1 COMMENT '订单类型：1包月',
  `pay_type` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '通道类型：wxpay,alipay',
  `order_num` int UNSIGNED NOT NULL DEFAULT 1 COMMENT '订单数量',
  `order_money` decimal(12, 2) UNSIGNED NOT NULL COMMENT '订单金额',
  `pay_money` decimal(12, 2) UNSIGNED NOT NULL COMMENT '支付金额',
  `order_code` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '支付平台订单号',
  `transaction_id` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '用户端订单号',
  `end_time` datetime NULL DEFAULT NULL COMMENT '结束时间',
  `pay_time` datetime NULL DEFAULT NULL,
  `status` smallint NOT NULL DEFAULT 0 COMMENT '订单状态：-1订单失效；0未支付；1支付成功',
  `other` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '其他信息',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '支付订单' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pay_order
-- ----------------------------
INSERT INTO `pay_order` VALUES (12, '20220513110527145614', 1, '示例Demo接口包月', 1, 'wxpay', 1, 0.00, 0.00, '', '', '2022-05-13 11:20:27', NULL, 1, '1', '2022-05-13 11:05:27', '2022-05-13 11:05:27', NULL);

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `member_id` int NOT NULL COMMENT '会员ID',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '标题',
  `sign` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '加密串',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `status` smallint NOT NULL DEFAULT 1 COMMENT '状态：1正常；0禁用',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `sign`) USING BTREE,
  UNIQUE INDEX `sign`(`sign`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '会员项目表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES (1, 2, '测试Demo', 'bqAJXaIB9XXwIq7q', '测试Demo', 1, '2022-05-12 20:20:13', '2022-05-12 20:20:13', NULL);

-- ----------------------------
-- Table structure for project_api
-- ----------------------------
DROP TABLE IF EXISTS `project_api`;
CREATE TABLE `project_api`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` int NOT NULL COMMENT '项目ID',
  `api_id` int NOT NULL COMMENT '接口ID',
  `member_id` int UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员ID',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `limit_date` datetime NOT NULL COMMENT '到期日期',
  `day_limit_count` int NOT NULL DEFAULT 1000 COMMENT '日限制请求数',
  `today_count` int NOT NULL DEFAULT 0 COMMENT '今日请求次数',
  `status` smallint NOT NULL DEFAULT 1 COMMENT '状态',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '项目接口配置' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of project_api
-- ----------------------------
INSERT INTO `project_api` VALUES (1, 1, 1, 2, '111', '2022-10-13 00:10:49', 10000, 0, 1, '2022-05-12 23:02:12', '2022-05-12 23:02:12', NULL);

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '序号',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `clock_type` tinyint NOT NULL DEFAULT 0 COMMENT '时钟类型:0时间间隔；1N月N日N时；2每月N日N时；3每日N时',
  `clock_month` char(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '01' COMMENT '定时时钟-月',
  `clock_day` char(4) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '01' COMMENT '定时时钟-日',
  `clock_time` time NOT NULL DEFAULT '00:00:00' COMMENT '定时时钟-时',
  `task` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '任务路由',
  `task_fun` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '路由方法',
  `is_trans` tinyint NOT NULL DEFAULT 0 COMMENT '开启事务',
  `active_count` int NOT NULL DEFAULT 0 COMMENT '执行次数',
  `last_active` datetime NULL DEFAULT NULL COMMENT '上次执行时间',
  `next_active` datetime NOT NULL COMMENT '下次执行时间',
  `last_elapsed` int NOT NULL DEFAULT 0 COMMENT '上次执行耗时,毫秒',
  `active_limit` int NOT NULL DEFAULT 0 COMMENT '执行次数上限',
  `error_count` int NOT NULL DEFAULT 0 COMMENT '错误计数',
  `error_msg` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '错误信息',
  `status` tinyint NOT NULL DEFAULT 0 COMMENT '状态:1执行',
  `details` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `task_type` tinyint NOT NULL DEFAULT 1 COMMENT '任务类型:1PHP类；2存储过程',
  `create_time` datetime NULL DEFAULT NULL,
  `update_time` datetime NULL DEFAULT NULL,
  `delete_time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '定时任务表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES (1, '心跳检测', 0, '', '', '01:00:00', 'Demo', 'run', 1, 1, '2022-05-13 11:04:43', '2022-05-13 12:04:43', 12, 3, 0, '', 1, '', 1, NULL, '2022-05-11 10:00:37', NULL);
INSERT INTO `task` VALUES (2, '重置汇总', 3, '', '', '00:01:00', 'Reset', 'run', 1, 1, '2022-05-13 11:04:43', '2022-05-14 00:01:00', 24, 3, 0, '', 1, '', 1, '2022-05-11 09:45:32', '2022-05-13 11:00:20', NULL);
INSERT INTO `task` VALUES (3, '订单处理', 0, '', '', '00:00:01', 'Order', 'run', 1, 31, '2022-05-13 11:35:01', '2022-05-13 11:35:02', 38, 3, 0, '', 1, '', 1, '2022-05-13 11:00:12', '2022-05-13 11:01:45', NULL);

-- ----------------------------
-- Table structure for phone_code_log
-- ----------------------------
DROP TABLE IF EXISTS `phone_code_log`;
CREATE TABLE `phone_code_log`  (
   `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
   `type` char(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'login' COMMENT '类型：login，register，reset',
   `phone` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '手机号',
   `code` char(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '验证码',
   `count` int NOT NULL DEFAULT 0 COMMENT '验证次数',
   `status` tinyint NOT NULL DEFAULT 0 COMMENT '状态：0未验证；1已使用',
   `create_time` datetime NULL DEFAULT NULL,
   `update_time` datetime NULL DEFAULT NULL,
   `delete_time` datetime NULL DEFAULT NULL,
   PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '短信验证码表' ROW_FORMAT = DYNAMIC;


SET FOREIGN_KEY_CHECKS = 1;
