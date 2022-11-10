<?php
require_once('User.php');
require_once('Connection.php');
require_once('Comment.php');

class Post
{
    public $id;
    public $title;
    public $body;
    public $creator_id;
    public $created_at;
    public $updated_at;

    public function create()
    {
        $connection = new Connection();
        $conn = $connection->mysqli;

        $sql = $conn->prepare("INSERT INTO posts (title, body, creator_id, created_at) VALUES (?, ?, ?, now())");
        $sql->bind_param("sss", $this->title, $this->body, $this->creator_id);
        $sql->execute();
        $this->id = $conn->insert_id;

        $conn->close();
        return $this;
    }

    public static function find($id)
    {
        $connection = new Connection();
        $conn = $connection->mysqli;

        $sql = $conn->prepare("SELECT * FROM posts WHERE id=?");
        $sql->bind_param("s", $id);

        $sql->execute();
        $result = $sql->get_result();
        // var_dump($result);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $post = new self();
            $post->id = $row['id'];
            $post->title = $row['title'];
            $post->body = $row['body'];
            $post->creator_id = $row['creator_id'];
            return $post;
        }
        $conn->close();
    }

    public function creator()
    {
        return User::find($this->creator_id);
    }

    public function update()
    {
        $connection = new Connection();
        $conn = $connection->mysqli;
        $sql = $conn->prepare("UPDATE posts SET title=?, body=? WHERE id=?");
        $sql->bind_param("sss", $this->title, $this->body, $this->id);
        $sql->execute();
        $conn->close();
    }

    public function destroy()
    {
        $connection = new Connection();
        $conn = $connection->mysqli;
        $sql = $conn->prepare("DELETE FROM posts WHERE id=?");
        $sql->bind_param("s", $this->id);
        $sql->execute();
        $conn->close();
    }

    public static function all()
    {
        $connection = new Connection();
        $posts = [];
        $sql = $connection->mysqli->prepare("SELECT * FROM posts ORDER BY created_at DESC");
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $post = new Post();
                $post->id = $row['id'];
                $post->title = $row['title'];
                $post->body = $row['body'];
                $post->creator_id = $row['creator_id'];
                $posts[] = $post;
            }
        }
        $connection->mysqli->close();
        return $posts;
    }

    public function comments(){
        $connection = new Connection();
        $comments = [];
        $sql = $connection->mysqli->prepare("SELECT * FROM comments WHERE post_id=?");
        $sql->bind_param("s", $this->id);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $comment = new Comment();
                $comment->id = $row['id'];
                $comment->body = $row['body'];
                $comment->creator_id = $row['creator_id'];
                $comments[] = $comment;
            }
        }
        $connection->mysqli->close();
        return $comments;
    }

}
