<?php

use App\Models\Comment;

require_once "../models/Comment.php";
require_once  "../App.php";
require_once  "../../lib/Database.php";

$commentModel = new Comment();

$id = $_GET['id'];

$commentModel->seeComment($id);


