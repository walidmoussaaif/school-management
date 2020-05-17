<?php
    namespace APP\MODELS;

    class RolePrivilegesModel extends AbstractModel
    {
        public $id;
        public $role_id;
        public $privilege_id;

        protected static $primaryKey = 'id';
        protected static $tableName = 'app_role_privileges';
        protected static $tableSchema = [
            'id'           => self::DATA_TYPE_INT,
            'role_id'      => self::DATA_TYPE_INT,
            'privilege_id' => self::DATA_TYPE_INT
        ];

        public static function getRolePrivilegesId($role_id)
        {
            $res = RolePrivilegesModel::getBy(['role_id' => $role_id]);
            if($res)
            {
                $extractIds = [];
                foreach ($res as $r){
                    $extractIds[] = $r->privilege_id;
                }
                return $extractIds;
            }
            return [];
        }

        public function getPrivilegesForRole($role_id)
        {
            $sql = 'SELECT P.privilege_url FROM app_role_privileges R
                    JOIN app_privileges P
                    ON R.privilege_id = P.privilege_id
                    WHERE role_id = ' . $role_id;
            $urls =  self::get($sql);
            $extractedUrls = [];
            if($urls) {
                foreach ($urls as $url){
                    $extractedUrls[] = $url->privilege_url;
                }
            }
            return $extractedUrls;
        }
    }