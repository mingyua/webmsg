-- -----------------------------
-- Think MySQL Data Transfer 
-- 
-- Host     : 
-- Port     : 
-- Database : 
-- 
-- Part : #1
-- Date : 2018-08-21 14:02:19
-- -----------------------------

SET FOREIGN_KEY_CHECKS = 0;


-- -----------------------------
-- Table structure for `wb_article`
-- -----------------------------
DROP TABLE IF EXISTS `wb_article`;
CREATE TABLE `wb_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键id',
  `cateid` int(11) DEFAULT NULL COMMENT '分类id',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `thumb` varchar(255) DEFAULT NULL COMMENT '缩略图',
  `keywords` text COMMENT '关键词',
  `desc` text COMMENT '描述',
  `content` mediumtext COMMENT '内容',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `status` int(11) DEFAULT NULL COMMENT '状态：1是2否',
  `other` varchar(255) DEFAULT NULL COMMENT '扩展字段',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `uptime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_article`
-- -----------------------------
INSERT INTO `wb_article` VALUES ('1', '1', '34234', '', '', '', '<p>3<br/></p>', '2', '1', '', '1532915137', '1533109147');
INSERT INTO `wb_article` VALUES ('2', '6', '2342', '', '', '', '', '0', '1', '', '1532915137', '1533114285');
INSERT INTO `wb_article` VALUES ('4', '5', '公司简介', './public/uploads/20180801/3ac1604f37813e4c8ca2603fdcf5241f.png', '', '3333333333', '<h1 style=\"border-bottom-color:#cccccc;border-bottom-width:2px;border-bottom-style:solid;padding:0px 4px 0px 0px;margin:0px 0px 10px;\"><span style=\"color:#e36c09;\" class=\"ue_t\">[此处键入简历标题]</span></h1><p><span style=\"color:#e36c09;\"><br/></span></p><table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\"><tbody><tr class=\"firstRow\"><td style=\"text-align:center;\" class=\"ue_t\" width=\"200\">【此处插入照片】</td><td><p><br/></p><p>联系电话：<span class=\"ue_t\">[键入您的电话]</span></p><p><br/></p><p>电子邮件：<span class=\"ue_t\">[键入您的电子邮件地址]</span></p><p><br/></p><p>家庭住址：<span class=\"ue_t\">[键入您的地址]</span></p><p><br/></p></td></tr></tbody></table><h3><span style=\"color:#e36c09;font-size:20px;\">目标职位</span></h3><p style=\"text-indent:2em;\" class=\"ue_t\">[此处键入您的期望职位]</p><h3><span style=\"color:#e36c09;font-size:20px;\">学历</span></h3><p><span style=\"display:none;line-height:0px;\">﻿</span></p><ol style=\"list-style-type: decimal;\" class=\" list-paddingleft-2\"><li><p><span class=\"ue_t\">[键入起止时间]</span> <span class=\"ue_t\">[键入学校名称] </span> <span class=\"ue_t\">[键入所学专业]</span> <span class=\"ue_t\">[键入所获学位]</span></p></li><li><p><span class=\"ue_t\">[键入起止时间]</span> <span class=\"ue_t\">[键入学校名称]</span> <span class=\"ue_t\">[键入所学专业]</span> <span class=\"ue_t\">[键入所获学位]</span></p></li></ol><h3><span style=\"color:#e36c09;font-size:20px;\" class=\"ue_t\">工作经验</span></h3><ol style=\"list-style-type: decimal;\" class=\" list-paddingleft-2\"><li><p><span class=\"ue_t\">[键入起止时间]</span> <span class=\"ue_t\">[键入公司名称]</span> <span class=\"ue_t\">[键入职位名称]</span></p></li><ol style=\"list-style-type: lower-alpha;\" class=\" list-paddingleft-2\"><li><p><span class=\"ue_t\">[键入负责项目]</span> <span class=\"ue_t\">[键入项目简介]</span></p></li><li><p><span class=\"ue_t\">[键入负责项目]</span> <span class=\"ue_t\">[键入项目简介]</span></p></li></ol><li><p><span class=\"ue_t\">[键入起止时间]</span> <span class=\"ue_t\">[键入公司名称]</span> <span class=\"ue_t\">[键入职位名称]</span></p></li><ol style=\"list-style-type: lower-alpha;\" class=\" list-paddingleft-2\"><li><p><span class=\"ue_t\">[键入负责项目]</span> <span class=\"ue_t\">[键入项目简介]</span></p></li></ol></ol><p><span style=\"color:#e36c09;font-size:20px;\">掌握技能</span></p><p style=\"text-indent:2em;\">&nbsp;<span class=\"ue_t\">[这里可以键入您所掌握的技能]</span><br/></p><p><br/></p>', '0', '1', '', '1533028083', '1533116872');
INSERT INTO `wb_article` VALUES ('5', '6', '测试新闻', '', '呵呵', '涓唱歌', '<p>333<br/></p>', '0', '1', '', '2018', '1533027820');
INSERT INTO `wb_article` VALUES ('6', '6', '月月月e', '', '月月eee', 'e', '<p>月月月月eeee<br/></p>', '0', '1', '', '1533028018', '1533028026');
INSERT INTO `wb_article` VALUES ('7', '7', '33333', '', '', '', '', '0', '1', '', '1533114069', '1533114077');
INSERT INTO `wb_article` VALUES ('8', '8', '联系我们', '', '', '', '', '0', '1', '', '1534324468', '0');

-- -----------------------------
-- Table structure for `wb_auth`
-- -----------------------------
DROP TABLE IF EXISTS `wb_auth`;
CREATE TABLE `wb_auth` (
  `groupid` int(11) NOT NULL,
  `menuid` int(11) NOT NULL,
  `menuurl` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_auth`
