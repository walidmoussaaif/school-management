<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\LIBS\Messenger;
    use APP\MODELS\ModuleModel;
    use APP\MODELS\SectorModel;
    use APP\MODELS\SpecialityModel;

    class SectorController extends AbstractController
    {
        use Helper,InputFilter;

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('sector.default');
            $this->_data['sectors'] = SectorModel::getAllSectors();
            $this->_view();
        }

        public function addAction()
        {
            $this->language->load('template.common');
            $this->language->load('sector.add');
            $this->_data['specialities'] = SpecialityModel::getAll();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $sector = new SectorModel();
                $sector->sector_name = isset($_POST['sector_name']) ? $this->filterString($_POST['sector_name']) : '';
                $sector->sector_short_name = isset($_POST['sector_short_name']) ? $this->filterString($_POST['sector_short_name']) : '';
                $sector->speciality_id = isset($_POST['speciality_id']) ? $this->filterInt($_POST['speciality_id']) : '';
                if($sector->checkProperties(['sector_id'])){
                    if($sector->save()){
                        $this->messenger->add($this->language->get('text_success'));
                        $this->redirect('/sector');
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
                $sector = SectorModel::getByPK($this->filterInt($this->_params[0]));
                if($sector){
                    $this->language->load('template.common');
                    $this->language->load('sector.edit');
                    $this->_data['specialities'] = SpecialityModel::getAll();
                    $this->_data['sector'] = $sector;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $sector->sector_name = isset($_POST['sector_name']) ? $this->filterString($_POST['sector_name']) : '';
                        $sector->sector_short_name = isset($_POST['sector_short_name']) ? $this->filterString($_POST['sector_short_name']) : '';
                        $sector->speciality_id = isset($_POST['speciality_id']) ? $this->filterInt($_POST['speciality_id']) : '';
                        if($sector->checkProperties()){
                            if($sector->save()){
                                $this->messenger->add($this->language->get('text_success'));
                                $this->redirect('/sector');
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirect('/sector');
                }
            } else{
                $this->redirect('/sector');
            }
        }

        public function deleteAction()
        {
            if(isset($this->_params[0])){
                $sector = SectorModel::getByPK($this->filterInt($this->_params[0]));
                if($sector){
                    $this->language->load('sector.delete');
                    if($sector->delete()){
                        $this->messenger->add($this->language->get('text_success'));
                    }
                }
            }
            $this->redirect('/sector');
        }

        public function moduleAction()
        {
            if(isset($this->_params[0])) {
                $sector = SectorModel::getByPK($this->filterInt($this->_params[0]));
                if($sector){
                    $this->language->load('template.common');
                    $this->language->load('sector.module');
                    $this->_data['sector'] = $sector;
                    $this->_data['modules'] = ModuleModel::getBy(['sector_id' => $sector->sector_id]);
                    $this->_view();
                } else{
                    $this->redirect('/sector');
                }
            } else{
                $this->redirect('/sector');
            }
        }

        public function addmoduleAction()
        {
            if(isset($this->_params[0])) {
                $sector = SectorModel::getByPK($this->filterInt($this->_params[0]));
                if($sector){
                    $this->language->load('template.common');
                    $this->language->load('sector.addmodule');
                    $this->_data['sector'] = $sector;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $module = new ModuleModel();
                        $module->module_name = isset($_POST['module_name']) ? $this->filterString($_POST['module_name']) : '';
                        $module->duration = isset($_POST['duration']) ? $this->filterFloat($_POST['duration']) : '';
                        $module->sector_id = $sector->sector_id;
                        if($module->checkProperties(['module_id'])){
                            if($module->save()){
                                $this->messenger->add($this->language->get('text_success'));
                                $this->redirect('/sector/module/' . $sector->sector_id);
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirect('/sector');
                }
            } else{
                $this->redirect('/sector');
            }
        }

        public function editmoduleAction()
        {
            if(isset($this->_params[0])) {
                $module = ModuleModel::getByPK($this->filterInt($this->_params[0]));
                if($module){
                    $this->language->load('template.common');
                    $this->language->load('sector.editmodule');
                    $this->_data['module'] = $module;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $module->module_name = isset($_POST['module_name']) ? $this->filterString($_POST['module_name']) : '';
                        $module->duration = isset($_POST['duration']) ? $this->filterFloat($_POST['duration']) : '';
                        if($module->checkProperties()){
                            if($module->save()){
                                $this->messenger->add($this->language->get('text_success'));
                                $this->redirect('/sector/module/' . $module->sector_id);
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirect('/sector');
                }
            } else{
                $this->redirect('/sector');
            }
        }

        public function deletemoduleAction()
        {
            if(isset($this->_params[0])) {
                $module = ModuleModel::getByPK($this->filterInt($this->_params[0]));
                if($module){
                    $this->language->load('sector.deletemodule');
                    if($module->delete()){
                        $this->messenger->add($this->language->get('text_success'));
                        $this->redirect('/sector/module/' . $module->sector_id);
                    }
                } else{
                    $this->redirect('/sector');
                }
            } else{
                $this->redirect('/sector');
            }
        }
    }