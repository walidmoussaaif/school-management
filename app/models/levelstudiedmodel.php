<?php
    namespace APP\MODELS;

    class LevelStudiedModel extends AbstractModel
    {
        public $level_id;
        public $level_label;

        protected static $primaryKey = 'level_id';
        protected static $tableName = 'level_studied';
        protected static $tableSchema = [
            'level_id' => self::DATA_TYPE_INT,
            'level_label'    => self::DATA_TYPE_STR
        ];
    }