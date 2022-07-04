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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.7.1/ace.js" integrity="sha512-FKkEO4RZEQjFmU1hoUYdx6HJLdpHpNzgWspgnQCxx7OOkDVz4kiGJxR97yWc5bzjwcCpJC/CRCiQzuoGYAChhQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <link rel="stylesheet" href="../style.css">

    </head>

    <body class="light-green lighten-5">

        <header>
        <i class="material-icons"><a href="" data-target="slide-out" class="sidenav-trigger black-text">menu</a></i>

            <h1 class="center-align"><span class="blog-title"></span><br>
                <span class="sub-title">
                    <?php 
                          echo UNIV_ID;
                          echo ' ';
                          echo UNIV_MY_NAME;
                          echo ' 最終更新日時'.date("Y/m/d/ H:i:s", getUpdateDate('edit.php'));
                    ?>
                </span>
            </h1>

        </header>
        
        <main>
           
            <div class="container">
               <form method="POST" id="article-form">
                     <div class="input-field">
                        <input type="text" id="title-form" name="title">
                        <label for="title-form">タイトル</label>
                    </div>

                    <div class="input-field">
                        <input type="text" id="description-form" name="description">
                        <label for="description-form">説明</label>
                    </div>

                    <div id="editor" style="min-height: 30em"></div>
                    <script>
                        const editor = ace.edit("editor",{
                            theme: "ace/theme/monokai",
                            mode: "ace/mode/html",
                        });
                    </script>

                    <label>
                    <input type="checkbox" class="filled-in" id="displayflag-checkbox" name="displayFlag"/>
                    <span>公開する</span>
                    </label>
                                        
                    <div class="center-align done-btn">
                        <input type="button" value="完了" class="center-align btn-large" id="submit-button">
                    </div>

                    <input type="hidden" id="content" name="content">

                    <script src="./edit.js"></script>

                </form>
            </div>
            
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


        <script src="article_data_fetch.js"></script> 
    </body>
</html>