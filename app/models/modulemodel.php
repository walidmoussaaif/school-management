<?php
    namespace APP\MODELS;

    class ModuleModel extends AbstractModel
    {
        public $module_id;
        public $module_name;
        public $duration;
        public $sector_id;

        protected static $primaryKey = 'module_id';
        protected static $tableName = 'modules';
        protected static $tableSchema = [
            'module_id'   => self::DATA_TYPE_INT,
            'module_name' => self::DATA_TYPE_STR,
            'duration'    => self::DATA_TYPE_DECIMAL,
            'sector_id'   => self::DATA_TYPE_INT
        ];
    }