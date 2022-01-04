<?php


class doopaction extends dooplays{



    function send_trophy()
    {
        // only max trophy will send

        // get trophy list
        $page = $this->get_page('https://dooplays.xyz/qute/trophy/index/act/select/src/board');

        $scnd = $this->trophy_get_seconds($page);
            sleep($scnd);

        $tokenurl = $this->get_tokenurl($page,'select/id/236');
        if($tokenurl == null)
        {
            echo 'no trophy';
        }else{
            $this->get_page($tokenurl);
        }

    }


    function trophy_get_seconds($page)
    {
        $ptrn = "|again after (\d+) seconds|";
        if(preg_match($ptrn,$page,$mtc))
        {
            return  $mtc[1];
        }
        return 1;
    }


    function start_missingcrystal()
    {
        // show joblist
        $page = $this->get_page("https://dooplays.xyz/qute/missing/index/show/0");
        $tokenurl = $this->get_tokenurl($page,'act/start');
        if($tokenurl == null)
        {

        }else{
            $page = $this->get_page($tokenurl);
            echo $page;
        }
    }


    function buy_energyresotoreposon()
    {
        $url = "https://dooplays.xyz/qute/mall/index/mode/special/id/252/subpage/0/act/buy/confirm/0/src/board";

        $page = $this->get_page($url);
        $tokenurl = $this->get_tokenurl($page,'act/buy');
        $page = $this->get_page($tokenurl);

    }

    function play_work_missingcrystal()
    {
        // $this->buy_energyresotoreposon();
        // start
        // get targeted 4 images

        $lastpage = '';
        $dom =null;
        $myurls = [];
        $ansindex = [];
        for($i =0;$i<3;$i++)
        {
            // echo $i;
            $page = $this->get_page("https://dooplays.xyz/qute/missing/index/show/{$i}");

            if(strpos($page,'sleeping'))
            {
                echo 'sleeping....';
                exit;
            }

            if(strpos($page,'use elixir'))
            {
                $tokenurl = $this->get_tokenurl($page,'act/elixir');
                $this->get_page($tokenurl);
                return;
            }


            $lastpage = $page;
            $tokenurl = $this->get_tokenurl($page,"act/next");
            if($tokenurl == null)
            {

            }else{
                $page = $this->get_page($tokenurl);
                echo 'going next page';
                return;
            }
            $tokenurl = $this->get_tokenurl($page,"reward/1");
            if($tokenurl == null)
            {

            }else{
                $page = $this->get_page($tokenurl);
                $page = $this->get_page("https://dooplays.xyz/qute/job/index/src/missing");
                echo 'Getting reword';
                return;
            }
            $tokenurl = $this->get_tokenurl($page,'act/start');
            if($tokenurl == null)
            {

            }else{
                $page = $this->get_page($tokenurl);
                echo "game starting...";
                return;
            }

            if(strpos($page,'Not enough energy'))
            {

                //
                $page = $this->get_page("https://dooplays.xyz/qute/job/index/act/quit/confirm/0");
                $tokenurl = $this->get_tokenurl($page,'quit/confirm');
                $page = $this->get_page($tokenurl);
                $this->goto_sleep();
                //sleep(180)
                echo 'game done.. take 3 minute break';
                exit();
            }


            $dom = str_get_html($page);
            $images = $dom->find("//img");

            foreach ($images as $image)
            {
                $imageurl = $image->src;
                if(strpos($image,'missing'))
                {

                    if(strpos($imageurl,'_'))
                    {
                        $myurls[md5($imageurl)] = $imageurl;

                    }else{
                        $ansindex[md5($imageurl)] = [$imageurl];
                    }
                }
            }
        }

        $aa = [];
        // find ans
        $l =0;
        foreach ($ansindex as $key =>$nn)
        {
            $u = basename($nn[0]);
            $u = substr($u,0,strpos($u,'.'));
            $aa[$l] = 0;

            foreach ($myurls as $kky => $xx)
            {
                $xy = basename($xx);

                $xy = substr($xy,0,strpos($xy,'_'));
                if($u == $xy)
                {
                    $aa[$l] = 1;
                }
            }
            $l++;
        }



//,$image->parent()->href
// get ans url

        $ans = 0;
        $p =0;
        foreach ($aa as $ann)
        {
            if($ann ==0)
            {
                $ans = $p;
            }
            $p++;
        }

        $tokenurl = $this->get_tokenurl($page,"number/{$ans}?token");

        // print_r($myurls);
        // print_r($ansindex);
        //  print_r($aa);

        // echo $tokenurl;
        $page = $this->get_page($tokenurl);
        // echo $page;
        // get 3 page images
        return;
    }


