<?php

require_once('Connection.php');
require_once('Post.php');

class User
{
    public $conn;
    public $id;
    public $name;
    public $email;
    public $password;

    public function create()
    {
        $connection = new Connection();

        $sql = $connection->mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $this->name, $this->email, $this->password);
        $sql->execute();
        $this->id = $connection->mysqli->insert_id;

        $connection->mysqli->close();
    }

    public function update()
    {
        $connection = new Connection();
        $sql = $connection->mysqli->prepare("UPDATE users SET name=?, email=? WHERE id=?");
        $sql->bind_param("sss", $this->name, $this->email, $this->id);
        $sql->execute();
        $connection->mysqli->close();
    }

    public function posts()
    {
        $connection = new Connection();
        $posts = [];
        $sql = $connection->mysqli->prepare("SELECT * FROM posts WHERE creator_id=?");
        $sql->bind_param("s", $this->id);
        $sql->execute();
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $post = new Post();
                $post->id = $row['id'];
                $post->title = $row['title'];
                $post->body = $row['body'];
                $posts[] = $post;
            }
        }
        $connection->mysqli->close();
        return $posts;
    }

    public static function find($id)
    {
        $connection = new Connection();
        $conn = $connection->mysqli;

        $sql = $conn->prepare("SELECT * FROM users WHERE id=?");
        $sql->bind_param("s", $id);

        $sql->execute();
        $result = $sql->get_result();
        // var_dump($result);
        if ($result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $user = new self();
            $user->id = $row['id'];
            $user->name = $row['name'];
            $user->email = $row['email'];
            return $user;
        }

        $conn->close();
    }

    public static function findByEmail($email)
    {
        $connection = new Connection();
        $conn = $connection->mysqli;

        $sql = $conn->prepare("SELECT * FROM users WHERE email=?");
        $sql->bind_param("s", $email);

        $sql->execute();
        $result = $sql->get_result();
        // var_dump($result);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user = new self();
            $user->id = $row['id'];
            $user->name = $row['name'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $conn->close();
            return $user;
        } else {
            $conn->close();
            return null;
        }
    }
}
