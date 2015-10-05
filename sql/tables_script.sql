create table tbl_homedata (
	code Int NOT NULL AUTO_INCREMENT,
	propertyLabel text ,
	propertyName varchar(50) ,
	propertyValue text ,
	UNIQUE (propertyName),
	Primary Key (code)) ENGINE = InnoDB;
insert into tbl_homedata (propertyLabel,propertyName,propertyValue) values  
('Site Title','siteTitle','Site Title') , 
('Site Heading Top','siteHeadingTop','Site Heading Top') ,
('Site Heading','siteHeading','Site Heading') ,
('Site Sub-Heading','siteSubHeading','Site Sub Heading') ,
('Copyright Text','copyrightText','Copyright Text') ,
('Contact Section Title','contactSectionTitle','Contact Section Title') ,
('Office Address Section Title','officeAddressTitle','office Address Section Title') ,
('Office Address','officeAddress','Office address') ,
('About Section Title','aboutSectionTitle','About section Title') ,
('About Section Column 1','aboutColumn1','First column - about Section') ,
('About Section Column 2','aboutColumn2','Second column - about Section') ,
('Social Media section Title','socialMediaSectionTitle','Social Media section Title') ,
('Facebook Link','facebookLink','#') ,
('Twitter Link','twitterLink','#') ,
('Google+ Link','googlePlusLink','#') ,
('LinkedIn Link','linkedInLink','#') ,
('Portfolio Section ','portfolioSectionTitle','Portfolio section title') ;
create table tbl_portfolio (
	code Int NOT NULL AUTO_INCREMENT,
	name text ,
	description text ,
	image text ,
	UNIQUE (code),
	Primary Key (code)) ENGINE = InnoDB;
insert into tbl_portfolio (name , description,image) values ('Name 1', 'description of the folowing item','img/portfolio/1.png');
insert into tbl_portfolio (name , description,image) values ('Name 2', 'description of the folowing item','img/portfolio/2.png');
insert into tbl_portfolio (name , description,image) values ('Name 3', 'description of the folowing item','img/portfolio/3.png');
insert into tbl_portfolio (name , description,image) values ('Name 4', 'description of the folowing item','img/portfolio/4.png');
insert into tbl_portfolio (name , description,image) values ('Name 5', 'description of the folowing item','img/portfolio/5.png');
insert into tbl_portfolio (name , description,image) values ('Name 6', 'description of the folowing item','img/portfolio/6.png');
create table tbl_user (
	code Int NOT NULL AUTO_INCREMENT,
	name text ,
	username char(20)  ,
	password char(100) ,
	UNIQUE (code),
	UNIQUE (username),
	Primary Key (code)) ENGINE = InnoDB;
insert into tbl_user (name,username,password ) values ('admin','admin',md5('admin'));