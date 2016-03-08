SET @sModule = 'page';
SET @sVendor = 'HiZup, Ltd';

CREATE TABLE IF NOT EXISTS H2O_Page (
  pageId tinyint(3) unsigned NOT NULL,
  title varchar(120) NOT NULL,
  text text,
  PRIMARY KEY (pageId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO H2O_Page (pageId, title, text) VALUES
(1, 'Privacy Policy', 'PLEASE EDIT THIS PAGE IN YOUR ADMINISTRATION PANEL<br /><br /><br />'),
(2, 'About Us', 'PLEASE EDIT THIS PAGE IN YOUR ADMINISTRATION PANEL<br /><br /><br />'),
(3, 'Contact Us', 'For any feedback, please contact us at: YOUR-EMAIL [AT] YOUR-HOST-MAIL [DOT] COM<br /><br /><br />');

INSERT INTO H2O_FooterMenu (uri, module, vendor, order) VALUES
('?m=page&n=contact', @sModule, @sVendor, 1),
('?m=page&n=about', @sModule, @sVendor, 2),
('?m=page&n=privacy', @sModule, @sVendor, 3);