<?php
    namespace APP\CONTROLLERS;
    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\LIBS\Messenger;
    use APP\MODELS\UserModel;

    class AuthController extends AbstractController
    {
        use Helper,InputFilter;
        public function loginAction()
        {
            $this->language->load('template.common');
            $this->language->load('auth.login');
            $this->_template->swapTemplate([':view' => ':action_view']);
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if(isset($_POST['username']) && isset($_POST['password'])){
                    $username = $this->filterString($_POST['username']);
                    $password = $this->filterString($_POST['password']);
                    $res = UserModel::authenticate($username,$password,$this->session);
                    if(!$res){
                        $this->messenger->add($this->language->get('text_log_failed'),Messenger::APP_MSG_ERROR);
                    } else{
                        if($res == 2){
                            $this->messenger->add($this->language->get('text_user_not_valid'),Messenger::APP_MSG_ERROR);
                        } else{
                            $this->redirect('/');
                        }
                    }
                } else{
                    $this->messenger->add($this->language->get('text_fail'),Messenger::APP_MSG_ERROR);
                }
            }
            $this->_view();
        }

        public function logoutAction()
        {
            $this->session->kill();
            $this->redirect('/auth/login');
        }
    }