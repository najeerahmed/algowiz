-- Quoc data insertions
-- insert into Users relation
insert into Users(username, pw, uname, email, city, state, country, dob, short_desc, points) values ('kendalcalm', 'heavenlychild', 'Kendal Combs', 'kcbs@gmail.com', 'New York', 'NY', 'United States', '1995-05-14', 'Computer Science graduate from an Ivy League. Front end developer. JS, React, you name it ;)', 0);
insert into Users(username, pw, uname, email, city, state, country, dob, short_desc, points) values ('ashaetsy', 'blingbling123*', 'Asha Roberson', 'ar231@nyu.edu', 'New York', 'NY', 'United States', '2003-08-24', 'Liberal Arts major. Self taught developer. Currently learning algorithm and need help.', 0);
insert into Users(username, pw, uname, email, city, state, country, dob, short_desc, points) values ('mrmeyermaxi', 'maximizedprofit$', 'Maxime Meyer', 'maximizer42@aol.com', 'Los Angeles', 'California', 'United States', '1992-09-10', 'Worked in banking before and looking to make a transition into the tech field.', 0);
insert into Users(username, pw, uname, email, city, state, country, dob, short_desc, points) values ('goldsmith0', 'goldminerlol3@', 'Aliya Goldsmith', 'golden98@gmail.com', 'Orlando', 'Florida', 'United States', '1998-07-18', 'Computer Science graduate student. Currently looking for a job', 0);
insert into Users(username, pw, uname, email, city, state, country, dob, short_desc, points) values ('geonat', 'pushinp$$$', 'Nate Wilkes', 'nwiles@yahoo.com', 'Houstin', 'Texas', 'United States', '1985-04-01', 'early adopter of internet. produced startups that failed but am solid with algo. Ask me anything.', 0);
insert into Users(username, pw, uname, email, city, state, country, dob, short_desc, points) values ('yeehaw1', 'rodeoridin!', 'Neha Barlow', 'yeetbarlow@gmail.com', 'Philadelphia', 'Pennsylvania', 'United States','2001-02-05', 'Currently taking an algo class at my unveristy. Looking to develop.', 0);
insert into Users(username, pw, uname, email, city, state, country, dob, short_desc, points) values ('antmanjj', 'ant123^', 'Anton Jackson', 'antjackson@gmail.com', 'Massachusetts', 'Boston', 'United States', '1970-11-21', 'Programming enthusiasts', 0);
insert into Users(username, pw, uname, email, city, state, country, dob, short_desc, points) values ('princes9', 'charming*1*', 'Kaila Prentice', 'princess1@gmail.com', 'Beverly Hills', 'California', 'United States', '2004-06-02', 'Passionate about programming. Love algorithms.', 0);
insert into Users(username, pw, uname, email, city, state, country, dob, short_desc, points) values ('willasr2', 'willreadbooks0', 'Willa Reed', 'wilard00@gmail.com', 'Denver', 'Colorado', 'United States', '2002-03-22', 'Read a few books on algorithm. Aspire to become a fullstack developer.', 0);
insert into Users(username, pw, uname, email, city, state, country, dob, short_desc, points) values ('bernman', 'bcardi!', 'Bernard Jackson', 'bernmanson@yahoo.com', 'Jersey City', 'New Jersey', 'United States', '1980-12-15', 'Consider myself an algo expert. Open to questions about algo and anything tech related.', 0);

-- insert into Topic relation - assuming start with #6
insert into Topic (topic_name) value ('Hashing');
insert into Topic (topic_name) value ('Recursion');
insert into Topic (topic_name) value ('Sorting');
insert into Topic (topic_name) value ('Trees');
insert into Topic (topic_name) value ('Dynamic Programming');
insert into Topic (topic_name) value ('Graphs');
insert into Topic(topic_name) value ('Red Black Tree');

-- insert into UserStatus relation - assuming start with #11
insert into UserStatus value(11, 1);
insert into UserStatus value(12, 1);
insert into UserStatus value(13, 1);
insert into UserStatus value(14, 1);
insert into UserStatus value(15, 1);
insert into UserStatus value(16, 1);
insert into UserStatus value(17, 1);
insert into UserStatus value(18, 1);
insert into UserStatus value(19, 1);
insert into UserStatus value(20, 1);

