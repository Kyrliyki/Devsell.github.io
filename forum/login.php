<?php
session_start();


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: forums.php");
	exit;
}

require_once "config.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
	if ($stmt = $DataBase->prepare('SELECT id, password 
									FROM user WHERE email = ?')) {
		$stmt->bind_param('s', $_POST['name']);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows != 0){
			$stmt->bind_result($id, $password);
			$stmt->fetch();
			if(password_verify($_POST['password'], $password)){
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['id'] = $id;
				$_SESSION['username'] = $_POST['name'];
				header("location: forums.php");
			} else {
				echo '<h3 style="background-color: red">Неверный пароль</h3>';
			}
		} else {
			echo '<h3 style="background-color: red">Такого пользователя не сущесвует</h3>';
		}
		$stmt->close();
	}
}



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign Up</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header><div class="brandd">Login</div> </header>
        <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                        <h1>Don't have an account yet? <a href="register.php" class= "text_text">Create here</a>.</h1>
                    </form>
                </div>
            </from>   
        </div>
    </body>
</html>