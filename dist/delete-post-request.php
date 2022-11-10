<?php
session_start();

require_once('Models/Post.php');

$post = Post::find($_GET['id']);
$post->destroy();
header('Location: my-posts.php');
