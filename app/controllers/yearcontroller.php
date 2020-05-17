<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\LIBS\Messenger;
    use APP\MODELS\schoolvacationmodel;
    use APP\MODELS\SchoolYearModel;

    class YearController extends AbstractController
    {
        use Helper,InputFilter;

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('year.default');
            $this->_data['years'] = SchoolYearModel::getAll();
            $this->_view();
        }

        public function addAction()
        {
            $this->language->load('template.common');
            $this->language->load('year.add');
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $year = new SchoolYearModel();
                $year->label = isset($_POST['label']) ? $this->filterString($_POST['label']) : '';
                if($year->checkProperties(['school_year_id'])){
                    if($year->save()){
                        $this->messenger->add($this->language->get('text_success'));
                        $this->redirect('/year');
                    }
                } else{
                    $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                }
            }
            $this->_view();
        }

        public function editAction()
        {
            if(isset($this->_params[0])){
                $school_year = SchoolYearModel::getByPK($this->filterInt($this->_params[0]));
                if($school_year){
                    $this->language->load('template.common');
                    $this->language->load('year.edit');
                    $this->_data['school_year'] = $school_year;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $school_year->label = isset($_POST['label']) ? $this->filterString($_POST['label']) : '';
                        if($school_year->checkProperties()){
                            if($school_year->save()){
                                $this->messenger->add($this->language->get('text_success'));
                                $this->redirect('/year');
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirect('/year');
                }
            } else{
                $this->redirect('/year');
            }
        }

        public function deleteAction()
        {
            if(isset($this->_params[0])){
                $school_year = SchoolYearModel::getByPK($this->filterInt($this->_params[0]));
                if($school_year){
                    $this->language->load('year.delete');
                    if($school_year->delete()){
                    $this->messenger->add($this->language->get('text_success'));
                    }
                }
            }
            $this->redirect('/year');
        }

        public function vacationAction()
        {
            if(isset($this->_params[0])){
                $school_year = SchoolYearModel::getByPK($this->filterInt($this->_params[0]));
                if($school_year){
                    $this->language->load('template.common');
                    $this->language->load('year.vacation');
                    $this->_data['year'] = $school_year;
                    $this->_data['school_year_vacations'] = schoolvacationmodel::getVacationBySchoolYear($school_year->school_year_id);
                    $this->_view();
                } else{
                    $this->messenger->add('sorry');
                    $this->redirect('/year');
                }
            } else{
                $this->redirect('/year');
            }
        }

        public function addvacationAction()
        {
            if(isset($this->_params[0])){
                $school_year = SchoolYearModel::getByPK($this->filterInt($this->_params[0]));
                if($school_year){
                    $this->language->load('template.common');
                    $this->language->load('year.addvacation');
                    $this->_data['year'] = $school_year;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $vacation = new schoolvacationmodel();
                        $vacation->start_date = isset($_POST['start_date']) ? $this->filterString($_POST['start_date']) : '';
                        $vacation->end_date = isset($_POST['end_date']) ? $this->filterString($_POST['end_date']) : '';
                        $vacation->label = isset($_POST['label']) ? $this->filterString($_POST['label']) : '';
                        $vacation->school_year_id = $school_year->school_year_id;
                        if($vacation->checkProperties(['school_vacation_id'])){
                            if($vacation->save()){
                                $this->messenger->add($this->language->get('text_success'));
                                $this->redirect('/year/vacation/' . $school_year->school_year_id);
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->messenger->add('sorry');
                    $this->redirect('/year');
                }
            } else{
                $this->redirect('/year');
            }
        }

        public function editvacationAction()
        {
            if(isset($this->_params[0])){
                $vacation = schoolvacationmodel::getByPK($this->filterInt($this->_params[0]));
                if($vacation){
                    $this->language->load('template.common');
                    $this->language->load('year.editvacation');
                    $this->_data['year'] = SchoolYearModel::getByPK($vacation->school_year_id);
                    $this->_data['vacation'] = $vacation;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $vacation->start_date = isset($_POST['start_date']) ? $this->filterString($_POST['start_date']) : '';
                        $vacation->end_date = isset($_POST['end_date']) ? $this->filterString($_POST['end_date']) : '';
                        $vacation->label = isset($_POST['label']) ? $this->filterString($_POST['label']) : '';
                        if($vacation->checkProperties()){
                            if($vacation->save()){
                                $this->messenger->add($this->language->get('text_success'));
                                $this->redirect('/year/vacation/' . $vacation->school_year_id);
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirect('/year');
                }
            } else{
                $this->redirect('/year');
            }
        }

        public function deletevacationAction()
        {
            if(isset($this->_params[0])){
                $vacation = schoolvacationmodel::getByPK($this->filterInt($this->_params[0]));
                if($vacation){
                    $this->language->load('year.deletevacation');
                    if($vacation->delete()){
                        $this->messenger->add($this->language->get('text_success'));
                    }
                }
            }
            $this->redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/year');
        }
    }