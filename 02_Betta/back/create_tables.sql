CREATE TABLE IF NOT EXISTS `masterquestions`
(
  `id` int AUTO_INCREMENT,
  `intro` varchar(650) NOT NULL default '',
  `topic` varchar(650) NOT NULL default '',
  `diff` varchar(650) NOT NULL default '',
  `func_name` varchar(650) NOT NULL default '',
  `paramname` varchar(650) NOT NULL default '',
  `paramtype` varchar(650) NOT NULL default '',
  `inone` varchar(255) NOT NULL default '',
  `outone` varchar(255) NOT NULL default '',
  `intwo` varchar(255) NOT NULL default '',
  `outtwo` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE = InnoDB;