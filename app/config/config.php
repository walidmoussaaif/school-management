<?php
    define('DS',DIRECTORY_SEPARATOR);
    define('APP_PATH',realpath(__DIR__) . DS . '..');
    define('VIEWS_PATH',APP_PATH . DS . 'views' . DS);
    define('TEMPLATES_PATH',APP_PATH . DS . 'templates' . DS);
    define('CSS','/css/');
    define('JS', '/js/');
    define('LANGUAGES_PATH',APP_PATH . DS . 'languages' . DS);
    define('APP_DEFAULT_LANGUAGE','fr');

    //database
    defined('DB_HOST_NAME') ? null : define('DB_HOST_NAME','localhost');
    defined('DB_USER_NAME') ? null : define('DB_USER_NAME','root');
    defined('DB_PASSWORD')  ? null : define('DB_PASSWORD','');
    defined('DB_NAME')      ? null : define('DB_NAME','school');
    defined('DB_PORT')      ? null : define('DB_PORT',3306);

    //session
    define('SESSION_SAVE_PATH', APP_PATH . DS . '..' . DS . 'Sessions');
    define('SESSION_NAME','_MVCSESSION_');

    //uploads
    define('UPLOAD_STORAGE', APP_PATH . DS . '..' . DS . 'public' . DS . 'uploads');
    define('IMAGES_UPLOAD_STORAGE',UPLOAD_STORAGE . DS . 'images');
    define('DOCUMENTS_UPLOAD_STORAGE',UPLOAD_STORAGE . DS . 'documents');
    define('APP_SALT', '$2a$07$yeNCSNwRpYopOhv0TrrReP$');
    define('MAX_FILE_SIZE_ALLOWED',ini_get('upload_max_filesize'));