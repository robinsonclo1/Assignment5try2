drop database if exists dogsdb;
create database if not exists dogsdb;

use dogsdb;

create table breeds(
	breed_id int unsigned not null auto_increment primary key,
    breed_name nvarchar(50) not null,
    created_date datetime default current_timestamp
);

create table dogs(
	dog_id int unsigned not null auto_increment primary key,
    dog_name nvarchar(100) not null,
    breed_id int unsigned,
    age int unsigned,
    is_fixed boolean,
    is_vaccinated boolean,
    created_date datetime default current_timestamp,
    foreign key (breed_id) references breeds(breed_id)
);

# some sample data
insert into breeds (breed_name) values ('Collie'),
	('Retriever'), ('Lab'), ('Shepherd'), ('Beagle');
