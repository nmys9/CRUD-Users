<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    $id=$_SESSION["id"];
    $result=mysqli_query($conn,"SELECT * FROM tb_user WHERE id=$id");
    $row=mysqli_fetch_assoc($result);
    if($row['username']=='admin'){
        header("Location: admin.php");
    }
}else{
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome <?php echo $row['name'] ?></h1><br>
    <img src="data:image/jpg;base64,<?php echo base64_encode($row['image'])?>" width="200">
    <br>
    <form action="update.php" method="POST">
        <input type="submit" value="Update" name="update"><br>
    </form>
    <form action="delete.php" method="POST">
        <input type="submit" value="Delete" name="delete"><br>
    </form>
    
    <br>
    <a href="search.php">Search for a User</a>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>