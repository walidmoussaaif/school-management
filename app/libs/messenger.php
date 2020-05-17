<?php
    namespace APP\LIBS;

    class Messenger
    {
        const APP_MSG_SUCCESS = 'alert-success';
        const APP_MSG_ERROR   = 'alert-danger';
        const APP_MSG_WARNING = 'alert-warning';
        const APP_MSG_INFO    = 'alert-info';
        private static $_instance;
        private $_session;
        private $_messages = [];

        private function __construct($session)
        {
            $this->_session = $session;
        }
        private function __clone(){}

        public static function getInstance(AppSessionHandler $session)
        {
            if(self::$_instance == null){
                self::$_instance = new self($session);
            }
            return self::$_instance;
        }

        private function messagesExists()
        {
            return isset($this->_session->messages);
        }

        public function add($message,$type = self::APP_MSG_SUCCESS)
        {
            if(!$this->messagesExists()){
                $this->_session->messages = [];
            }
            $msgs = $this->_session->messages;
            $msgs[] = [$message,$type];
            $this->_session->messages = $msgs;
        }

        public function getMessages()
        {
            if($this->messagesExists()){
                $this->_messages = $this->_session->messages;
                unset($this->_session->messages);
                return $this->_messages;
            }
            return [];
        }
    }