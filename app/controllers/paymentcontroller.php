<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\LIBS\Messenger;
    use APP\MODELS\DetailPaymentModel;
    use APP\MODELS\FolderModel;
    use APP\MODELS\PaymentMethodModel;
    use APP\MODELS\PaymentModel;
    use APP\MODELS\ReglementStatusModel;
    use APP\MODELS\SchoolYearModel;
    use APP\MODELS\StudentModel;

    class PaymentController extends AbstractController
    {
        use Helper,InputFilter;

        private function redirectToPayment()
        {
            $this->redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/payment');
        }

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('payment.default');
            $this->_data['years'] = SchoolYearModel::getAll();
            if(isset($_GET['year']) && isset($_GET['cin'])){
                $student_cin = isset($_GET['cin']) ? $this->filterString($_GET['cin']) : '';
                $school_year_id = isset($_GET['year']) ? $_GET['year'] : '';
                $student = StudentModel::getOneBy(['student_cin' => $student_cin]);
                if($student){
                    $student = StudentModel::getOneByKey($student->student_id);
                    $this->_data['student'] = $student;
                    $folder = FolderModel::getFolderByYearAndStudent($school_year_id,$student->student_id);
                    if($folder){
                        $this->_data['registered'] = 1;
                        $this->_data['folder'] = $folder;
                        $this->_data['detail_payments'] = PaymentModel::getDetailPaymentByFolderId($folder->folder_id);
                        $this->_data['paid'] = PaymentModel::getPaidAmountByFolderId($folder->folder_id);
                    } else{
                        $this->_data['registered'] = 0;
                        $this->messenger->add($this->language->get('text_student_not_registered'),Messenger::APP_MSG_ERROR);
                    }
                } else{
                    $this->messenger->add($this->language->get('text_student_not_exists'),Messenger::APP_MSG_ERROR);
                }
            }
            $this->_view();
        }

        public function addAction()
        {
            $this->language->load('template.common');
            $this->language->load('payment.add');
            if(isset($this->_params[0])){
                $folder_id = $this->filterInt($this->_params[0]);
                $payment = PaymentModel::getOneBy(['folder_id' => $folder_id]);
                if($payment){
                    $folder = FolderModel::getByPK($folder_id);
                    $student = StudentModel::getByPK($folder->student_id);
                    if($folder && $student) {
                        $this->_data['student_cin'] = $student->student_cin;
                        $this->_data['school_year_id'] = $folder->school_year_id;
                        $this->_data['payment_methods'] = PaymentMethodModel::getAll();
                        $this->_data['reglement_status'] = ReglementStatusModel::getAll();
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $payment = PaymentModel::getOneBy(['folder_id' => $folder->folder_id]);
                            $total_amount = $payment->total_amount;
                            $amount_paid = PaymentModel::getPaidAmountByFolderId($folder->folder_id)->paid;
                            $res_amount = $total_amount - $amount_paid;
                            $detail_payment = new DetailPaymentModel();
                            $detail_payment->payment_id = ($payment) ? $payment->payment_id : '';
                            $detail_payment->payment_method_id = isset($_POST['payment_method_id']) ? $this->filterInt($_POST['payment_method_id']) : '';
                            $detail_payment->reglement_status_id = isset($_POST['reglement_status_id']) ? $this->filterInt($_POST['reglement_status_id']) : '';
                            $detail_payment->amount_deposit = isset($_POST['deposit_amount']) ? $this->filterFloat($_POST['deposit_amount']) : '';
                            $detail_payment->received_date = isset($_POST['deposit_date']) ? $this->filterString($_POST['deposit_date']) : '';
                            $payment_method_id = $detail_payment->payment_method_id;
                            $check_except = [];
                            if(is_numeric($payment_method_id)){
                                if ($payment_method_id == 1) {
                                    $check_except = [
                                        'detail_payment_id', 'payment_reference',
                                        'execution_date','bank_name','porter_first_name',
                                        'porter_last_name'
                                    ];
                                } elseif ($payment_method_id == 2) {
                                    $check_except = [
                                        'detail_payment_id',
                                        'execution_date','bank_name','porter_first_name',
                                        'porter_last_name'
                                    ];
                                    $detail_payment->payment_reference = isset($_POST['reference']) ? $this->filterString($_POST['reference']) : '';
                                } else {
                                    $check_except = [
                                        'detail_payment_id'
                                    ];
                                    $detail_payment->payment_reference = isset($_POST['reference']) ? $this->filterString($_POST['reference']) : '';
                                    $detail_payment->execution_date = isset($_POST['execution_date']) ? $this->filterString($_POST['execution_date']) : '';
                                    $detail_payment->bank_name = isset($_POST['bank_name']) ? $this->filterString($_POST['bank_name']) : '';
                                    $detail_payment->porter_first_name = isset($_POST['porter_first_name']) ? $this->filterString($_POST['porter_first_name']) : '';
                                    $detail_payment->porter_last_name = isset($_POST['porter_last_name']) ? $this->filterString($_POST['porter_last_name']) : '';
                                }

                                if($detail_payment->checkProperties($check_except)){
                                    if($detail_payment->amount_deposit > $res_amount){
                                        $this->messenger->add($this->language->get('text_paid_more'),Messenger::APP_MSG_ERROR);
                                    } else{
                                        if($detail_payment->save()){
                                            $total_amount = $payment->total_amount;
                                            $amount_paid = PaymentModel::getPaidAmountByFolderId($folder->folder_id)->paid;
                                            $res_amount = $total_amount - $amount_paid;
                                            if($res_amount == $total_amount){
                                                $payment->payment_status_id = 2;
                                            } else{
                                                if($res_amount == 0){
                                                    $payment->payment_status_id = 1;
                                                } else{
                                                    $payment->payment_status_id = 3;
                                                }
                                            }
                                            if($payment->save()){
                                                $this->messenger->add($this->language->get('text_success'));
                                                $this->redirect('/payment?year=' . $folder->school_year_id . '&cin=' . $student->student_cin);
                                            } else{
                                                $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                                            }
                                        } else{
                                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                                        }
                                    }
                                } else{
                                    $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                                }
                            } else{
                                $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                            }
                        }
                    } else{
                        $this->redirectToPayment();
                    }
                } else{
                    $this->redirectToPayment();
                }
            } else{
                $this->redirectToPayment();
            }
            $this->_view();
        }

        public function editAction()
        {
            if(isset($this->_params[0])){
                $detail_payment_id = $this->filterInt($this->_params[0]);
                $detail_payment = DetailPaymentModel::getByPK($detail_payment_id);
                if($detail_payment){
                    $this->language->load('template.common');
                    $this->language->load('payment.edit');
                    $payment = PaymentModel::getOneBy(['payment_id' => $detail_payment->payment_id]);
                    $folder = FolderModel::getByPK($payment->folder_id);
                    $student = StudentModel::getByPK($folder->student_id);
                    $old_paid = $detail_payment->amount_deposit;
                    $this->_data['detail_payment'] = $detail_payment;
                    $this->_data['student_cin'] = $student->student_cin;
                    $this->_data['school_year_id'] = $folder->school_year_id;
                    $this->_data['payment_methods'] = PaymentMethodModel::getAll();
                    $this->_data['reglement_status'] = ReglementStatusModel::getAll();
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $detail_payment->payment_id = ($payment) ? $payment->payment_id : '';
                        $detail_payment->payment_method_id = isset($_POST['payment_method_id']) ? $this->filterInt($_POST['payment_method_id']) : '';
                        $detail_payment->reglement_status_id = isset($_POST['reglement_status_id']) ? $this->filterInt($_POST['reglement_status_id']) : '';
                        $detail_payment->amount_deposit = isset($_POST['amount_deposit']) ? $this->filterFloat($_POST['amount_deposit']) : '';
                        $detail_payment->received_date = isset($_POST['received_date']) ? $this->filterString($_POST['received_date']) : '';
                        $payment_method_id = $detail_payment->payment_method_id;
                        $check_except = [];
                        if(is_numeric($payment_method_id))
                        {
                            if ($payment_method_id == 1) {
                                $check_except = [
                                    'payment_reference','execution_date',
                                    'bank_name','porter_first_name',
                                    'porter_last_name'
                                ];
                                $detail_payment->payment_reference = null;
                                $detail_payment->execution_date = null;
                                $detail_payment->bank_name = null;
                                $detail_payment->porter_first_name = null;
                                $detail_payment->porter_last_name =  null;
                            } elseif ($payment_method_id == 2) {
                                $check_except = [
                                    'execution_date','bank_name','porter_first_name',
                                    'porter_last_name'
                                ];
                                $detail_payment->payment_reference = isset($_POST['payment_reference']) ? $this->filterString($_POST['payment_reference']) : '';
                                $detail_payment->execution_date = null;
                                $detail_payment->bank_name = null;
                                $detail_payment->porter_first_name = null;
                                $detail_payment->porter_last_name =  null;
                            } else {
                                $check_except = [];
                                $detail_payment->payment_reference = isset($_POST['payment_reference']) ? $this->filterString($_POST['payment_reference']) : '';
                                $detail_payment->execution_date = isset($_POST['execution_date']) ? $this->filterString($_POST['execution_date']) : '';
                                $detail_payment->bank_name = isset($_POST['bank_name']) ? $this->filterString($_POST['bank_name']) : '';
                                $detail_payment->porter_first_name = isset($_POST['porter_first_name']) ? $this->filterString($_POST['porter_first_name']) : '';
                                $detail_payment->porter_last_name = isset($_POST['porter_last_name']) ? $this->filterString($_POST['porter_last_name']) : '';
                            }
                        }
                        if($detail_payment->checkProperties($check_except)){
                            $total_amount = $payment->total_amount;
                            $total_paid = PaymentModel::getPaidAmountByFolderId($folder->folder_id)->paid;
                            $res_amount = $total_amount - ($total_paid - $old_paid);
                            if($detail_payment->amount_deposit > $res_amount){
                                $this->messenger->add($this->language->get('text_paid_more'),Messenger::APP_MSG_ERROR);
                            } else{
                                if($detail_payment->save()){
                                    $total_amount = $payment->total_amount;
                                    $total_paid = PaymentModel::getPaidAmountByFolderId($folder->folder_id)->paid;
                                    $res_amount = $total_amount - $total_paid;
                                    if($res_amount == $total_amount){
                                        $payment->payment_status_id = 2;
                                    } else{
                                        if($res_amount == 0){
                                            $payment->payment_status_id = 1;
                                        } else{
                                            $payment->payment_status_id = 3;
                                        }
                                    }
                                    if($payment->save()){
                                        $this->messenger->add($this->language->get('text_success'));
                                        $this->redirect('/payment?year=' . $folder->school_year_id . '&cin=' . $student->student_cin);
                                    }
                                }
                            }

                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirectToPayment();
                }
            } else{
                $this->redirectToPayment();
            }
        }

        public function deleteAction()
        {
            if(isset($this->_params[0])){
                $this->language->load('payment.delete');
                $detail_payment_id = $this->filterInt($this->_params[0]);
                $detail_payment = DetailPaymentModel::getByPK($detail_payment_id);
                if($detail_payment->delete()){
                    $payment = PaymentModel::getOneBy(['payment_id' => $detail_payment->payment_id]);
                    if($payment){
                        $total_amount = $payment->total_amount;
                        $paid_amount = PaymentModel::getPaidAmountByFolderId($payment->folder_id)->paid;
                        $res_amount = $total_amount - $paid_amount;
                        if($res_amount == $total_amount){
                            $payment->payment_status_id = 2;
                        } else{
                            if($res_amount == 0){
                                $payment->payment_status_id = 1;
                            } else{
                                $payment->payment_status_id = 3;
                            }
                        }
                        if($payment->save()){
                            $this->messenger->add($this->language->get('text_success'));
                        }
                        $this->redirectToPayment();
                    } else{
                        $this->redirectToPayment();
                    }
                } else{
                    $this->redirectToPayment();
                }
            } else{
                $this->redirectToPayment();
            }
        }

        public function infoAction()
        {
            if(isset($this->_params[0])){
                $detail_payment_id = $this->filterInt($this->_params[0]);
                $detail_payment = DetailPaymentModel::getByPK($detail_payment_id);
                if($detail_payment){
                    $this->language->load('template.common');
                    $this->language->load('payment.info');
                    $payment = PaymentModel::getByPK($detail_payment->payment_id);
                    $folder = FolderModel::getByPK($payment->folder_id);
                    $student = StudentModel::getByPK($folder->student_id);
                    if($folder && $student){
                        $this->_data['previous_url'] = '/payment?year=' . $folder->school_year_id . '&cin=' . $student->student_cin;
                    }
                    $this->_data['detail_payment'] = $detail_payment;
                    $this->_view();
                } else{
                    $this->redirectToPayment();
                }
            } else{
                $this->redirectToPayment();
            }
        }
    }