-- -----------------------------
INSERT INTO `wb_auth` VALUES ('1', '23', '');
INSERT INTO `wb_auth` VALUES ('1', '20', 'log/index');
INSERT INTO `wb_auth` VALUES ('1', '19', '');
INSERT INTO `wb_auth` VALUES ('1', '46', 'cate/status');
INSERT INTO `wb_auth` VALUES ('1', '45', 'cate/delete');
INSERT INTO `wb_auth` VALUES ('1', '44', 'cate/alldel');
INSERT INTO `wb_auth` VALUES ('1', '43', 'cate/add');
INSERT INTO `wb_auth` VALUES ('1', '21', 'cate/index');
INSERT INTO `wb_auth` VALUES ('1', '56', 'menu/status');
INSERT INTO `wb_auth` VALUES ('1', '55', 'menu/delete');
INSERT INTO `wb_auth` VALUES ('1', '54', 'menu/alldel');
INSERT INTO `wb_auth` VALUES ('1', '53', 'menu/add');
INSERT INTO `wb_auth` VALUES ('1', '18', 'menu/index');
INSERT INTO `wb_auth` VALUES ('1', '17', 'set/index');
INSERT INTO `wb_auth` VALUES ('1', '16', '');
INSERT INTO `wb_auth` VALUES ('1', '1', 'index/center');
INSERT INTO `wb_auth` VALUES ('1', '24', 'data/index');
INSERT INTO `wb_auth` VALUES ('1', '26', 'data/backup');
INSERT INTO `wb_auth` VALUES ('1', '47', 'data/importlist');
INSERT INTO `wb_auth` VALUES ('1', '48', 'data/import');
INSERT INTO `wb_auth` VALUES ('1', '49', 'data/del');
INSERT INTO `wb_auth` VALUES ('1', '50', 'data/export');
INSERT INTO `wb_auth` VALUES ('1', '51', 'data/repair');
INSERT INTO `wb_auth` VALUES ('1', '52', 'data/optimize');
INSERT INTO `wb_auth` VALUES ('1', '27', '');
INSERT INTO `wb_auth` VALUES ('1', '28', 'user/index');
INSERT INTO `wb_auth` VALUES ('1', '57', 'user/adduser');
INSERT INTO `wb_auth` VALUES ('1', '29', 'user/group');
INSERT INTO `wb_auth` VALUES ('1', '30', 'user/auth');
INSERT INTO `wb_auth` VALUES ('1', '61', 'user/authedit');
INSERT INTO `wb_auth` VALUES ('1', '58', 'user/status');
INSERT INTO `wb_auth` VALUES ('1', '59', 'user/delete');
INSERT INTO `wb_auth` VALUES ('1', '60', 'user/alldel');
INSERT INTO `wb_auth` VALUES ('1', '36', '');
INSERT INTO `wb_auth` VALUES ('1', '38', 'article/single');
INSERT INTO `wb_auth` VALUES ('1', '37', 'article/index');
INSERT INTO `wb_auth` VALUES ('1', '40', 'article/delete');
INSERT INTO `wb_auth` VALUES ('1', '41', 'article/alldel');
INSERT INTO `wb_auth` VALUES ('1', '42', 'article/status');
INSERT INTO `wb_auth` VALUES ('1', '39', 'article/add');
INSERT INTO `wb_auth` VALUES ('1', '62', 'ekd/lsdk');
INSERT INTO `wb_auth` VALUES ('2', '37', 'article/index');
INSERT INTO `wb_auth` VALUES ('2', '38', 'article/single');
INSERT INTO `wb_auth` VALUES ('2', '36', '');
INSERT INTO `wb_auth` VALUES ('2', '60', 'user/alldel');
INSERT INTO `wb_auth` VALUES ('2', '59', 'user/delete');
INSERT INTO `wb_auth` VALUES ('2', '58', 'user/status');
INSERT INTO `wb_auth` VALUES ('2', '61', 'user/authedit');
INSERT INTO `wb_auth` VALUES ('2', '30', 'user/auth');
INSERT INTO `wb_auth` VALUES ('2', '29', 'user/group');
INSERT INTO `wb_auth` VALUES ('2', '57', 'user/adduser');
INSERT INTO `wb_auth` VALUES ('2', '28', 'user/index');
INSERT INTO `wb_auth` VALUES ('2', '27', '');
INSERT INTO `wb_auth` VALUES ('2', '46', 'cate/status');
INSERT INTO `wb_auth` VALUES ('2', '45', 'cate/delete');
INSERT INTO `wb_auth` VALUES ('2', '44', 'cate/alldel');
INSERT INTO `wb_auth` VALUES ('2', '43', 'cate/add');
INSERT INTO `wb_auth` VALUES ('2', '21', 'cate/index');
INSERT INTO `wb_auth` VALUES ('2', '56', 'menu/status');
INSERT INTO `wb_auth` VALUES ('2', '55', 'menu/delete');
INSERT INTO `wb_auth` VALUES ('2', '54', 'menu/alldel');
INSERT INTO `wb_auth` VALUES ('2', '53', 'menu/add');
INSERT INTO `wb_auth` VALUES ('2', '18', 'menu/index');
INSERT INTO `wb_auth` VALUES ('2', '17', 'set/index');
INSERT INTO `wb_auth` VALUES ('2', '16', '');
INSERT INTO `wb_auth` VALUES ('2', '1', 'index/center');
INSERT INTO `wb_auth` VALUES ('2', '40', 'article/delete');

-- -----------------------------
-- Table structure for `wb_cate`
-- -----------------------------
DROP TABLE IF EXISTS `wb_cate`;
CREATE TABLE `wb_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `pid` int(11) DEFAULT NULL COMMENT '父级ID',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  `entitle` varchar(255) DEFAULT NULL COMMENT '英文名称',
  `url` varchar(255) DEFAULT NULL COMMENT '分类地址',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标 ',
  `thumb` varchar(1000) DEFAULT NULL COMMENT '栏目图片',
  `status` int(11) DEFAULT NULL COMMENT '状态：1显示 ;0不显示',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `temp` int(11) DEFAULT '0' COMMENT '模板id',
  `childrenid` varchar(255) DEFAULT NULL COMMENT '子分类',
  `other` varchar(255) DEFAULT NULL COMMENT '扩展字段',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_cate`
-- -----------------------------
INSERT INTO `wb_cate` VALUES ('1', '0', '关于我们', 'ABOUT US', 'about.html', 'layui-icon-survey', '', '1', '1', '2', '1,5,7,8', '1', '1534412491');
INSERT INTO `wb_cate` VALUES ('5', '1', '公司简介', 'COMPANY', 'about/index', 'layui-icon-home', '', '1', '0', '1', '5', '1', '1534412491');
INSERT INTO `wb_cate` VALUES ('6', '0', '新闻动态', '', '', 'layui-icon-list', '', '1', '0', '2', '6', '1', '1534412491');
INSERT INTO `wb_cate` VALUES ('7', '1', '公司环境', '4', '', 'layui-icon-picture', '', '1', '0', '2', '7', '1', '1534412491');
INSERT INTO `wb_cate` VALUES ('8', '1', '联系我们', 'contact', 'about/contact', '', '', '1', '3', '1', '8', '', '1534412491');

-- -----------------------------
-- Table structure for `wb_config`
-- -----------------------------
DROP TABLE IF EXISTS `wb_config`;
CREATE TABLE `wb_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `placeholder` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `tip` varchar(255) DEFAULT NULL,
  `width` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`key`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_config`
-- -----------------------------
INSERT INTO `wb_config` VALUES ('1', '网站名称', 'name', '我的网站', '', 'text', '', '', '1');
INSERT INTO `wb_config` VALUES ('2', '网站域名', 'nomote', '我是域名', '', 'text', '', '', '2');
INSERT INTO `wb_config` VALUES ('3', '首页标题', 'title', '我的标题', '', 'text', '', '', '3');
INSERT INTO `wb_config` VALUES ('4', 'META关键词', 'keywords', '我是关键语', '多个关键词用英文状态 , 号分割', 'textarea', '', '', '4');
INSERT INTO `wb_config` VALUES ('5', 'META描述', 'description', '我是描述', '', 'textarea', '', '', '5');
INSERT INTO `wb_config` VALUES ('6', 'META验证', 'yuanz', '我是验证信息', '', 'text', '', '', '6');
INSERT INTO `wb_config` VALUES ('7', '版权信息', 'foot', '我是底部版权11', '', 'textarea', '', '', '7');
INSERT INTO `wb_config` VALUES ('8', '网站LOGO', 'logo', '', '', 'file', '21323', '', '8');

-- -----------------------------
-- Table structure for `wb_group`
-- -----------------------------
DROP TABLE IF EXISTS `wb_group`;
CREATE TABLE `wb_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `name` varchar(255) DEFAULT NULL COMMENT '组名称',
  `desc` varchar(255) DEFAULT NULL COMMENT '组描述',
  `status` int(11) DEFAULT NULL COMMENT '组状态',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `uptime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_group`
-- -----------------------------
INSERT INTO `wb_group` VALUES ('1', '系统管理员', '最高权限', '1', '0', '0');
INSERT INTO `wb_group` VALUES ('2', '编辑员', '对数据进行编辑操作', '1', '1534148004', '1534148902');
INSERT INTO `wb_group` VALUES ('3', '普通用户', '只能浏览数据', '1', '1534148007', '1534148920');

-- -----------------------------
-- Table structure for `wb_hook`
-- -----------------------------
DROP TABLE IF EXISTS `wb_hook`;
CREATE TABLE `wb_hook` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '属性id',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `kinds` int(11) NOT NULL COMMENT '分类',
  `url` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL COMMENT '描述',
  `position` varchar(255) DEFAULT NULL COMMENT '位置',
  `relation` varchar(255) DEFAULT NULL COMMENT '关联id',
  `thumb` varchar(255) DEFAULT NULL COMMENT '图片',
  `sort` int(11) DEFAULT NULL COMMENT '排序',
  `status` int(11) DEFAULT NULL COMMENT '状态',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `uptime` int(11) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_hook`