    function goto_sleep()
    {
        $url = "https://dooplays.xyz/qute/creature/index/src/job";
        $page = $this->get_page($url);
        $tokenurl = $this->get_tokenurl($page,'act/sleep');
        $page = $this->get_page($tokenurl);
    }

    function play_battle_arena()
    {
        $straturl = "https://dooplays.xyz/qute/arena/index/act/ticket/id/420/src/";
        $nextroundurl = "https://dooplays.xyz/qute/battle/index/src/arena";
        $skill_strongpunch = "https://dooplays.xyz/qute/battle/index/act/skill/id/7";
        $next = "https://dooplays.xyz/qute/battle/index/act/next";
        $skill_notmalattack = "https://dooplays.xyz/qute/battle/index/act/skill/id/1";
        $dicline = "https://dooplays.xyz/qute/arena/index/arena/1/act/decline/src/battle";
        $skill_decary = "https://dooplays.xyz/qute/battle/index/act/skill/id/12";
        $skill_concontrate = "https://dooplays.xyz/qute/battle/index/act/skill/id/16";
        $accept_quite = "https://dooplays.xyz/qute/arena/index/arena/1/act/accept/src/battle";

        // buy ticket
        $ticketpage = $this->get_page('https://dooplays.xyz/qute/mall/index/mode/special/id/420/subpage/0/act/buy/confirm/0/src/board');
        $buytiurl = $this->get_tokenurl($ticketpage,'buy/confirm');
        $this->get_page($buytiurl);

        //begin
        $xpage = $this->get_page('https://dooplays.xyz/qute/arena/index/act/ticket/id/420/src/battle');
        $keeploop =1;
        $next_url = $nextroundurl;

        $i =0;
        while ($keeploop)
        {
            $i++;
            if($i > 65)
            {
                $keeploop =0;
                $this->get_page($accept_quite);
                $this->get_page('https://dooplays.xyz/qute/arena/index/act/quit/confirm/1/src/creature');

            }





            echo $next_url .'<br/>';
            $xpage = $this->get_page($next_url);
            $fskillurl = $this->get_tokenurl($xpage,'act/skill');
            if($fskillurl == null)
            {

            }else{
                $next_url = $fskillurl;
                continue;
            }

            if(strpos($xpage,'cool.gif')>0)
            {
                $rurl = $this->get_tokenurl($xpage,'act/accept');
                if($rurl == null)
                {

                }else{
                    $next_url = $rurl;
                    $this->get_page($rurl);
                    $keeploop = 0; // battle end
                    continue;
                }
            }


            $rurl = $this->get_tokenurl($xpage,'battle/index/src/arena');
            if($rurl == null)
            {

            }else{
                $next_url = $rurl;
                continue;
            }

            $rurl = $this->get_tokenurl($xpage,'index/act/next');
            if($rurl == null)
            {

            }else{
                $next_url = $rurl;
                continue;
            }

            $rurl = $this->get_tokenurl($xpage,'ticket/id/420');
            if($rurl == null)
            {

            }else{
                $next_url = $rurl;
                continue;
            }


            $rurl = $this->get_tokenurl($xpage,'act/decline');
            if($rurl == null)
            {

            }else{
                $next_url = $rurl;
                continue;
            }

            $rurl = $this->get_tokenurl($xpage,'act/accept');
            if($rurl == null)
            {

            }else{
                $next_url = $rurl;
                $this->get_page($rurl);
                $keeploop = 0; // battle end
                continue;
            }


            if($i > 70)
            {
                $keeploop =0;
                $this->get_page($accept_quite);
                $this->get_page('https://dooplays.xyz/qute/arena/index/act/quit/confirm/1/src/creature');
            }
        }
    }

