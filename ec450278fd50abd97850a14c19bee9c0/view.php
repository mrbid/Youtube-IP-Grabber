<?php
    /*
        James William Fletcher (james@voxdsp.com)
            December 2021
        
        Simple local view panel with access logging.

        Part of the YoutubeIPGrabber; https://github.com/mrbid/Youtube-IP-Grabber
    */

    if(isset($_GET['clr']))
    {
        file_put_contents('log.txt', '', LOCK_EX);
        header("Location: view.php");
    }

?>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<style>
    #xyz
    {
        display:inline;
        position:absolute;
        margin:0 auto;
        top: 0;
        left: 0;
        width:100%;
        height:100%;
        z-index: 9999;
    }
</style>

<div id="xyz">
    <table id="dtab" class="display">
    <thead>
        <tr>
            <th style="cursor:pointer;" title="IP Address"><i class="fas fa-user-secret"></i></th>
            <th style="cursor:pointer;" title="User-Agent"><i class="fas fa-question"></i></th>
            <th style="cursor:pointer;" title="CPU Cores"><i class="fas fa-microchip"></i></th>
            <th style="cursor:pointer;" title="Device Memory (GB)"><i class="fas fa-memory"></i></th>
            <th style="cursor:pointer;" title="Graphics Card"><i class="fas fa-puzzle-piece"></i></th>
            <th style="cursor:pointer;" title="Language"><i class="fas fa-flag"></i></th>
            <th style="cursor:pointer;" title="Platform"><i class="fas fa-desktop"></i></th>
            <th style="cursor:pointer;" title="Time-Zone"><i class="far fa-clock"></i></th>
            <th style="cursor:pointer;" title="Effective Connection Type"><i class="fas fa-wifi"></i></th>
            <th style="cursor:pointer;" title="Connection Type"><i class="fas fa-network-wired"></i></th>
            <th style="cursor:pointer;" title="Connection Speed (MB/s)"><i class="fas fa-tachometer-alt"></i></th>
            <th style="cursor:pointer;" title="Connection Ping"><i class="fas fa-hourglass-start"></i></th>
            <th style="cursor:pointer;" title="Number of Browser Plugins"><i class="fas fa-plug"></i></th>
            <th style="cursor:pointer;" title="Colour Depth"><i class="fas fa-palette"></i></th>
            <th style="cursor:pointer;" title="Is loaded IN-APP"><i class="fas fa-tablet-alt"></i></th>
        </tr>
    </thead>
    <tbody>
<?php

function prep0($str)
{
    $title = htmlspecialchars(urldecode($str));

    $str = hash('crc32', $title);
    $str = substr($str, 0, 3);
    $str = substr_replace(strtoupper($str), '-', 2, 0);

    $str = str_replace("00-0", '<font color="#dc3545">NULL</font>', $str);
    $str = str_replace("EC-B", '<font color="#dc3545">NULL</font>', $str);
    return $str;
}

function prep($str)
{
    $str = str_replace('1', '<i class="fab fa-bluetooth" title="Bluetooth" style="cursor:pointer;"></i>', $str);
    $str = str_replace('cellular', '<i class="fas fa-broadcast-tower" title="Cellular" style="cursor:pointer;"></i>', $str);
    $str = str_replace('2', '<i class="fas fa-broadcast-tower" title="Cellular" style="cursor:pointer;"></i>', $str);
    $str = str_replace('3', '<i class="fas fa-network-wired" title="Ethernet" style="cursor:pointer;"></i>', $str);
    $str = str_replace('4', '<i class="fas fa-times" title="None" style="cursor:pointer;"></i>', $str);
    $str = str_replace('wifi', '<i class="fas fa-wifi" title="WIFI" style="cursor:pointer;"></i>', $str);
    $str = str_replace('5', '<i class="fas fa-wifi" title="WIFI" style="cursor:pointer;"></i>', $str);
    $str = str_replace('6', '<i class="fas fa-microwave" title="Wimax" style="cursor:pointer;"></i>', $str);
    $str = str_replace('7', '<i title="Other" style="cursor:pointer;">?</i>', $str);
    $str = str_replace('unknown', '<i title="Unknown" style="cursor:pointer;">?</i>', $str);
    $str = str_replace('8', '<i class="fas fa-question" title="Unknown" style="cursor:pointer;"></i>', $str);
    $str = str_replace('undefined', '<i title="Undefined" style="cursor:pointer;">?</i>', $str);
    $str = str_replace('0', '<i title="Undefined (0)" style="cursor:pointer;">?</i>', $str);
    return $str;
}

