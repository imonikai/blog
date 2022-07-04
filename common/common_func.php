<?php

    function h($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    function has_login($session)
    {

        if ( !isset($session[SESSION_KEY_LOGIN]) || $session[SESSION_KEY_LOGIN] != ADMIN_LOGIN )
        {
            return false;
        }
        else if( isset($session[SESSION_KEY_LOGIN]) && $session[SESSION_KEY_LOGIN] == ADMIN_LOGIN )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function getUpdateDate($filename)
    {
        $name = basename($filename);
        date_default_timezone_set('Asia/Tokyo');
        $last_modified = filemtime($name); 
        return  $last_modified;
    }

    function referrerCheck($hostName)
    {
        if( $hostName == HOST ) {
            return true;
        }
        return false;
    }
    
?>