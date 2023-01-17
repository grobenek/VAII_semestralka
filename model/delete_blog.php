<?php

use model\Blog;

require_once('../model/Blog.php');

Blog::deleteBlog($_POST['blogId']);
