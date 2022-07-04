<?php

    require_once('../common/config.php');
    require_once('../common/common_func.php');
    try 
    {

        $html = '';

        $dbh = new PDO('sqlite:../db/blog.db');
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT id,title,description,created FROM article WHERE displayflag="true" ORDER BY id DESC';
        
        $stmt = $dbh->prepare($sql);

        $stmt->execute();

        $dbh = null;

        while ($row = $stmt->fetch()) {
            $html .= '<a href="./#'.$row['id'].'", class="black-text card-link">'."\n";
                $html .= '<div class="card">'."\n";
                    $html .= '<div class="card-content">'."\n";
                    $html .= '<span class="card-title">'.$row['title'].'</span>'."\n";
                    $html .= '<p>'.$row['description'].'</p>'."\n";
                    $html .= '<p class="right-align">'.$row['created'].'</p>'."\n";
                    $html .= '</div>'."\n";
                $html .= '</div>'."\n";
            $html .= '</a>'."\n";
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