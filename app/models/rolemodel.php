<?php
    namespace APP\MODELS;

    class RoleModel extends AbstractModel
    {
        public $role_id;
        public $role;

        protected static $primaryKey = 'role_id';
        protected static $tableName = 'app_roles';
        protected static $tableSchema = [
            'role_id' => self::DATA_TYPE_INT,
            'role'    => self::DATA_TYPE_STR
        ];

        public static function checkRoleFordAdd($role)
        {
            return self::getBy(['role' => $role]);
        }

        public static function checkRoleForUpdate($old_role,$role)
        {
            $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE role <> "' . $old_role . '" AND role = "'. $role .'"';
            return self::getOne($sql);
        }
    }