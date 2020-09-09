<?php
//Change before deploy
header('Access-Control-Allow-Origin: *');

header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Book.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate book object
$book = new Book($db);

//Get POST variables
$id = $_POST['id'];
$book_id = $_POST['book_id'];
$authors = $_POST['authors'];
$original_title = $_POST['original_title'];
$small_image_url = $_POST['small_image_url'];
//Book query
try {
    $result = $book->addBook($id, $book_id, $authors, $original_title, $small_image_url);
    echo json_encode(
        array('message' => "Post Successful")
    );
} catch (Exception $e) {
    echo json_encode(
        array('message' => "Post Failed")
    );
}
