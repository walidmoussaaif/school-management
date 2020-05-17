<?php

    use APP\LIBS\AppSessionHandler;
    use APP\LIBS\FrontController;
    use APP\LIBS\Language;
    use APP\LIBS\TEMPLATE\Template;
    use APP\LIBS\Registry;
    use APP\LIBS\Messenger;
    use \APP\LIBS\Authentication;

    require_once '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
    require_once APP_PATH . DS . 'libs' . DS . 'autoload.php';
    $session = new AppSessionHandler();
    $session->start();
    if(!isset($session->lang)){
        $session->lang = APP_DEFAULT_LANGUAGE;
    }
    $templateParts = require_once '..' . DS . 'app' . DS . 'config' . DS . 'templateconfig.php';
    $template = new Template($templateParts);
    $languge = new Language();
    $messenger = Messenger::getInstance($session);
    $authentication = Authentication::getInstance($session);
    $registry = Registry::getInstance();
    $registry->session = $session;
    $registry->language = $languge;
    $registry->template = $template;
    $registry->messenger = $messenger;
    $frontController = new FrontController($template, $registry,$authentication);
    $frontController->dispatch();