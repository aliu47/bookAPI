<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Book.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate book object
$book = new Book($db);

//Get URL variable
$getID = $_GET['id'];

//Book query
$result = $book->readID($getID);
//get row count
$num = $result->rowCount();
if ($num > 0) {
    $books_arr = array();
    $books_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $book_item = array(
            'id' => $id,
            'book_id' => $book_id,
            'authors' => $authors,
            'original_title' => $original_title,
            'small_image_url' => $small_image_url
        );
        //push to data
        array_push($books_arr['data'], $book_item);
    }
    echo json_encode($books_arr);
} else {
    echo json_encode(
        array('message' => "no books found")
    );
}
