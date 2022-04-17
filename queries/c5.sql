with num_questions as(
select topic_id, count(question_id) as q_num
from Questions
group by topic_id
)
, num_answers as (
select topic_id, count(answer_id) as a_num
from Questions join Answers using (question_id)
group by topic_id
)
select topic_id, topic_name, q_num, a_num
from num_questions join num_answers using (topic_id) join Topic using (topic_id)