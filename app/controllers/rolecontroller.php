<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\LIBS\Messenger;
    use APP\MODELS\PrivilegeGroupModel;
    use APP\MODELS\PrivilegeModel;
    use APP\MODELS\RoleModel;
    use APP\MODELS\RolePrivilegesModel;
    use APP\MODELS\UserModel;

    class RoleController extends AbstractController
    {
        use Helper,InputFilter;

        private function redirectToRole()
        {
            $this->redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/role');
        }

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('role.default');
            $this->_data['roles'] = RoleModel::getAll();
            $this->_view();
        }

        public function addAction()
        {
            $this->language->load('template.common');
            $this->language->load('role.add');
            $this->_data['privileges'] = PrivilegeModel::getAll();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $check_role = RoleModel::checkRoleFordAdd(isset($_POST['role']) ? $_POST['role'] : '');
                if($check_role){
                    $this->messenger->add($this->language->get('text_exists'),Messenger::APP_MSG_ERROR);
                } else{
                    $role = new RoleModel();
                    $role->role = isset($_POST['role']) ? $_POST['role'] : '';
                    if($role->checkProperties(['role_id'])){
                        if($role->save()){
                            $privileges = isset($_POST['privileges']) ? $_POST['privileges'] : [];
                            if(is_array($privileges) && !empty($privileges)){
                                $role_id = $role->role_id;
                                foreach ($privileges as $privilege){
                                    $rp = new RolePrivilegesModel();
                                    $rp->role_id = $role_id;
                                    $rp->privilege_id = $privilege;
                                    $rp->save();
                                }
                                $this->updateSession();
                            }
                            $this->messenger->add($this->language->get('text_success'));
                            $this->redirect('/role');
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
            if(isset($this->_params[0]) && !empty($this->_params[0])){
                $role_id = $this->filterInt($this->_params[0]);
                $role = RoleModel::getByPK($role_id);
                if($role){
                    $this->language->load('template.common');
                    $this->language->load('role.edit');
                    $this->_data['privileges'] = PrivilegeModel::getAll();
                    $this->_data['role'] = $role;
                    $extractedIds = RolePrivilegesModel::getRolePrivilegesId($role->role_id);
                    $this->_data['role_privileges'] = $extractedIds;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $check_role = RoleModel::checkRoleForUpdate($role->role,isset($_POST['role']) ? $_POST['role'] : '');
                        if($check_role){
                            $this->messenger->add($this->language->get('text_exists'),Messenger::APP_MSG_ERROR);
                        } else{
                            $role->role = $this->filterString($_POST['role']);
                            if($role->checkProperties()){
                                if($role->save()){
                                    $privileges = isset($_POST['privileges']) ? $_POST['privileges'] : [];
                                    if(is_array($privileges)){
                                        $privilegesIdsToBeDeleted = array_diff($extractedIds, $privileges);
                                        $privilegesIdsToBeAdded = array_diff($privileges, $extractedIds);

                                        // Delete the unwanted privileges
                                        foreach ($privilegesIdsToBeDeleted as $deletedPrivilege) {
                                            $unwantedPrivilege = RolePrivilegesModel::getBy(['privilege_id' => $deletedPrivilege, 'role_id' => $role->role_id]);
                                            $unwantedPrivilege->current()->delete();
                                        }

                                        // Add the new privileges
                                        foreach ($privilegesIdsToBeAdded as $privilegeId) {
                                            $rolePrivilegeModel = new RolePrivilegesModel();
                                            $rolePrivilegeModel->role_id = $role->role_id;
                                            $rolePrivilegeModel->privilege_id = $privilegeId;
                                            $rolePrivilegeModel->save();
                                        }
                                        $this->updateSession();
                                    }
                                    $this->messenger->add($this->language->get('text_success'));
                                    $this->redirect('/role');
                                } else{
                                    $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                                }
                            } else{
                                $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                            }
                        }
                    }
                } else{
                    $this->redirectToRole();
                }
            } else{
                $this->redirectToRole();
            }
            $this->_view();
        }

        public function deleteAction()
        {
            if(isset($this->_params[0]) && !empty($this->_params[0])){
                $id = $this->filterInt($this->_params[0]);
                $role = RoleModel::getByPK($id);
                if($role){
                    $this->language->load('role.delete');
                    if($role->delete()){
                        $this->messenger->add($this->language->get('text_success'));
                        $this->redirect('/role');
                    }
                } else{
                    $this->redirectToRole();
                }
            } else{
                $this->redirectToRole();
            }
        }
    }