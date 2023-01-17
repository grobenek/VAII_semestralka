<?php

require_once('../model/User.php');

$users = User::getAllUsers();

$data = array();
foreach ($users as $user) {
    $data[] = array(
        'userId' => $user->getUserId(),
        'login' => $user->getLogin(),
        'isAdmin' => $user->getIsAdmin(),
        'aboutUser' => $user->getAboutUser(),
        'email' => $user->getEmail());}

echo json_encode($data);
