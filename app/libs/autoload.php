<?php
    namespace APP\LIBS;
    class Autoload
    {
        public static function autoload($classname)
        {
            $classname = str_replace('APP','',$classname);
            $classname = str_replace(array('\\','/'),DS,$classname);
            $classname .= '.php';
            $classname = strtolower($classname);
            if(file_exists(APP_PATH . $classname))
            {
                require APP_PATH . $classname;
            }
            else
            {
                return;
            }
        }
    }
    spl_autoload_register(__NAMESPACE__ . '\Autoload::autoload');
