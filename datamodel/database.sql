CREATE TABLE IF NOT EXISTS `agenda` (
  `agen_id`      INT(11)      NOT NULL AUTO_INCREMENT,
  `agen_user_id` INT(11)      NOT NULL,
  `agen_title`   VARCHAR(255) NOT NULL,
  `agen_content` TEXT         NOT NULL,
  `agen_start`   DATETIME     NOT NULL,
  `agen_end`     DATETIME     NOT NULL,
  `agen_cate_id` INT(11)               DEFAULT NULL,
  PRIMARY KEY (`agen_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET utf8;

CREATE TABLE IF NOT EXISTS `category` (
  `cate_id`      INT(11)      NOT NULL AUTO_INCREMENT,
  `cate_user_id` INT(11)      NOT NULL,
  `cate_title`   VARCHAR(255) NOT NULL,
  `cate_color`   CHAR(6)      NOT NULL,
  PRIMARY KEY (`cate_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `post` (
  `post_id`         INT(11)  NOT NULL AUTO_INCREMENT,
  `post_user_id`    INT(11)  NOT NULL,
  `post_content`    TEXT,
  `post_created_at` DATETIME NOT NULL,
  `post_updated_at` DATETIME NOT NULL,
  PRIMARY KEY (`post_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `todo` (
  `todo_id`      INT(11) NOT NULL AUTO_INCREMENT,
  `todo_user_id` INT(11) NOT NULL,
  `todo_content` TEXT    NOT NULL,
  PRIMARY KEY (`todo_id`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `user` (
  `user_id`    INT(11)      NOT NULL AUTO_INCREMENT,
  `user_mail`  VARCHAR(255) NOT NULL,
  `user_pwd`   CHAR(128)    NOT NULL,
  `user_login` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_mail` (`user_mail`),
  UNIQUE KEY `user_login` (`user_login`)
)
  ENGINE = MyISAM
  DEFAULT CHARSET = utf8;

