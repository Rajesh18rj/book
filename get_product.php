<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
header('Content-Type: application/json');

// include database connection
include 'dbconfig.php'; // change to your actual db file name

if (isset($_GET['isbn'])) {
    $isbn = mysqli_real_escape_string($db, $_GET['isbn']);

    $sql = "SELECT name, material FROM products WHERE group_name = '$isbn' LIMIT 1";
    $result = mysqli_query($db, $sql);

    if (!$result) {
        echo json_encode(['error' => mysqli_error($db)]);
        exit;
    }

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode([
            'book_title' => $row['name'],
            'author' => $row['material']
        ]);
    } else {
        echo json_encode(['message' => 'No product found']);
    }
} else {
    echo json_encode(['error' => 'No ISBN provided']);
}
?>