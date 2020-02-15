create table products(
	id int primary key auto_increment not null,
	images blob not null,
	title varchar(255) not null,
	description varchar(255) not null
);
create table comments(
	id int primary key auto_increment not null,
	name varchar(255) not null,
	email varchar(255) not null,
	text_field text not null,
	status varchar(20) not null
);