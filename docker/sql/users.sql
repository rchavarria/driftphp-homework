--
-- Create database and table for Users
--
create database usersdb;

use usersdb;

create table users
(
    uid  varchar(64) default '' not null primary key,
    name varchar(255)           not null
);

-- initial users
insert into users (uid, name)
values ('plnctn', 'Plancton, el origen');
