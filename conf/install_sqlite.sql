create table #prefix#galleries (
	id integer primary key, 
	title char(72) not null, 
	description text not null, 
	folder char(128) not null, 
	thumbnail char(128) not null, 
	`date` date not null 
);