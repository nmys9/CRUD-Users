<?php


require 'config.php';
if(!empty($_SESSION["id"])){
    header("Location: index.php");
}
if(isset($_POST["submit"])){
    $image=mysqli_real_escape_string($conn,file_get_contents($_FILES['image']['tmp_name']));
    $name=mysqli_real_escape_string($conn,$_POST["name"]);
    $username=mysqli_real_escape_string($conn,$_POST["username"]);
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $password=mysqli_real_escape_string($conn,$_POST["password"]);
    $confirmpassword=mysqli_real_escape_string($conn,$_POST["confirmpassword"]);
    $duplicate=mysqli_query($conn,"SELECT * FROM tb_user WHERE username = '$username' OR email='$email'");
    if(mysqli_num_rows($duplicate)>0){
        echo
        "<script> alert('Username or Email Has Already Taken');</script>";
    }else{
        if($password == $confirmpassword){
        $query="INSERT INTO tb_user VALUES('','$name','$username','$email','$password','$image' )";
        mysqli_query($conn,$query);
        echo
        "<script> alert('Registration Successful');</script>";
        }else{
            echo
            "<script> alert('Password dose not match');</script>";
        }
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h2>Registration</h2>
    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <label for="im">User Image: </label>
        <input type="file" name="image" id="im"><br>
        <label for="n">Name:</label>
        <input type="text" name="name" id="n" required value=""><br>
        <label for="us">Username: </label>
        <input type="text" name="username" id="us" required value=""><br>
        <label for="em">Email:</label>
        <input type="email" name="email" id="em" required value=""><br>
        <label for="pa">Password:</label>
        <input type="password" name="password" id="pa" required value=""><br>
        <label for="co">Confirm Password:</label>
        <input type="password" name="confirmpassword" id="co" required value=""><br>
        <button type="submit" name="submit">Register</button>
    </form>
    
    <br>
    <a href="login.php">Login</a>
    
</body>
</html>