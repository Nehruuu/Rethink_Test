<?php
 include_once 'header.php';
?>
<?php
    session_start();
    if(isset($_SESSION["user"])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
<?php
    if (isset($_POST["login"])){
        $username = $_POST["uname"];
        $password = $_POST["password"];
        require_once "database.php";
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($user){
            if (password_verify($password, $user["password"])){
                header("Location: index.php");
                $_SESSION["user"] = $username;
                die();
            }else{
                echo"<div class='alert aler-danger'>Password does not match!</div>";
            }
        }else{
            echo"<div class='alert aler-danger'>User does not exists!</div>";
        }
    }
    ?>
    <form action="login.php" method="post">
    <div class="container">
    <h1> Login </h1>
        <div class="form-group">
            <input type="text" class ="form-control" placeholder="Username" name="uname">
        </div>
        <div class="form-group">
            <input type="text" class ="form-control" placeholder="Password" name="password">
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Login" name="login">
            <a class="btn btn-primary" href="register.php">Register</a>
        </div>
    </div>
</div>
    
</form>
</body>
</html>