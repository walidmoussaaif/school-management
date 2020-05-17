<?php
    namespace APP\MODELS;

    class StudentModel extends AbstractModel
    {
        public $student_id;
        public $student_cin;
        public $student_first_name;
        public $student_last_name;
        public $student_birthday;
        public $student_email;
        public $student_gender_id;
        public $student_phone;
        public $student_address;
        public $student_city;
        public $student_bachelore;
        public $registered_date;
        public $school_origine_id;
        public $level_studied_id;
        public $student_img;

        protected static $primaryKey = 'student_id';
        protected static $tableName = 'students';

        protected static $tableSchema = [
            'student_id' => self::DATA_TYPE_INT,
            'student_cin' => self::DATA_TYPE_STR,
            'student_first_name' => self::DATA_TYPE_STR,
            'student_last_name' => self::DATA_TYPE_STR,
            'student_birthday' => self::DATA_TYPE_DATE,
            'student_email' => self::DATA_TYPE_STR,
            'student_gender_id' => self::DATA_TYPE_INT,
            'student_phone' => self::DATA_TYPE_STR,
            'student_address' => self::DATA_TYPE_STR,
            'student_city' => self::DATA_TYPE_STR,
            'student_bachelore' => self::DATA_TYPE_INT,
            'registered_date' => self::DATA_TYPE_DATE,
            'school_origine_id' => self::DATA_TYPE_INT,
            'level_studied_id' => self::DATA_TYPE_INT,
            'student_img'      => self::DATA_TYPE_STR
        ];

        public static function getRegisteredStudentsCount($school_year_id)
        {
            $sql = 'SELECT count(*) as count FROM students S
                    JOIN folders F
                    ON S.student_id = F.student_id
                    WHERE F.school_year_id=:id';
            return self::getOne($sql,['id' => [self::DATA_TYPE_INT, $school_year_id]])->count;
        }

        public static function getStudentsByPaymentStatus($school_year_id,$status)
        {

            $sql = 'SELECT * FROM students S
                    JOIN folders F
                    ON S.student_id = F.student_id
                    JOIN payments P
                    ON F.folder_id = P.folder_id
                    WHERE P.payment_status_id = ' . $status . ' AND F.school_year_id=:id';

            return self::get($sql, ['id' => [self::DATA_TYPE_INT,$school_year_id]]);
        }

        public static function checkCinForAdd($cin)
        {
            $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE student_cin="'. $cin .'"';
            return self::getOne($sql);
        }

        public static function checkCinForUpdate($old_cin,$new_cin)
        {
            $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE student_cin <> "'. $old_cin .'" AND student_cin="' . $new_cin .'"';
            return self::getOne($sql);
        }

        public static function getTableSchema()
        {
            return self::$tableSchema;
        }

        public static function getAll()
        {
            $sql = 'SELECT * FROM students S 
                    JOIN genders G 
                    ON S.student_gender_id = G.gender_id';
            return self::get($sql);
        }

        public static function getNonRegisteredStudents($school_year_id)
        {
            $sql = 'SELECT * FROM students S 
                    JOIN genders G 
                    ON S.student_gender_id = G.gender_id
                    WHERE S.student_id NOT IN(SELECT student_id FROM folders WHERE school_year_id=:id) 
                    ORDER BY S.registered_date DESC';
            return self::get($sql,['id' => [self::DATA_TYPE_INT,$school_year_id]]);
        }

        public static function getRegisteredStudents($school_year_id)
        {
            $sql = 'SELECT * FROM students S 
                    JOIN genders G 
                    ON S.student_gender_id = G.gender_id
                    JOIN folders F
                    ON S.student_id = F.student_id
                    JOIN payments P
                    ON P.folder_id = F.folder_id
                    JOIN groups GR
                    ON F.group_id = GR.group_id
                    JOIN sectors SC
                    ON GR.sector_id = SC.sector_id
                    WHERE F.school_year_id = :id';
            return self::get($sql,['id' => [self::DATA_TYPE_INT,$school_year_id]]);
        }

        public static function getOneByKey($student_id)
        {
            $sql = 'SELECT * FROM students S
                    JOIN genders G
                    ON S.student_gender_id = G.gender_id
                    JOIN school_origine SO
                    ON S.school_origine_id = SO.school_origine_id
                    JOIN level_studied L
                    ON S.level_studied_id = L.level_id WHERE S.student_id=:student_id';
            return self::getOne($sql,['student_id' => [self::DATA_TYPE_INT,$student_id]]);
        }
    }