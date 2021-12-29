<?php

ini_set('max_execution_time',0);

include_once 'lib/simplehtmldom.php';
include_once 'lib/dooplays.php';

$doop = new doopaction();

//echo $doop->arena_buy_silver_ticket();

for ($i = 0;$i<100;$i++)
{
    $doop->play_work_missingcrystal();
    echo "{$i}\n";
}

