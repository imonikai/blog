<?php
    require_once('../common/config.php');
    require_once('../common/common_func.php');

    session_start();
    session_regenerate_id();

    $result[RESPONSE_KEY_RESULT] = RESPONSE_NG;

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

    if( !isset($_GET['id']) || !isset($_GET['requireHTML']))
    {
        echo(json_encode($result));
        exit();
    }
    else
    {
        try 
        {

            $id = h($_GET['id']);
            $requireHTML = h($_GET['requireHTML']);


            $dbh = new PDO('sqlite:../db/blog.db');
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            if($id == 'all' && $requireHTML == 1)
            {

                $sql = 'SELECT id,title,description,content, FROM article WHERE displayFlag="true"';
            
                $stmt = $dbh->prepare($sql);
    
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                    static $i = 1;
                    $result['article'.$i] = array('id' => $row['id'], 'title' => $row['title'], 'description' => $row['description'], 'content' => $row['content']);
                    $i++;
                }
    
                $dbh = null;

                $result[RESPONSE_KEY_RESULT] = RESPONSE_OK;
                echo json_encode($result);

                exit();
            }
            else if($id == 'all' && $requireHTML == 0)
            {
                $sql = 'SELECT id,title,description FROM article';
            
                $stmt = $dbh->prepare($sql);
    
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                    static $i = 1;
                    $result[$i] = array('id' => $row['id'], 'title' => $row['title'], 'description' => $row['description']);
                    $i++;
                }
    
                $dbh = null;

                $result[RESPONSE_KEY_RESULT] = RESPONSE_OK;
                echo json_encode($result);

                exit();
            }
            else if($id != 'all' && $requireHTML == 1)
            {
                $sql = 'SELECT id,title,description,content FROM article WHERE id=:id';
            
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':id', $id);
    
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                    static $i = 1;
                    $result[$i] = array('id' => $row['id'], 'title' => $row['title'], 'description' => $row['description'], 'content' => $row['content']);
                    $i++;
                }
                $dbh = null;

                $result[RESPONSE_KEY_RESULT] = RESPONSE_OK;
                echo json_encode($result);


                exit();
            }
            else if($id != 'all' && $requireHTML == 0)
            {
                $sql = 'SELECT id,title,description,content FROM article WHERE id=:id';
            
                $stmt = $dbh->prepare($sql);
                $stmt->bindValue(':id', $id);
    
                $stmt->execute();

                while ($row = $stmt->fetch()) {
                    static $i = 1;
                    $result[$i] = array('id' => $row['id'], 'title' => $row['title'], 'description' => $row['description']);
                    $i++;
                }
    
                $dbh = null;

                $result[RESPONSE_KEY_RESULT] = RESPONSE_OK;
                echo json_encode($result);

                exit();
            }
            else
            {

                $result = array(RESPONSE_KEY_RESULT => RESPONSE_NG);
                echo json_encode($result);

                exit();
            }


        }
        catch(PDOException $e)
        {
            $dbh = null;
            $result = array(RESPONSE_KEY_RESULT => RESPONSE_NG);
            echo $e;
            echo json_encode($result);
            exit();

        }
    }
?>