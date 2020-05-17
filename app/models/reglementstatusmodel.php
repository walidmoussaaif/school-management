<?php
    namespace APP\MODELS;

    class ReglementStatusModel extends AbstractModel
    {
        public $reglement_status_id;
        public $status_label;

        protected static $primaryKey = 'reglement_status_id';
        protected static $tableName = 'reglement_status';
        protected static $tableSchema = [
            'reglement_status_id' => self::DATA_TYPE_INT,
            'status_label'        => self::DATA_TYPE_STR
        ];
    }