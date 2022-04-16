select a_time, a_text, best_answer
from Questions join Answers using (question_id)
where questions.question_id=4
order by a_time