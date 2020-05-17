<?php
    namespace APP\MODELS;

    class PrivilegeModel extends AbstractModel
    {
        public $privilege_id;
        public $privilege;
        public $privilege_url;
        public $group_id;

        protected static $primaryKey = 'privilege_id';
        protected static $tableName = 'app_privileges';
        protected static $tableSchema = [
            'privilege_id'  => self::DATA_TYPE_INT,
            'privilege'     => self::DATA_TYPE_STR,
            'privilege_url' => self::DATA_TYPE_STR,
            'group_id'     => self::DATA_TYPE_INT
        ];


        public static function getAll()
        {
            $sql = 'SELECT * FROM app_privileges P 
                    JOIN app_privileges_groups PG 
                    ON P.group_id = PG.privilege_id_group';
            $res = self::get($sql);
            $privileges = [];
            foreach ($res as $privilege){
                $privileges[$privilege->privilege_group][] = $privilege;
            }
            return $privileges;
        }
    }