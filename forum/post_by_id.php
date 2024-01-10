<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
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
    <div>
        <?$sql = "SELECT *
                FROM post
                WHERE post_id=".$_GET["post_id"];
        $result = $DataBase->query($sql);
            
        ?>
    </div>
    <div class="container">
        <div class="subforum">
            <?foreach($result as $row){?>
            <div class="subforum-row-row">
                
                <div class="subforum-description subforum-column">
                    <h4><a><?=$row["post_name"]?></a></h4>
                </div>

            </div>
            <div class="containerr">
                <h1>
                    <?=
                    $row["post_content"]
                    ?>
                </h1>
            </div>
            <?}
            ?>
            </div>
        </div>
        
    </div>
    <footer>
        <span>  </span>
    </footer>
    <script src="main.js"></script>
</body>
</html>