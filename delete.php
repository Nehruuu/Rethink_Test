<?php
if (isset($_GET['id'])) {
include("database.php");
$id = $_GET['id'];
$sql = "DELETE FROM blogs WHERE id='$id'";
if(mysqli_query($conn,$sql)){
    session_start();
    $_SESSION["delete"] = "Post Deleted Successfully!";
    header("Location:index.php");
}else{
    die("Something went wrong");
}
}else{
    echo "Posts does not exist";
}
?>