-- q1 - id: 16
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('7','12','Types of Hashing','What are the different types of hash for hash map?','2022-01-13 9:03:02', 0);
-- a1
insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('17','16',0,0,0,'There are two well known types which are hash with chaining and hash with open addressing.', '2022-01-15 20:15:20');
insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('18','16',0,0,0,
        'Yeah and just wanted to point out that for open addressing, the number of elements being inserted into the hash map is less than the number of positions of available on the hash map. This is a good factor to consider which type of hashing you’d want to use.',
        '2022-01-15 22:00:15');

-- q2 - id: 17
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('7','19','Probe Sequences','What are probe sequences? And are there more than one type of probe sequences?','2021-03-19 10:21:20', 0);
-- a1
insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('14','17',0,0,0,
        'Probe sequences is a method used to probe through the hash map to see if there are any space available left to perform an insertion… There’s only one type of probe sequence known as linear probe sequence ', '2021-03-20 09:00:20');
-- a2
insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('15','17',0,0,0,
        'Probe sequence is a method used in hashing with open addressing. Because in an open addressing hashing we can’t build chains off of the hash table, we use the probe technique to find a location on the table to insert or find an element. There are several types of probe sequence: Linear, Quadratic, Double Hashing, etc.',
        '2021-03-20 14:25:01');

