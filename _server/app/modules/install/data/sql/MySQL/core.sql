--
-- Author:        Pierre-Henry Soria <ph7software@gmail.com>
-- Copyright:     (c) 2014, Pierre-Henry Soria. All Rights Reserved.
-- License:       See H2O.LICENSE.txt and H2O.COPYRIGHT.txt in the root directory.
-- Link           http://hizup.com
--

CREATE TABLE IF NOT EXISTS H2O_Admin (
  profileId tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  email varchar(120) NOT NULL,
  password varchar(120) NOT NULL,
  name varchar(50) DEFAULT NULL,
  lang char(2) NOT NULL DEFAULT 'en',
  timeZone varchar(6) NOT NULL DEFAULT '-6',
  joinDate datetime DEFAULT NULL,
  lastActivity datetime DEFAULT NULL,
  lastEdit datetime DEFAULT NULL,
  ip varchar(45) NOT NULL DEFAULT '127.0.0.1',
  PRIMARY KEY (profileId),
  UNIQUE KEY email (email)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS H2O_Affiliate (
  profileId tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  email varchar(120) NOT NULL,
  password varchar(120) NOT NULL,
  name varchar(50) DEFAULT NULL,
  companyName varchar(50) DEFAULT NULL,
  lang char(2) NOT NULL DEFAULT 'en',
  timeZone varchar(6) NOT NULL DEFAULT '-6',
  bankAccount varchar(150) DEFAULT NULL,
  amount decimal(8,2) NOT NULL DEFAULT '0.00',
  totalPayment decimal(8,2) NOT NULL DEFAULT '0.00',
  lastPayment decimal(8,2) NOT NULL DEFAULT '0.00',
  lastPaymentDate datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  refer int(10) unsigned DEFAULT 0,
  joinDate datetime DEFAULT NULL,
  lastActivity datetime DEFAULT NULL,
  lastEdit datetime DEFAULT NULL,
  ip varchar(45) NOT NULL DEFAULT '127.0.0.1',
  PRIMARY KEY (profileId),
  UNIQUE KEY email (email)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS H2O_Ad (
  adId tinyint(3) unsigned NOT NULL,
  code text,
  PRIMARY KEY (adId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO H2O_Ad (adId, code) VALUES
(1, '<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-8560246457913786" data-ad-slot="9865718955"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({})</script><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>'),
(2, '<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-8560246457913786" data-ad-slot="9865718955"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({})</script><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>'),
(3, '<ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px" data-ad-client="ca-pub-8560246457913786" data-ad-slot="9785735354"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({})</script><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>');


CREATE TABLE IF NOT EXISTS H2O_Analytics (
  analyticsId tinyint(3) unsigned NOT NULL,
  code text,
  PRIMARY KEY (analyticsId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO H2O_Analytics (analyticsId, code) VALUES
(1, '<script>(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');ga(\'create\',\'UA-YOUR-ID\',\'YOUR-WEBSITE.com\');ga(\'send\',\'pageview\');</script>');


CREATE TABLE IF NOT EXISTS H2O_Module (
  moduleId smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  vendorName varchar(40) NOT NULL,
  moduleName varchar(40) NOT NULL,
  version smallint(4) NOT NULL,
  uri varchar(40) DEFAULT NULL,
  path varchar(255) DEFAULT NULL,
  active enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (moduleId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS H2O_TopMenu (
  menuId smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  vendorName varchar(40) NOT NULL,
  moduleName varchar(40) NOT NULL,
  controllerName varchar(40) NOT NULL,
  actionName varchar(40) NOT NULL,
  vars varchar(60) DEFAULT NULL,
  parentMenu smallint(4) unsigned DEFAULT NULL,
  grandParentMenu smallint(4) unsigned DEFAULT NULL,
  onlyForUsers enum('0','1') NOT NULL DEFAULT '0',
  active enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (menuId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS H2O_BottomMenu (
  menuId smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  vendorName varchar(40) NOT NULL,
  moduleName varchar(40) NOT NULL,
  controllerName varchar(40) NOT NULL,
  actionName varchar(40) NOT NULL,
  vars varchar(60) DEFAULT NULL,
  parentMenu smallint(4) unsigned DEFAULT NULL,
  grandParentMenu smallint(4) unsigned DEFAULT NULL,
  active enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (menuId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;