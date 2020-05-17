<?php
    namespace APP\LIBS\TEMPLATE;
    trait TemplateHelper
    {
        public function matchUrl($url)
        {
            $server_url = parse_url($_SERVER['REQUEST_URI'])['path'];
            $request = '/' . explode('/',$server_url,3)[1];
            return $request == $url;
        }

        public function showValue($fieldName, $object = null)
        {
            return isset($_POST[$fieldName]) ? $_POST[$fieldName] : (is_null($object) ? '' : $object->$fieldName);
        }

        public function selectedIf($fieldName, $value, $object = null)
        {
            return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || (!is_null($object) && $object->$fieldName == $value)) ? 'selected="selected"' : '';
        }

        public function checkedIf($fieldName, $value, $object = null)
        {
            return ((isset($_POST[$fieldName]) && $_POST[$fieldName] == $value) || (!is_null($object) && $object->$fieldName == $value)) ? 'checked="checked"' : '';
        }

        // -------------------------------

        public function showValueGet($fieldName, $object = null)
        {
            return isset($_GET[$fieldName]) ? $_GET[$fieldName] : (is_null($object) ? '' : $object->$fieldName);
        }

        public function selectedIfGet($fieldName, $value, $object = null)
        {
            return ((isset($_GET[$fieldName]) && $_GET[$fieldName] == $value) || (!is_null($object) && $object->$fieldName == $value)) ? 'selected="selected"' : '';
        }

        public function checkedIfGet($fieldName, $value, $object = null)
        {
            return ((isset($_GET[$fieldName]) && $_GET[$fieldName] == $value) || (!is_null($object) && $object->$fieldName == $value)) ? 'checked="checked"' : '';
        }
    }