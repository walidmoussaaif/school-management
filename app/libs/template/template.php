<?php
    namespace APP\LIBS\TEMPLATE;
    class Template
    {
        use TemplateHelper;
        private $template_parts;
        private $_action_view;
        private $_data;
        private $_registry;

        public function __get($key)
        {
            return $this->_registry->$key;
        }

        public function __construct(array $parts)
        {
            $this->template_parts = $parts;
        }

        public function swapTemplate($template)
        {
            $this->template_parts['template'] = $template;
        }

        public function setRegistry($registry)
        {
            $this->_registry = $registry;
        }

        public function setActionViewFile($actionViewPath)
        {
            $this->_action_view = $actionViewPath;
        }

        public function setAppData($data)
        {
            $this->_data = $data;
        }

        public function renderTemplateHeaderStart()
        {
            extract($this->_data);
            require_once TEMPLATES_PATH . 'templateheaderstart.php';
        }

        public function renderTemplateHeaderEnd()
        {
            extract($this->_data);
            require_once TEMPLATES_PATH . 'templateheaderend.php';
        }

        public function renderTemplateFooter()
        {
            extract($this->_data);
            require_once TEMPLATES_PATH . 'footer.php';
        }

        public function renderTemplateBlocks()
        {
            extract($this->_data);
            if(array_key_exists('template',$this->template_parts)) {
                $parts = $this->template_parts['template'];
                if(!empty($parts)) {
                    foreach ($parts as $key => $value) {
                        if($key == ':view') {
                            require_once $this->_action_view;
                        } else {
                            require_once $value;
                        }
                    }
                }
            }
        }

        public function renderHeaderResources()
        {
            $output = '';
            if(array_key_exists('header_resources',$this->template_parts)){
                $resources = $this->template_parts['header_resources'];
                $css = $resources['css'];
                $js  = $resources['js'];
                if(!empty($css)){
                    foreach ($css as $cssKey => $cssValue){
                        $output .= '<link rel="stylesheet" href="'. $cssValue .'"/>';
                    }
                }
                if(!empty($js)){
                    foreach($js as $jsKey => $jsValue){
                        $output .= '<script src="'. $jsValue .'"></script>';
                    }
                }
            }
            echo $output;
        }

        public function renderFooterResources()
        {
            $output = '';
            if(array_key_exists('footer_resources',$this->template_parts)){
                $resources = $this->template_parts['footer_resources'];
                $js = $resources['js'];
                if(!empty($js)){
                    foreach ($js as $jsKey => $jsValue){
                        $output .= '<script src="'. $jsValue .'"></script>';
                    }
                }
            }
            echo $output;
        }

        public function renderApp()
        {
            $this->renderTemplateHeaderStart();
            $this->renderHeaderResources();
            $this->renderTemplateHeaderEnd();
            $this->renderTemplateBlocks();
            $this->renderFooterResources();
            $this->renderTemplateFooter();
        }
    }