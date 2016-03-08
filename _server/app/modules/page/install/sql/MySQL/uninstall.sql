SET @sModule = 'page';
SET @sVendor = 'HiZup, Ltd';

DROP TABLE IF EXISTS H2O_Page;
DELETE FROM H2O_FooterMenu WHERE module = @sModule AND vendor = @sVendor;