-- -----------------------------
INSERT INTO `wb_hook` VALUES ('6', '23423', '2', '234', '23423', '234', '1,34234', '', '0', '1', '1534743162', '1534743162');

-- -----------------------------
-- Table structure for `wb_log`
-- -----------------------------
DROP TABLE IF EXISTS `wb_log`;
CREATE TABLE `wb_log` (
  `uid` int(11) DEFAULT NULL COMMENT '用户ID',
  `tag` varchar(255) DEFAULT NULL COMMENT '行为:登录,查看,修改等',
  `kinds` varchar(255) DEFAULT NULL COMMENT '日志类型:1系统,2访客',
  `ip` varchar(255) DEFAULT NULL COMMENT 'ip地址',
  `mac` varchar(255) DEFAULT NULL COMMENT 'mac地址',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `network` varchar(255) DEFAULT NULL COMMENT '网络类型',
  `addtime` int(11) NOT NULL COMMENT '添加时间',
  `uptime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_log`
-- -----------------------------
INSERT INTO `wb_log` VALUES ('1', '删除数据', '1', '192.168.0.102', '14-15-87-4d', '贵州省贵阳市', '电信', '1532915137', '1532915137');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '111.121.41.47', '14-DD-A9-EA-77-0F', '贵州省贵阳市', '电信', '1533262207', '1533262207');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '111.121.41.47', '14-DD-A9-EA-77-0F', '贵州省贵阳市', '电信', '1533262229', '1533262229');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '111.121.41.47', '14-DD-A9-EA-77-0F', '贵州省贵阳市', '电信', '1533262258', '1533262258');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '211.149.224.203', '14-DD-A9-EA-77-0F', '四川省成都市', '成都西维数码科技有限公司四川电信成都光华互联网数据中心节点', '1533262433', '1533262433');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '118.178.84.58', '14-DD-A9-EA-77-0F', '中国', 'CZ88.NET', '1533262468', '1533262468');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '120.77.37.52', '14-DD-A9-EA-77-0F', '北京市', '长城宽带', '1533262513', '1533262513');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '112.124.121.64', '14-DD-A9-EA-77-0F', '浙江省杭州市', '阿里云服务器', '1533262533', '1533262533');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '114.215.197.61', '14-DD-A9-EA-77-0F', '北京市', '北京万网志成科技有限公司', '1533262551', '1533262551');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '118.178.84.58', '14-DD-A9-EA-77-0F', '中国', 'CZ88.NET', '1533262605', '1533262605');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '118.178.84.58', '14-DD-A9-EA-77-0F', '中国', '', '1533262987', '1533262987');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '118.178.84.58', '14-DD-A9-EA-77-0F', '中国', '', '1533263334', '1533263334');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '118.178.84.58', '14-DD-A9-EA-77-0F', '中国', '', '1533263339', '1533263339');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '118.178.84.58', '14-DD-A9-EA-77-0F', '中国', '', '1533263397', '1533263397');
INSERT INTO `wb_log` VALUES ('1', '1', '1', '118.178.84.58', '14-DD-A9-EA-77-0F', '中国', '', '1533263802', '1533263802');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533517836', '1533517836');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533517851', '1533517851');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533518794', '1533518794');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533518932', '1533518932');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533518946', '1533518946');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533519038', '1533519038');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533519601', '1533519601');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533605016', '1533605016');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533624530', '1533624530');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533720547', '1533720547');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533782189', '1533782189');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1533863403', '1533863403');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534122419', '1534122419');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534138764', '1534138764');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534154017', '1534154017');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534210334', '1534210334');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534294452', '1534294452');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534311154', '1534311154');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534324354', '1534324354');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534381742', '1534381742');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534405724', '1534405724');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534407984', '1534407984');
INSERT INTO `wb_log` VALUES ('3', 'mingyu登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534409606', '1534409606');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534412021', '1534412021');
INSERT INTO `wb_log` VALUES ('3', 'mingyu登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534412186', '1534412186');
INSERT INTO `wb_log` VALUES ('3', 'mingyu登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534468087', '1534468087');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534469866', '1534469866');
INSERT INTO `wb_log` VALUES ('3', 'mingyu登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534469970', '1534469970');
INSERT INTO `wb_log` VALUES ('3', 'mingyu登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534470839', '1534470839');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534470879', '1534470879');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534471090', '1534471090');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534484870', '1534484870');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534727565', '1534727565');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534733937', '1534733937');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534734243', '1534734243');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534735205', '1534735205');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534735668', '1534735668');
INSERT INTO `wb_log` VALUES ('3', 'mingyu登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534753233', '1534753233');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534755131', '1534755131');
INSERT INTO `wb_log` VALUES ('3', 'mingyu登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534755193', '1534755193');
INSERT INTO `wb_log` VALUES ('3', 'mingyu登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534755300', '1534755300');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534755400', '1534755400');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534755599', '1534755599');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534756277', '1534756277');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534813789', '1534813789');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534823870', '1534823870');
INSERT INTO `wb_log` VALUES ('1', 'admin登录成功.', '1', '127.0.0.1', '14-DD-A9-EA-77-0F', '本机地址', '', '1534831273', '1534831273');

-- -----------------------------
-- Table structure for `wb_menu`
-- -----------------------------
DROP TABLE IF EXISTS `wb_menu`;
CREATE TABLE `wb_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '分类次级id',
  `name` varchar(255) DEFAULT NULL COMMENT '菜单名称',
  `url` varchar(255) DEFAULT NULL COMMENT '菜单url地址',
  `icon` varchar(255) DEFAULT NULL COMMENT '图标',
  `childrenid` varchar(255) DEFAULT NULL COMMENT '子ID',
  `status` int(11) DEFAULT NULL COMMENT '状态：1显示;0不显示',
  `sort` int(11) DEFAULT NULL COMMENT '排序 正序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_menu`
