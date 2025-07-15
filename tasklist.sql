create database if not exists tasklist;
use tasklist; 
create table if not exists users(
    id int auto_increment primary key,
    username not null unique,
    mdp not null
);
create table if not exists tasks (
    id int auto_increment primary key,
    users_id int not null,
    task_name varchar(255) not null,
    task_details text,
    is_done boolean default false;
    foreign key (users_id) references users(id) on delete cascade 
);