<?php
    namespace APP\MODELS;

    class GroupModel extends  AbstractModel
    {
        public $group_id;
        public $group_name;
        public $sector_id;

        protected static $primaryKey  = 'group_id';
        protected static $tableName = 'groups';
        protected static $tableSchema = [
            'group_id'   => self::DATA_TYPE_INT,
            'group_name' => self::DATA_TYPE_STR,
            'sector_id' => self::DATA_TYPE_INT
        ];
    }