<?php
    namespace APP\MODELS;

    class SectorModel extends AbstractModel
    {
        public $sector_id;
        public $sector_name;
        public $sector_short_name;
        public $speciality_id;

        protected static $primaryKey = 'sector_id';
        protected static $tableName = 'sectors';
        protected static $tableSchema = [
            'sector_id'         => self::DATA_TYPE_INT,
            'sector_name'       => self::DATA_TYPE_STR,
            'sector_short_name' => self::DATA_TYPE_STR,
            'speciality_id'     => self::DATA_TYPE_INT
        ];

        public static function getAllSectors()
        {
            $sql = 'SELECT * FROM sectors S
                    JOIN specialities SP
                    ON S.speciality_id = SP.speciality_id';

            return self::get($sql);
        }
    }