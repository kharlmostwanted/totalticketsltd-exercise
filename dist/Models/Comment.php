<?php
require_once('Connection.php');
require_once('User.php');

class Comment
{
    public $id;
    public $body;
    public $post_id;
    public $parent_id;
    public $creator_id;
    public $created_at;
    public $updated_at;

    public $requiredAttributes = [
        'body',
        'post_id',
        'creator_id',
    ];

    public function create()
    {
        $connection = new Connection();
        $conn = $connection->mysqli;

        $sql = $conn->prepare("INSERT INTO comments (post_id, body, creator_id, created_at) VALUES (?, ?, ?, now())");
        $sql->bind_param("sss", $this->post_id, $this->body, $this->creator_id);
        $sql->execute();
        $this->id = $conn->insert_id;

        $conn->close();
        return $this;
    }

    public static function find($id)
    {
        $connection = new Connection();
        $conn = $connection->mysqli;

        $sql = $conn->prepare("SELECT * FROM comments WHERE id=?");
        $sql->bind_param("s", $id);

        $sql->execute();
        $result = $sql->get_result();
        // var_dump($result);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $comment = new self();
            $comment->id = $row['id'];
            $comment->body = $row['body'];
            $comment->creator_id = $row['creator_id'];
            $comment->created_at = $row['created_at'];
            return $comment;
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
        $sql = $conn->prepare("UPDATE comments SET title=?, body=? WHERE id=?");
        $sql->bind_param("sss", $this->title, $this->body, $this->id);
        $sql->execute();
        $conn->close();
    }

    public function destroy()
    {
        $connection = new Connection();
        $conn = $connection->mysqli;
        $sql = $conn->prepare("DELETE FROM comments WHERE id=?");
        $sql->bind_param("s", $this->id);
        $sql->execute();
        $conn->close();
    }

    public static function all()
    {
        $connection = new Connection();
        $posts = [];
        $sql = $connection->mysqli->prepare("SELECT * FROM comments");
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $post = new Post();
                $post->id = $row['id'];
                $post->body = $row['body'];
                $post->creator_id = $row['creator_id'];
                $posts[] = $post;
            }
        }
        $connection->mysqli->close();
        return $posts;
    }
}
