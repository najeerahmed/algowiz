-- Drop any if already present
drop table if exists TopicHierarchy CASCADE;
drop table if exists Answers CASCADE;
drop table if exists Questions CASCADE;
drop table if exists UserStatus CASCADE;
drop table if exists StatusDict CASCADE;
drop table if exists Topic CASCADE;
drop table if exists Users CASCADE;
drop table if exists UsersLogin CASCADE;
drop table if exists UsersInfo CASCADE;


-- Create the Tables

-- Create Users
Create table UsersLogin(
    user_id integer primary key auto_increment,
    username varchar(20) unique not null,
    pw varchar(24) not null
);

Create table UsersInfo(
    user_id integer primary key,
    uname varchar(100) not null,
    email varchar(50) not null,
    city varchar (30) not null,
    state varchar(30) not null,
    country varchar(30) not null,
    dob date not null,
    short_desc varchar(500), -- null allowed
    points integer not null,
    foreign key (user_id) references UsersLogin(user_id)
);



-- Create StatusDict
Create table StatusDict(
    status_id integer primary key auto_increment,
    status_title varchar(30) not null,
    point_threshold integer not null
);

-- Create UserStatus
Create table UserStatus(
    user_id integer not null,
    status_id integer not null,
    primary key(user_id, status_id),
    foreign key (user_id) references UsersLogin(user_id),
    foreign key (status_id) references StatusDict(status_id)
);

-- Create Topic
Create table Topic(
    topic_id integer primary key auto_increment,
    topic_name varchar(50) not null
);

-- Questions
Create table Questions(
    question_id integer primary key auto_increment,
    topic_id integer not null,
    user_id integer not null,
    title varchar(500) not null,
    q_text varchar(2000) not null,
    q_time datetime not null,
    resolved boolean not null,
    
    foreign key (topic_id) references Topic(topic_id),
    foreign key (user_id) references UsersLogin(user_id)
);



create table Answers(
    answer_id integer primary key auto_increment,
    user_id integer not null,
    question_id integer not null,
    thumbs_up integer not null,
    thumbs_down integer not null,
    best_answer boolean not null,
    a_text varchar(2000) not null,
    a_time datetime not null,
    
    foreign key (user_id) references UsersLogin(user_id),
    foreign key (question_id) references Questions(question_id)
);

-- Create ThumbsUp relation
create table ThumbsUp (
    user_id integer not null,
    answer_id integer not null,

    foreign key (user_id) references UsersLogin(user_id),
    foreign key (answer_id) references Answers(answer_id)
);

-- Create ThumbsDown relation
create table ThumbsDown (
    user_id integer not null,
    answer_id integer not null,

    foreign key (user_id) references UsersLogin(user_id),
    foreign key (answer_id) references Answers (answer_id)
);

create table TopicHierarchy (
    topic_id integer, 
    subtopic_id integer,
    primary key(topic_id, subtopic_id),
    foreign key (topic_id) references Topic(topic_id),
    foreign key (subtopic_id) references Topic(topic_id)
);