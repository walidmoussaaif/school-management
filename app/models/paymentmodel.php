<?php
    namespace APP\MODELS;

    class PaymentModel extends AbstractModel
    {
        public $payment_id;
        public $total_amount;
        public $folder_id;
        public $payment_status_id;

        protected static $primaryKey = 'payment_id';
        protected static $tableName = 'payments';
        protected static $tableSchema = [
            'payment_id'        => self::DATA_TYPE_INT,
            'total_amount'      => self::DATA_TYPE_DECIMAL,
            'folder_id'         => self::DATA_TYPE_INT,
            'payment_status_id' => self::DATA_TYPE_INT
        ];

        public static function getDetailPaymentByFolderId($folder_id)
        {
            $sql = 'SELECT * FROM payments P
                    JOIN payment_status PS
                    ON P.payment_status_id = PS.status_id
                    JOIN detail_payments DP
                    ON P.payment_id = DP.payment_id
                    JOIN payment_methods PM
                    ON DP.payment_method_id = PM.method_id
                    JOIN reglement_status RS
                    ON DP.reglement_status_id = RS.reglement_status_id 
                    WHERE P.folder_id = :id';

            return self::get($sql,['id' => [self::DATA_TYPE_INT,$folder_id]]);
        }

        public static function getPaidAmountByFolderId($folder_id)
        {
            $sql = 'SELECT sum(PD.amount_deposit) AS paid FROM payments P
                    JOIN detail_payments PD
                    ON P.payment_id = PD.payment_id
                    WHERE P.folder_id = :id';

            return self::getOne($sql,['id' => [self::DATA_TYPE_INT,$folder_id]]);
        }
    }