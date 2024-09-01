<?php


require 'config.php';
if(!empty($_SESSION["id"])){
    header("Location: index.php");
}
if(isset($_POST["submit"])){
    $usernameemail=mysqli_real_escape_string($conn,$_POST["usernameemail"]);
    $password=mysqli_real_escape_string($conn,$_POST["password"]);
    $result=mysqli_query($conn,"SELECT * FROM tb_user WHERE username='$usernameemail' OR email='$usernameemail' ");
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if($password==$row["password"]){
            $_SESSION["login"]=true;
            $_SESSION["id"]=$row["id"];
            if($row['username']=='admin' and $row['name']=='admin'){
                header("Location: admin.php");
            }else{
                header("Location: index.php");
            }
            
        }else{
            echo "<script> alert('wrong password'); </script>";
        }
    }else{
        echo "<script> alert('User Not Registered'); </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="" method="post" autocomplete="off">
        <label for="us">Username or Email:</label>
        <input type="text" name="usernameemail" id="us" require value=""><br>
        <label for="pa">Password:</label>
        <input type="password" name="password" id="pa" require value=""><br>
        <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="registration.php">Registration</a>
</body>
</html>