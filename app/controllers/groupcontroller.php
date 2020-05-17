<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\LIBS\Messenger;
    use APP\MODELS\GroupModel;
    use APP\MODELS\SectorModel;
    use APP\MODELS\SpecialityModel;

    class GroupController extends AbstractController
    {
        use Helper,InputFilter;

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('group.default');
            $this->_data['groups'] = SpecialityModel::getAllSpecialities();
            $this->_view();
        }

        public function addAction()
        {
            $this->language->load('template.common');
            $this->language->load('group.add');
            $this->_data['sectors'] = SectorModel::getAllSectors();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $group = new GroupModel();
                $group->group_name = isset($_POST['group_name']) ? $this->filterString($_POST['group_name']) : '';
                $group->sector_id = isset($_POST['sector_id']) ? $this->filterInt($_POST['sector_id']) : '';
                if($group->checkProperties(['group_id'])){
                    if($group->save()){
                        $this->messenger->add($this->language->get('text_success'));
                        $this->redirect('/group');
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
                $group = GroupModel::getByPK($this->filterInt($this->_params[0]));
                if($group){
                    $this->language->load('template.common');
                    $this->language->load('group.edit');
                    $this->_data['group'] = $group;
                    $this->_data['sectors'] = SectorModel::getAllSectors();
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $group->group_name = isset($_POST['group_name']) ? $this->filterString($_POST['group_name']) : '';
                        $group->sector_id = isset($_POST['sector_id']) ? $this->filterInt($_POST['sector_id']) : '';
                        if($group->checkProperties()){
                            if($group->save()){
                                $this->messenger->add($this->language->get('text_success'));
                                $this->redirect('/group');
                            }
                        } else{
                            $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                        }
                    }
                    $this->_view();
                } else{
                    $this->redirect('/group');
                }
            } else{
                $this->redirect('/group');
            }
        }

        public function deleteAction()
        {
            if(isset($this->_params[0])){
                $group = GroupModel::getByPK($this->filterInt($this->_params[0]));
                if($group){
                    $this->language->load('group.delete');
                    if($group->delete()){
                        $this->messenger->add($this->language->get('text_success'));
                    }
                }
            }
            $this->redirect('/group');
        }
    }