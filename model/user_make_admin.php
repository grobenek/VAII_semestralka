<?php

require_once('../model/User.php');

$userId = $_POST['userId'];

$user = User::getUserById($userId);

User::makeUserAdmin($userId, $user->getLogin(), $user->getEmail(), $user->getAboutUser());