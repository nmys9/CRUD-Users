<?php
require 'config.php';
if(!empty($_SESSION['id'])){
    $id=$_SESSION['id'];
    $query="SELECT * FROM tb_user WHERE id='$id'";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_assoc($result);

}else{
    header("Location:login.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upadte User</title>
</head>
<body>
    <h1>Update <?php echo $row['name']; ?> Info</h1>
    <img src="data:image/jpg;base64,<?php echo base64_encode($row['image'])?>" width="90">
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php htmlspecialchars($row['id']);?>">
        <label for="im">User Image:</label>
        <input type="file" name="image" id="im" title="Update Image"><br>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($row['name']); ?>"><br>
        <label for="us">Username:</label>
        <input type="text" name="username" id="us" value="<?php echo htmlspecialchars($row['username']); ?>"><br>
        <label for="em">Email</label>
        <input type="email" name="email" id="em" value="<?php echo htmlspecialchars($row['email']); ?>"><br>
        <input type="submit" value="Update" name="submit">


    </form>
    
    <a href="update_password.php">Update Password</a>
    
    <?php
        if(isset($_POST['submit'])){
            if(!empty($_FILES['image']['name'])){
                $image=$_FILES['image']['tmp_name'];
                $imageData=mysqli_real_escape_string($conn,file_get_contents($image));
            }else{
                $imageData=null;
            }
            $name=mysqli_real_escape_string($conn,$_POST['name']);
            $username=mysqli_real_escape_string($conn,$_POST['username']);
            $email=mysqli_real_escape_string($conn,$_POST['email']);

            if(isset($imageData)){
                $query="UPDATE tb_user SET name='$name', username='$username', email='$email',image='$imageData' WHERE id='$id'";
            }else{
                $query="UPDATE tb_user SET name='$name', username='$username', email='$email' WHERE id='$id'";
            }
            
            if(mysqli_query($conn,$query)){
                
                $query="SELECT * FROM tb_user WHERE id='$id'";
                $result=mysqli_query($conn,$query);
                $row = mysqli_fetch_assoc($result);
            }else{
                echo "Error Updating";
            }
        }
    ?>
</body>
</html>
<?php
// $row['name']=$name;
//                 $row['username']=$username;
//                 $row['email']=$email;
                
//                 if(isset($imageData)){
//                     $row['image']=$imageData;
//                 }
                ?>