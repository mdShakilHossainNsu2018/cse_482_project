drop table if exists users;
create table users (user_id  int auto_increment primary key, email varchar(30) unique, username varchar(30), password varchar(30));


