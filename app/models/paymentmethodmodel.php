<?php
    namespace APP\MODELS;

    class PaymentMethodModel extends AbstractModel
    {
        public $method_id;
        public $method_desc;

        protected static $primaryKey = 'method_id';
        protected static $tableName = 'payment_methods';
        protected static $tableSchema = [
          'method_id'   => self::DATA_TYPE_INT,
          'method_desc' => self::DATA_TYPE_STR
        ];
    }