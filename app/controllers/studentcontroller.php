<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\FileUpload;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\LIBS\Messenger;
    use APP\MODELS\FolderModel;
    use APP\MODELS\GenderModel;
    use APP\MODELS\GroupModel;
    use APP\MODELS\LevelStudiedModel;
    use APP\MODELS\PaymentModel;
    use APP\MODELS\SchoolOriginModel;
    use APP\MODELS\SchoolYearModel;
    use APP\MODELS\SpecialityModel;
    use APP\MODELS\StudentModel;

    class StudentController extends AbstractController
    {
        use Helper,InputFilter;

        private function redirectToStudent()
        {
            $this->redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/student');
        }

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('student.default');
            $years = SchoolYearModel::getAll();
            $this->_data['years'] = $years;
            $this->_data['school_year'] = isset($_GET['year']) ? $this->filterInt($_GET['year']) : (isset($years[0]->school_year_id) ? $years[0]->school_year_id : '');
            if(isset($_GET['status'])){
                $school_year_id = $this->filterInt(isset($_GET['year']) ? $_GET['year'] : '');
                $status = $this->filterInt(isset($_GET['status']) ? $_GET['status'] : '');
                if($status == 0 || $status == 1){
                    if($status == 0){
                        $this->_data['students'] = StudentModel::getNonRegisteredStudents($school_year_id);
                        $this->_data['status'] = 0;
                        $this->_data['yes'] = ''; $this->_data['no'] = 'checked';
                    } else{
                        $this->_data['students'] = StudentModel::getRegisteredStudents(!empty($school_year_id) ? $school_year_id : (isset($years[0]->school_year_id) ? $years[0]->school_year_id : ''));
                        $this->_data['status'] = 1;
                        $this->_data['yes'] = 'checked'; $this->_data['no'] = '';
                    }
                } else{
                    $this->_data['students'] = StudentModel::getNonRegisteredStudents(!empty($school_year_id) ? $school_year_id : (isset($years[0]->school_year_id) ? $years[0]->school_year_id : ''));
                    $this->_data['status'] = 0;
                    $this->_data['yes'] = ''; $this->_data['no'] = 'checked';
                }
            } else{
                $this->_data['students'] = StudentModel::getNonRegisteredStudents((isset($years[0]->school_year_id) ? $years[0]->school_year_id : ''));
                $this->_data['status'] = 0;
                $this->_data['yes'] = ''; $this->_data['no'] = 'checked';
            }
            $this->_view();
        }

        public function addAction()
        {
            $this->language->load('template.common');
            $this->language->load('student.add');
            $this->_data['schools'] = SchoolOriginModel::getAll();
            $this->_data['levels'] = LevelStudiedModel::getAll();
            $this->_data['genders'] = GenderModel::getAll();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $check_cin = StudentModel::checkCinForAdd(isset($_POST['student_cin']) ? $_POST['student_cin'] : '');
                if($check_cin){
                    $this->messenger->add($this->language->get('text_cin_exists'),Messenger::APP_MSG_ERROR);
                } else{
                    $student = new StudentModel();
                    $student->student_cin        = isset($_POST['student_cin']) ? $this->filterString($_POST['student_cin']) : '';
                    $student->student_first_name = isset($_POST['student_first_name']) ? $this->filterString($_POST['student_first_name']) : '';
                    $student->student_last_name  = isset($_POST['student_last_name']) ? $this->filterString($_POST['student_last_name']) : '';
                    $student->student_birthday   = isset($_POST['student_birthday']) ? $this->filterString($_POST['student_birthday']) : '';
                    $student->student_email      = isset($_POST['student_email']) ? $this->filterString($_POST['student_email']) : '';
                    $student->student_gender_id  = isset($_POST['student_gender_id']) ? $this->filterInt($_POST['student_gender_id']) : '';
                    $student->student_phone      = isset($_POST['student_phone']) ? $this->filterString($_POST['student_phone']) : '';
                    $student->student_address    = isset($_POST['student_address']) ? $this->filterString($_POST['student_address']) : '';
                    $student->student_city       = isset($_POST['student_city']) ? $this->filterString($_POST['student_city']) : '';
                    $student->student_bachelore  = isset($_POST['student_bachelore']) ? $this->filterInt($_POST['student_bachelore']) : '';
                    $student->registered_date    = date('Y-m-d');
                    $student->school_origine_id  = isset($_POST['school_origine_id']) ? $this->filterInt($_POST['school_origine_id']) : '';
                    $student->level_studied_id   = isset($_POST['level_studied_id']) ? $this->filterInt($_POST['level_studied_id']) : '';
                    if($student->checkProperties(['student_id','student_img'])){
                        if(!empty($_FILES['student_img']['name'])){
                            $img = new FileUpload($_FILES['student_img']);
                            if($img->upload()){
                                $student->student_img = $img->getFileName();
                            } else{
                                $student->student_img = 'default.png';
                            }
                        } else{
                            $student->student_img = 'default.png';
                        }
                        if($student->save()){
                            $this->messenger->add($this->language->get('text_success'));
                            $this->redirect('/student/info/' . $student->student_id);
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    } else{
                        $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                    }
                }
            }
            $this->_view();
        }

        public function editAction()
        {
            if(isset($this->_params[0])){
                $student = StudentModel::getByPK($this->filterInt($this->_params[0]));
                if($student){
                    $this->language->load('template.common');
                    $this->language->load('student.edit');
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $check_cin = StudentModel::checkCinForUpdate($student->student_cin,isset($_POST['student_cin']) ? $_POST['student_cin'] : '');
                        if($check_cin){
                            $this->messenger->add($this->language->get('text_cin_exists'),Messenger::APP_MSG_ERROR);
                        } else {
                            $student->student_cin        = isset($_POST['student_cin']) ? $this->filterString($_POST['student_cin']) : '';
                            $student->student_first_name = isset($_POST['student_first_name']) ? $this->filterString($_POST['student_first_name']) : '';
                            $student->student_last_name  = isset($_POST['student_last_name']) ? $this->filterString($_POST['student_last_name']) : '';
                            $student->student_birthday   = isset($_POST['student_birthday']) ? $this->filterString($_POST['student_birthday']) : '';
                            $student->student_email      = isset($_POST['student_email']) ? $this->filterString($_POST['student_email']) : '';
                            $student->student_gender_id  = isset($_POST['student_gender_id']) ? $this->filterInt($_POST['student_gender_id']) : '';
                            $student->student_phone      = isset($_POST['student_phone']) ? $this->filterString($_POST['student_phone']) : '';
                            $student->student_address    = isset($_POST['student_address']) ? $this->filterString($_POST['student_address']) : '';
                            $student->student_city       = isset($_POST['student_city']) ? $this->filterString($_POST['student_city']) : '';
                            $student->student_bachelore  = isset($_POST['student_bachelore']) ? $this->filterInt($_POST['student_bachelore']) : '';
                            $student->school_origine_id  = isset($_POST['school_origine_id']) ? $this->filterInt($_POST['school_origine_id']) : '';
                            $student->level_studied_id   = isset($_POST['level_studied_id']) ? $this->filterInt($_POST['level_studied_id']) : '';
                            //check properties
                            if($student->checkProperties(['student_img'])){
                                if(!empty($_FILES['student_img']['name'])){
                                    $oldStudentImg = $student->student_img;
                                    $img = new FileUpload($_FILES['student_img']);
                                    if($img->upload()){
                                        $student->student_img = $img->getFileName();
                                        if($oldStudentImg != 'default.png'){
                                            @unlink(IMAGES_UPLOAD_STORAGE . DS . $oldStudentImg);
                                        }
                                    }
                                }
                                if($student->save()){
                                    $this->messenger->add($this->language->get('text_success'));
                                    $this->redirect('/student');
                                } else{
                                    $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                                }
                            } else{
                                $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                            }
                        }
                    }
                    $this->_data['student'] = $student;
                    $this->_data['schools'] = SchoolOriginModel::getAll();
                    $this->_data['levels'] = LevelStudiedModel::getAll();
                    $this->_data['genders'] = GenderModel::getAll();
                    $this->_view();
                } else{
                    $this->redirectToStudent();
                }
            } else{
                $this->redirectToStudent();
            }
        }

        public function deleteAction()
        {
            if(isset($this->_params[0])){
                $student = StudentModel::getByPK($this->filterInt($this->_params[0]));
                if($student){
                    $this->language->load('student.delete');
                    if($student->delete()){
                        if($student->student_img != 'default.png'){
                            @unlink(IMAGES_UPLOAD_STORAGE . DS . $student->student_img);
                        }
                        $this->messenger->add($this->language->get('text_success'));
                    }
                }
            }
            $this->redirectToStudent();
        }

        public function infoAction()
        {
            if(isset($this->_params[0])){
                $id = $this->filterInt($this->_params[0]);
                $student = StudentModel::getOneByKey($id);
                if($student){
                    $this->language->load('template.common');
                    $this->language->load('student.info');
                    $this->_data['student'] = $student;
                    if(isset($this->_params[1])){
                        $school_year_id = $this->filterInt($this->_params[1]);
                        $this->_data['selected_school_year'] = SchoolYearModel::getByPK($school_year_id);
                        $folder = FolderModel::getFolderByYearAndStudent($school_year_id,$student->student_id);
                        if($folder){
                            $folder = $folder;
                            $this->_data['registered'] = true;
                            $this->_data['folder'] = $folder;
                            $this->_data['paid'] = PaymentModel::getPaidAmountByFolderId($folder->folder_id);
                        }
                    }
                } else{
                    $this->redirectToStudent();
                }
                $this->_view();
            } else{
                $this->redirectToStudent();
            }
        }

        public function registerAction()
        {
            if(isset($this->_params[0])){
                $student_id = $this->filterInt($this->_params[0]);
                $student = StudentModel::getByPK($student_id);
                if($student){
                    $this->language->load('template.common');
                    $this->language->load('student.register');
                    $this->_data['student'] = $student;
                    $this->_data['years'] = SchoolYearModel::getAll();
                    $this->_data['specialities'] = SpecialityModel::getAllSpecialities();
                    $this->_data['groups'] = GroupModel::getAll();
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $school_year_id = isset($_POST['school_year_id']) ? $this->filterInt($_POST['school_year_id']) : '';
                        $group_id = isset($_POST['group_id']) ? $this->filterInt($_POST['group_id']) : '';
                        $total_amount = isset($_POST['total_amount']) ? $this->filterFloat($_POST['total_amount']) : '';
                        $check_folder = FolderModel::getBy([
                            'school_year_id' => $school_year_id,
                            'student_id'     => $student->student_id
                        ]);
                        if($check_folder){
                            $this->messenger->add($this->language->get('text_already_registered'),Messenger::APP_MSG_ERROR);
                        } else{
                            $folder = new FolderModel();
                            $folder->group_id = $group_id;
                            $folder->school_year_id = $school_year_id;
                            $folder->student_id = $student->student_id;
                            if($folder->checkProperties(['folder_id']) && !empty($total_amount)){
                                if($folder->save()){
                                    $payment = new PaymentModel();
                                    $payment->total_amount = $total_amount;
                                    $payment->folder_id = $folder->folder_id;
                                    $payment->payment_status_id = 2;
                                    $payment->save();
                                    $this->messenger->add($this->language->get('text_success'));
                                    $this->redirect('/student/info/' . $folder->student_id . '/' . $folder->school_year_id);
                                } else{
                                    $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                                }
                            } else{
                                $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                            }
                        }
                    }
                } else{
                    $this->redirectToStudent();
                }
                $this->_view();
            } else{
                $this->redirectToStudent();
            }
        }

        public function editfolderAction()
        {
            if(isset($this->_params[0])) {
                $folder = FolderModel::getByPK($this->filterInt($this->_params[0]));
                if($folder){
                    $this->language->load('template.common');
                    $this->language->load('student.editfolder');
                    $this->_data['folder'] = $folder;
                    $student = StudentModel::getByPK($folder->student_id);
                    $this->_data['student'] = $student;
                    $this->_data['years'] = SchoolYearModel::getAll();
                    $this->_data['specialities'] = SpecialityModel::getAllSpecialities();
                    $this->_data['groups'] = GroupModel::getAll();
                    $payment =  PaymentModel::getOneBy(['folder_id' => $folder->folder_id]);
                    $this->_data['payment'] = $payment;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $total_amount = isset($_POST['total_amount']) ? $this->filterFloat($_POST['total_amount']) : $payment->total_amount;
                        $folder->group_id = isset($_POST['group_id']) ? $this->filterInt($_POST['group_id']) : '';
                        $folder->school_year_id = isset($_POST['school_year_id']) ? $this->filterInt($_POST['school_year_id']) : '';
                        if($folder->checkProperties() && !empty($total_amount)){
                            $payment->total_amount = $total_amount;
                            $total_amount = $payment->total_amount;
                            $amount_paid = PaymentModel::getPaidAmountByFolderId($folder->folder_id)->paid;
                            $res_amount = $total_amount - $amount_paid;
                            if($res_amount < 0){
                                $this->messenger->add($this->language->get('text_paid_more'),Messenger::APP_MSG_INFO);
                            } else{
                                if($folder->save()){
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
                                        $this->redirect('/student/info/' . $student->student_id . '/' . $folder->school_year_id);
                                    }
                                } else{
                                    $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                                }
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirectToStudent();
                }
            } else{
                $this->redirectToStudent();
            }
        }

        public function deletefolderAction()
        {
            if(isset($this->_params[0])){
                $folder = FolderModel::getByPK($this->filterInt($this->_params[0]));
                if($folder){
                    $this->language->load('student.deletefolder');
                    if($folder->delete()){
                        $this->messenger->add($this->language->get('text_success'));
                    }
                }
            }
            $this->redirectToStudent();
        }
    }