<?php

/*
	@Desc: Programmed by Neorm 2O16/2O17
	@Contact: https://www.facebook.com/gonniy.officiel
*/

# [!] include the user class
require_once('user.class.php');

# [!] istantiating User class and pass the table name
$user = new User('users');

# ==================| createUser method |==================
# [+] first we should define the properties [username, password, email]
User::setUsername('Ali');
User::setPassword('Mohammed123');
User::setEmail('gonniy@outlook.com');
$user->createUser();
# =========================================================

# ==================| updateUser method |==================
# [+] set the updated infos
User::setUsername('Said');
User::setPassword('123123');
User::setEmail('s3faqma@gmail.com');
$user->updateUser(1); // set the id of a particular user to updated his/her informations
# =========================================================

# ==================| isUser method |==================
# [+] in this method we just need 2 arguments(properties) [username, password(Optional)]
#     That means we can use this method for check for an user via username solo Or check from
#     the login page via both arguments(username, password), i will use just username to show you
User::setUsername('Mohammed');
echo $user->isUser(User::getUsername()) ? 'User exists!' : 'User not exists!';
# =====================================================

# ==================| deleteUser method |==================
# [+] delete user via id .Excpect 1 argument($id)
echo $user->deleteUser(1) ? 'The user has been deleted!' : 'The user id not found.';
# ==========================================================

# ==================| gradedUser method |==================
# [+] update the status of an user and set it a moderator or admin ect...
# [!] default value is (0) and it's mean a regular member
echo $user->gradedUser(3, 2) ? 'The user updated level to moderator' : 'shiit Static!';
# ==========================================================