-- q3 - id: 18
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('7','16','Advantage of Hashmap','What are the advantages that hashmap has over linked list?','2022-02-12 15:12:20', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('18','18',0,0,0,'Basic operations on linked list including Search, Insert and Delete take O(n) or linear time to perform. However, when you use Hashmap and implement it carefully, these operations take O(1) or constant time to perform. This is a significant improvement in time complexity.',
        '2022-02-13 20:00:20');

-- q4 - id: 19 - Sorting
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('9','17','Sorting Algorithm in Linear time',
        'Are there any algorithms that perform sorting in linear time?',
        '2021-12-17 11:12:22', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('12','19',0,0,0,
        'No there aren’t any algorithms that perform in linear time. Best runtime is Merge Sort / Quick Sort with runtime of O(nlogn)',
        '2021-12-17 13:20:55');

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('18','19',0,0,0,
        'There do exist algorithms that run linear time however, they run on certain assumptions. An example is Counting Sort. The algorithm runs in linear time however, the input numbers can only be positive integers. The max number must also be reasonable as well because if it is too large, the runtime will increase accordingly.',
        '2021-12-17 14:22:20');

-- q5 - id: 20 - Sorting
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('9','11','Bucket Sort',
        'Does Bucket Sort always sort numbers in linear time?',
        '2022-01-05 09:05:30', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('16','20',0,0,0,
        'Not necessarily. It depends on the input numbers you feed to the algorithm and the number of buckets divided up to sort the algorithm. Generally to ensure a linear runtime for bucket sort, the numbers should be uniformly distributed and the number of buckets should be equally divided into ‘n’ number of buckets where n is the number of numbers used in the array.',
        '2022-01-06 08:02:32');

-- q6 - id: 21 - Sorting
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('9','13','Radix Sort and Decimal Numbers',
        'Can Radix sort be used on decimal numbers?',
        '2022-02-01 12:02:32', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('11','21',0,0,0,
        'It can’t be used.',
        '2022-02-02 12:15:21');

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('17','21',0,0,0,
        'It basically can’t however you can modify the numbers and round them to integers to use radix sort to perform sorting on them. This is because radix sort also incorporate counting sort in the algorithm to sort the numbers.',
        '2022-02-02 13:05:15');

-- id 22 - topic Trees
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('10','20','Min value at leaf',
        'Is the min value always at the leaf of the tree?',
        '2022-02-04 16:53:22', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('14','22',0,0,0,
        'Yes it is. A simple algorithm to finding the min value using a tree is to get all the leaf nodes and take the min of their value.',
        '2022-02-22 08:22:30');

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('13','22',0,0,0,
        'No it is not. The min value is always to the far left of the tree, but that node itself can have a rigth child which makes it not a leaf node.',
        '2022-02-22 15:02:22');

-- id 23 - topic trees
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('10','12','Reconstruct trees based on traversal',
        'Can you reconstruct a binary tree given its preorder traversal, inorder traversal or postorder traversal?',
        '2021-09-15 15:22:55', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('14','23',0,0,0,
        'Yes you can. With in order, you know that the value given is always the min value within the tree / subtree you’re dealing with. With pre-order, you know that the node given is the root node of the tree / subtree, and with post-order, you know that root node is at the end of the given printed traversal. So from these facts you can use to reconstruct the tree. I suggest you create a tree, perform the traversals and then reconstruct the tree to see what I mean.',
        '2022-09-15 17:02:28');

-- q10: id: 24
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('13','16','RB Tree reparation runtime',
        'What is the worst runtime to repair a red black tree?',
        '2022-02-04 16:53:22', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('17','24',0,0,0,
        'The worst case runtime to repair the RB tree is O(logn) since the worst case requires the reparation to traverse up to the root and perform a constant number of operations.',
        '2022-02-04 17:09:11');

-- q11 - id: 25
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('13','16','Min number of nodes in RB Tree',
        'What is a minimum number of nodes given the black height of the RB tree?',
        '2022-02-02 18:24:21', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('12','25',0,0,0,
        'Should be 2^2bh(x) – 1.',
        '2022-02-02 19:43:58');

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('15','25',0,0,0,
        'Because the min height of a red black tree is the height of the black height itself, the minimum number of nodes given the black height should be 2^bh(x) – 1',
        '2022-02-03 07:51:48');

-- q12 - id: 26
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('13','17','Height of RB Tree',
        'What is the height of a red black tree?',
        '2022-03-12 21:12:55', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('14','26',0,0,0,
        'The height of the red black tree depends on the longest number of edges within the tree so basically we can call this number ‘h’.',
        '2022-02-02 22:43:58');

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('18','26',0,0,0,
        'Red black tree is a balanced tree so its height is always O(logn)',
        '2022-02-03 06:22:00');

-- q13 - id: 27
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('11','11','Longest Palindromic Sequence',
        'Hi. I’m trying to solve the “Longest Palindromic Subsequence” problem but my brute force solution runtime is really long when I try to put an input for string of length 40 or above. Is there a more efficient way to solve this problem?',
        '2021-11-12 23:11:15', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('18','27',0,0,0,
        'So you can improve the runtime of this problem with dynamic programming. A hint is to consider two cases. First case is when considering the first and last characters and they are the same. Hence if the substring between them are the same then the subsequence would be the palindromic subsequence between the two plus two characters to include the ones that we are considering. Then the second case when they are not the same. Then we have to consider the subsequence after the first character and the subsequence before the last character considering. Hope this helps.',
        '2021-11-13 05:22:42');

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('19','27',0,0,0,
        'Definitely. And just to add to the above hint, you can use a 2D array to memorize the longest subsequence.',
        '2021-11-13 11:32:57');

-- q14 - id: 28
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('12','14','Graph shortest distance',
        'Is there an algorithm for graph to determine the shortest path from one node to another?',
        '2022-01-03 10:25:38', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('18','28',0,0,0,
        'Yes you can use the Bread First Search also known as BFS algorithm to solve this.',
        '2022-01-03 11:50:09');

-- q15 - id: 29
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('12','16','Strongly Connected Component',
        'I’m struggling to understand the concept of strongly connected components within a graph. One of my practice problem is asking me to determine strongly connected component but when I check the graph there are pair of vertices that doesn’t exist a two way path between each other but the solution says that there do exist strongly connected components in the graph. Can someone explain this to me?',
        '2022-01-08 13:12:58', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('17','29',0,0,0,
        'Hey OP. It would be best if you can post a picture of the graph but from what I read you are understanding the concept wrongly. SCC doesn’t refer to the entire graph but rather is a maximal set of vertices such that directed paths exist between every pair of vertices. A graph doesn’t need to be entirely strongly connected to have strongly connected component.',
        '2022-01-08 16:41:38');

-- id: 30
insert into Questions(topic_id,user_id,title,q_text,q_time, resolved)
values ('12','15','Topological Order',
        'When sorting nodes in graph what does topological order mean?',
        '2022-04-01 22:10:05', 0);

insert into Answers(user_id,question_id,thumbs_up,thumbs_down,best_answer,a_text,a_time)
values ('18','29',0,0,0,
        'Basically once you lay out the nodes in a topological order the nodes should be such that set (u,v) has vertex u before v',
        '2022-04-02 09:02:53');