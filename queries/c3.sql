select username, status_title
from Users join UserStatus using (user_id) join statusdict using (status_id)