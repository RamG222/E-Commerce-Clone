<?php
    include('./connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<body>
    <center>
        <h1 class="text-center m-4">Admin Panel - Amazon Clone</h1>
        <h2 class="text-center m-4">Default username: 1234 & password: 1234</h2>
  
        <form method="post" class="form-group" action="" name="login_form">
            <div class="form-element">
                <label>Username</label>
                <input type="text" class="" name="user" id="mobile" required />
            </div>
            <br>

            <div class="form-element">
                <label>Password</label>
                <input type="password" name="pass" id="pass" required />
            </div>
            <br>

            <button class="btn btn-primary" type="submit" name="Login" value="">Login</button>
        </form>

        <?php 
                if (isset($_POST['Login'])){
                    $username = mysqli_real_escape_string($con, $_POST['user']);
                    $password = mysqli_real_escape_string($con, $_POST['pass']);
                          
                    $sql1 = "SELECT * FROM mst_login WHERE MOBILE='$username' AND PASSWORD='$password'";
                    $result1 = mysqli_query($con, $sql1);
            
                    if(mysqli_num_rows($result1) == 1){
                        header("Location: dashboard.php");
                        exit();
                    } else {
                        // Login failed
                        echo '<br> Login Failed';
                    }
                }
        ?>
    </center> 
</body>
</html>
