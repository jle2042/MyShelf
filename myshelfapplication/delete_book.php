<?php

require('database.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM toberead WHERE id=$id"; 
$result = mysqli_query($mysqli,$query) or die ( mysqli_error($mysqli));
header("Location: book_list.php"); 
exit();
?>