    function arena_firstskill($page)
    {
        $fskillurl = $this->get_tokenurl($page,'act/skill');
        $page = $this->get_page($fskillurl);
        $nextp = $this->get_page('https://dooplays.xyz/qute/battle/index/act/next');
        $turl = $this->get_tokenurl($nextp,'act/accept');
        if($turl == null)
        {

        }else{

        }
    }

    function arena_buy_silver_ticket($limit =10)
    {
        $url ="https://dooplays.xyz/qute/mall/index/mode/special/id/420/subpage/0/act/buy/confirm/1/src/arena?token=8aa8263dc4e7f02997bdc2c4a64f019b";
        $page = $this->get_page($url);
        $turl =  $this->get_tokenurl($page);
        if($turl !== null)
        {
            $npage = $this->get_page($turl);
            echo $npage;
        }
    }

    function play_slot_machine()
    {
        $url ="https://dooplays.xyz/qute/slot/index/act/next?token=8ca6d2faa3651210b52840379d661c35";
        $keepplaying = 1;

        while ($keepplaying)
        {
            $page = $this->get_page($url);
            $tokenurl = $this->get_tokenurl($page);
            if($tokenurl == null)
            {
                $keepplaying = 0;
            }else{
                $url = $tokenurl;
            }
        }
        echo "complete";

    }

}



class  dooplays{

    public $cookie = '';

    function __construct($cookie)
    {
        $this->cookie = $cookie;
    }

    function see_priyo_place()
    {
        return   $this->get_page('https://dooplays.xyz/qute/creature/index/src/profile');
    }

    function get_tokenurl($page,$match = 'token=')
    {
        $dom = str_get_html($page);
        $pages = $dom->find("//a");
        foreach ($pages as $urx)
        {
            $url = $urx->href;
            if(strpos($url,$match))
            {
                return $url;
            }
        }
        return null;
    }
    function get_page($url)
    {
        return   $this->func_get_content($url);
    }

    function func_get_content($myurl, $method = 'get', $posts = [], $headers = [],$encoding=0)
    {


        $host = parse_url(urldecode($myurl))['host'];
        //   /*
        if($headers == [])
        {
            $headers = [
                "Host: ".$host,
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.00",
                "Accept-Language: en-US,en;q=0.5",
                // "Accept-Encoding: gzip, deflate, br",
                "Connection: keep-alive",
                "Cookie: {$this->cookie}",
                "Upgrade-Insecure-Requests: 1",
                "TE: Trailers",];
        }
        // */

        $myurl = str_replace(" ","%20",$myurl);
        // global $range;
        $ch = curl_init();

        //  $agent = 'tab mobile';
        // curl_setopt($ch, CURLOPT_PROXY, '85.26.146.169:80');
        curl_setopt($ch, CURLOPT_URL, $myurl);
        // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);

        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/dcookie.txt');
        curl_setopt( $ch, CURLOPT_COOKIEFILE,dirname(__FILE__) . '/dcookie.txt');
        //  curl_setopt($ch, CURLOPT_HEADER, true); // header
        // curl_setopt($ch, CURLOPT_NOBODY, true); // header
        curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
        //  curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_RANGE, $range);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_TIMEOUT , 60);
        # sending manually set cookie
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if($method != 'get')
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($posts));
        }

        //  curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"serialno\":\"$code\"}");


        //   $error = curl_error($ch);
        $result = curl_exec($ch);
        curl_close($ch);
        if($encoding)
        {
            return mb_convert_encoding($result, 'utf-8','auto');
        }

        // debug
        //  file_put_contents($this->ROOT.'/webpage.txt',$result);

        return $result;
        //  return mb_convert_encoding($result, 'UTF-8','auto');
    }

}


