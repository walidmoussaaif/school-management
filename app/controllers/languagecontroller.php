<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;

    class LanguageController extends AbstractController
    {
        use Helper,InputFilter;
        public function defaultAction()
        {
            if(isset($this->_params[0])){
                $lang = $this->filterString($this->_params[0]);
                $this->session->lang = $lang;
            }
            $this->redirect($_SERVER['HTTP_REFERER']);
        }
    }