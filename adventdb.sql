-- Advent schema, optimised for MySQL

-- generic text posts
DROP TABLE IF EXISTS posts;
CREATE TABLE posts (
	id int(11) NOT NULL AUTO_INCREMENT,
	title varchar(128) NOT NULL,
	slug varchar(128) NOT	NULL,
	author int(11) NOT NULL,
	created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	blurb varchar(256) NOT NULL,
	content text NOT NULL,
	PRIMARY KEY (id),
	KEY slug (slug),
	FOREIGN KEY (author)
		REFERENCES users(id)
);

-- maybe one day will have need of multiple user accounts
DROP TABLE IF EXISTS users;
CREATE TABLE users (
	id int(11) NOT NULL AUTO_INCREMENT,
	username varchar(100) NOT NULL,
	displayname varchar(100) NOT NULL,
	saltedpass varchar(256) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY username (username)
);

-- photos etc (still havent thought out schema for this)
DROP TABLE IF EXISTS images;
CREATE TABLE images (
	id int(11) NOT NULL AUTO_INCREMENT,
	artist varchar(128) NOT NULL,
	source varchar(128) NOT NULL,
	description text NOT NULL,
	image varchar(250) NOT NULL,
	thumbnail varchar(250),
	PRIMARY KEY (id)
);

-- products to sell
DROP TABLE IF EXISTS products;
CREATE TABLE products (
	id int(11) NOT NULL AUTO_INCREMENT,
	productname varchar(100) NOT NULL,
	slug varchar(128) NOT NULL,
	description text NOT NULL,
	price decimal(19,4),
	thumbnailid int(11),
	PRIMARY KEY (id),
	FOREIGN KEY (thumbnailid)
		REFERENCES images(id)
);

-- optional features for products. May revise
DROP TABLE IF EXISTS productoptions;
CREATE TABLE productoptions (
	id int(11) NOT NULL AUTO_INCREMENT,
	optionname varchar(50) NOT NULL,
	type varchar(50) NOT NULL,
	surcharge decimal(19,4),
	PRIMARY KEY (id),
	FOREIGN KEY (type)
		REFERENCES producttypes(type)
);

-- types for product options
DROP TABLE IF EXISTS producttypes;
CREATE TABLE producttypes (
	id int(11) NOT NULL AUTO_INCREMENT,
	productid int(11) NOT NULL,
	type varchar(50) NOT NULL,
	PRIMARY KEY (id),
	INDEX (type),
	FOREIGN KEY (productid)
		REFERENCES products(id)
);


-- tags for products
DROP TABLE IF EXISTS productimages;
CREATE TABLE productimages (
	productid int(11) NOT NULL,
	imageid int(11) NOT NULL,
	PRIMARY KEY (productid,imageid),
	FOREIGN KEY (productid)
		REFERENCES products(id),
	FOREIGN KEY (imageid)
		REFERENCES images(id)
);

-- normalised tag table
DROP TABLE IF EXISTS tags;
CREATE TABLE tags (
	id int(11) NOT NULL AUTO_INCREMENT,
	tagname varchar(50),
	PRIMARY KEY(id),
	UNIQUE KEY tag (tagname)
);

-- tags for products
DROP TABLE IF EXISTS producttags;
CREATE TABLE producttags (
	productid int(11) NOT NULL,
	tagid int(11) NOT NULL,
	PRIMARY KEY (productid,tagid),
	FOREIGN KEY (productid)
		REFERENCES products(id),
	FOREIGN KEY (tagid)
		REFERENCES tags(id)
);

-- tags for text posts
DROP TABLE IF EXISTS posttags;
CREATE TABLE posttags (
	postid int(11) NOT NULL,
	tagid int(11) NOT NULL,
	PRIMARY KEY (postid,tagid),
	FOREIGN KEY (postid)
		REFERENCES posts(id),
	FOREIGN KEY (tagid)
		REFERENCES tags(id)
);

-- tags for images
DROP TABLE IF EXISTS imagetags;
CREATE TABLE imagetags (
	imageid int(11) NOT NULL,
	tagid int(11) NOT NULL,
	PRIMARY KEY (imageid,tagid),
	FOREIGN KEY (imageid)
		REFERENCES images(id),
	FOREIGN KEY (tagid)
		REFERENCES tags(id)
);