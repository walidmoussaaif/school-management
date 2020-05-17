<?php
    namespace APP\MODELS;

    class DetailPaymentModel extends AbstractModel
    {
        public $detail_payment_id;
        public $payment_reference;
        public $received_date;
        public $execution_date;
        public $amount_deposit;
        public $bank_name;
        public $porter_first_name;
        public $porter_last_name;
        public $reglement_status_id;
        public $payment_method_id;
        public $payment_id;

        protected static $primaryKey = 'detail_payment_id';
        protected static $tableName = 'detail_payments';
        protected static $tableSchema = [
            'detail_payment_id' => self::DATA_TYPE_INT,
            'payment_reference' => self::DATA_TYPE_STR,
            'received_date' => self::DATA_TYPE_DATE,
            'execution_date' => self::DATA_TYPE_DATE,
            'amount_deposit' => self::DATA_TYPE_DECIMAL,
            'bank_name' => self::DATA_TYPE_STR,
            'porter_first_name' => self::DATA_TYPE_STR,
            'porter_last_name' => self::DATA_TYPE_STR,
            'reglement_status_id' => self::DATA_TYPE_INT,
            'payment_method_id' => self::DATA_TYPE_INT,
            'payment_id' => self::DATA_TYPE_INT
        ];
    }