<?php
require('database.php');

//function to grab random book from database
function getRandomBook() {
    global $mysqli;
    $result = $mysqli->query("SELECT * FROM toberead ORDER BY RAND() LIMIT 1");
    return $result->fetch_assoc();
}

$randomBook = getRandomBook();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="index.css">
<title>MyShelf</title> 
</head>
    <body>
        <h1 class="centered-heading">Your next read...</h1>
        <div class="list-button-container">
        <button class= "list-button" onclick="window.location.href='book_list.php'">Back to Book List</button>
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Format</th>
                <th>Genre</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr>
                <td><?= htmlspecialchars($randomBook['title']) ?></td>
                <td><?= htmlspecialchars($randomBook['author']) ?></td>
                <td><?= htmlspecialchars($randomBook['format']) ?></td>
                <td><?= htmlspecialchars($randomBook['genre']) ?></td>
                <td><img src="<?= $randomBook['image'] ?>" alt="Book Image" style="max-width: 100px;"></td>
                <td><a href="edit_book.php?id=<?= $randomBook["id"]; ?>">Edit</a></td>
                <td><a href="delete_book.php?id=<?= $randomBook["id"]; ?>">Delete</a></td>
            </tr>
        </table>
    </body>
</html>
        