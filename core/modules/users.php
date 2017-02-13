<?php
class users
{

    public function newUser($arg)
    {
        $arg = self::stripslashes_deep($arg);
        if (preg_match('/[^a-zA-Z0-9]+/',$arg['login']) || (mb_strlen($arg['login']) < 6 || mb_strlen($arg['login']) > 20))
            return 'Не коректно введен логин!';
        if (preg_match('/[^a-zA-Z0-9]+/',$arg['password']) || (mb_strlen($arg['password']) < 6 || mb_strlen($arg['password']) > 20))
            return 'Не коректно введен пароль!';
        if ($arg['password'] !== $arg['repassword'])
            return 'Пароли не совпадают!';
        if (!preg_match('/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/',$arg['email']))
            return 'Не коректно введена почта!';
        if (preg_match('/[^а-яА-ЯёЁ]+/u',$arg['name']) || mb_strlen($arg['name']) < 1)
            return 'Не коректно введено имя!';
        if (preg_match('/[^а-яА-ЯёЁ]+/u',$arg['firstname'],$math))
            return 'Не коректно введена фамилия!';
        if (preg_match('/[^а-яА-ЯёЁ]+/u',$arg['patronymic']))
            return 'Не коректно введено отчество!';
        if (preg_match('/(\d{4}\-\d{2}\-\d{2})/',$arg['bdate']) || mb_strlen($arg['bdate']) < 1)
            return 'Не коректно введена дата рождения!';
        $db = db::GetInit();
        if($db->get_row($db->query("SELECT count(*) FROM `users` WHERE `login` = ".$db->real_escape($arg['login'])))['count(*)'] > 0)
            return 'Пользователь с таким логином уже существует';
        $salt = self::generate_code(5);
        $ip = ip2long(checkip::GetRealIP());
        $arg['password'] = md5(md5($arg['password']).md5($salt));
        if($db->query("INSERT INTO `users`(`login`, `hash`, `salt`, `email`, `name`, `firstname`, `patronymic`, `bdate`, `about`, `ip`)
                VALUES (".$db->real_escape($arg['login']).",'{$arg['password']}','{$salt}',".$db->real_escape($arg['email']).",".$db->real_escape($arg['name']).", ".$db->real_escape($arg['firstname']).",".$db->real_escape($arg['patronymic']).",".$db->real_escape($arg['bdate']).",".$db->real_escape($arg['about']).",'$ip')")) {
            $time = date("Y-m-d",time());
            if($db->get_row($db->query("SELECT count(*) FROM `ip` WHERE `ip` = '$ip'"))['count(*)'] > 0)
                $db->query("UPDATE `ip` SET `time`= '$time' WHERE `ip`='$ip'");
            else
                $db->query("INSERT INTO `ip` (`ip`, `time`) VALUES ('$ip','$time')");
            return 0;
        } else return "Пользователь не добавлен, обратитесь к администрации";
    }
    public function loginUser($arg)
    {
        $arg = self::stripslashes_deep($arg);
        $db = db::GetInit();
        if($q = $db->get_row($db->query("SELECT * FROM `users` WHERE `login` = ".$db->real_escape($arg['login']))))
            if(md5(md5($arg['password']).md5($q['salt'])) == $q['hash'])
                return 0;
            else return "Неверно указан логин или пароль";
        else return "Неверно указан логин или пароль";
    }
    static function stripslashes_deep($value)
	{
		if(is_array($value))
			$value = array_map('self::stripslashes_deep', $value);
		elseif (!empty($value) && is_string($value))
			$value = stripslashes($value);
		return $value;
	}
    static function generate_code($number)
    {
        $arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z',
        'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','R','S','T','U','V','X','Y','Z',
        '1','2','3','4','5','6','7','8','9','0','!','@');

        $return = "";

        for($i = 0; $i < $number; $i++) {
            $index = rand(0, count($arr) - 1);
            $return .= $arr[$index];
        }

        return $return;
    }
}

 ?>
