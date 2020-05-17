<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\FileUpload;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\LIBS\Messenger;
    use APP\MODELS\GenderModel;
    use APP\MODELS\PrivilegeModel;
    use APP\MODELS\RoleModel;
    use APP\MODELS\UserModel;
    use http\Client\Curl\User;

    class UserController extends AbstractController
    {
        use Helper,InputFilter;

        private function redirectToUser()
        {
            $this->redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/user');
        }

        public function defaultAction()
        {
            $this->language->load('template.common');
            $this->language->load('user.default');
            $this->_data['users'] = UserModel::getAllUsers($this->session);
            $this->_view();
        }

        public function addAction()
        {
            $this->language->load('template.common');
            $this->language->load('user.add');
            $this->_data['roles'] = RoleModel::getAll();
            $this->_data['genders'] = GenderModel::getAll();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $check_cin = UserModel::checkCinForAdd(isset($_POST['user_cin']) ? $_POST['user_cin'] : '');
                $check_username = UserModel::checkUsername(isset($_POST['username']) ? $_POST['username'] : '');
                if($check_cin || $check_username){
                    if($check_cin){
                        $this->messenger->add($this->language->get('text_cin_exists'),Messenger::APP_MSG_ERROR);
                    }
                    if($check_username){
                        $this->messenger->add($this->language->get('text_username_exists'),Messenger::APP_MSG_ERROR);
                    }
                } else{
                    $user = new UserModel();
                    $user->user_cin          = isset($_POST['user_cin'])   ? $this->filterString($_POST['user_cin']) : '';
                    $user->username          = isset($_POST['username'])   ? $this->filterString($_POST['username']) : '';
                    $user->upassword         = isset($_POST['upassword'])  ? sha1($_POST['upassword']) : '';
                    $user->gender_id         = isset($_POST['gender_id'])  ? $this->filterInt($_POST['gender_id']) : '';
                    $user->email             = isset($_POST['email'])      ? $this->filterString($_POST['email']) : '';
                    $user->phone             = isset($_POST['phone'])      ? $this->filterString($_POST['phone']) : '';
                    $user->subscription_date = date('Y-m-d');
                    $user->last_login        = date('Y-m-d H:i:s');
                    $user->role_id           = isset($_POST['role_id'])    ? $this->filterInt($_POST['role_id']) : '';
                    $user->ustatus           = isset($_POST['ustatus'])    ? $this->filterInt($_POST['ustatus'] ): '';
                    $user->first_name        = isset($_POST['first_name']) ? $this->filterString($_POST['first_name']) : '';
                    $user->last_name         = isset($_POST['last_name'])  ? $this->filterString($_POST['last_name'] ): '';
                    $user->address           = isset($_POST['address'])    ? $this->filterString($_POST['address']) : '';
                    $user->dob               = isset($_POST['dob'])        ? $this->filterString($_POST['dob']) : '';
                    //check-properties and insert
                    if($user->checkProperties(['user_id','user_img'])){
                        if(!empty($_FILES['user_img']['name'])){
                            $img = new FileUpload($_FILES['user_img']);
                            if($img->upload()){
                                $user->user_img = $img->getFileName();
                            } else{
                                $user->user_img = 'default_user.png';
                            }
                        } else{
                            $user->user_img = 'default_user.png';
                        }
                        if($user->save()){
                            $this->messenger->add($this->language->get('text_success'));
                            $this->redirect('/user');
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
                $id = $this->filterInt($this->_params[0]);
                $user = UserModel::getOneBy(['user_id' => $id]);
                if($user){
                    $this->language->load('template.common');
                    $this->language->load('user.edit');
                    $this->_data['roles'] = RoleModel::getAll();
                    $this->_data['genders'] = GenderModel::getAll();
                    $this->_data['user'] = $user;
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $check_cin = UserModel::checkCinForUpdate($user->user_cin,isset($_POST['user_cin']) ? $_POST['user_cin'] : '');
                        $check_username = UserModel::checkUsernameForUpdate($user->username,isset($_POST['username']) ? $_POST['username'] : '');
                        if($check_cin || $check_username){
                            if($check_cin){
                                $this->messenger->add($this->language->get('text_cin_exists'),Messenger::APP_MSG_ERROR);
                            }
                            if($check_username){
                                $this->messenger->add($this->language->get('text_username_exists'),Messenger::APP_MSG_ERROR);
                            }
                        } else{
                            $user->user_id          = $this->filterInt($this->_params[0]);
                            $user->user_cin          = isset($_POST['user_cin'])   ? $this->filterString($_POST['user_cin']) : '';
                            $user->username          = isset($_POST['username'])   ? $this->filterString($_POST['username']) : '';
                            $user->upassword         = (isset($_POST['upassword'])  && !empty($_POST['upassword'])) ? sha1($_POST['upassword']) : $user->upassword;
                            $user->gender_id         = isset($_POST['gender_id'])  ? $this->filterInt($_POST['gender_id']) : '';
                            $user->email             = isset($_POST['email'])      ? $this->filterString($_POST['email']) : '';
                            $user->phone             = isset($_POST['phone'])      ? $this->filterString($_POST['phone']) : '';
                            $user->subscription_date = date('Y-m-d');
                            $user->role_id           = isset($_POST['role_id'])    ? $this->filterInt($_POST['role_id']) : '';
                            $user->ustatus           = isset($_POST['ustatus'])    ? $this->filterInt($_POST['ustatus'] ): $user->ustatus;
                            $user->first_name        = isset($_POST['first_name']) ? $this->filterString($_POST['first_name']) : '';
                            $user->last_name         = isset($_POST['last_name'])  ? $this->filterString($_POST['last_name'] ): '';
                            $user->address           = isset($_POST['address'])    ? $this->filterString($_POST['address']) : '';
                            $user->dob               = isset($_POST['dob'])        ? $this->filterString($_POST['dob']) : '';
                            //check-properties and insert
                            if($user->checkProperties(['user_id','last_login'])){
                                if(!empty($_FILES['user_img']['name'])){
                                    $oldStudentImg = $user->user_img;
                                    if($oldStudentImg != 'default_user.png'){
                                        @unlink(IMAGES_UPLOAD_STORAGE . DS . $oldStudentImg);
                                    }
                                    $img = new FileUpload($_FILES['user_img']);
                                    if($img->upload()){
                                        $user->user_img = $img->getFileName();
                                    } else{
                                        $user->user_img = 'default_user.png';
                                    }
                                }
                                if($user->save()){
                                    $this->messenger->add($this->language->get('text_success'));
                                    if($user->user_id == $this->session->u->user_id){
                                        $this->updateSession();
                                    }
                                    $this->redirect('/user');
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
                    $this->redirectToUser();
                }
            } else{
                $this->redirectToUser();
            }
        }

        public function deleteAction()
        {
            if(isset($this->_params[0]) && !empty($this->_params[0])){
                $id = $this->filterInt($this->_params[0]);
                $user = UserModel::getByPK($id);
                if($user){
                    $this->language->load('user.delete');
                    $user->delete();
                    if($user->user_img != 'default.png'){
                        @unlink(IMAGES_UPLOAD_STORAGE . DS . $user->user_img);
                    }
                    $this->messenger->add($this->language->get('text_success'));
                    $this->redirect('/user');
                } else{
                    $this->redirectToUser();
                }
            } else{
                $this->redirectToUser();
            }
        }

        public function activeAction()
        {
            if(isset($this->_params[0]) && !empty($this->_params[0])){
                $id = $this->filterInt($this->_params[0]);
                $user = UserModel::getByPK($id);
                if($user){
                    $this->language->load('user.active');
                    if($user->ustatus){
                        $user->ustatus = 0;
                        $this->messenger->add($this->language->get('text_disactive'));
                    } else{
                        $user->ustatus = 1;
                        $this->messenger->add($this->language->get('text_active'));
                    }
                    $user->save();
                    $this->redirect('/user');
                } else{
                    $this->redirectToUser();
                }
            } else{
                $this->redirectToUser();
            }
        }

        public function infoAction()
        {
            if(isset($this->_params[0]) && !empty($this->_params[0])){
                $id = $this->filterInt($this->_params[0]);
                $user = UserModel::getByPK($id);
                if($user){
                    $this->language->load('template.common');
                    $this->language->load('user.info');
                    $this->_data['user'] = $user;
                    $this->_view();
                } else{
                    $this->redirectToUser();
                }
            } else{
                $this->redirectToUser();
            }
        }
    }