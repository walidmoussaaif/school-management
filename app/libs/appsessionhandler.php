<?php
    namespace APP\LIBS;
    class AppSessionHandler extends  \SessionHandler
    {
        private $sessionName = SESSION_NAME;
        private $sessionSavePath = SESSION_SAVE_PATH;

        public function __construct()
        {
            session_name($this->sessionName);
            session_save_path($this->sessionSavePath);
            //session_set_save_handler($this, true);
        }

        public function __get($key) {
            if(isset($_SESSION[$key])) {
                $data = @unserialize($_SESSION[$key]);
                if($data === false) {
                    return $_SESSION[$key];
                } else {
                    return $data;
                }
            }
        }

        public function __set($key, $value) {
            if(is_object($value)) {
                $_SESSION[$key] = serialize($value);
            } else {
                $_SESSION[$key] = $value;
            }
        }

        public function __isset($key)
        {
            return isset($_SESSION[$key]) ? true : false;
        }

        public function __unset($key)
        {
            unset($_SESSION[$key]);
        }

        public function start()
        {
            if('' === session_id()) {
                session_start();
            }
        }

        public function kill()
        {
            session_unset();
            session_destroy();
        }
    }

