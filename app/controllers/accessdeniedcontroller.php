<?php
    namespace APP\CONTROLLERS;

    use APP\LIBS\Messenger;

    class AccessDeniedController extends AbstractController
    {
        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('access.default');
            $this->_view();
        }
    }