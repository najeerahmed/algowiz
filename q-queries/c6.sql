select *
from Questions
where title like '%algorithm%' or q_text like '%algorithm%'; -- each word is separated my the mod operator 