-- -----------------------------
INSERT INTO `wb_menu` VALUES ('1', '0', '控制台', 'index/center', 'layui-icon-console', '1', '1', '1');
INSERT INTO `wb_menu` VALUES ('16', '0', '设置', '', 'layui-icon-set', '16,17,18,21,43,44,45,46,53,54,55,56', '1', '3');
INSERT INTO `wb_menu` VALUES ('17', '16', '系统设置', 'set/index', '', '17', '1', '2');
INSERT INTO `wb_menu` VALUES ('18', '16', '菜单设置', 'menu/index', '', '18,53,54,55,56', '1', '2');
INSERT INTO `wb_menu` VALUES ('19', '0', '日记管理', '', 'layui-icon-form', '19,20,63', '1', '7');
INSERT INTO `wb_menu` VALUES ('20', '19', '系统日记', 'log/index', '', '20,63', '1', '1');
INSERT INTO `wb_menu` VALUES ('21', '16', '栏目管理', 'cate/index', '', '21,43,44,45,46', '1', '2');
INSERT INTO `wb_menu` VALUES ('23', '0', '数据管理', '', 'layui-icon-template-1', '23,24,26,47,48,49,50,51,52', '1', '5');
INSERT INTO `wb_menu` VALUES ('24', '23', '数据导入', 'data/index', '', '24', '1', '2');
INSERT INTO `wb_menu` VALUES ('26', '23', '数据备份', 'data/backup', '', '26,47,48,49,50,51,52', '1', '1');
INSERT INTO `wb_menu` VALUES ('53', '18', '添加/修改菜单', 'menu/add', '', '53', '0', '0');
INSERT INTO `wb_menu` VALUES ('27', '0', '用户管理', '', 'layui-icon-user', '27,28,29,30,57,58,59,60,61', '1', '4');
INSERT INTO `wb_menu` VALUES ('28', '27', '系统管理员', 'user/index', '', '28,57', '1', '1');
INSERT INTO `wb_menu` VALUES ('29', '27', '用户组', 'user/group', '', '29,30,61', '1', '2');
INSERT INTO `wb_menu` VALUES ('30', '29', '权限分配', 'user/auth', '', '30,61', '0', '3');
INSERT INTO `wb_menu` VALUES ('38', '36', '单页管理', 'article/single', '', '38', '0', '0');
INSERT INTO `wb_menu` VALUES ('61', '30', '修改权限', 'user/authedit', '', '61', '0', '0');
INSERT INTO `wb_menu` VALUES ('36', '0', '文章管理', '', '', '36,37,38,39,40,41,42', '0', '9');
INSERT INTO `wb_menu` VALUES ('37', '36', '文章列表', 'article/index', '', '37,40,41,42', '0', '0');
INSERT INTO `wb_menu` VALUES ('39', '36', '添加/修改文章', 'article/add', '', '39', '0', '0');
INSERT INTO `wb_menu` VALUES ('40', '37', '删除', 'article/delete', '', '40', '0', '0');
INSERT INTO `wb_menu` VALUES ('41', '37', '批量删除', 'article/alldel', '', '41', '0', '0');
INSERT INTO `wb_menu` VALUES ('42', '37', '状态修改', 'article/status', '', '42', '0', '0');
INSERT INTO `wb_menu` VALUES ('43', '21', '栏目添加/修改', 'cate/add', '', '43', '0', '0');
INSERT INTO `wb_menu` VALUES ('44', '21', '批量删除', 'cate/alldel', '', '44', '0', '0');
INSERT INTO `wb_menu` VALUES ('45', '21', '删除栏目', 'cate/delete', '', '45', '0', '0');
INSERT INTO `wb_menu` VALUES ('46', '21', '状态修改', 'cate/status', '', '46', '0', '0');
INSERT INTO `wb_menu` VALUES ('47', '26', '备份文件列表', 'data/importlist', '', '47', '0', '0');
INSERT INTO `wb_menu` VALUES ('48', '26', '还原数据', 'data/import', '', '48', '0', '0');
INSERT INTO `wb_menu` VALUES ('49', '26', '删除备份', 'data/del', '', '49', '0', '0');
INSERT INTO `wb_menu` VALUES ('50', '26', '备份数据表', 'data/export', '', '50', '0', '0');
INSERT INTO `wb_menu` VALUES ('51', '26', '修复表', 'data/repair', '', '51', '0', '0');
INSERT INTO `wb_menu` VALUES ('52', '26', '优化表', 'data/optimize', '', '52', '0', '0');
INSERT INTO `wb_menu` VALUES ('54', '18', '批量删除', 'menu/alldel', '', '54', '0', '0');
INSERT INTO `wb_menu` VALUES ('55', '18', '删除菜单', 'menu/delete', '', '55', '0', '0');
INSERT INTO `wb_menu` VALUES ('56', '18', '状态修改', 'menu/status', '', '56', '0', '0');
INSERT INTO `wb_menu` VALUES ('57', '28', '添加/修改管理员', 'user/adduser', '', '57', '0', '0');
INSERT INTO `wb_menu` VALUES ('58', '27', '状态修改', 'user/status', '', '58', '0', '0');
INSERT INTO `wb_menu` VALUES ('59', '27', '删除', 'user/delete', '', '59', '0', '0');
INSERT INTO `wb_menu` VALUES ('60', '27', '批量删除', 'user/alldel', '', '60', '0', '0');
INSERT INTO `wb_menu` VALUES ('63', '20', '批量删除', 'log/alldel', '', '63', '0', '1');
INSERT INTO `wb_menu` VALUES ('64', '0', '模块管理', '', 'layui-icon-component', '64,65,66,67,68,69,70,71', '1', '9');
INSERT INTO `wb_menu` VALUES ('65', '64', '图片轮播', 'hook/slide', '', '65,67', '1', '0');
INSERT INTO `wb_menu` VALUES ('66', '64', '友情链接', 'hook/link', '', '66,68', '1', '2');
INSERT INTO `wb_menu` VALUES ('67', '65', '添加图片', 'hook/addslide', '', '67', '0', '1');
INSERT INTO `wb_menu` VALUES ('68', '66', '添加/修改友情', 'hook/addlink', '', '68', '0', '0');
INSERT INTO `wb_menu` VALUES ('69', '64', '删除', 'hook/delete', '', '69', '0', '0');
INSERT INTO `wb_menu` VALUES ('70', '64', '批量删除', 'hook/alldel', '', '70', '0', '0');
INSERT INTO `wb_menu` VALUES ('71', '64', '企业管理', 'shop/index', '', '71', '1', '0');
INSERT INTO `wb_menu` VALUES ('72', '71', '删除企业', 'shop/alldel', '', '', '0', '0');

