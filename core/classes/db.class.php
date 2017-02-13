<?php
class db
{
    /**
     * Хранит один экземпляр класса Controller
     * @static Controller $_init
     **/
    private static $_init = null;
    /**
     * Текущее соединение к mysql
     **/
    public $db_id = FALSE;
    /**
     * Ид последнего запроа
     **/
    private $query_id = null;
    /**
     * Конфигурации для подключения к mysql
     **/
    public $dbConfig = [
        'user' => 'root',
        'pass' => '',
        'name' => 'tz',
        'location' => 'localhost'
    ];
    /**
     * Конструктор, подключается к mysql
     **/
    private function __construct()
    {
        $this->dbConfig['location'] = explode(":", $db_location);

        if (isset($db_location[1]))
            $this->db_id = @mysqli_connect($db_location[0], $this->dbConfig['user'], $this->dbConfig['pass'], $this->dbConfig['name'], $db_location[1]);
        else
            $this->db_id = @mysqli_connect($db_location[0], $this->dbConfig['user'], $this->dbConfig['pass'], $this->dbConfig['name']);
        if(!$this->db_id) return false;

        if(!defined('COLLATE'))
            define ("COLLATE", "utf8");
        mysqli_query($this->db_id, "SET NAMES '" . COLLATE . "'");
    }
    /**
     * Функция инициализации конструктора
     * @return db|GetInit
     **/
    public static function GetInit()
    {
        if(empty(self::$_init))
        {
            self::$_init = new self;
        }
        return  self::$_init;
    }
    public function close()
    {
        @mysqli_close($this->db_id);
    }

    public function query($query)
    {
        return $this->query_id = mysqli_query($this->db_id, $query);
    }
    function get_row($query_id = '')
    {
        if ($query_id == '') $query_id = $this->query_id;

        return mysqli_fetch_assoc($query_id);
    }
    function real_escape($value) {
		if (!is_numeric($value))
            $value = "'".mysqli_real_escape_string($this->db_id,$value)."'";
		return $value;
	}
}
?>
