<?php
    namespace APP\MODELS;

    class PrivilegeGroupModel extends  AbstractModel
    {
        public $privilege_id_group;
        public $privilege_group;

        protected static $primaryKey = 'privilege_id_group';
        protected static $tableName = 'app_privileges_groups';
        protected static $tableSchema = [
            'privilege_id_group' => self::DATA_TYPE_INT,
            'privilege_group'    => self::DATA_TYPE_STR
        ];
    }