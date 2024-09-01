<?php
require 'config.php';
if(empty($_SESSION["id"])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="se">Search for a User: </label>
        <input type="text" name="username" id="se"><br>
        <input type="submit" value="Search" name="submit">
    </form>

    <?php
        if(isset($_POST['submit'])){
            $username=$_POST['username'];
            $query="SELECT name,username,image FROM tb_user WHERE username='$username'";
            $result=mysqli_query($conn,$query);
            if($result && mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
            
                echo '<h4>Details for a User</h4>';
                echo '<img src="data:image/jpg;base64,'. base64_encode($row['image']).'" width="200">';
                echo "<p>Username : {$row['username']}</p>";
                echo "<p>Name : {$row['name']}</p>";
            }else{
                echo '<p>No user found with that username. ):</p>';
            }

        }
    ?>
    <br>
    <a href="index.php">Go Back</a>

</body>
</html>