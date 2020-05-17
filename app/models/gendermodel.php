<?php
    namespace APP\MODELS;

    class GenderModel extends AbstractModel
    {
        public $gender_id;
        public $gender_label;

        protected static $primaryKey = 'gender_id';
        protected static $tableName = 'genders';
        protected static $tableSchema = [
          'gender_id' => self::DATA_TYPE_INT,
          'gender_label'     => self::DATA_TYPE_STR
        ];
    }