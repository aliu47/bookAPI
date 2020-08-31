<?php
class Book
{
    //DB stuff
    private $conn;
    private $table = 'books';
    //Book properties
    public $id;
    public $book_id;
    public $authors;
    public $original_title;
    public $small_image_url;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function read()
    {
        //Create query
        $query =  'SELECT id,book_id, authors, original_title,small_image_url FROM ' . $this->table;
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }

    public function readID($getID)
    {
        //Create query
        $query =  'SELECT id,book_id, authors, original_title,small_image_url FROM books WHERE id =?';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute([$getID]);
        return $stmt;
    }

    public function addBook($postID, $postBookID, $postAuthor, $postOriginalTitle, $postSmallURL)
    {
        //Create query
        $query =  'INSERT INTO books (id,book_id, authors, original_title ,small_image_url) 
        VALUES (?,?,?,?,?)';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute([$postID, $postBookID, $postAuthor, $postOriginalTitle, $postSmallURL]);
        return $stmt;
    }

    public function removeBook($postID)
    {
        //Create query
        $query =  'DELETE FROM books WHERE id=?';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute([$postID]);
        return $stmt;
    }
}
