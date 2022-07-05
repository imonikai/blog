<?php
    require_once('../common/config.php');
    require_once('../common/common_func.php');

    session_start();
    session_regenerate_id();

    $result = array(RESPONSE_KEY_RESULT => RESPONSE_NG);

    if( has_login($_SESSION) == false )
    {
        echo(json_encode($result));
        exit();
    }

    $referer = $_SERVER['HTTP_REFERER'];
    $url = parse_url($referer);
    $host = $url['host'];

    if(referrerCheck($host) == false)
    {
        $_SESSION = array();
        echo(json_encode($result));
        exit();
    }

    if( !isset($_GET['id']) || !isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['content']) || !isset($_POST['displayFlag']) || $_GET['id'] == '' || $_POST['title'] == '' || $_POST['description'] == '' || $_POST['content'] == '' || $_POST['displayFlag'] == '')
    {
        echo(json_encode($result));
        exit();
    }
    else
    {
        try 
        {

            $id = h($_GET['id']);
            $title = h($_POST['title']);
            $description = h($_POST['description']);
            $content = $_POST['content'];
            $displayFlag = h($_POST['displayFlag']);

            $content = preg_replace('/<script.*?>.*?<\/script>/mis', '', $content);

            $dbh = new PDO('sqlite:../db/blog.db');
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'UPDATE article SET title=:title, description=:description, content=:content,displayflag=:displayflag WHERE id=:id';
            
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':content', $content);
            $stmt->bindValue(':displayflag', $displayFlag);
            $stmt->bindValue(':id', $id);

            $stmt->execute();

            $dbh = null;

            $result = array(RESPONSE_KEY_RESULT => RESPONSE_OK);
            echo json_encode($result);
            exit();

        }
        catch(PDOException $e)
        {
            $dbh = null;
            echo json_encode($result);
            exit();

        }
    }


?>