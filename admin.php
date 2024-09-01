<?php
require 'config.php';
if(!empty($_SESSION["id"])){
    $id=$_SESSION["id"];
    $result=mysqli_query($conn,"SELECT * FROM tb_user WHERE id=$id");
    $row=mysqli_fetch_assoc($result);
    if($row['username']!='admin'){
        header("Location: index.php");
    }
    
}else{
    header("Location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h1>Welcome</h1>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Username</td>
            <td>Email</td>
            <td>Image Profile</td>
        </tr>
        <?php
            $query="SELECT * FROM tb_user";
            $result=mysqli_query($conn,$query);
            $rows=mysqli_fetch_all($result,MYSQLI_ASSOC);
            foreach($rows as $row){
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['email']}</td>";
                echo '<td><img src="data:image/jpg;base64,'.base64_encode($row['image']).'" width="80"></td>';
                echo '</form>';
                echo "</tr>";
            }
            

        ?>
    </table>
    
    
    <br>
    <a href="logout.php">Logout</a>

</body>
</html>