-- Advent schema, optimised for MySQL

-- maybe one day will have need of multiple user accounts
CREATE TABLE IF NOT EXISTS users (
	id int(11) NOT NULL AUTO_INCREMENT,
	username varchar(100) NOT NULL,
	displayname varchar(100) NOT NULL,
	password varchar(256) NOT NULL,
	email varchar(256),
	PRIMARY KEY (id),
	UNIQUE KEY username (username)
);

-- default CI session persistence
CREATE TABLE IF NOT EXISTS ci_sessions (
	id varchar(40) NOT NULL,
	ip_address varchar(45) NOT NULL,
	timestamp int(10) unsigned DEFAULT 0 NOT NULL,
	data blob NOT NULL,
	PRIMARY KEY (id),
	KEY ci_sessions_timestamp (timestamp)
);


-- generic text posts
CREATE TABLE IF NOT EXISTS posts (
	id int(11) NOT NULL AUTO_INCREMENT,
	title varchar(128) NOT NULL,
	slug varchar(128) NOT NULL,
	author int(11) NOT NULL,
	created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	blurb varchar(256) NOT NULL,
	content text NOT NULL,
	PRIMARY KEY (id),
	UNIQUE KEY slug (slug)
);

-- photos etc (still haven't thought out schema for this)
CREATE TABLE IF NOT EXISTS images (
	id int(11) NOT NULL AUTO_INCREMENT,
	artist varchar(128) NOT NULL,
	source varchar(128) NOT NULL,
	description text NOT NULL,
	image varchar(250) NOT NULL,
	thumbnail varchar(250),
	PRIMARY KEY (id)
);

-- products to sell
CREATE TABLE IF NOT EXISTS products (
	id int(11) NOT NULL AUTO_INCREMENT,
	productname varchar(100) NOT NULL,
	slug varchar(128) NOT NULL,
	description text NOT NULL,
	price decimal(19,4),
	PRIMARY KEY (id),
	UNIQUE KEY slug (slug)
);

-- Optional product attributes
CREATE TABLE IF NOT EXISTS productattributes (
	id int(11) NOT NULL AUTO_INCREMENT,
	attributename varchar(50) NOT NULL,
	PRIMARY KEY (id),
	INDEX (attributename)
);

-- options for product attributes.
CREATE TABLE IF NOT EXISTS attributeoptions (
	id int(11) NOT NULL AUTO_INCREMENT,
	optionname varchar(50) NOT NULL,
	surcharge decimal(19,4),
	PRIMARY KEY (id)
);

-- Tags
CREATE TABLE IF NOT EXISTS tags (
	id int(11) NOT NULL AUTO_INCREMENT,
	tagname varchar(100),
	PRIMARY KEY(id),
	UNIQUE KEY tag (tagname)
);

-- Groups
CREATE TABLE IF NOT EXISTS groups (
	id int(11) NOT NULL AUTO_INCREMENT,
	name varchar(50) NOT NULL,
	description text,
	level int(11) NOT NULL,
	PRIMARY KEY(id)
);

-- Join table - Posts can have Users (authors)
CREATE TABLE IF NOT EXISTS posts_users (
	post_id int(11) NOT NULL,
	user_id int(11) NOT NULL,
	PRIMARY KEY (post_id,user_id),
	FOREIGN KEY (post_id)
		REFERENCES posts(id)
		ON DELETE CASCADE,
	FOREIGN KEY (user_id)
		REFERENCES users(id)
		ON DELETE CASCADE
);

-- Join table - Products can have many images
CREATE TABLE IF NOT EXISTS products_images (
	product_id int(11) NOT NULL,
	image_id int(11) NOT NULL,
	PRIMARY KEY (product_id,image_id),
	FOREIGN KEY (product_id)
		REFERENCES products(id)
		ON DELETE CASCADE,
	FOREIGN KEY (image_id)
		REFERENCES images(id)
		ON DELETE CASCADE
);

-- Join table - Products can have many product attributes
CREATE TABLE IF NOT EXISTS products_productattributes (
	id int(11) NOT NULL AUTO_INCREMENT,
	product_id int(11) NOT NULL,
	productattribute_id int(11) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (product_id)
		REFERENCES products(id)
		ON DELETE CASCADE,
	FOREIGN KEY (productattribute_id)
		REFERENCES productattributes(id)
		ON DELETE CASCADE
);

-- Join table - Product attributes can have many options
CREATE TABLE IF NOT EXISTS productattributes_attributeoptions (
	id int(11) NOT NULL AUTO_INCREMENT,
	productattribute_id int(11) NOT NULL,
	attributeoption_id int(11) NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (productattribute_id)
		REFERENCES productattributes(id)
		ON DELETE CASCADE,
	FOREIGN KEY (attributeoption_id)
		REFERENCES attributeoptions(id)
		ON DELETE CASCADE
);

-- Join table - tags for products
CREATE TABLE IF NOT EXISTS products_tags (
	product_id int(11) NOT NULL,
	tag_id int(11) NOT NULL,
	PRIMARY KEY (product_id,tag_id),
	FOREIGN KEY (product_id)
		REFERENCES products(id)
		ON DELETE CASCADE,
	FOREIGN KEY (tag_id)
		REFERENCES tags(id)
		ON DELETE CASCADE
);

-- Join table - tags for text posts
CREATE TABLE IF NOT EXISTS posts_tags (
	post_id int(11) NOT NULL,
	tag_id int(11) NOT NULL,
	PRIMARY KEY (post_id,tag_id),
	FOREIGN KEY (post_id)
		REFERENCES posts(id)
		ON DELETE CASCADE,
	FOREIGN KEY (tag_id)
		REFERENCES tags(id)
		ON DELETE CASCADE
);

-- Join table - tags for images
CREATE TABLE IF NOT EXISTS images_tags (
	image_id int(11) NOT NULL,
	tag_id int(11) NOT NULL,
	PRIMARY KEY (image_id,tag_id),
	FOREIGN KEY (image_id)
		REFERENCES images(id)
		ON DELETE CASCADE,
	FOREIGN KEY (tag_id)
		REFERENCES tags(id)
		ON DELETE CASCADE
);