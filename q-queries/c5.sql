select topic_name, count(distinct Answers.question_id) as number_questions, count(answer_id) as number_answers
from Topic join Questions on Topic.topic_id = Questions.topic_id
join Answers on Questions.question_id = Answers.question_id
group by Topic.topic_id;