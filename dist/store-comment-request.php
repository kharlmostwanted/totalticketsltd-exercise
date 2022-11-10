<?php
session_start();

require_once('Models/Comment.php');

$comment = new comment();
$comment->post_id = $_POST['post_id'];
$comment->body = $_POST['body'];
$comment->creator_id = $_SESSION['user_id'];

if (!empty($comment->post_id) && !empty($comment->body) && !empty($comment->creator_id)) {
  $comment->create();
}

header('Location: show-post.php?id=' . $comment->post_id);
