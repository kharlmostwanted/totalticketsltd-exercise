<?php
session_start();

require_once('Models/Post.php');

$post = new Post();
$post->title = $_POST['title'];
$post->body = $_POST['body'];
$post->creator_id = $_SESSION['user_id'];
$post->create();
header('Location: show-post.php?id=' . $post->id);
