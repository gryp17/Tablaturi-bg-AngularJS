
--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `author_ID` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `summary` varchar(500) DEFAULT NULL,
  `content` longtext,
  `date` datetime DEFAULT NULL,
  `picture` varchar(500) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `article_comment`
--

CREATE TABLE IF NOT EXISTS `article_comment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `article_ID` int(11) DEFAULT NULL,
  `author_ID` int(11) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_article_id` (`article_ID`),
  KEY `fk_article_comment` (`author_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tab`
--

CREATE TABLE IF NOT EXISTS `tab` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `path` varchar(200) DEFAULT NULL,
  `band` varchar(200) DEFAULT NULL,
  `song` varchar(200) DEFAULT NULL,
  `version` int(11) DEFAULT NULL,
  `tab_type` varchar(20) DEFAULT NULL,
  `content` mediumtext,
  `rating` double DEFAULT NULL,
  `downloads` int(11) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `uploader_ID` int(11) DEFAULT NULL,
  `tunning` varchar(40) DEFAULT NULL,
  `difficulty` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_tab_user` (`uploader_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tab_comment`
--

CREATE TABLE IF NOT EXISTS `tab_comment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tab_ID` int(11) DEFAULT NULL,
  `author_ID` int(11) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_tab_id` (`tab_ID`),
  KEY `fk_tab_comment` (`author_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tab_rating`
--

CREATE TABLE IF NOT EXISTS `tab_rating` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tab_ID` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_tab_id` (`tab_ID`),
  KEY `fk_tab_rater` (`user_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tab_report`
--

CREATE TABLE IF NOT EXISTS `tab_report` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `reported_ID` int(11) DEFAULT NULL,
  `reporter_ID` int(11) DEFAULT NULL,
  `report` longtext,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_reported_tab` (`reported_ID`),
  KEY `fk_reporter_user_tab` (`reporter_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `birthday` datetime DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `activated` int(11) DEFAULT NULL,
  `about_me` varchar(500) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `instrument` varchar(500) DEFAULT NULL,
  `web` varchar(200) DEFAULT NULL,
  `occupation` varchar(200) DEFAULT NULL,
  `favourite_bands` varchar(500) DEFAULT NULL,
  `reputation` int(11) DEFAULT NULL,
  `last_active_date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_comment`
--

CREATE TABLE IF NOT EXISTS `user_comment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) DEFAULT NULL,
  `author_ID` int(11) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_comment_user` (`user_ID`),
  KEY `fk_comment_author` (`author_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_report`
--

CREATE TABLE IF NOT EXISTS `user_report` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `reported_ID` int(11) DEFAULT NULL,
  `reporter_ID` int(11) DEFAULT NULL,
  `report` longtext,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_reported_user` (`reported_ID`),
  KEY `fk_reporter_userr` (`reporter_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_favourite`
--

CREATE TABLE IF NOT EXISTS `user_favourite` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `tab_ID` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_favourite_tab_id` (`tab_ID`),
  KEY `fk_favourite_user_id` (`user_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- Table structure for table `user_activation`
--

CREATE TABLE IF NOT EXISTS `user_activation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) DEFAULT NULL,
  `hash` varchar(200) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_activation_user_id` (`user_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `password_reset`
--

CREATE TABLE IF NOT EXISTS `password_reset` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) DEFAULT NULL,
  `hash` varchar(200) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_password_reset_user_id` (`user_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
