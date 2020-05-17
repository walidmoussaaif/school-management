<?php
    namespace APP\MODELS;

    use mysql_xdevapi\Statement;

    class UserModel extends AbstractModel
    {
        public $user_id;
        public $user_cin;
        public $username;
        public $upassword;
        public $gender_id;
        public $email;
        public $phone;
        public $subscription_date;
        public $last_login;
        public $role_id;
        public $ustatus;
        public $first_name;
        public $last_name;
        public $address;
        public $dob;
        public $user_img;

        public $privileges;

        protected static $primaryKey = 'user_id';
        protected static $tableName = 'app_users';
        protected static $tableSchema = [
            'user_id'           => self::DATA_TYPE_INT,
            'user_cin'          => self::DATA_TYPE_STR,
            'username'          => self::DATA_TYPE_STR,
            'upassword'         => self::DATA_TYPE_STR,
            'gender_id'         => self::DATA_TYPE_STR,
            'email'             => self::DATA_TYPE_STR,
            'phone'             => self::DATA_TYPE_STR,
            'subscription_date' => self::DATA_TYPE_DATE,
            'last_login'        => self::DATA_TYPE_DATE,
            'role_id'           => self::DATA_TYPE_INT,
            'ustatus'           => self::DATA_TYPE_BOOL,
            'first_name'        => self::DATA_TYPE_STR,
            'last_name'         => self::DATA_TYPE_STR,
            'address'           => self::DATA_TYPE_STR,
            'dob'               => self::DATA_TYPE_DATE,
            'user_img'          => self::DATA_TYPE_STR
        ];

        public static function authenticate($username, $password, $session)
        {
            $password = sha1($password);
            $foundUser = self::getOneBy([
                'username' => $username,
                'upassword' => $password
            ]);
            if($foundUser) {
                if($foundUser->ustatus == 0) {
                    return 2;
                } else{
                    $foundUser->last_login = date('Y-m-d H:i:s');
                    $foundUser->save();
                    $foundUser->privileges = RolePrivilegesModel::getPrivilegesForRole($foundUser->role_id);
                    $session->u = $foundUser;
                    return 3;
                }
            }
            return false;
        }

        public static function getTableSchema()
        {
            return self::$tableSchema;
        }

        public static function getAllUsers($session)
        {
            $sql = 'SELECT * FROM app_users 
                    JOIN app_roles 
                    ON app_users.role_id = app_roles.role_id 
                    JOIN genders ON app_users.gender_id = genders.gender_id 
                    WHERE app_users.user_id <>' . $session->u->user_id;
            return self::get($sql);
        }

        public static function checkCinForAdd($cin)
        {
            return self::getBy(['user_cin' => $cin]);
        }

        public static function checkCinForUpdate($oldcin,$cin)
        {
            $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE user_cin <> "'. $oldcin .'" AND user_cin="' . $cin .'"';
            return self::getOne($sql);
        }

        public static function checkUsername($username)
        {
            return self::getBy(['username' => $username]);
        }

        public static function checkUsernameForUpdate($oldusername,$username)
        {
            $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE username <> "'. $oldusername .'" AND username="' . $username .'"';
            return self::getOne($sql);
        }
    }