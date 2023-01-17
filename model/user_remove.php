<?php

require_once('../model/User.php');

$userId = $_POST['userId'];

User::removeUserById($userId);
