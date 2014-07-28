create table #prefix#galleries (
	id int not null auto_increment primary key, 
	title char(72) not null, 
	description text not null, 
	folder char(128) not null, 
	thumbnail char(128) not null, 
	`date` date not null 
);