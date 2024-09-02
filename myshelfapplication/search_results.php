<?php
require('database.php');

// check if a genre is selected, if it is assign it to $getGenre variable
if (isset($_GET['genre'])) {
    $getGenre = $_GET['genre'];
    $books = getBooks($getGenre);
} else {
    // if no genre is selected, fetch all books
    $books = getBooks();
}

// get books on selected genre
function getBooks($getGenre = '') {
    global $mysqli;
    $query = "SELECT * FROM toberead";

    //if genre is selected, add where clause
    if (!empty($getGenre)) {
        $query .= " WHERE genre = ?";
    }

   //prepare query to execute
    $stmt = $mysqli->prepare($query);

    if (!empty($getGenre)) {
        // bind selected genre
        $stmt->bind_param("s", $getGenre);
    }
    //execute and retrieve results
    $stmt->execute();
    $result = $stmt->get_result();

    // fetch all books in the selected genre
    $books = $result->fetch_all(MYSQLI_ASSOC);

    return $books;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="index.css">
<title>Search Results</title> 
</head>
    <body>  
        <div class="list-button-container">
            <button class= "list-button" onclick="window.location.href='index.php'">Home</button>
        </div>

        <div class="list-button-container">
            <button class= "list-button" onclick="window.location.href='book_list.php'">Back to all Books</button>
        </div>

        <h1 class="centered-heading">Search Results for: <?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?></h1>

        <?php if (!empty($books)): ?>

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
    
    <?php foreach ($books as $row): ?>

            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['author']) ?></td>
                <td><?= htmlspecialchars($row['format']) ?></td>
                <td><?= htmlspecialchars($row['genre']) ?></td>
                <td><img src="<?= $row['image'] ?>" alt="Book Image" style="max-width: 100px;"></td>
                <td><a href="edit_book.php?id=<?= $row["id"]; ?>">Edit</a></td>
                <td><a href="delete_book.php?id=<?= $row["id"]; ?>">Delete</a></td>
            </tr>

    <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No books found.</p>
    <?php endif; ?>
</body>
</html>
