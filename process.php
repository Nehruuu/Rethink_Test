<?php
include('database.php');
include_once 'header_user.php';

if (isset($_POST["create"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $user_id = $_SESSION['user_id'];
    $sqlInsert = "INSERT INTO blogs(title, content, user_id) VALUES ('$title','$content', '$user_id')";
    if(mysqli_query($conn,$sqlInsert)){
        session_start();
        $_SESSION["create"] = "Post Added Successfully!";
        header("Location:index.php");
    }else{
        die("Something went wrong");
    }
}
if (isset($_POST["edit"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $content = mysqli_real_escape_string($conn, $_POST["content"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sqlUpdate = "UPDATE blogs SET title = '$title', content = '$content' WHERE id='$id'";
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Post Updated Successfully!";
        header("Location:index.php");
    }else{
        die("Something went wrong");
    }
}
?>