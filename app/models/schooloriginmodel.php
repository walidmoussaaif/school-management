<?php
    namespace APP\MODELS;

    class SchoolOriginModel extends  AbstractModel
    {
        public $school_origine_id;
        public $school_origine_name;

        protected static $primaryKey = 'school_origine_id';
        protected static $tableName = 'school_origine';
        protected static $tableSchema = [
            'school_origine_id'   => self::DATA_TYPE_INT,
            'school_origine_name' => self::DATA_TYPE_STR
        ];
    }