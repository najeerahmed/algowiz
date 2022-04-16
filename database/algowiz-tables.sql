-- Drop any if already present
drop table if exists Answers CASCADE;
drop table if exists Questions CASCADE;
drop table if exists UserStatus CASCADE;
drop table if exists StatusDict CASCADE;
drop table if exists Topic CASCADE;
drop table if exists Users CASCADE;


-- Create the Tables

-- Create Users
Create table Users(
    user_id integer primary key auto_increment, -- Can change all IDs to auto-increment.

    -- Syntax for auto-increment:
    -- user_id MEDIUMINT NOT NULL AUTO_INCREMENT
    -- primary key (user_id)

    username varchar(20) unique not null,
    pw varchar(24) not null,
    uname varchar(50) not null,
    email varchar(50) not null,
    city varchar (30) not null,
    state varchar(30) not null,
    country varchar(30) not null,
    dob date not null,
    short_desc varchar(500), -- null allowed
    points integer not null
);

-- Insert into Users here:
INSERT INTO Users(username,pw,uname,email,city,state,country,dob,short_desc,points) VALUES ('chiefkheif','password1','Najeer Ahmed', 'nka232@nyu.edu', 'Brooklyn', 'New York', 'United States', '1994-03-08','this is a short description.', 0);


-- Create StatusDict
Create table StatusDict(
    status_id integer primary key auto_increment,
    status_title varchar(30) not null,
    point_threshold integer not null
);

-- Insert into StatusDict here:
INSERT INTO StatusDict(status_title,point_threshold) VALUES ('Beginner', 0);

-- Create UserStatus
Create table UserStatus(
    user_id integer not null,
    status_id integer not null,
    primary key(user_id, status_id),
    foreign key (user_id) references Users(user_id),
    foreign key (status_id) references StatusDict(status_id)
);

-- Insert into UserStatus
INSERT INTO UserStatus(user_id, status_id) VALUES ('1','1');

-- Create Topic
Create table Topic(
    topic_id integer primary key auto_increment,
    topic_name varchar(50) not null
);

-- Insert into Topic
INSERT INTO Topic(topic_name) VALUES ('The beginnings');

-- Questions
Create table Questions(
    question_id integer primary key auto_increment,
    topic_id integer not null,
    user_id integer not null,
    title varchar(500) not null,
    q_text varchar(2000) not null,
    q_time datetime not null,

    foreign key (topic_id) references Topic(topic_id),
    foreign key (user_id) references Users(user_id)
);

-- insert into Questions
INSERT INTO Questions(question_id,topic_id,user_id,title,q_text,q_time) VALUES ('1','1','1','What is an algorithm?','See title.','2022-04-14 15:08:32');

create table Answers(
    answer_id integer primary key auto_increment,
    user_id integer not null,
    question_id integer not null,
    thumbs_up integer not null,
    thumbs_down integer not null,
    best_answer boolean not null,
    a_text varchar(2000) not null,
    a_time datetime not null,

    foreign key (user_id) references Users(user_id),
    foreign key (question_id) references Questions(question_id)
);

-- insert into Answers
INSERT INTO Answers(answer_id,user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time) VALUES ('1','1','1',0,0,0,'An algorithm is a way of life', '2022-04-14 15:19:00');