function prep2($str)
{
    if($str == '')
        return 0;
    return $str;
}

function catch_undefined($str)
{
    $str = str_replace("undefined", '<font color="#dc3545"><b>UNDEFINED</b></font>', $str);
    $str = str_replace("unknown", '<font color="#dc3545"><b>UNKNOWN</b></font>', $str);
    return $str;
}

function prep3($str)
{
    return urldecode(str_replace('unknown', '0', str_replace('undefined', '-1', $str)));
}

function prep4($str)
{
    $str = str_replace('0', '<i class="fas fa-times"></i>', $str);
    $str = str_replace('1', '<i style="color:#dc3545;" class="fas fa-check"></i>', $str);
    return $str;
}

$lines = explode("\n", file_get_contents('log.txt'));
foreach($lines as $l)
{
    if($l == '')
        continue;
    
    $ar = array();
    $pc = explode('&', $l);
    foreach($pc as $p)
        array_push($ar, explode('=', $p, 2)[1]);

    if(strstr($ar[11], '()') !== FALSE)
        continue;

    echo '<tr>';

    echo '<td style="text-align:center;"><nobr><b style="cursor:pointer;" title="'.htmlspecialchars(urldecode($ar[10])).'"><a href="https://extreme-ip-lookup.com/'.htmlspecialchars($ar[10]).'" target="_blank"><i class="fas fa-fingerprint"></i></a></b>&nbsp;<b style="cursor:pointer;" title="Forwarded For '.htmlspecialchars(urldecode($ar[11])).'"><a href="https://extreme-ip-lookup.com/'.htmlspecialchars($ar[11]).'" target="_blank"><i class="fas fa-random"></i></a></b></nobr></td>';
    echo '<td style="text-align:center;"><b style="cursor:pointer;" title="'.htmlspecialchars(urldecode($ar[9])).'">UA</b></td>';
    echo '<td style="text-align:center;">'.htmlspecialchars(prep3($ar[12])).'</td>';
    echo '<td style="text-align:center;white-space:nowrap;">'.htmlspecialchars(prep3($ar[13])).' GB</td>';
    echo '<td style="text-align:center;"><b style="cursor:pointer;" title="' . htmlspecialchars(urldecode($ar[0])).'">'. prep0($ar[0]) . '</b></td>';
    echo '<td style="text-align:center;white-space:nowrap;">'.htmlspecialchars(prep($ar[1])).'</td>';
    echo '<td style="text-align:center;white-space:nowrap;">'.str_replace('Linux ', '<i style="color:#ffbf00;" class="fab fa-linux"></i>', htmlspecialchars(urldecode($ar[2]))).'</td>';
    echo '<td style="text-align:center;">'.catch_undefined(htmlspecialchars(urldecode($ar[3]))).'</td>';
    echo '<td style="text-align:center;">'.prep(htmlspecialchars($ar[5])).'</td>';
    echo '<td style="text-align:center;">'.prep(htmlspecialchars($ar[6])).'</td>';
    echo '<td style="text-align:center;">'.htmlspecialchars(number_format(prep3($ar[14]), 2)).'</td>';
    echo '<td style="text-align:center;">'.htmlspecialchars(prep3($ar[15])).'</td>';
    echo '<td style="text-align:center;">'.htmlspecialchars(urldecode($ar[6])).'</td>';
    echo '<td style="text-align:center;">'.htmlspecialchars(urldecode($ar[7])).'</td>';
    echo '<td style="text-align:center;">'.prep4(htmlspecialchars(urldecode($ar[8]))).'</td>';
    
    echo '</tr>';
}

?>
    </tbody>
</table> 
</div>

<script>
$(document).ready(function()
{
    $(document).tooltip();
    
    $('#dtab').DataTable(
    {
        "iDisplayLength":2500,
        "order":[],
        "aLengthMenu": [
            [5, 10, 25, 50, 100, 150, 250, 500, 2500, 10000, -1],
            [5, 10, 25, 50, 100, 150, 250, 500, 2500, 10000, "All"]
        ],
    });
});
</script>
