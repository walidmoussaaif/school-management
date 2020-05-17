<?php
    namespace APP\LIBS;

    use APP\MODELS\RolePrivilegesModel;
    use APP\MODELS\UserModel;

    trait Helper
    {
        public function redirect($path)
        {
            session_write_close();
            header('Location: ' . $path);
            exit;
        }

        private function updateSession()
        {
            $user_id = $this->session->u->user_id;
            $role_id = $this->session->u->role_id;
            if(!empty($user_id)){
                $user = UserModel::getByPK($user_id);
                $user->privileges = RolePrivilegesModel::getPrivilegesForRole($role_id);
                $this->session->u = $user;
            }
        }
    }