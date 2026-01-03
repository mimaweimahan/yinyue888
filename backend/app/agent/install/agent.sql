SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `tisktshop`
--

-- --------------------------------------------------------

--
-- 表的结构 `tp_agent`
--

CREATE TABLE `tp_agent` (
    `agent_id` int(11) NOT NULL COMMENT '代理ID',
    `username` varchar(60) NOT NULL COMMENT '登陆帐号',
    `nickname` varchar(60) NOT NULL COMMENT '账号昵称',
    `password` varchar(255) NOT NULL COMMENT '登陆密码',
    `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开启状态[1开,0关]',
    `is_bind` tinyint(1) NOT NULL DEFAULT '0' COMMENT '绑定谷歌验证[1是,0否]',
    `telegram` varchar(255) DEFAULT NULL COMMENT 'telegram号',
    `last_ip` varchar(60) DEFAULT NULL COMMENT '最后登陆ID',
    `last_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最后登陆时间',
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='代理商';

--
-- 转储表的索引
--

--
-- 表的索引 `tp_agent`
--
ALTER TABLE `tp_agent`
    ADD PRIMARY KEY (`agent_id`),
  ADD KEY `username` (`username`),
  ADD KEY `status` (`status`),
  ADD KEY `is_bind` (`is_bind`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tp_agent`
--
ALTER TABLE `tp_agent`
    MODIFY `agent_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '代理ID';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;