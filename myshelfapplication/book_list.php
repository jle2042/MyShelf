<?php
require('database.php');

//fetch amount of books currently in the database to output how many books are on shelf
$countQuery = "SELECT COUNT(*) AS bookCount FROM toberead";
$countResult = $mysqli->query($countQuery);
$bookCount = $countResult->fetch_assoc()['bookCount'];

//fetch all books to display
function getBooks() {
   global $mysqli;
    $result = $mysqli->query("SELECT * FROM toberead");
    $books = $result->fetch_all(MYSQLI_ASSOC);
    return $books;
}
$books = getBooks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="index.css">
<title>View Books</title> 
</head>
    <body>  
    <h1 class="centered-heading">Books on your shelf to read...</h1><br>
    
    <div class="list-button-container">
        <button class= "list-button" onclick="window.location.href='index.php'">Home</button>
        <button class="random-button" onclick="window.location.href='random_book.php'">Click to let MyShelf pick your next read</button>
    </div>

    <div>
        <p>You currently have <?php echo $bookCount; ?> books on your shelf</p>
    </div>

    <h3 class="search-header">Filter Results Based on Genre</h3>
    <form method="GET" action="search_results.php">
    <select name="genre">
        <option value="mystery/thriller">Mystery / Thriller</option>
        <option value="romance">Romance</option>
        <option value="memoir">Memoir</option>
        <option value="nonfiction">Nonfiction</option>
        <option value="fantasy">Fantasy</option>
        <option value="horror">Horror</option>
    </select>
    <button type="submit">Search</button>
    </form>

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
</body>
</html>