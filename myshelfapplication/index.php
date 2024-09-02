<!DOCTYPE html>
<html>
<head>
<title>MyShelf</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MyShelf</title>
<link rel="stylesheet" href="index.css">
</head>
    <body>
        <h1 class="centered-heading">Welcome to MyShelf</h1>
        <h3 class="centered-subheading">A place to track books you already own</h3>

        <form action="add_book.php" method="post">
            <input type="submit" class="button" value="Add Book">
        </form> 
            <br>
        <form action="book_list.php" method="post">
            <input type="submit" class="button" value="Your Saved Books">
        </form> 
    </body>
</html>