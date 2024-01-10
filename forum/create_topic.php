<?php
require_once "config.php";
if (isset($_POST["name"]) && isset($_POST["cotegories"]) && isset($_POST["text"])){
	$text = mysqli_real_escape_string($DataBase, trim($_POST["text"]));
    $name = mysqli_real_escape_string($DataBase, trim($_POST["name"]));
	date_default_timezone_set('Europe/Moscow');
    $date = date('m/d/Y h:i:s a', time());
	$id = $_SESSION['id'];
    if($_POST["cotegories"]=="C++"){
        $cotegories=1;
    }
    else{
        $cotegories=2;
    }
	$sql = "INSERT INTO post (post_content,post_date,post_by,post_cat,post_name) VALUES ('$text','$date','$id','$cotegories','$name')";
	if(mysqli_query($DataBase, $sql)){
        echo "<h3 style='background-color: green'>Данные успешно добавлены</h3>";
    } else{
        echo "Ошибка: " . mysqli_error($DataBase);
    }
    mysqli_close($DataBase);
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DevSell</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    
</head>

<body>
    <header>
        <!--NavBar Section-->
       
        <div class="navbar">
            <nav class="navigation hide" id="navigation">
                <span class="close-icon" id="close-icon" onclick="showIconBar()"><i class="fa fa-close"></i></span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="forums.php">Main</a></li>
                    <li class="nav-item"><a href="create_topic.php">Posts</a></li>
                    <?if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false){
                        ?><li class="nav-item"><a href="login.php">Login</a></li><?
                    }
                    else{
                        ?><li class="nav-item"><a href="logout.php">Exit</a></li><?
                    }?>
                </ul>
            </nav>
            <a class="bar-icon" id="iconBar" onclick="hideIconBar()"><i class="fa fa-bars"></i></a>
            <div class="brand">DevSell</div>
            
        </div>
    </header>
    <div class="container">
        <div class="subforum">
            <div class="subforum-titlee"><h1>Создание поста</h1></div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="subforum-titlee">
                    <h1>Название</h1>
                    <input type="text" name='name' class="form-control">
                </div>
                <div class="subforum-titlee">
                    <form action="/" method="post">
                        <label for="cotegories">Выберите Категрию:</label>
                        <select name="cotegories" id="cotegories" class="select-categories">
                            <option value="C++">C++</option>
                            <option value="Python">Python</option>
                        </select>
                    </form>
                </div>    
                <div class="subforum-titlee">
                    <textarea type="text" name="text" class="form-controll">
                    </textarea>
                </div>
                <div class="subforum-titlee">
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                </div>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <span>  </span>
    </footer>
    <script src="main.js"></script>
</body>
</html>