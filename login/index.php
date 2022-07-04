<?php
    require_once('../common/config.php');
    require_once('../common/common_data.php');
    require_once('../common/common_func.php');


    session_start();
    session_regenerate_id(true);

    if( has_login($_SESSION) == true )
    {
        header('Location: ../admin');
        exit();
    }

    if(isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] == ADMIN_EMAIL)
    {
        if(password_verify($_POST['password'], PASSWORD_HASHED_DATA))
        {
            $_SESSION[SESSION_KEY_LOGIN] = ADMIN_LOGIN;
            session_regenerate_id(true);
            header('Location: ../admin');
        }
        else
        {
            $_SESSION = array();
            header('Location: ./index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang = "ja">

    <head>
        <meta charset = "utf-8">
        <title>あたらしいブログ</title>
        <meta name = "viewport" content = "width=device-width,initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- Google icon font -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Materialize CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
            <!--- jquery -->
            <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous">
        </script>

        <link rel="stylesheet" href="../style.css">
    </head>

    <body class="light-green lighten-5">

        <header>
        <i class="material-icons"><a href="" data-target="slide-out" class="sidenav-trigger black-text">menu</a></i>

            <h1 class="center-align blog-title"><?php echo BLOG_TITLE ?><br>
                <span class="sub-title">
                    <?php 
                          echo UNIV_ID;
                          echo ' ';
                          echo UNIV_MY_NAME;
                          echo ' 最終更新日時'.date("Y/m/d/ H:i:s", getUpdateDate('index.php'));
                    ?>
                </span>
            </h1>

        </header>
        
        <main>
            <div class="container">
                <form method="POST" action="./index.php" class="login-form">
                    <div class="input-field">
                        <input type="email" name="email" id="email" class="validate">
                        <label for="email">メールアドレス</label>
                        <span class="helper-text" data-error="メールアドレスとして認められないよ！" data-success="メールアドレスだね！"></span>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" id="password" class="validate">
                        <label for="password">パスワード</label>
                        <span class="helper-text" data-error="パスワードとして認められないよ！" data-success="パスワードだね！"></span>
                    </div>
                    <div class="center-align">
                        <input type="submit" value="ログイン" class="center-align btn-large">
                    </div>
                </form>

            </div>

            <ul id="slide-out" class="sidenav">
                <li>
                    <a href="mailto:cehd21067@g.nihon-u.ac.jp">
                    <i class="material-icons">mail_outline</i>お問い合わせ
                    </a>
                </li>
                <li>
                    <a href="https://www.youtube.com/watch?v=AYJrRakUyvg" target="_blank">
                        <i class="material-icons">tv</i>好きな動画１
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="material-icons">check</i>ログイン
                    </a>
                </li>
            </ul>

            <script>
                $(document).ready(function(){
                    $('.sidenav').sidenav();
                });
            </script>

        <footer>

        </footer>
        
        
        <!-- Materialize JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </body>
</html>