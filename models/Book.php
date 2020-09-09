<?php
class Book
{
    //DB stuff
    private $conn;
    // private $table = 'books';
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

    // Get all books
    public function read()
    {
        //Create query
        $query =  'SELECT id,book_id, authors, original_title,small_image_url FROM books';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }

    public function readLimit($getLimit)
    {
        //Create query
        $query =  'SELECT id,book_id, authors, original_title,small_image_url FROM books LIMIT ?';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //bind limit value
        $stmt->bindValue(1, $getLimit, PDO::PARAM_INT);
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


    public function readAuthor($getID)
    {
        //Create query
        $query =  'SELECT id,book_id, authors, original_title,small_image_url FROM books WHERE author =?';
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
