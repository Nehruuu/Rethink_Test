
<?php
    session_start();
    if(!isset($_SESSION["user"])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="header">
  <a href="index.php" class="logo">MiniBlog</a>
  <div class="header-right">
    <a class="active" href="logout.php">logout</a>
  </div>
  <div class="header-right">
    <a class="active" href="index.php">Home</a>
  </div>
  <div class="header-right">
   <a> Hi <?php echo $_SESSION['user'];?>! </a>
  </div>
</div>
</body>
</html>