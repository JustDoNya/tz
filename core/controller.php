<?php
class controller
{
    /**
     * Хранит один экземпляр класса Controller
     * @static Controller $_init
     **/
    private static $_init = null;
    /**
     * Хранит экземпляр Базы данных
     * @var $_db
     **/
    private $_db = null;
    /**
     * Функция инициализации конструктора
     * @return controller|GetInit
     **/
    public static function GetInit()
    {
        if(empty(self::$_init))
        {
            self::$_init = new self;
        }
        return  self::$_init;
    }
    /**
     * Функция входа
     **/
    public function index()
    {
        mb_internal_encoding("UTF-8");
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-type: aplication/json');
            echo json_encode($this->$_POST['type']());
            exit;
        }
        $title = "Форма входа";
        include 'view/view.php';
    }
    /**
     * Вызов метода входа в ситему
     * @return false или тескт ошибки
     */
    private function login()
    {
        require '/modules/checkip.php';
        require '/modules/users.php';
        $user = new users;
        return ['error' => $user->loginUser($_POST)];
    }
    /**
     * Вызов метода проверки ИП на дату регистрации
     * @return false или текст ошибки
     */
    private function checkip()
    {
        require '/modules/checkip.php';
        return ['error' => checkip::check()];
    }
    /**
     * Вызов метода регистрации пользователя
     * @return false или тект ошибки
     */
    private function reg()
    {
        require '/modules/checkip.php';
        require '/modules/users.php';
        $user = new users;
        return ['error' => $user->newUser($_POST)];
    }
}
