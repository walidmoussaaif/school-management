<?php
    namespace APP\CONTROLLERS;

    use APP\LIBS\Helper;
    use APP\LIBS\InputFilter;
    use APP\MODELS\UserModel;

    class ProfileController extends AbstractController
    {
        use Helper,InputFilter;
        public function defaultAction()
        {
            if(isset($this->_params[0])){
                $user = UserModel::getByPK($this->filterInt($this->_params[0]));
                if($user){
                    if($user->user_id == $this->session->u->user_id){
                        $this->language->load('template.common');
                        $this->language->load('profile.default');
                        $this->_data['user'] = $user;
                        $this->_view();
                    } else{
                        $this->redirect('/accessdenied');
                    }
                } else{
                    $this->redirect('/');
                }
            } else{
                $this->redirect('/');
            }
        }
    }