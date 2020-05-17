<?php
     namespace APP\MODELS;

     class TeacherModel extends AbstractModel
     {
        public $teacher_id;
        public $teacher_cin;
        public $teacher_first_name;
        public $teacher_last_name;
        public $teacher_birthday;
        public $teacher_email;
        public $teacher_gender_id;
        public $teacher_phone;
        public $teacher_address;
        public $teacher_img;
        public $registration_date;

        protected static $primaryKey = 'teacher_id';
        protected static $tableName = 'teachers';
        protected static $tableSchema = [
            'teacher_id'         => self::DATA_TYPE_INT,
            'teacher_cin'        => self::DATA_TYPE_STR,
            'teacher_first_name' => self::DATA_TYPE_STR,
            'teacher_last_name'  => self::DATA_TYPE_STR,
            'teacher_birthday'   => self::DATA_TYPE_DATE,
            'teacher_email'      => self::DATA_TYPE_STR,
            'teacher_gender_id'  => self::DATA_TYPE_INT,
            'teacher_phone'      => self::DATA_TYPE_STR,
            'teacher_address'    => self::DATA_TYPE_STR,
            'teacher_img'        => self::DATA_TYPE_STR,
            'registration_date'  => self::DATA_TYPE_DATE
        ];

        public static function getAllTeachers()
        {
            $sql = 'SELECT * FROM teachers T
                    JOIN genders G
                    ON T.teacher_gender_id = G.gender_id';

            return self::get($sql);
        }

        public static function checkCinForUpdate($old_cin,$new_cin)
        {
            $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE teacher_cin <> "' . $old_cin . '" AND teacher_cin = "'. $new_cin . '"';
            return self::get($sql);
        }
     }