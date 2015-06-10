-- db = save-energy 

create table energy_user(

	id int(10) auto_increment,
	first_name varchar(100),
	last_name varchar(100),
	user_type varchar(200),
	username varchar(100) unique,
	passwd varchar(100),
	auth_token varchar(200),
	avatar varchar(100),
	resetting_password boolean,
	reset_password_time varchar(100),
	dated varchar(100),
	status varchar(100),

	primary key(id)
	
)engine=innodb;

insert into energy_user(id,user_type,username,passwd,status) values(1,"su","admin","admin","active");

create table energy_address(
	
	id int(10) auto_increment,
	user_id int(10),
	street_1 varchar(200),
	street_2 varchar(200),
	city varchar(200),
	state varchar(200),
	zipcode varchar(100),
	country varchar(200),
	dated varchar(100),
	
	primary key(id),
	foreign key(user_id) references energy_user(id) on update cascade on delete cascade
	
)engine=innodb;

create table energy_meter(

	id int(10) auto_increment,
	address_id int(10),
	reading_type varchar(200), -- day time, night time
	reading varchar(200),
	dated varchar(200),
	
	primary key(id),
	foreign key(address_id) references energy_address(id) on update cascade on delete cascade
	
)engine=innodb;
