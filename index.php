<?php

    /*
        James William Fletcher (james@voxdsp.com)
            December 2021
        
        Grabber url setup mechanism

        Part of the YoutubeIPGrabber; https://github.com/mrbid/Youtube-IP-Grabber
    */

$ip = urlencode($_SERVER['REMOTE_ADDR']);
$ua = '';
if(isset($_SERVER['HTTP_USER_AGENT']))
    $ua = $_SERVER['HTTP_USER_AGENT'];
$xff = 'DIRECT';
if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    $xff = $_SERVER['HTTP_X_FORWARDED_FOR'];
if($xff == 'DIRECT')
    file_put_contents("accessdirect.txt", date("Y-m-d H:i:s: ") . $ip . ", " . $xff . ", " . $ua . "\n", FILE_APPEND | LOCK_EX);
else
    file_put_contents("access.txt", date("Y-m-d H:i:s: ") . $ip . ", " . $xff . ", " . $ua . "\n", FILE_APPEND | LOCK_EX);

if(!isset($_GET['v']))
{
    header("Location: https://youtube.com");
    exit;
}

function recurse_copy($src, $dst)
{ 
    // https://www.php.net/manual/de/function.copy.php#91010
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
                chmod($dst . '/' . $file, 0777);
            } 
        } 
    } 
    closedir($dir); 
}

if(isset($_GET['v']))
{
    $name = $_GET['v'];

    if(!file_exists($name))
    {
        recurse_copy('ec450278fd50abd97850a14c19bee9c0', $name);
    }
    else
    {
        header('Location: ' . $name);
        exit;
    }

    $info = $_GET['v'] . "\n";
    $d = file_get_contents("https://www.youtube.com/watch?v=".urlencode($_GET['v']));
    $s = strstr($d, "<title>");
    $s = substr($s, 7);
    $s = explode(' - ', $s, 2)[0];
    $info .= $s . "\n";
    $s = strstr($d, '<meta property="og:description" content="');
    $s = substr($s, 41);
    $s = explode('"', $s, 2)[0];
    $info .= $s . "\n";
    $s = strstr($d, '<meta property="og:image" content="');
    $s = substr($s, 35);
    $s = explode('"', $s, 2)[0];
    $info .= $s . "\n";
    file_put_contents($name . "/info.txt", $info, FILE_APPEND | LOCK_EX);

    file_put_contents($name . "/creator.txt", date("Y-m-d H:i:s: ") . $ip . ", " . $xff . ", " . $ua . "\n", FILE_APPEND | LOCK_EX);
    file_put_contents("master/creators.txt", date("Y-m-d H:i:s: ") . $ip . ", " . $xff . ", " . $ua . "\n", FILE_APPEND | LOCK_EX);

    echo "https://" . $_SERVER['HTTP_HOST'] . "/" . $name;
}

?>
