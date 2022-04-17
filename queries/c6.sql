-- Given a keyword query, output all questions that match the query and that fall into a particular topic,
-- sorted from highest to lowest relevance. (Select and define a suitable form of relevance – you could
-- match the keywords against the query title, the query text, or the query answers, and possibly give
-- different weights to these different fields.)

-- Keyword: algo
-- implemented FULLTEXT index on Question(title,q_text), Question(title), Question(q_text)
-- Use boolean mode to allow for partial prefix word searches


with Search as(

select *, MATCH(q_text) AGAINST ('+algo*' in boolean MODE) as text_score, match(title) against ('+algo*' in boolean mode) as title_score
from Questions join Topic using (topic_id)
where MATCH(title, q_text) against ('+algo*' in boolean mode)
order by text_score*0.2+title_score desc
)

select title, title_score+text_score*0.2 as score from Search;
