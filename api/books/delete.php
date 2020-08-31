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

//Get POST variables
$id = $_POST['id'];
//Book query
try {
    $result = $book->removeBook($id);
    echo json_encode(
        array('message' => "Remove Successful")
    );
} catch (Exception $e) {
    echo json_encode(
        array('message' => "Remove Failed")
    );
}
