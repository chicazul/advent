-- Advent schema

-- generic text posts
DROP TABLE IF EXISTS 'posts';
CREATE TABLE 'posts' (
	'id' int(11) NOT NULL AUTO_INCREMENT,
	'author' int(11) NOT NULL,
	'datecreated' timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	'datesaved' timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	'contents' text NOT NULL,
	PRIMARY KEY('id')
)

-- maybe one day will have need of multiple user accounts
DROP TABLE IF EXISTS 'users';
CREATE TABLE 'users' (
	'id' int(11) NOT NULL AUTO_INCREMENT,
	'username' varchar(100) NOT NULL,
	'displayname' varchar(100) NOT NULL,
	PRIMARY KEY('id'),
	UNIQUE KEY 'username' ('username')
)

-- photos etc (still haven't thought out schema for this)
DROP TABLE IF EXISTS 'images';
CREATE TABLE 'images' (
	'id' int(11) NOT NULL AUTO_INCREMENT,
	'artist' varchar(100) NOT NULL,
	'description' text NOT NULL,
	'image' varchar(250) NOT NULL DEFAULT '',
	'thumbnail' varchar(250) DEFAULT '',
	PRIMARY KEY('id')
)

-- products to sell
DROP TABLE IF EXISTS 'products';
CREATE TABLE 'products' (
	'id' int(11) NOT NULL AUTO_INCREMENT,
	'productname' varchar(100) NOT NULL,
	'description' text NOT NULL,
	'price' decimal(19,4),
	PRIMARY KEY('id')
)

-- optional features for products. May revise
DROP TABLE IF EXISTS 'productoptions';
CREATE TABLE 'productoptions' (
	'id' int(11) NOT NULL AUTO_INCREMENT,
	'optionname' varchar(50) NOT NULL,
	'type' varchar(50) NOT NULL,
	'surcharge' decimal(19,4),
	PRIMARY KEY('id')
)

DROP TABLE IF EXISTS 'tags';
CREATE TABLE 'tags' (
	'id' int(11) NOT NULL AUTO_INCREMENT,
	'tagname' varchar(50),
	PRIMARY KEY('id'),
	UNIQUE KEY 'tag' ('tagname')
)

DROP TABLE IF EXISTS 'producttags';
CREATE TABLE 'producttags' (
	'productid' int(11) NOT NULL,
	'tagid' int(11),
	PRIMARY KEY('productid','tagid')
)

DROP TABLE IF EXISTS 'posttags';
CREATE TABLE 'posttags' (
	'postid' int(11) NOT NULL,
	'tagid' int(11),
	PRIMARY KEY('postid','tagid')
)

DROP TABLE IF EXISTS 'imagetags';
CREATE TABLE 'imagetags' (
	'imageid' int(11) NOT NULL,
	'tagid' int(11),
	PRIMARY KEY('imageid','tagid')
)