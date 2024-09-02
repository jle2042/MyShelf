<?php
require('database.php');

//fetch book by id
function getBookById($book_id, $mysqli) {
    $sql = "SELECT * FROM toberead WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    //if none matches return null
    $book = null;
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    }
    $stmt->close();

    //return book data
    return $book;
}

//sql query to update for the specified id
function updateBook($book_id, $title, $author, $format, $genre, $mysqli) {
    $update_sql = "UPDATE toberead SET title=?, author=?, format=?, genre=? WHERE id=?";
    $update_stmt = $mysqli->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $title, $author, $format, $genre, $book_id);
    $update_stmt->execute();
    $update_stmt->close();
}

//get value of the id
if (!isset($_GET['id'])) {
    header("Location: error.php");
    exit;
}

//get book based on id
$book_id = $_GET['id'];

// Get book content based on ID
$book = getBookById($book_id, $mysqli);

//if $book doesn't contain any data, error
if (!$book) {
    header("Location: error.php");
    exit;
}

// Update Book details from form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $format = $_POST['format'];
    $genre = $_POST['genre'];
   

    updateBook($book_id, $title, $author, $format, $genre, $mysqli);

    // Redirect back to the book_list page after updating
    header("Location: book_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="index.css">
<title>Edit Book</title>
</head>
    <body>
        <h1 class="centered-heading">Edit Book</h1>
        <div class="form-container"> 
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $book_id; ?>">

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $book['title']; ?>">

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?php echo $book['author']; ?>">
        
        <label for="format">Format:</label>
        <select id="format" name="format">
            <option value="Physical">Physical</option>
            <option value="Ebook">Ebook</option>
            <option value="Audio">Audio</option>
        </select><br>

        <label for="genre" class="form-label">Genre:</label>
        <select id="genre" name="genre">
            <option value="mystery/thriller">Mystery / Thriller</option>
            <option value="romance">Romance</option>
            <option value="memoir">Memoir</option>
            <option value="nonfiction">Nonfiction</option>
            <option value="fantasy">Fantasy</option>
        </select><br>


         <input type="submit" value="Update">
        </form>
    </body>
</html>