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
    user_id varchar(10) primary key, -- Can change all IDs to auto-increment.
    
    -- Syntax for auto-increment:
    -- user_id MEDIUMINT NOT NULL AUTO_INCREMENT
    -- primary key (user_id)
    
    username varchar(20) not null,
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
INSERT INTO Users(user_id,username,pw,uname,email,city,state,country,dob,short_desc,points) VALUES ('U001','chiefkheif','password1','Najeer Ahmed', 'nka232@nyu.edu', 'Brooklyn', 'New York', 'United States', '1994-03-08','this is a short description.', 0);


-- Create StatusDict
Create table StatusDict(
    status_id varchar(4) primary key,
    status_title varchar(30) not null,
    point_threshold integer not null
);

-- Insert into StatusDict here:
INSERT INTO StatusDict(status_id,status_title,point_threshold) VALUES ('S001','Noob', 0);

-- Create UserStatus
Create table UserStatus(
    user_id varchar(10) not null,
    status_id varchar(4) not null,
    primary key(user_id, status_id)
);

-- Insert into UserStatus
INSERT INTO UserStatus(user_id,status_id) VALUES ('U001','S001');

-- Create Topic
Create table Topic(
    topic_id varchar(4) primary key,
    topic_name varchar(30) not null
);

-- Insert into Topic
INSERT INTO Topic(topic_id, topic_name) VALUES ('T001', 'The beginnings');

-- Questions
Create table Questions(
    question_id varchar(20) primary key,
    topic_id varchar(4) not null,
    user_id varchar(10) not null,
    title varchar(30) not null,
    q_text varchar(1000) not null,
    q_time datetime not null,
    
    foreign key (topic_id) references Topic(topic_id),
    foreign key (user_id) references Users(user_id)
);

-- insert into Questions
INSERT INTO Questions(question_id,topic_id,user_id,title,q_text,q_time) VALUES ('Q001','T001','U001','What is an algorithm?','See title.','2022-04-14 15:08:32');

create table Answers(
    answer_id varchar(40) primary key,
    user_id varchar(10) not null,
    question_id varchar(20) not null,
    thumbs_up integer not null,
    thumbs_down integer not null,
    best_answer boolean not null,
    a_text varchar(2000) not null,
    a_time datetime not null,
    
    foreign key (user_id) references Users(user_id),
    foreign key (question_id) references Questions(question_id)
);

-- insert into Answers
INSERT INTO Answers(answer_id,user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time) VALUES ('A001','U001','Q001',0,0,0,'An algorithm is a way of life', '2022-04-14 15:19:00');
