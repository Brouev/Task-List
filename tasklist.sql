create database task_list;use task_list; 
create table user_id(
    id int auto_increment primary key,
    username not null unique,
    mdp not null;
)
create table task (
    id int auto_increment primary key,
    user_id int not null,
    task_name not null
    task_details
    is_done boolean default false;
)
