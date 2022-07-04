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

    if(!isset($_GET['id']) || $_GET['id'] == '')
    {
        echo(json_encode($result));
        exit();
    }
    else
    {
        try 
        {
            $id = h($_GET['id']);
            $dbh = new PDO('sqlite:../db/blog.db');
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = 'DELETE FROM article WHERE id=:id';
            
            $stmt = $dbh->prepare($sql);
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