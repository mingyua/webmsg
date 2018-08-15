-- -----------------------------
-- Think MySQL Data Transfer 
-- 
-- Host     : 
-- Port     : 
-- Database : 
-- 
-- Part : #1
-- Date : 2018-08-15 17:03:02
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_article`
-- -----------------------------
INSERT INTO `wb_article` VALUES ('1', '1', '34234', '', '', '', '<p>3<br/></p>', '2', '1', '', '1532915137', '1533109147');
INSERT INTO `wb_article` VALUES ('2', '6', '2342', '', '', '', '', '0', '1', '', '1532915137', '1533114285');
INSERT INTO `wb_article` VALUES ('3', '7', '4', '', '', '44444444', '', '0', '1', '', '1532915137', '1533092154');
INSERT INTO `wb_article` VALUES ('4', '5', '公司简介', './public/uploads/20180801/3ac1604f37813e4c8ca2603fdcf5241f.png', '', '3333333333', '<h1 style=\"border-bottom-color:#cccccc;border-bottom-width:2px;border-bottom-style:solid;padding:0px 4px 0px 0px;margin:0px 0px 10px;\"><span style=\"color:#e36c09;\" class=\"ue_t\">[此处键入简历标题]</span></h1><p><span style=\"color:#e36c09;\"><br/></span></p><table style=\"border-collapse:collapse;\" width=\"100%\" border=\"1\"><tbody><tr class=\"firstRow\"><td style=\"text-align:center;\" class=\"ue_t\" width=\"200\">【此处插入照片】</td><td><p><br/></p><p>联系电话：<span class=\"ue_t\">[键入您的电话]</span></p><p><br/></p><p>电子邮件：<span class=\"ue_t\">[键入您的电子邮件地址]</span></p><p><br/></p><p>家庭住址：<span class=\"ue_t\">[键入您的地址]</span></p><p><br/></p></td></tr></tbody></table><h3><span style=\"color:#e36c09;font-size:20px;\">目标职位</span></h3><p style=\"text-indent:2em;\" class=\"ue_t\">[此处键入您的期望职位]</p><h3><span style=\"color:#e36c09;font-size:20px;\">学历</span></h3><p><span style=\"display:none;line-height:0px;\">﻿</span></p><ol style=\"list-style-type: decimal;\" class=\" list-paddingleft-2\"><li><p><span class=\"ue_t\">[键入起止时间]</span> <span class=\"ue_t\">[键入学校名称] </span> <span class=\"ue_t\">[键入所学专业]</span> <span class=\"ue_t\">[键入所获学位]</span></p></li><li><p><span class=\"ue_t\">[键入起止时间]</span> <span class=\"ue_t\">[键入学校名称]</span> <span class=\"ue_t\">[键入所学专业]</span> <span class=\"ue_t\">[键入所获学位]</span></p></li></ol><h3><span style=\"color:#e36c09;font-size:20px;\" class=\"ue_t\">工作经验</span></h3><ol style=\"list-style-type: decimal;\" class=\" list-paddingleft-2\"><li><p><span class=\"ue_t\">[键入起止时间]</span> <span class=\"ue_t\">[键入公司名称]</span> <span class=\"ue_t\">[键入职位名称]</span></p></li><ol style=\"list-style-type: lower-alpha;\" class=\" list-paddingleft-2\"><li><p><span class=\"ue_t\">[键入负责项目]</span> <span class=\"ue_t\">[键入项目简介]</span></p></li><li><p><span class=\"ue_t\">[键入负责项目]</span> <span class=\"ue_t\">[键入项目简介]</span></p></li></ol><li><p><span class=\"ue_t\">[键入起止时间]</span> <span class=\"ue_t\">[键入公司名称]</span> <span class=\"ue_t\">[键入职位名称]</span></p></li><ol style=\"list-style-type: lower-alpha;\" class=\" list-paddingleft-2\"><li><p><span class=\"ue_t\">[键入负责项目]</span> <span class=\"ue_t\">[键入项目简介]</span></p></li></ol></ol><p><span style=\"color:#e36c09;font-size:20px;\">掌握技能</span></p><p style=\"text-indent:2em;\">&nbsp;<span class=\"ue_t\">[这里可以键入您所掌握的技能]</span><br/></p><p><br/></p>', '0', '1', '', '1533028083', '1533116872');
INSERT INTO `wb_article` VALUES ('5', '6', '测试新闻', '', '呵呵', '涓唱歌', '<p>333<br/></p>', '0', '1', '', '2018', '1533027820');
INSERT INTO `wb_article` VALUES ('6', '6', '月月月e', '', '月月eee', 'e', '<p>月月月月eeee<br/></p>', '0', '1', '', '1533028018', '1533028026');
INSERT INTO `wb_article` VALUES ('7', '7', '33333', '', '', '', '', '0', '1', '', '1533114069', '1533114077');

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
INSERT INTO `wb_auth` VALUES ('1', '30', 'user/auth');
INSERT INTO `wb_auth` VALUES ('1', '29', 'user/group');
INSERT INTO `wb_auth` VALUES ('1', '28', 'user/index');
INSERT INTO `wb_auth` VALUES ('1', '27', '');
INSERT INTO `wb_auth` VALUES ('1', '26', 'data/backup');
INSERT INTO `wb_auth` VALUES ('1', '24', 'data/index');
INSERT INTO `wb_auth` VALUES ('1', '23', '');
INSERT INTO `wb_auth` VALUES ('1', '25', 'log/visitor');
INSERT INTO `wb_auth` VALUES ('1', '20', 'log/index');
INSERT INTO `wb_auth` VALUES ('1', '19', '');
INSERT INTO `wb_auth` VALUES ('1', '18', 'menu/index');
INSERT INTO `wb_auth` VALUES ('1', '17', 'set/index');
INSERT INTO `wb_auth` VALUES ('1', '16', '');
INSERT INTO `wb_auth` VALUES ('1', '1', 'index/center');

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
  `other` varchar(255) DEFAULT NULL COMMENT '扩展字段',
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_cate`
-- -----------------------------
INSERT INTO `wb_cate` VALUES ('1', '0', '关于我们', 'ABOUT US', 'about.html', 'layui-icon-survey', '', '1', '1', '2', '1', '1532915137');
INSERT INTO `wb_cate` VALUES ('5', '1', '公司简介', 'COMPANY', 'about/index', 'layui-icon-home', '', '1', '0', '1', '1', '1532915178');
INSERT INTO `wb_cate` VALUES ('6', '0', '新闻动态', '', '', 'layui-icon-list', '', '1', '0', '2', '1', '1532936292');
INSERT INTO `wb_cate` VALUES ('7', '1', '公司环境', '4', '', 'layui-icon-picture', '', '1', '0', '2', '1', '1532923009');

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
INSERT INTO `wb_config` VALUES ('7', '版权信息', 'foot', '我是底部版权', '', 'textarea', '', '', '7');
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
INSERT INTO `wb_group` VALUES ('1', '系统管理员', '最高权限', '1', '', '');
INSERT INTO `wb_group` VALUES ('2', '编辑员', '对数据进行编辑操作', '1', '1534148004', '1534148902');
INSERT INTO `wb_group` VALUES ('3', '普通用户', '只能浏览数据', '1', '1534148007', '1534148920');

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
  `addtime` int(11) DEFAULT NULL COMMENT '添加时间',
  `uptime` int(11) DEFAULT NULL COMMENT '更新时间'
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
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_menu`
-- -----------------------------
INSERT INTO `wb_menu` VALUES ('1', '0', '控制台', 'index/center', 'layui-icon-console', '', '1', '1');
INSERT INTO `wb_menu` VALUES ('16', '0', '设置', '', 'layui-icon-set', '16,17,18,21', '1', '3');
INSERT INTO `wb_menu` VALUES ('17', '16', '系统设置', 'set/index', '', '17', '1', '2');
INSERT INTO `wb_menu` VALUES ('18', '16', '菜单设置', 'menu/index', '', '18', '1', '2');
INSERT INTO `wb_menu` VALUES ('19', '0', '日记管理', '', 'layui-icon-form', '', '1', '3');
INSERT INTO `wb_menu` VALUES ('20', '19', '系统日记', 'log/index', '', '', '1', '1');
INSERT INTO `wb_menu` VALUES ('21', '16', '栏目管理', 'cate/index', '', '21', '1', '2');
INSERT INTO `wb_menu` VALUES ('23', '0', '数据管理', '', 'layui-icon-upload-drag', '', '1', '5');
INSERT INTO `wb_menu` VALUES ('24', '23', '数据导入', 'data/index', '', '', '1', '2');
INSERT INTO `wb_menu` VALUES ('26', '23', '数据备份', 'data/backup', '', '', '1', '1');
INSERT INTO `wb_menu` VALUES ('25', '19', '访客日记', 'log/visitor', '', '', '1', '0');
INSERT INTO `wb_menu` VALUES ('27', '0', '用户管理', '', 'layui-icon-user', '27,28,29,30', '1', '4');
INSERT INTO `wb_menu` VALUES ('28', '27', '系统管理员', 'user/index', '', '', '1', '1');
INSERT INTO `wb_menu` VALUES ('29', '27', '用户组', 'user/group', '', '29,30', '1', '2');
INSERT INTO `wb_menu` VALUES ('30', '29', '权限分配', 'user/auth', '', '', '0', '3');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_shortcut`
-- -----------------------------
INSERT INTO `wb_shortcut` VALUES ('1', '文章管理', 'layui-icon-read', '/manage/article/index', '1', '1');
INSERT INTO `wb_shortcut` VALUES ('2', '添加文章', 'layui-icon-add-1', '/manage/article/add', '1', '2');
INSERT INTO `wb_shortcut` VALUES ('3', '单页管理', 'layui-icon-fonts-code', '/manage/article/single', '1', '3');

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- -----------------------------
-- Records of `wb_user`
-- -----------------------------
INSERT INTO `wb_user` VALUES ('1', '1', '1', 'admin', 'e10adc3949ba59abbe56e057f20f883e', './public/uploads/avatar/1534215311.gif', '18798075208', '1', '1533519038', '1534320884');
INSERT INTO `wb_user` VALUES ('3', '1', '1', 'mingyu', '123456', '', '18798075208', '1', '1534152368', '1534152368');
INSERT INTO `wb_user` VALUES ('16', '1', '2', 'mingyu1', 'e10adc3949ba59abbe56e057f20f883e', '', '18798075208', '1', '1534319601', '1534319601');
