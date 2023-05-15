<?php
 include_once 'header.php';
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
    if (isset($_POST["submit"])){
        $username = $_POST["uname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $conf_pwd = $_POST["conf_pwd"];

        $password_hash = password_hash($password, PASSWORD_DEFAULT);


        $errors = array();

        if (empty($username) OR empty($email) OR empty($password) OR empty($conf_pwd)){
            array_push($errors, "All fields are required!");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, "Email is not valid");
        }
        if (strlen($password) < 8){
            array_push($errors, "Password must be 8 characters long");
        }
        if ($password !== $conf_pwd){
            array_push($errors,"Password does not match");
        }
        require_once "database.php";
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if($rowCount>0){
            array_push($errors,"User email already exists!");
        }
        if (count($errors)>0){
            foreach ($errors as $error){
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }else{
            
            $sql = "INSERT INTO users (username, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt){
                mysqli_stmt_bind_param($stmt,"sss",$username,$email,$password_hash);
                mysqli_stmt_execute($stmt);
                echo"<div class='alet alert-success'>Registration Successful!</div>";

            }else{
                die("Error! Unable to Register!");
            }
        }
    }
    ?>
    <form action="register.php" method="post">
    <div class="container">
        <h1> Register </h1>
        <div class="form-group">
            <input type="text" class ="form-control" placeholder="Username" name="uname">
        </div>
        <div class="form-group">
            <input type="text" class ="form-control" placeholder="Email" name="email">
        </div>
        <div class="form-group">
            <input type="password" class ="form-control" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <input type="password" class ="form-control" placeholder="Password" name="conf_pwd">
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Register" name="submit">
            <a class="btn btn-primary" href="login.php">Login</a>
        </div>
    </div>
</div>
</form>
</body>
</html>