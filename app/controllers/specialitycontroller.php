<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\LIBS\Messenger;
    use APP\MODELS\SpecialityModel;

    class SpecialityController extends AbstractController
    {
        use Helper,InputFilter;

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('speciality.default');
            $this->_data['specialities'] = SpecialityModel::getAll();
            $this->_view();
        }

        public function addAction()
        {
            $this->language->load('template.common');
            $this->language->load('speciality.add');
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $speciality = new SpecialityModel();
                $speciality->speciality_name = isset($_POST['speciality_name']) ? $_POST['speciality_name'] : '';
                if($speciality->checkProperties(['speciality_id'])){
                    if($speciality->save()){
                        $this->messenger->add($this->language->get('text_success'));
                        $this->redirect('/speciality');
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
                $speciality = SpecialityModel::getByPK($this->filterInt($this->_params[0]));
                if($speciality){
                    $this->language->load('template.common');
                    $this->language->load('speciality.edit');
                    $this->_data['speciality'] = $speciality;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $speciality->speciality_name = isset($_POST['speciality_name']) ? $_POST['speciality_name'] : '';
                        if($speciality->checkProperties()){
                            if($speciality->save()){
                                $this->messenger->add($this->language->get('text_success'));
                                $this->redirect('/speciality');
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirect('/speciality');
                }
            } else{
                $this->redirect('/speciality');
            }
        }

        public function deleteAction()
        {
            if(isset($this->_params[0])){
                $speciality = SpecialityModel::getByPK($this->filterInt($this->_params[0]));
                if($speciality){
                    $this->language->load('speciality.delete');
                    if($speciality->delete()){
                        $this->messenger->add($this->language->get('text_success'));
                    }
                }
            }
            $this->redirect('/speciality');
        }
    }