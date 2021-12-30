<?php

$COOKIE_STRING = '_ga=GA1.2.1479320406.1640751935; _gid=GA1.2.2138057181.1640751935; __gads=ID=e4f4cdb373e1aa26-22c58eef90cf00c4:T=1640751937:RT=1640751937:S=ALNI_Mb1QGJYFBzJfT76Gsqhf8A0q3tv_Q; csrf_cookie_name=680acef6d736866e6c60fb9a4416032e; login_key=$11475$$2y$10$x23p/ajAtA1HkptEhW5ULe/snru4QjXa/qse6V/LcbTrnuofczIlq; action_token=aec02a9eb3eeab927af21b026306dc4c';


ini_set('max_execution_time',0);
include_once 'lib/simplehtmldom.php';
include_once 'lib/dooplays.php';

if(isset($_REQUEST['slot']))
{
    $doop->play_slot_machine();
    echo 'slot machine playing complete';
    exit();
}
$doop = new doopaction($COOKIE_STRING);

//echo $doop->arena_buy_silver_ticket();


for ($i = 0;$i<100;$i++)
{
    $doop->play_work_missingcrystal();
    echo "{$i}\n";
}

