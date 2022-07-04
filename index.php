<?php
    require_once('./common/config.php');
    require_once('./common/common_data.php');
    require_once('./common/common_func.php');
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

        <link rel="stylesheet" href="style.css">
    </head>

    <body class="light-green lighten-5">

        <header>

            <i class="material-icons"><a href="" data-target="slide-out" class="sidenav-trigger black-text">menu</a></i>



            <h1 class="center-align blog-title">
                <a href="" class="top-link black-text">
                    <?php echo BLOG_TITLE ?><br>
                    <span class="sub-title">
                        <?php 
                            echo UNIV_ID;
                            echo ' ';
                            echo UNIV_MY_NAME;
                            echo ' 最終更新日時'.date("Y/m/d/ H:i:s", getUpdateDate('index.php'));
                        ?>
                    </span>
                </a>
            </h1>



        </header>
        
        <main>
            <div class="container" id="main-content" style="display: none"></div>
        </main>

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
                <a href="./login">
                    <i class="material-icons">check</i>ログイン
                </a>
            </li>
        </ul>

        <script>
            $(document).ready(function(){
                $('.sidenav').sidenav();
            });
        </script>

        <footer class='.center-align'>

        </footer>
        
        
        <!-- Materialize JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

        <script src="fetch.js"></script>
        <script src="index.js"></script>
    </body>
</html>