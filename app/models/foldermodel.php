<?php
    namespace APP\MODELS;

    class FolderModel extends AbstractModel
    {
        public $folder_id;
        public $group_id;
        public $school_year_id;
        public $student_id;

        protected static $primaryKey = 'folder_id';
        protected static $tableName = 'folders';
        protected static $tableSchema = [
            'folder_id'      => self::DATA_TYPE_INT,
            'group_id'       => self::DATA_TYPE_INT,
            'school_year_id' => self::DATA_TYPE_INT,
            'student_id'     => self::DATA_TYPE_INT
        ];

        public static function getFolderByYearAndStudent($school_year_id,$student_id)
        {
            $sql = 'SELECT * FROM folders F
                    JOIN payments P
                    ON F.folder_id = P.folder_id
                    JOIN groups G
                    ON F.group_id = G.group_id
                    JOIN sectors S
                    ON S.sector_id = G.sector_id
                    JOIN specialities SP
                    ON S.speciality_id = SP.speciality_id
                    JOIN school_years SY
                    ON F.school_year_id = SY.school_year_id
                    WHERE F.school_year_id = :year_id AND F.student_id = :student_id';

            return self::getOne($sql,[
                'year_id'    => [self::DATA_TYPE_INT,$school_year_id],
                'student_id' => [self::DATA_TYPE_INT,$student_id]
            ]);
        }
    }