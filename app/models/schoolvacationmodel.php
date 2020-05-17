<?php
    namespace APP\MODELS;

    class SchoolVacationModel extends AbstractModel
    {
        public $school_vacation_id;
        public $label;
        public $start_date;
        public $end_date;
        public $school_year_id;

        protected static $primaryKey = 'school_vacation_id';
        protected static $tableName = 'school_vacations';
        protected static $tableSchema = [
            'school_vacation_id' => self::DATA_TYPE_INT,
            'label'              => self::DATA_TYPE_STR,
            'start_date'         => self::DATA_TYPE_DATE,
            'end_date'           => self::DATA_TYPE_DATE,
            'school_year_id'     => self::DATA_TYPE_INT
        ];

        public static function getVacationBySchoolYear($school_year_id)
        {
            $sql = 'SELECT SV.*,DATEDIFF(end_date,start_date) AS total FROM school_vacations SV WHERE SV.school_year_id = :id';
            return self::get($sql,['id' => [self::DATA_TYPE_INT,$school_year_id]]);
        }
    }