
<?php
 session_start();
 include 'config.php';

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];


    // $hashedpassword = md5($password);

    $query = "SELECT * FROM `user` WHERE email='$email' AND password='$password' LIMIT 1";

    $queryrun = mysqli_query($conn, $query);

    if(mysqli_num_rows($queryrun)>0){
        foreach($queryrun as $row){
        $id = $row['id'];
        $email = $row['email'];
        $password = $row['password'];


        $_SESSION['auth_user'] = [
            'id' => $id,
            'email' => $email,
            'password' => $password
        ];

        $_SESSION['status']="Connection successfull";
        header("location: dashboard.php");
        exit(0);
        }
    }else{
        $_SESSION['status']="Connection failed";
        header("location: index.php");
        exit(0);
    }


    // mysqli_close($conn);
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
    <?php 
        if(isset($_SESSION['status'])){
            echo "<h4>" . $_SESSION['status'] . "</h4>";
            unset($_SESSION['status']);
        }
    ?>
    <form method="POST" action="">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="submit" name="Login" <?php  ?> value="Login">
    </form>
</body>
</html>
