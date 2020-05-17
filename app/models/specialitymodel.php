<?php
    namespace APP\MODELS;

    class SpecialityModel extends AbstractModel
    {
        public $speciality_id;
        public $speciality_name;

        protected static $primaryKey = 'speciality_id';
        protected static $tableName = 'specialities';
        protected static $tableSchema = [
            'speciality_id'   => self::DATA_TYPE_INT,
            'speciality_name' => self::DATA_TYPE_STR
        ];

        public static function getAllSpecialities()
        {
            $sql = 'SELECT * FROM specialities SP
                    JOIN sectors S
                    ON SP.speciality_id = S.speciality_id
                    JOIN groups G
                    ON S.sector_id = G.sector_id
                    ORDER BY SP.speciality_id';
            return self::get($sql);
        }
    }