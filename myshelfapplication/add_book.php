<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>MyShelf</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="index.css">        
</head>
  <body>
    <a href="index.php" class="home-button">Home</a>
    <h1 class="centered-heading">Let's add a book...</h1>
    
    <div class="form-container"> 
    <form action="process-form.php" method="post" enctype="multipart/form-data">
     
    <label for="title" class="form-label">Title:</label>
    <input type="text" id="title" name="title"><br>
  
    <label for="author" class="form-label">Author:</label>
    <input type="text" id="author" name="author"><br>
       
    <label for="format" class="form-label">Format:</label>
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
      <option value="horror">Horror</option>
    </select><br>

    <label for="image">Upload Book Image:</label>
    <input type="file" name="image" id="image"><br>

    <button>Submit</button>
  </body>
</html>