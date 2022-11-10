<?php
session_start();

require_once('Models/Post.php');

$post = Post::find($_GET['id']);
$post->title = $_POST['title'];
$post->body = $_POST['body'];
$post->update();
header('Location: show-post.php?id=' . $post->id);
