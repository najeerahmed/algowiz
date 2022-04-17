select uname, status_title
from Users join UserStatus on Users.user_id = UserStatus.user_id
join StatusDict on UserStatus.status_id = StatusDict.status_id;