<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    $id=$_SESSION["id"];
    $result=mysqli_query($conn,"SELECT * FROM tb_user WHERE id=$id");
    $row=mysqli_fetch_assoc($result);
    
}else{
    header("Location: login.php");
}

// enter your password to delete your profile

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Delete my Profile</h1>
    <form action="" method="POSt">
        <label for="pa">Password:</label>
        <input type="password" name="password" id="pa">
        <input type="submit" value="Delete" name="submit">
    </form>
    <?php
        if(isset($_POST['submit'])){
            $password=$_POST['password'];
            if($password==$row['password']){
                $query="DELETE FROM tb_user WHERE id='$id'";
                if(mysqli_query($conn,$query)){

                    header("Location: logout.php");
                }else{
                    echo 'field';
                }
            }else{
                echo 'User not found';
        
            }
        }
    ?>
</body>
</html>