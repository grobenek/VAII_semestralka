<?php

use model\Category;

require_once('../model/Category.php');

$categoryId = $_POST['categoryId'];

Category::removeCategory($categoryId);
