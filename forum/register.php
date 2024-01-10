<?php
require_once "config.php";


if (isset($_POST["name"]) && isset($_POST["password"])){
	$name = mysqli_real_escape_string($DataBase, trim($_POST["name"]));
	$password = mysqli_real_escape_string($DataBase, password_hash(trim($_POST["password"]), PASSWORD_DEFAULT));
	
	
	$sql = "INSERT INTO user (email, password) VALUES ('$name', '$password')";
	if(mysqli_query($DataBase, $sql)){
        echo "<h3 style='background-color: green'>Данные успешно добавлены</h3>";
    } else{
        echo "Ошибка: " . mysqli_error($DataBase);
    }
    mysqli_close($DataBase);
    
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <link rel="stylesheet" href="style.css">
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">-->
        
    </head>
    <body>
        <header><div class="brandd">Register</div> </header>
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="subforum-titlee"><h1>Please fill this form to create an account.</h1></div>
                <div class="box">
                    <form action="" method="post">
                        <div class="form-group">
                            <h1>Email</h1>
                            <input type="email" pattern="[^ @]*@[^ @]*"  name="name" class="form-control" required>
                        </div>      
                        <div class="form-group">
                            <h1>Password</h1>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                        <h1>Already have an account? <a href="login.php" class= "text_text">Login here</a>.</h1>
                    </form>
                </div>
            </from>   
        </div>
    </body>
</html>