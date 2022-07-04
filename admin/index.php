<?php
    require_once('../common/config.php');
    require_once('../common/common_data.php');
    require_once('../common/common_func.php');

    session_start();
    session_regenerate_id();

    if( has_login($_SESSION) == false )
    {
        header('Location: ../login');
        exit();
    }

    $referer = $_SERVER['HTTP_REFERER'];
    $url = parse_url($referer);
    $host = $url['host'];

    if(referrerCheck($host) == false)
    {
        $_SESSION = array();
        header('Location: ../login');
        exit();
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

            <h1 class="center-align blog-title">管理人画面<br>
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
                <a href="edit.php" class="card-link">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">新規作成</span>
                            <p>あたらしい記事を作ります</p>
                        </div>
                    </div>
                </a>

                <a href="select.php" class="card-link">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">変更</span>
                            <p>すでに作成された記事に変更を加えます</p>
                        </div>
                    </div>
                </a>
            </div>
            
        </main>

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
                <a href="../login">
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