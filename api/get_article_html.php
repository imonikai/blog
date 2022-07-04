<?php

    require_once('../common/config.php');
    require_once('../common/common_func.php');
    try 
    {

        $html = '';

        if( !isset($_GET['id']) )
        {
            echo '記事のIDを指定してください';
            exit();
        }

        $id = $_GET['id'];

        $dbh = new PDO('sqlite:../db/blog.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT title,content FROM article WHERE id=:id AND displayFlag="true" ORDER BY id DESC';
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id);

        $stmt->execute();

        $dbh = null;

        while ($row = $stmt->fetch()) {
            $html .= '<div class="card">'."\n";
            $html .= '<div class="card-content">'."\n";
            $html .= '<span class="card-title center-align">'."\n";
            $html .= '<h4>'.h($row['title']).'</h4>'."\n";
            $html .= '</span>'."\n";
            $html .= $row['content']."\n";
            $html .= '</div>'."\n";
            $html .= '</div>'."\n";
        }
        echo $html;
        exit();
    }
    catch(PDOException $e)
    {
        $dbh = null;
        echo $e;
        exit();

    }
?>