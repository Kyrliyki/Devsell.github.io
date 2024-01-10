<?php
session_start();
require_once "config.php";
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
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
    <div class="container">
        <div class="subforum">
            <div class="subforum-title">
                <h1>General Information</h1><?$example=$_GET["cotegories"];?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
                    <select name="cotegories" id="cotegories" class="select-categories">
                        <option value="">Все категории</option>
                        <option value="1" <?php if (isset($example) && $example=="1") echo ' selected';?>>C++</option>
                        <option value="2" <?php if (isset($example) && $example=="2") echo ' selected';?>>Python</option>
                    </select>
                    <input type="search" name="search">
                    <input type="submit" name="submit" class="primaryy" value="Выбрать">
                </from>
            </div>
            <?
           
            if(!empty($_GET["cotegories"]) and !empty($_GET["search"])){
                if($_GET["cotegories"]=="1"){
                    $cotegories=1;
                    

                }
                else{
                    $cotegories=2;

                }
                $sql = "SELECT t1.* , t2.email
                    FROM post AS t1 JOIN user AS t2
                    WHERE t1.post_by=t2.id AND t1.post_name LIKE '%".$_GET["search"]."%' AND t1.post_cat=".$cotegories ;
            }
            elseif(!empty($_GET["cotegories"])){
                if($_GET["cotegories"]=="1"){
                    $cotegories=1;
                    

                }
                else{
                    $cotegories=2;

                }
                $sql = "SELECT t1.* , t2.email
                    FROM post AS t1 JOIN user AS t2
                    WHERE t1.post_by=t2.id AND t1.post_cat=".$cotegories;
                }
            
            elseif(!empty($_GET["search"] && empty($_GET["cotegories"]))){
                $sql = "SELECT t1.* , t2.email
                                    FROM post AS t1 JOIN user AS t2
                    WHERE t1.post_by=t2.id AND t1.post_name LIKE '%".$_GET["search"]."%' ";
            }
            else{
                $sql = "SELECT t1.* , t2.email
                FROM post AS t1 JOIN user AS t2
                WHERE t1.post_by=t2.id";
            }
            
            $result = $DataBase->query($sql);
            print_r( $mysqli_result);
            
                foreach($result as $row){?>
                    <div class="subforum-row">
                    
                    <div class="subforum-description subforum-column">
                        <h4><a href=post_by_id.php?post_id=<?=$row["post_id"]?>><?=$row["post_name"]?></a></h4>
                    </div>
                    <div class="subforum-stats subforum-column center">
                        <span><?= $row["email"]?></span>
                    </div>
                    <div class="subforum-info subforum-column">
                        <b><?= $row["post_date"]?></b> 
                        
                    </div>
                </div>
            
            <?  }
           
            
            ?>
            
            
        </div>
        
    </div>


    <footer>
        <span>  </span>
    </footer>
    <script src="main.js"></script>
</body>
</html>