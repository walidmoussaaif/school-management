<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\FileUpload;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\LIBS\Messenger;
    use APP\MODELS\GenderModel;
    use APP\MODELS\SchoolYearModel;
    use APP\MODELS\TeacherModel;
    use APP\MODELS\TeacherVacationModel;

    class TeacherController extends AbstractController
    {
        use Helper,InputFilter;

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('teacher.default');
            $this->_data['teachers'] = TeacherModel::getAllTeachers();
            $this->_view();
        }

        public function addAction()
        {
            $this->language->load('template.common');
            $this->language->load('teacher.add');
            $this->_data['genders'] = GenderModel::getAll();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $teacher = new TeacherModel();
                $teacher->teacher_cin = isset($_POST['teacher_cin']) ? $this->filterString($_POST['teacher_cin']) : '';
                $check_teacher = TeacherModel::getOneBy(['teacher_cin' => $teacher->teacher_cin]);
                if($check_teacher){
                    $this->messenger->add($this->language->get('text_cin_exists'),Messenger::APP_MSG_ERROR);
                } else{
                    $teacher->teacher_first_name = isset($_POST['teacher_first_name']) ? $this->filterString($_POST['teacher_first_name']) : '';
                    $teacher->teacher_last_name = isset($_POST['teacher_last_name']) ? $this->filterString($_POST['teacher_last_name']) : '';
                    $teacher->teacher_birthday = isset($_POST['teacher_birthday']) ? $this->filterString($_POST['teacher_birthday']) : '';
                    $teacher->teacher_email = isset($_POST['teacher_email']) ? $this->filterString($_POST['teacher_email']) : '';
                    $teacher->teacher_gender_id = isset($_POST['teacher_gender_id']) ? $this->filterInt($_POST['teacher_gender_id']) : '';
                    $teacher->teacher_phone = isset($_POST['teacher_phone']) ? $this->filterString($_POST['teacher_phone']) : '';
                    $teacher->teacher_address = isset($_POST['teacher_address']) ? $this->filterString($_POST['teacher_address']) : '';
                    $teacher->registration_date = date('Y-m-d');
                    if($teacher->checkProperties(['teacher_id','teacher_img'])){
                        if(!empty($_FILES['teacher_img']['name'])){
                            $img = new FileUpload($_FILES['teacher_img']);
                            if($img->upload()){
                                $teacher->teacher_img = $img->getFileName();
                            } else{
                                $teacher->teacher_img = 'default_teacher.png';
                            }
                        } else{
                            $teacher->teacher_img = 'default_teacher.png';
                        }
                        if($teacher->save()){
                            $this->messenger->add($this->language->get('text_success'));
                            $this->redirect('/teacher');
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
                $teacher_id = $this->filterInt($this->_params[0]);
                $teacher = TeacherModel::getByPK($teacher_id);
                if($teacher){
                    $this->language->load('template.common');
                    $this->language->load('teacher.edit');
                    $this->_data['genders'] = GenderModel::getAll();
                    $this->_data['teacher'] = $teacher;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $check_cin = TeacherModel::checkCinForUpdate($teacher->teacher_cin,isset($_POST['teacher_cin']) ? $_POST['teacher_cin'] : '');
                        if($check_cin){
                            $this->messenger->add($this->language->get('text_cin_exists'),Messenger::APP_MSG_ERROR);
                        } else{
                            $teacher->teacher_cin = isset($_POST['teacher_cin']) ? $this->filterString($_POST['teacher_cin']) : '';
                            $teacher->teacher_first_name = isset($_POST['teacher_first_name']) ? $this->filterString($_POST['teacher_first_name']) : '';
                            $teacher->teacher_last_name = isset($_POST['teacher_last_name']) ? $this->filterString($_POST['teacher_last_name']) : '';
                            $teacher->teacher_birthday = isset($_POST['teacher_birthday']) ? $this->filterString($_POST['teacher_birthday']) : '';
                            $teacher->teacher_email = isset($_POST['teacher_email']) ? $this->filterString($_POST['teacher_email']) : '';
                            $teacher->teacher_gender_id = isset($_POST['teacher_gender_id']) ? $this->filterInt($_POST['teacher_gender_id']) : '';
                            $teacher->teacher_phone = isset($_POST['teacher_phone']) ? $this->filterString($_POST['teacher_phone']) : '';
                            $teacher->teacher_address = isset($_POST['teacher_address']) ? $this->filterString($_POST['teacher_address']) : '';
                            if($teacher->checkProperties()){
                                if(!empty($_FILES['teacher_img']['name'])){
                                    $old_teacher_img = $teacher->teacher_img;
                                    if($old_teacher_img != 'default_teacher.png'){
                                        @unlink(IMAGES_UPLOAD_STORAGE . DS . $old_teacher_img);
                                    }
                                    $img = new FileUpload($_FILES['teacher_img']);
                                    if($img->upload()){
                                        $teacher->teacher_img = $img->getFileName();
                                    }
                                }
                                if($teacher->save()){
                                    $this->messenger->add($this->language->get('text_success'));
                                    $this->redirect('/teacher');
                                } else{
                                    $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                                }
                            } else{
                                $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                            }
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirect('/teacher');
                }
            } else{
                $this->redirect('/teacher');
            }
        }

        public function deleteAction()
        {
            if(isset($this->_params[0])){
                $teacher_id = $this->filterInt($this->_params[0]);
                $teacher = TeacherModel::getByPK($teacher_id);
                if($teacher){
                    $this->language->load('teacher.delete');
                    if($teacher->delete()){
                        $this->messenger->add($this->language->get('text_success'));
                        if($teacher->teacher_img  != 'default_teacher.png'){
                            @unlink(IMAGES_UPLOAD_STORAGE . DS . $teacher->teacher_img);
                        }
                    }
                }
            }
            $this->redirect('/teacher');
        }

        public function infoAction()
        {
            if(isset($this->_params[0])){
                $teacher_id = $this->filterInt($this->_params[0]);
                $teacher = TeacherModel::getByPK($teacher_id);
                if($teacher){
                    $this->language->load('template.common');
                    $this->language->load('teacher.info');
                    $this->_data['teacher'] = $teacher;
                    $this->_view();
                } else{
                    $this->redirect('/teacher');
                }
            } else{
                $this->redirect('/teacher');
            }
        }

        public function vacationAction()
        {
            if(isset($this->_params[0])){
                $teacher_id = $this->filterInt($this->_params[0]);
                $teacher = TeacherModel::getByPK($teacher_id);
                if($teacher){
                    $this->language->load('template.common');
                    $this->language->load('teacher.vacation');
                    $years = SchoolYearModel::getAll();
                    $school_year = (isset($_GET['year']) && !empty($_GET['year'])) ? $this->filterInt($_GET['year']) : $years[0]->school_year_id;
                    $this->_data['years'] = $years;
                    $this->_data['teacher'] = $teacher;
                    $this->_data['teacher_vacations'] = TeacherVacationModel::getByTeacherId($teacher->teacher_id,$school_year);
                    $this->_view();
                } else{
                    $this->redirect('/teacher');
                }
            } else{
                $this->redirect('/teacher');
            }
        }

        public function addvacationAction()
        {
            if(isset($this->_params[0])){
                $teacher_id = $this->filterInt($this->_params[0]);
                $teacher = TeacherModel::getByPK($teacher_id);
                if($teacher){
                    $this->language->load('template.common');
                    $this->language->load('teacher.addvacation');
                    $this->_data['years'] = SchoolYearModel::getAll();
                    $this->_data['teacher_id'] = $teacher->teacher_id;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $vacation = new TeacherVacationModel();
                        $vacation->teacher_id = $teacher->teacher_id;
                        $vacation->school_year_id = isset($_POST['school_year_id']) ? $this->filterInt($_POST['school_year_id']) : '';
                        $vacation->start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
                        $vacation->end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
                        $vacation->reason = isset($_POST['reason']) ? $this->filterString($_POST['reason']) : '';
                        if($vacation->checkProperties(['teacher_vacation_id'])){
                            if($vacation->save()){
                                $this->messenger->add($this->language->get('text_success'));
                                $this->redirect('/teacher/vacation/' . $teacher->teacher_id);
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirect('/teacher');
                }
            } else{
                $this->redirect('/teacher');
            }
        }

        public function editvacationAction()
        {
            if(isset($this->_params[0])){
                $vacation = TeacherVacationModel::getByPK($this->filterInt($this->_params[0]));
                if($vacation){
                    $this->language->load('template.common');
                    $this->language->load('teacher.editvacation');
                    $this->_data['years'] = SchoolYearModel::getAll();
                    $this->_data['vacation'] = $vacation;
                    $this->_data['teacher_id'] = $vacation->teacher_id;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $vacation->school_year_id = isset($_POST['school_year_id']) ? $this->filterInt($_POST['school_year_id']) : '';
                        $vacation->start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
                        $vacation->end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
                        $vacation->reason = isset($_POST['reason']) ? $this->filterString($_POST['reason']) : '';
                        if($vacation->checkProperties(['teacher_vacation_id'])){
                            if($vacation->save()){
                                $this->messenger->add($this->language->get('text_success'));
                                $this->redirect('/teacher/vacation/' . $vacation->teacher_id);
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirect('/teacher');
                }
            } else{
                $this->redirect('/teacher');
            }
        }

        public function deletevacationAction()
        {
            if(isset($this->_params[0])){
                $vacation = TeacherVacationModel::getByPK($this->filterInt($this->_params[0]));
                if($vacation) {
                    $this->language->load('teacher.deletevacation');
                    if($vacation->delete()){
                        $this->messenger->add($this->language->get('text_success'));
                    }
                }
            }
            $this->redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/teacher');
        }
    }