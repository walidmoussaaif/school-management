<?php
    namespace APP\LIBS\DATABASE;

    class PDODatabaseHandler
    {
        private static $_instance;
        private static $_handler;

        private function __construct(){
            self::init();
        }

        public function __call($name, $arguments)
        {
            return call_user_func_array(array(&self::$_handler, $name), $arguments);
        }

        private static function init()
        {
            try {
                self::$_handler = new \PDO(
                    'mysql:hostname=' . DB_HOST_NAME . ';port=' . DB_PORT  .';dbname=' . DB_NAME,
                    DB_USER_NAME, DB_PASSWORD, array(
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
                        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                    )
                );
            } catch (\PDOException $e) {}
        }

        public static function getInstance()
        {
            if(self::$_instance === null) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
    }