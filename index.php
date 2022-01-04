<?php

$user = 'fahim';
//$user = 'cosmos';

// please set your browser cookie here...
$COOKIE_STRING = '_ga=GA1.2.1479320406.1640751935; _gid=GA1.2.2138057181.1640751935; __gads=ID=e4f4cdb373e1aa26-22c58eef90cf00c4:T=1640751937:RT=1640751937:S=ALNI_Mb1QGJYFBzJfT76Gsqhf8A0q3tv_Q; csrf_cookie_name=680acef6d736866e6c60fb9a4416032e; login_key=$11475$$2y$10$x23p/ajAtA1HkptEhW5ULe/snru4QjXa/qse6V/LcbTrnuofczIlq; action_token=aec02a9eb3eeab927af21b026306dc4c';

if($user == 'cosmos')
{
    $COOKIE_STRING = '_ga=GA1.2.2107435311.1640498022; __gads=ID=19132c62d1be0d25-22be6f8c88cf00ad:T=1640498159:RT=1640498159:S=ALNI_MZFY34cjgiKC7KNnE935dTRlhPZDw; login_key=%249236%24%242y%2410%24PwstL7MM9NhQIeX6c9uoR.xeSol.YEpplYwo6ylVN.pvxLAO84JU.; action_token=6ec2894270a34c241ba597ebc7baff25; csrf_cookie_name=9f69a8e32ae0e218de1ee0ea1de35dd0; _gid=GA1.2.1197642389.1641053226';
}

$starttime = microtime(true); // Top of page

ini_set('max_execution_time',0);
include_once 'lib/simplehtmldom.php';
include_once 'lib/dooplays.php';
$doop = new doopaction($COOKIE_STRING);


if(isset($_REQUEST['sendtrophy']))
{
    ini_set('max_execution_time',65);
    $doop->send_trophy();
    echo 'trophy sending.....';
}


if(isset($_REQUEST['arena']))
{
    $doop->play_battle_arena();
    echo 'arena complete';
    // exit;
}
if(isset($_REQUEST['slot']))
{
    $doop->play_slot_machine();
    echo 'slot machine playing complete';
    // exit();
}

//echo $doop->arena_buy_silver_ticket();
if(isset($_REQUEST['trophy']))
{
    $doop->buy_energyresotoreposon();
    for ($i = 0;$i<100;$i++)
    {
        $doop->play_work_missingcrystal();
        echo "{$i}\n";
    }
    //  exit;
}


$endtime = microtime(true); // Bottom of page

printf("Page loaded in %f seconds", $endtime - $starttime );