-- -----------------------------
-- Table structure for `wb_shoper`
-- -----------------------------
DROP TABLE IF EXISTS `wb_shoper`;
CREATE TABLE `wb_shoper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kinds` int(11) DEFAULT NULL COMMENT '1为个人，2为企业',
  `realname` varchar(40) DEFAULT NULL COMMENT '联系人姓名',
  `sex` varchar(20) DEFAULT NULL COMMENT '性别',
  `cards` varchar(40) DEFAULT NULL COMMENT '身份证',
  `bothday` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL COMMENT '公司名称或单位称呼',
  `tel` varchar(40) DEFAULT NULL COMMENT '座机电话',
  `phone` varchar(40) DEFAULT NULL COMMENT '手机',
  `qq` varchar(40) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `ip` varchar(200) DEFAULT NULL COMMENT '服务器IP',
  `addr` varchar(200) DEFAULT NULL COMMENT '联系地址',
  `hangye` varchar(200) DEFAULT NULL COMMENT '做的是什么行业',
  `city` varchar(40) DEFAULT NULL COMMENT '城市',
  `provice` varchar(40) DEFAULT NULL COMMENT '省份',
  `area` varchar(40) DEFAULT NULL COMMENT '地区',
  `description` varchar(2000) DEFAULT NULL COMMENT '描述',
  `contents` longtext,
  `avater` varchar(200) DEFAULT NULL COMMENT '头像',
  `url` varchar(200) DEFAULT NULL COMMENT '网址',
  `money` int(11) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL COMMENT '开始时间、成立时间',
  `endtime` int(11) DEFAULT NULL COMMENT '结束时间',
  `status` int(2) DEFAULT NULL,
  `sort` int(2) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_shoper`
-- -----------------------------
INSERT INTO `wb_shoper` VALUES ('1', '2', 'X小姐', '0', '', '0', '', '', '18073702086', '2248630880', '', 'APP开发，想做成淘宝那种，可以在网上交易的', '', '服装', '贵阳', '贵州', '龙里县', '', '1453469498', '', '', '0', '1421933498', '1485091898', '0', '0', '0');
INSERT INTO `wb_shoper` VALUES ('2', '0', '李冰', '女', '', '0', '800婚庆网', '0379-62786492', '', '1981708732', '', '招婚庆代理商', '', '婚纱摄影', '洛阳', '河南', '', '中国800婚庆网-中国城市婚庆、婚嫁、结婚行业门户第一品牌。结婚，办喜事，了解当地结婚习俗就上800婚庆网。结婚筹备一站到底，省事省力省心省钱！www.800hqw.com  招各地区独家代理合作。4008-654-655 李经理', '', '', '800hqw.com ', '0', '1421933498', '1421933498', '0', '0', '1449146842');
INSERT INTO `wb_shoper` VALUES ('3', '0', '陈燕文', '女', '', '0', '贵州祥和家园装饰', '0851-88250149', '189848607450', '2807286689', '2807286689@qq.com', '211.149.224.203', '', '房产建筑', '贵阳', '贵州', '', '包括服务器费用和两域名：gyxhxy.com、gyxhxy.cn。', '', '', 'gyxhxy.com', '920', '1392383341', '1550149741', '0', '0', '1522474093');
INSERT INTO `wb_shoper` VALUES ('4', '0', '何鸿雁', '女', '', '0', '贵州至乐心理咨询中心', '0851-5287997', '18286112484', '2994236813', '2994236813@qq.com', '', '贵阳市城基路58号华亿医院内', '心理咨询', '', '', '', '', '', '', 'zhilexinli.com', '1000', '1405440000', '1531670400', '0', '0', '1500025911');
INSERT INTO `wb_shoper` VALUES ('7', '0', '彭毅', '男', '', '0', '微皮客', '0851-8110056', '18798075208', '285412937', '285412937@qq.com', '115.47.25.57', '贵州省贵阳市云岩区金关巷21号', '教育培训', '贵阳', '贵州', '白云区', '33333', '', '', 'wxappjz.com', '0', '1439827200', '1534521600', '0', '2', '1509794579');
INSERT INTO `wb_shoper` VALUES ('8', '0', '周恩秀', '女', '', '0', '贵州景昱硅材料有限公司', '0851-8110056 ', '13595194993 ', '21462371', '21462371@qq.com', '192.168.65.67', '贵州贵阳国家高新区金阳科技产业园标准厂房辅助用房B315室', '教育培训', '贵阳', '贵州', '高新', '黔ICP备13005359号', '', '', 'gzjygcl.com', '1000', '1448032243', '1448032243', '0', '0', '1460960066');
INSERT INTO `wb_shoper` VALUES ('9', '0', '余先生', '男', '', '0', '贵州黔图无酿酒', '83936075', '13308517988', '1285904074', '1285904074@qq.com ', '211.149.224.203', '', '', '贵阳', '贵州', '乌当', '黔ICP备14000320号', '', '', 'qtwuniang.com', '1000', '1439560477', '1471182877', '0', '0', '1457243846');
INSERT INTO `wb_shoper` VALUES ('10', '0', '', '', '', '0', '鲜旅APP', '', '', '', '', '', '', '', '', '', '', '', '', '', 'xuanlv365.com', '1000', '1438178022', '1469800422', '0', '0', '1449145960');
INSERT INTO `wb_shoper` VALUES ('11', '0', '李方龙', '', '', '0', '贵州省黔龙玉丰交通设施有限公司', '', '15285188808 ', '1073573499', '1073573499@qq.com', '192.168.65.67', '贵阳市观山湖区绿地联盛国际第5号楼1单元17层18号房', '', '', '', '', '黔ICP备15007981号', '', '', 'gzqlyf.com ', '1000', '1434376344', '1465998744', '0', '0', '1457243741');
INSERT INTO `wb_shoper` VALUES ('12', '0', '', '', '', '0', '深圳网信科技', '4000851589', '', '3181998508', '3181998508@qq.com', '211.149.224.203', '深圳市龙岗区上雪科技园', '教育培训', '', '', '', '备15002997号33', '<p><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">尊敬的用户:</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">&nbsp; 您好！</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">&nbsp; 感谢您在过去的日子里，选择了我司提供的服务。有了您的信任和支持，才有我司的不断发展和进步。在未来的日子里，我们仍将一如既往地致力于提供优质的提供服务。</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">您在我司的以下业务将要过期请及时续费:</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">域名（wxkj365.com）及服务器 到期时间2016-05-18,涉及总金额:1000/年.</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">服务器过期后会立即停机，3天内没有续费的会被删除。国际域名和.cn域名等(.in域名和.cm域名除外)一般在过期30天内可以正常续费，过期30天后将进入高价赎回期。</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">.cm域名到期未续费就会删除，无赎回期。.xyz域名过期10天后进入赎回期。.es域名过期9天后就会删除，无赎回期。</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">为了保证业务的正常使用，我司建议您收到通知后立即办理续费事宜;</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">续费方法：</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">&nbsp;&nbsp;&nbsp; 1.支付宝转账：支付宝账号：</span><span t=\"7\" data=\"18798075208\" isout=\"1\" style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(204, 204, 204); z-index: 1; position: static; background-color: rgb(255, 255, 255);\">18798075208</span><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">。</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">&nbsp;&nbsp;&nbsp; 2.工商银行：户名：彭毅、卡号：6222&nbsp;</span><span t=\"7\" data=\"02240201267\" style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(204, 204, 204); z-index: 1; background-color: rgb(255, 255, 255);\">02240201267</span><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">&nbsp;4913.</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">&nbsp;</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">再次感谢您对我司的信任和支持！</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">&nbsp;此致</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">致礼！</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">电话:</span><span t=\"7\" data=\"18798075208\" style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(204, 204, 204); z-index: 1; background-color: rgb(255, 255, 255);\">18798075208</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">qq:</span><span t=\"7\" data=\"285412937\" style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; border-bottom-width: 1px; border-bottom-style: dashed; border-bottom-color: rgb(204, 204, 204); z-index: 1; background-color: rgb(255, 255, 255);\">285412937</span><br style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\"/><span style=\"font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; background-color: rgb(255, 255, 255);\">email:</span><a href=\"mailto:285412937@qq.com\" target=\"_blank\" style=\"outline: none; cursor: pointer; color: rgb(0, 96, 145); font-family: &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; font-size: 14px; line-height: 23.8px; white-space: normal; background-color: rgb(255, 255, 255);\">285412937@qq<wbr/>.com</a></p>', '', 'wxkj365.com ', '1000', '1431945591', '1463567991', '0', '0', '1462936175');
INSERT INTO `wb_shoper` VALUES ('13', '0', '张远强 ', '', '', '0', '贵州最空间装饰工程有限公司', '', '18798830580', '1106235947', '1106235947@qq.com ', '211.149.224.203', '贵阳市观山湖区国际会议中心SOHO办公区Ｅ座13-6', '', '', '', '', '黔ICP备15003967号-1 ', '', '', 'zkjzs888.com', '1000', '1429883417', '1461505817', '0', '0', '1457244023');
INSERT INTO `wb_shoper` VALUES ('14', '0', '', '', '', '0', '', '', '', '', '', '211.149.224.203', '', '', '', '', '', '', '', '', 'gztaihong.com', '1000', '1429113600', '1460736000', '0', '0', '1460959280');
INSERT INTO `wb_shoper` VALUES ('15', '0', '', '', '', '0', '贵州新颖项广告', '', '18786738868', '524822393', '524822393@qq.com', '', '', '', '', '', '', '黔ICP备15002997号-1', '', '', 'xyxgg.com ', '1000', '1428414445', '1460036845', '0', '0', '1457244328');
INSERT INTO `wb_shoper` VALUES ('16', '0', '', '', '', '0', '贵阳弘信钧天人力资源有限公司', '', '17785138235', '', '', '211.149.224.203', '贵阳中天会展城E座', '', '', '', '', '', '', '', 'gyhxjt.com ', '1000', '1426686379', '1552916779', '0', '0', '1522474043');
INSERT INTO `wb_shoper` VALUES ('17', '0', '王成', '男', '', '0', '金诚行金融咨询服务有限公司', '400-8258-848', '15286060013', '798454616', '1004100233@qq.com', '', '贵阳市云岩区延安西路2号贵州建设大厦2单元17层1号 ', '', '', '', '', '服务器、域名（jch8848.com）续费：1000元/年。', '', '', 'jch8848.com', '1000', '1426089600', '1552320000', '0', '0', '1522474066');
INSERT INTO `wb_shoper` VALUES ('18', '0', '张福祥', '男', '', '0', '贵州晨露山泉水有限公司', '400-6491-399 ', '18785181399', '1551161960', '1551161960@qq.com', '211.149.224.203', '贵阳市南明区东站路1号A1-2', '', '', '', '', '服务器、域名（gzclsq.cn）续费：860元/年，域名为首年赠送，现服务提供商域名价格调整为60元/年。即服务器费用+域名费用总金额：860元/年。', '', '', 'gzclsq.cn', '860', '1425916800', '1520611200', '0', '0', '1493954016');
INSERT INTO `wb_shoper` VALUES ('19', '0', '潘洪登', '男', '', '0', '湖南青少年励志教育学校', '', '188 74250 661', '841990053', '841990053@qq.com', '211.149.204.162', '', '教育培训', '', '', '', '', '', '', '841990053.com', '860', '1425571200', '1551801600', '0', '0', '1520241913');
INSERT INTO `wb_shoper` VALUES ('20', '0', '', '', '', '0', '贵州百汇通', '0851-82272227', '', '', '', '', '', '', '', '', '', '', '', '', 'bhtxysj.com ', '1000', '1423748324', '1455284324', '0', '0', '1448977195');
INSERT INTO `wb_shoper` VALUES ('21', '0', '曹浩', '男', '', '0', '贵州家和顺心理文化发展有限公司', '0851-85193468', '18786779670', '1016268581', '469547077@qq.com', '211.149.224.203', '贵阳友谊路佳苑福邸2单元3001', '', '', '', '', '', '', '', 'jiaheshun.wang', '860', '1422452006', '1517146406', '0', '0', '1515466624');
INSERT INTO `wb_shoper` VALUES ('22', '0', '董琪龙', '', '', '0', '贵阳奇瑞威麟汽车销售服务有限公司', '', '15585156199', '', 'qiruivlqiche@163.com', '211.149.204.162', '贵阳市经济技术开发区开发大道888号', '', '', '', '', '', '', '', 'gyqrwl.com ', '1000', '1421933498', '1453469498', '0', '0', '1448976772');
INSERT INTO `wb_shoper` VALUES ('23', '0', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'gzflky.com ', '860', '1421933498', '1421933498', '0', '0', '0');
INSERT INTO `wb_shoper` VALUES ('24', '0', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'gzjbl.com', '1000', '1421933498', '1421933498', '0', '0', '0');
INSERT INTO `wb_shoper` VALUES ('25', '0', '邓先生', '', '', '0', '贵州升翔广告标牌制作有限公司 ', '400-0851-211', '13087855344', '2407196080', '2407196080@qq.com', '', '贵阳金阳新区绿地联盛集团3栋19楼13号', '', '', '', '', '', '', '', 'gzshengxiang.com', '1000', '1408714141', '1534944541', '0', '0', '1509794682');
INSERT INTO `wb_shoper` VALUES ('26', '0', '', '', '', '0', '贵州云数贸互联商贸有限公司', '', '15185112060', '2338511184', '2338511184@qq.com', '', '', '', '', '贵州', '', '黔ICP备14003499号-1', '', '', 'gzyshlsm.com ', '1000', '1408454858', '1471613258', '0', '0', '1448976521');
INSERT INTO `wb_shoper` VALUES ('27', '0', '仇小兵', '男', '', '0', '贵州天赐兵珍酒业有限公司', '', '15885502699', '987595318', '987595318@qq.com', '', '贵阳市南明区朝南阳洞路49号（军体校内）', '', '', '', '', ' 黔ICP备14003399号', '', '', 'gztcbz.cn', '1000', '1408454749', '1471613149', '0', '0', '1448978678');
INSERT INTO `wb_shoper` VALUES ('28', '0', '', '', '', '0', '贵阳魅摄影婚纱摄影', '0851---84829415', '13518503362', '170965082', '170965082@qq.com', '', '白云区白云南路 458号（白云公园铁桥旁）', '', '', '', '', '黔ICP备14003002号-1', '', '', 'gymsy.cn', '1000', '1406121821', '1469280221', '0', '0', '1448976317');
INSERT INTO `wb_shoper` VALUES ('30', '0', '', '', '', '0', '贵州厨具销售网', '', '', '1952650929', '1952650929@qq.com', '192.168.65.67', '贵阳市云岩区外环东路235号1层4号', '', '', '', '', '', '', '', 'cj0851.com ', '1000', '1402924707', '1466083107', '0', '0', '1448976005');
INSERT INTO `wb_shoper` VALUES ('31', '0', '', '', '', '0', '华娱锐视文化传播有限公司', '0851-5297161', '', '327444863', '327444863@qq.com', '', '贵阳市云岩区中华中路喷水池南国花锦，凯都大厦1205', '', '', '', '', '黔ICP备14006215号', '', '', 'szhyrs.com ', '1000', '1398518139', '1461676539', '0', '0', '1460960702');
INSERT INTO `wb_shoper` VALUES ('32', '0', '', '', '', '0', '贵州顾通腾飞科技有限公司', '0851-5859505', '18085139991', '509326948', 'boss@gzgtled.com', '192.168.65.67', '贵州省贵阳市南明区中山西路77号华亿大厦1710号', '', '', '', '', ' 黔ICP备14001501号', '', '', 'gzgtled.cn ', '1000', '1398268800', '1461427200', '0', '0', '1460960649');
INSERT INTO `wb_shoper` VALUES ('33', '0', '', '', '', '0', '贵州顾通腾飞科技有限公司', '0851-5859505', '18085139991', '509326948', 'boss@gzgtled.com', '192.168.65.67', '贵州省贵阳市南明区中山西路77号华亿大厦1710号', '数码科技', '', '', '', '服务器、域名（gzgtled.com、gzgtled.net、gzgtled.cn）续费总金额为：1200元/年。', '', '', 'gzgtled.com', '1200', '1398268800', '1492963200', '0', '0', '1462936334');
INSERT INTO `wb_shoper` VALUES ('34', '0', '', '', '', '0', '贵州顾通腾飞科技有限公司', '0851-5859505', '18085139991', '509326948', 'boss@gzgtled.com', '192.168.65.67', '贵州省贵阳市南明区中山西路77号华亿大厦1710号', '', '', '', '', ' 黔ICP备14001501号', '', '', 'gzgtled.net', '1000', '1398268800', '1461427200', '0', '0', '1460960676');
INSERT INTO `wb_shoper` VALUES ('35', '0', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'gzjpjy.cn ', '1000', '1421933498', '1421933498', '0', '0', '0');
INSERT INTO `wb_shoper` VALUES ('36', '0', '', '', '', '0', '贵州沅素贸易有限公司', '0851-6576668', '13985150013', '', '', '192.168.65.67', '贵州贵阳市油榨街美佳假日花园10栋202室', '', '', '', '', '', '', '', '5100gz.com', '1000', '1396012213', '1459170613', '0', '0', '1448975522');
INSERT INTO `wb_shoper` VALUES ('38', '0', '朱良明', '', '', '0', '贵阳中联吊车配件销售部', '', '13984004011', '381563313', '381563313@qq.com', '', '贵州省贵阳市小河区开发大道红河新村12栋5单元', '', '', '', '', '', '', '', 'zldcpj.com ', '860', '1389013607', '1483708007', '0', '0', '1457253582');
INSERT INTO `wb_shoper` VALUES ('39', '0', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'gzjygcl.com', '1000', '1421933498', '1421933498', '0', '0', '0');
INSERT INTO `wb_shoper` VALUES ('40', '0', '', '', '', '0', '贵州百年喜酒业有限公司', '0851-6881290', '13765135733', '1164887090', '1164887090@qq.com ', '192.168.65.67', '贵阳市云岩区南馨苑E栋405', '', '', '', '', '黔ICP备13005269号-1 ', '', '', 'gzbnxj.com', '1000', '1383829433', '1478523833', '0', '0', '1478411976');
INSERT INTO `wb_shoper` VALUES ('41', '0', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'lshnt.com', '1000', '1421933498', '1421933498', '0', '0', '0');
INSERT INTO `wb_shoper` VALUES ('42', '0', '', '', '', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'gzmxhj.com', '1000', '1421933498', '1421933498', '0', '0', '0');
INSERT INTO `wb_shoper` VALUES ('43', '0', '', '', '', '0', '贵州猎风户外体育发展有限公司', '0851-2266320', '', '2987557605', '2987557605@qq.com', '192.168.65.67', '贵阳市观山湖区绿地联盛国际7号楼1单元2504室 ', '教育培训', '', '', '', '黔ICP备13004677号-1', '', '', 'lfhwty.com', '1000', '1381755571', '1476449971', '0', '0', '1460960390');
INSERT INTO `wb_shoper` VALUES ('44', '0', '', '', '', '0', '贵州巨鸿厨具设备有限公司', '0851-86759328', '', '1952650929', '1952650929@qq.com', '', '贵阳市云岩区外环东路235号1层4号 ', '', '', '贵州', '', '', '', '', 'gzjhcj.com ', '1000', '1375880227', '1470574627', '0', '0', '1448974715');
INSERT INTO `wb_shoper` VALUES ('45', '0', '', '', '', '0', '重庆光电仪器有限公司', '', '13883392947', '554369754', 'cqgdyq@163.com', '192.168.65.67', '重庆市北碚区缙善路70号附5号', '教育培训', '', '贵州', '', '黔ICP备13003395号-1 ', '', '', 'cqgdyqc.com ', '860', '1374065638', '1531832038', '0', '0', '1500025883');
INSERT INTO `wb_shoper` VALUES ('46', '0', '王朝军', '', '', '0', '贵州省水土保持技术咨询研究中心', '0851-5610484', '13984081302', '', '49954281@qq.com', '192.168.65.67', '贵阳市南明区西湖巷16号西湖佳苑清水阁', '教育培训', '', '贵州', '', '黔ICP备0101001010号', '', '', 'gzsbzx.com ', '1000', '1372003200', '1498233600', '0', '0', '1473149811');
INSERT INTO `wb_shoper` VALUES ('47', '0', '', '', '', '0', '祥和家园装饰', '0851-88250149', '', '1498920352', 'gzsdtmy@163.com', '211.149.224.203', '贵阳市南明区花果园国际中心1号楼36层整层', '教育培训', '', '贵州', '', '', '', '', 'gyxhxy.cn', '1000', '1371052800', '1528819200', '0', '0', '1515466080');
INSERT INTO `wb_shoper` VALUES ('48', '0', '', '', '', '0', '', '', '', '', '601254978@qq.com', '', '', '', '', '', '', '', '', '', 'gylongteng.cn', '50', '1370361600', '1465056000', '0', '0', '1465012152');
INSERT INTO `wb_shoper` VALUES ('49', '0', '刘锐', '男', '', '0', '贵州蓝带扎啤', '', '13765354486', '66649961', '66649961@qq.com', '211.149.224.203', '贵阳市云岩区金鸭社区', '教育培训', '', '贵州', '', '黔ICP备13001907号', '', '', 'gzldzp.com', '860', '1367769600', '1525536000', '0', '0', '1501738096');
INSERT INTO `wb_shoper` VALUES ('50', '0', '魏付六', '', '', '0', '贵阳龙腾网络营销策划有限公司', '0581-8110056', '18798029545', '601254978', '601254978@qq.com', '192.168.65.67', '', '教育培训', '贵阳', '贵州', '乌当', '', '', '', 'gylongteng.com', '2400', '1363688507', '1458382907', '0', '2', '1456737109');
INSERT INTO `wb_shoper` VALUES ('51', '0', '', '请选择', '', '0', '贵州祥和家园装饰（安顺分公司）', '0851-88250149', '17785138235', '2807286689', '', '211.149.224.203', '', '婚纱摄影', '', '', '', '', '', '', 'as.gyxhxy.com', '800', '1455428620', '1518587020', '0', '0', '1488426322');
INSERT INTO `wb_shoper` VALUES ('52', '0', '', '请选择', '', '0', '贵州祥和家园装饰（清镇分公司）', '0851-88250149', '17785138235', '2807286689', '', '211.149.224.203', '', '房产建筑', '', '', '', '', '', '', 'qz.gyxhxy.com', '800', '1455428721', '1487051121', '0', '0', '1457243177');
INSERT INTO `wb_shoper` VALUES ('53', '0', '田野', '男', '', '0', '美吉姆', '', '13984412434', '278440256', '278440256@qq.com', '211.149.224.203', '', '', '', '', '', '', '', '', 'wap.gylongteng.com', '800', '1426694400', '1458316800', '0', '0', '1457493768');
INSERT INTO `wb_shoper` VALUES ('54', '0', '', '', '', '0', '美宜居', '', '', '', '', '211.149.224.203', '', '', '', '', '', '', '', '', 'test.gylongteng.com', '800', '1429251366', '1460873766', '0', '0', '1457244984');
INSERT INTO `wb_shoper` VALUES ('55', '0', '徐文炳', '男', '', '0', '新学府教育', '0851-85843671', '13358117560', '150311408', '150311408@qq.com', '211.149.224.203', '', '教育培训', '', '', '', '', '', '', 'xxfjy.cn', '800', '1448518838', '1480141238', '0', '0', '1460960015');
INSERT INTO `wb_shoper` VALUES ('57', '0', '', '请选择', '', '0', '贵阳职业技术学院武装部网站', '', '', '', '', '192.168.65.67', '', '教育培训', '', '', '', '', '', '', 'wz.gylongteng.com', '1000', '1373698808', '1499929208', '0', '0', '1457249340');
INSERT INTO `wb_shoper` VALUES ('58', '0', '', '请选择', '', '0', '贵州古肯', '', '', '4784066', '4784066@qq.com', '211.149.204.162', '', '房产建筑', '', '', '', '', '', '', 'gokon.com.cn', '1000', '1412838548', '1475996948', '0', '0', '1460960335');
INSERT INTO `wb_shoper` VALUES ('59', '0', '', '请选择', '', '0', '贵州泓新源实业发展有限公司 ', '0851-5975640', '', '', '', '211.149.204.162', '', '金融通信', '', '', '', '', '', '', 'gzhxy.com', '1000', '1410883200', '1537113600', '0', '0', '1520241952');
INSERT INTO `wb_shoper` VALUES ('60', '0', '刘晓成', '男', '', '0', '贵阳学孚教育咨询服务有限公司', '0851-86996105', '18932016696', '346920718', '944164514@qq.com', '192.168.65.67', '', '教育培训', '', '', '', '服务器续费：主网站（51xuefu.com、51xuefu.cn、51xuefu.net）续费：800元/年，四个分站200/个/年，涉及总金额：1600元/年。', '<p><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">尊敬的用户:</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">&nbsp; 您好！</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">&nbsp; 感谢您在过去的日子里，选择了我司提供的服务。有了您的信任和支持，才有我司的不断发展和进步。在未来的日子里，我们仍将一如既往地致力于提供优质的提供服务。</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">您在我司的以下业务将要过期请及时续费:</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"></span>服务器续费：主网站（51xuefu.com、51xuefu.cn、51xuefu.net）续费：800元/年，四个分站200/个/年，涉及总金额：1600元/年。</p><p>&nbsp;</p><p><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">服务器过期后会立即停机，3天内没有续费的会被删除。国际域名和.cn域名等(.in域名和.cm域名除外)一般在过期30天内可以正常续费，过期30天后将进入高价赎回期。</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">.cm域名到期未续费就会删除，无赎回期。.xyz域名过期10天后进入赎回期。.es域名过期9天后就会删除，无赎回期。</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">为了保证业务的正常使用，我司建议您收到通知后立即办理续费事宜;</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">续费方法：</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">&nbsp; &nbsp; 1.支付宝转账：支付宝账号：</span><span style=\"Z-INDEX: 1; BORDER-BOTTOM: rgb(204,204,204) 1px dashed; POSITION: static; TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\" t=\"7\" data=\"18798075208\" isout=\"1\"><span style=\"Z-INDEX: 1; BORDER-BOTTOM: rgb(204,204,204) 1px dashed\" onclick=\"return false;\" t=\"7\" data=\"18798075208\">18798075208</span></span><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">。</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">&nbsp; &nbsp; 2.工商银行：户名：彭毅、卡号：6222<span class=\"Apple-converted-space\">&nbsp;</span></span><span style=\"Z-INDEX: 1; BORDER-BOTTOM: rgb(204,204,204) 1px dashed; TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\" t=\"7\" data=\"02240201267\"><span style=\"Z-INDEX: 1; BORDER-BOTTOM: rgb(204,204,204) 1px dashed\" onclick=\"return false;\" t=\"7\" data=\"02240201267\">02240201267</span></span><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">&nbsp;4913.</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">&nbsp;</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">再次感谢您对我司的信任和支持！</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">&nbsp;此致</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">致礼！</span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">电话:</span><span style=\"Z-INDEX: 1; BORDER-BOTTOM: rgb(204,204,204) 1px dashed; TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\" t=\"7\" data=\"18798075208\"><span style=\"Z-INDEX: 1; BORDER-BOTTOM: rgb(204,204,204) 1px dashed\" onclick=\"return false;\" t=\"7\" data=\"18798075208\">18798075208</span></span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">qq:</span><span style=\"Z-INDEX: 1; BORDER-BOTTOM: rgb(204,204,204) 1px dashed; TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\" t=\"7\" data=\"285412937\"><span style=\"Z-INDEX: 1; BORDER-BOTTOM: rgb(204,204,204) 1px dashed\" onclick=\"return false;\" t=\"7\" data=\"285412937\">285412937</span></span><br style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\"/><span style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; LETTER-SPACING: normal; COLOR: rgb(0,0,0); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px\">email:</span><a style=\"TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; OUTLINE-STYLE: none; OUTLINE-COLOR: invert; OUTLINE-WIDTH: medium; FONT: 14px/23px &#39;lucida Grande&#39;, Verdana, &#39;Microsoft YaHei&#39;; WHITE-SPACE: normal; LETTER-SPACING: normal; COLOR: rgb(0,96,145); CURSOR: pointer; WORD-SPACING: 0px; TEXT-DECORATION: underline; -webkit-text-stroke-width: 0px\" href=\"mailto:285412937@qq.com\" target=\"_blank\">285412937@qq<wbr/>.com</a></p>', '', '51xuefu.cn', '1600', '1398787200', '1525017600', '0', '0', '1515466412');
INSERT INTO `wb_shoper` VALUES ('61', '0', '', '请选择', '', '0', '贵州上和酒坊酒业有限公司', '', '', '', '', '请选择', '', '教育培训', '', '', '', '域名和服务器是客户自己的', '', '', 'gzshjf.com', '800', '1332145903', '1458376303', '0', '0', '1457253815');
INSERT INTO `wb_shoper` VALUES ('62', '0', '黄松', '男', '', '0', '贵州乾宏汽车竞拍网', '', '', '21733366', 'wwgd999@qq.com', '211.149.224.203', '', '房产建筑', '', '', '', '', '', '', 'gzqhqc.com', '1060', '1458230400', '1489766400', '0', '0', '1460959695');
INSERT INTO `wb_shoper` VALUES ('63', '0', '', '请选择', '', '0', '晨春石业', '', '', '', '', '请选择', '', '请选择', '', '', '', '', '', '', 'guistone.com', '0', '1497849587', '1497849587', '0', '0', '1497850091');
INSERT INTO `wb_shoper` VALUES ('64', '0', '潘洪登', '男', '522732199008056978', '0', '湖南励志教育', '', '18874250661', '841990053', '841990053@qq.com', '211.149.224.203', '贵州省黔南布依族苗族自治州三都水族自治县14号', '教育培训', '', '', '', '', '', '', 'qsn580.com', '1000', '1472745600', '1535817600', '0', '0', '1509794555');

-- -----------------------------
-- Table structure for `wb_shortcut`
-- -----------------------------
DROP TABLE IF EXISTS `wb_shortcut`;
CREATE TABLE `wb_shortcut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_shortcut`
-- -----------------------------
INSERT INTO `wb_shortcut` VALUES ('1', '文章管理', 'layui-icon-read', '/manage/article/index', '1', '1');
INSERT INTO `wb_shortcut` VALUES ('2', '添加文章', 'layui-icon-survey', '/manage/article/add', '1', '2');
INSERT INTO `wb_shortcut` VALUES ('3', '单页管理', 'layui-icon-file-b', '/manage/article/single', '1', '3');
INSERT INTO `wb_shortcut` VALUES ('4', '栏目管理', 'layui-icon-tabs', '/manage/cate/index', '1', '1');
INSERT INTO `wb_shortcut` VALUES ('5', '数据备份', 'layui-icon-template-1', '/manage/data/backup', '1', '4');
INSERT INTO `wb_shortcut` VALUES ('6', '密码修改', 'layui-icon-password', '/manage/user/repwd', '1', '5');
INSERT INTO `wb_shortcut` VALUES ('7', '图片轮播', 'layui-icon-carousel', '/manage/hook/slide', '1', '7');
INSERT INTO `wb_shortcut` VALUES ('8', '系统日记', 'layui-icon-form', '/manage/log/index', '1', '8');
INSERT INTO `wb_shortcut` VALUES ('9', '友情链接', 'layui-icon-link', '/manage/hook/link', '1', '9');

-- -----------------------------
-- Table structure for `wb_template`
-- -----------------------------
DROP TABLE IF EXISTS `wb_template`;
CREATE TABLE `wb_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键ID',
  `name` varchar(255) DEFAULT NULL COMMENT '模板名称',
  `type` int(11) DEFAULT NULL COMMENT '模板类型：1单页;2列表',
  `template` varchar(255) DEFAULT NULL COMMENT '模板地址',
  `thumb` varchar(255) DEFAULT NULL COMMENT '模板显示图片',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `uptime` int(11) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_template`
-- -----------------------------
INSERT INTO `wb_template` VALUES ('1', '单页模型', '1', '', '', '0', '0');
INSERT INTO `wb_template` VALUES ('2', '列表', '2', '', '', '0', '0');

-- -----------------------------
-- Table structure for `wb_thumb`
-- -----------------------------
DROP TABLE IF EXISTS `wb_thumb`;
CREATE TABLE `wb_thumb` (
  `artid` int(11) NOT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_thumb`
-- -----------------------------
INSERT INTO `wb_thumb` VALUES ('4', './public/uploads/20180801/430e2747aee1727c9f627155a1fdcb66.jpg', '1');
INSERT INTO `wb_thumb` VALUES ('4', './public/uploads/20180801/3ac1604f37813e4c8ca2603fdcf5241f.png', '0');

-- -----------------------------
-- Table structure for `wb_user`
-- -----------------------------
DROP TABLE IF EXISTS `wb_user`;
CREATE TABLE `wb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kinds` int(11) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userpwd` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `uptime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_user`
-- -----------------------------
INSERT INTO `wb_user` VALUES ('1', '1', '1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', './public/uploads/avatar/1534823171.gif', '18798075208', '1', '1533519038', '1534831273');
INSERT INTO `wb_user` VALUES ('3', '1', '2', 'mingyu', 'e10adc3949ba59abbe56e057f20f883e', './public/uploads/avatar/1534823334.gif', '18798075208', '1', '1534152368', '1534755300');
INSERT INTO `wb_user` VALUES ('4', '1', '1', 'mingyua', 'e10adc3949ba59abbe56e057f20f883e', './public/uploads/avatar/1534823334.gif', '18798075208', '1', '1534152368', '1534152368');