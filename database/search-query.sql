
with Search as(

                        select question_id, title, topic_name, q_time, MATCH(q_text) AGAINST ('+$algo?*' in boolean MODE) as text_score, match(title) against ('+$algo*' in boolean mode) as title_score
                        from Questions join Topic using (topic_id)
                        where MATCH(title, q_text) against ('+$algo*' in boolean mode)
                        order by text_score*0.2+title_score desc
                        )


, ASearch as(
	select question_id, topic_name, title, text_score, title_score, q_time, MATCH(a_text) AGAINST('+$algo?*' in boolean mode) as atext_score
	from Search join Answers using (question_id)
    where MATCH(a_text) against ('+$algo*' in boolean mode)
)

select question_id, topic_name,title, q_time, (text_score + title_score + 0.2*atext_score) as score from ASearch order by score desc