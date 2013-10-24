-- Advent schema, optimised for MySQL

DROP TABLE IF EXISTS imagetags;
DROP TABLE IF EXISTS posttags;
DROP TABLE IF EXISTS producttags;
DROP TABLE IF EXISTS tags;
DROP TABLE IF EXISTS productimages;
DROP TABLE IF EXISTS productoptions;
DROP TABLE IF EXISTS producttypes;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS posts;
DROP TABLE IF EXISTS users;

-- maybe one day will have need of multiple user accounts
CREATE TABLE users (
	id int(11) NOT NULL AUTO_INCREMENT,
	username varchar(100) NOT NULL,
	displayname varchar(100) NOT NULL,
	saltedpass varchar(256) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY username (username)
);

-- generic text posts
CREATE TABLE posts (
	id int(11) NOT NULL AUTO_INCREMENT,
	title varchar(128) NOT NULL,
	slug varchar(128) NOT NULL,
	author int(11) NOT NULL,
	created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	blurb varchar(256) NOT NULL,
	content text NOT NULL,
	PRIMARY KEY (id),
	KEY slug (slug),
	FOREIGN KEY (author)
		REFERENCES users(id)
		ON DELETE RESTRICT
);

-- photos etc (still havent thought out schema for this)
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
		ON DELETE SET NULL
		ON UPDATE CASCADE
);

-- types for product options
CREATE TABLE producttypes (
	id int(11) NOT NULL AUTO_INCREMENT,
	productid int(11) NOT NULL,
	type varchar(50) NOT NULL,
	PRIMARY KEY (id),
	INDEX (type),
	FOREIGN KEY (productid)
		REFERENCES products(id)
		ON DELETE CASCADE
);

-- optional features for products. May revise
CREATE TABLE productoptions (
	id int(11) NOT NULL AUTO_INCREMENT,
	optionname varchar(50) NOT NULL,
	type varchar(50) NOT NULL,
	surcharge decimal(19,4),
	PRIMARY KEY (id),
	FOREIGN KEY (type)
		REFERENCES producttypes(type)
		ON DELETE CASCADE
);

-- tags for products
CREATE TABLE productimages (
	productid int(11) NOT NULL,
	imageid int(11) NOT NULL,
	PRIMARY KEY (productid,imageid),
	FOREIGN KEY (productid)
		REFERENCES products(id)
		ON DELETE CASCADE,
	FOREIGN KEY (imageid)
		REFERENCES images(id)
		ON DELETE CASCADE
);

-- normalised tag table
CREATE TABLE tags (
	id int(11) NOT NULL AUTO_INCREMENT,
	tagname varchar(50),
	PRIMARY KEY(id),
	UNIQUE KEY tag (tagname)
);

-- tags for products
CREATE TABLE producttags (
	productid int(11) NOT NULL,
	tagid int(11) NOT NULL,
	PRIMARY KEY (productid,tagid),
	FOREIGN KEY (productid)
		REFERENCES products(id)
		ON DELETE CASCADE,
	FOREIGN KEY (tagid)
		REFERENCES tags(id)
		ON DELETE CASCADE
);

-- tags for text posts
CREATE TABLE posttags (
	postid int(11) NOT NULL,
	tagid int(11) NOT NULL,
	PRIMARY KEY (postid,tagid),
	FOREIGN KEY (postid)
		REFERENCES posts(id)
		ON DELETE CASCADE,
	FOREIGN KEY (tagid)
		REFERENCES tags(id)
		ON DELETE CASCADE
);

-- tags for images
CREATE TABLE imagetags (
	imageid int(11) NOT NULL,
	tagid int(11) NOT NULL,
	PRIMARY KEY (imageid,tagid),
	FOREIGN KEY (imageid)
		REFERENCES images(id)
		ON DELETE CASCADE,
	FOREIGN KEY (tagid)
		REFERENCES tags(id)
		ON DELETE CASCADE
);