<?php
    namespace APP\LIBS;
    class Language
    {
        private $dictionary = [];
        public function load($path)
        {
            $defaultLanguage = APP_DEFAULT_LANGUAGE;
            if(isset($_SESSION['lang'])){
                $defaultLanguage = $_SESSION['lang'];
            }
            $path = explode('.',$path);
            $langFilePath = LANGUAGES_PATH . $defaultLanguage . DS . $path[0] . DS . $path[1] . '.lang.php';
            if(file_exists($langFilePath)){
                require $langFilePath;
                if(isset($_) && is_array($_) && !empty($_)){
                    foreach ($_ as $key => $value){
                        if(!array_key_exists($key,$this->dictionary)){
                            $this->dictionary[$key] = $value;
                        }
                    }
                }
            }
        }

        public function getDictionary()
        {
            return $this->dictionary;
        }

        public function get($key)
        {
            if(array_key_exists($key, $this->dictionary)) {
                return $this->dictionary[$key];
            }
        }
    }