<?php
    /*
        James William Fletcher (github.com/mrbid)
            December 2021
        
        Grabber URL Payload logger

        Part of the YoutubeIPGrabber; https://github.com/mrbid/Youtube-IP-Grabber
    */
    $r = str_replace('&ua=', "&ua=".date("Y-m-d H:i:s: "), $_SERVER['QUERY_STRING']);
    file_put_contents("log.txt", $r . "\n", FILE_APPEND | LOCK_EX);
    file_put_contents("../master/log.txt", $r . "\n", FILE_APPEND | LOCK_EX);
?>
