<?php
class checkip
{
    static public function check()
    {
        $db = db::GetInit();
        $q = $db->query("SELECT * FROM `ip` WHERE `ip` = '".ip2long(self::GetRealIP())."'");
        $q = $db->get_row();
        if(!$q)
            return 0;
        else
            if($q['time'] > date("Y-m-d",time()-60*60*24*7))
                return "К сожалению с 1 IP адреса можно регистрироватся 1 раз в 7 дней!";
            else return 0;
    }
    static public function GetRealIP() {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) $ip = $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else $ip = $_SERVER['REMOTE_ADDR'];
        return $ip;
    }
}

?>
