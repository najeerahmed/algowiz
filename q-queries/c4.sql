select answer_id, a_text, a_time, best_answer
from Answers join Questions on Answers.question_id = Questions.question_id
where Questions.question_id = 17 -- where question id can be inserted
order by a_time;