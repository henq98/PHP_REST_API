<?php

namespace src\models;

use src\configs\Database;

class Post
{
    // Post properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;
    // Database table
    private $table = 'posts';

    // Get all posts
    public function readAll()
    {
        $query = 'SELECT
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
          FROM
             '.$this->table.' p
          LEFT JOIN
            categories c ON p.category_id = c.id
          ORDER BY
            p.created_at DESC';

        $stmt = Database::getConnection()->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Get single Post
    public function readOne()
    {
        $query = 'SELECT
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
          FROM
             '.$this->table.' p
          LEFT JOIN
            categories c ON p.category_id = c.id
          WHERE
            p.id = ?
          LIMIT 0,1';

        $stmt = Database::getConnection()->prepare($query);
        $stmt->bindValue(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch();

        // Set properties
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }

    // Create Post
    public function create()
    {
        $query = 'INSERT INTO '.$this->table.'
            SET
              title = :title,
              body = :body,
              author = :author,
              category_id = :category_id';
        // Prepare statement
        $stmt = Database::getConnection()->prepare($query);
        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->errorInfo());

        return false;
    }

    // Update Post
    public function update()
    {
        $query = 'UPDATE '.$this->table.'
            SET
              title = :title,
              body = :body,
              author = :author,
              category_id = :category_id
            WHERE
             id = :id';
        // Prepare statement
        $stmt = Database::getConnection()->prepare($query);
        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        // Bind data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category_id', $this->category_id);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->errorInfo());

        return false;
    }

    // Delete Post
    public function delete()
    {
        $query = 'DELETE FROM '.$this->table.' WHERE id = :id';
        // Prepare statement
        $stmt = Database::getConnection()->prepare($query);
        // Clean id data
        $this->id = htmlspecialchars(strip_tags($this->id));
        // Bind id data
        $stmt->bindParam(':id', $this->id);
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->errorInfo());

        return false;
    }
}
