<?php
class users
{

    public function newUser($arg)
    {
        $arg['login'] = htmlspecialchars(stripslashes($arg['login']));
        $arg['password'] = htmlspecialchars(stripslashes($arg['password']));
        $arg['email'] = htmlspecialchars(stripslashes($arg['email']));
        $arg['name'] = htmlspecialchars(stripslashes($arg['name']));
        $arg['firstname'] = htmlspecialchars(stripslashes($arg['firstname']));
        $arg['patronymic'] = htmlspecialchars(stripslashes($arg['patronymic']));
        $arg['bdate'] = htmlspecialchars(stripslashes($arg['bdate']));
        $arg['about'] = htmlspecialchars(stripslashes($arg['about']));
        $db = db::GetInit();
        $q = $db->query("SELECT count(*) FROM `users` WHERE `login` = '{$arg['login']}'");
        $q = $db->get_row();
        if($q['count(*)'] > 0)
            return 'Пользователь с таким логином уже существует';
        $salt = "!2sar";
        $ip = ip2long(checkip::GetRealIP());
        $arg['password'] = md5(md5($arg['password']).md5($salt));
        if($db->query("INSERT INTO `users`(`login`, `hash`, `salt`, `email`, `name`, `firstname`, `patronymic`, `bdate`, `about`, `ip`) VALUES ('{$arg['login']}','{$arg['password']}','{$salt}','{$arg['email']}','{$arg['name']}','{$arg['firstname']}','{$arg['patronymic']}','{$arg['bdate']}','{$arg['about']}','$ip')")) {
            $q = $db->query("SELECT count(*) FROM `ip` WHERE `ip` = '$ip'");
            $q = $db->get_row();
            $time = date("Y-m-d",time());
            if($q['count(*)'] > 0)
                $db->query("UPDATE `ip` SET `time`= '$time' WHERE `ip`='$ip'");
            else
                $db->query("INSERT INTO `ip` (`ip`, `time`) VALUES ('$ip','$time')");
            return 0;
        } else return "Пользователь не добавлен, обратитесь к администрации";
    }
    public function loginUser($arg)
    {
        $arg['login'] = htmlspecialchars(stripslashes($arg['login']));
        $arg['password'] = htmlspecialchars(stripslashes($arg['password']));
        $db = db::GetInit();
        $q = $db->query("SELECT * FROM `users` WHERE `login` = '{$arg['login']}'");
        $q = $db->get_row();
        if($q)
            if(md5(md5($arg['password']).md5($q['salt'])) == $q['hash'])
                return 0;
            else return "Неверно указан логин или пароль";
        else return "Неверно указан логин или пароль";
    }
}

 ?>
