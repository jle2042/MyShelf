<?php
session_start();
require('database.php');

// validate user input
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
$format = filter_input(INPUT_POST, 'format', FILTER_SANITIZE_STRING);
$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_STRING);

// check that all required fields have user input
if (!$title || !$author || !$format || !$genre) {
    die("Please provide all required fields.");
}

//book images
$image = $_FILES['image']['name'];
$image_temp = $_FILES['image']['tmp_name'];
$image_path = 'images/' . $image;
move_uploaded_file($image_temp, $image_path);

//sql statements to insert new book
$sql = "INSERT INTO toberead (title, author, format, genre, image)
        VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($mysqli);

if (! mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($mysqli));
}

mysqli_stmt_bind_param($stmt, "sssss", $title, $author, $format, $genre, $image_path);
if (!mysqli_stmt_execute($stmt)) {
    die("Error inserting data: " . mysqli_error($mysqli));
}

echo '<script>alert("Book Added");</script>';
mysqli_close($mysqli);
header("Location: index.php");
exit;
?>
