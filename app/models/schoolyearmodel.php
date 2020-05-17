<?php
    namespace APP\MODELS;

    class SchoolYearModel extends AbstractModel
    {
        public $school_year_id;
        public $label;

        protected static $primaryKey = 'school_year_id';
        protected static $tableName = 'school_years';
        protected static $tableSchema = [
            'school_year_id' => self::DATA_TYPE_INT,
            'label'          => self::DATA_TYPE_STR
        ];

        public static function getAll()
        {
            $sql = 'SELECT * FROM ' . self::$tableName . ' ORDER BY school_year_id DESC';
            return self::get($sql);
        }
    }