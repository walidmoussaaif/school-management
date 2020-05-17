<?php
    namespace APP\MODELS;

    class TeacherVacationModel extends AbstractModel
    {
        public $teacher_vacation_id;
        public $school_year_id;
        public $start_date;
        public $end_date;
        public $reason;
        public $teacher_id;

        protected static $primaryKey = 'teacher_vacation_id';
        protected static $tableName = 'teacher_vacations';
        protected static $tableSchema = [
            'teacher_vacation_id' => self::DATA_TYPE_INT,
            'school_year_id'      => self::DATA_TYPE_INT,
            'start_date'          => self::DATA_TYPE_DATE,
            'end_date'            => self::DATA_TYPE_DATE,
            'reason'              => self::DATA_TYPE_STR,
            'teacher_id'          => self::DATA_TYPE_INT,
        ];

        public static function getByTeacherId($teacher_id, $school_year_id)
        {
            $sql = 'SELECT TV.*,DATEDIFF(end_date,start_date) AS total FROM teacher_vacations TV WHERE TV.teacher_id=:id AND TV.school_year_id=:sid';
            return self::get($sql,[
                'id' => [self::DATA_TYPE_INT,$teacher_id],
                'sid' => [self::DATA_TYPE_INT,$school_year_id]
            ]);
        }
    }