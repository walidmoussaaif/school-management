<div class="header">
    <div class="row">
        <div class="col-6 d-flex flex-row">
            <div class="p-2">
                <h4 class="text-quote text-uppercase font-weight-normal mt-2"><q>be kind to one another</q></h4>
            </div>
        </div>
        <div class="col-6 d-flex flex-row-reverse">
            <div class="p-2">
                <a id="btn_log_out" href="/auth/logout" class="btn btn-primary"><i class="fas fa-sign-out-alt"></i> <?= $text_log_out ?> M,<?= $this->session->u->first_name ?></a>
            </div>
            <div class="p-2">
                <a href="/profile/default/<?= $this->session->u->user_id ?>" class="btn btn-primary"><i class="fas fa-cog"></i></a>
            </div>
            <div class="p-2">
                <a href="/language/default/<?= strtolower($text_lang) ?>" class="btn btn-primary">
                    <i class="fas fa-globe-americas"></i> <?= $text_lang ?>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="sc">
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="user-pic">
                <img class="img-responsive img-rounded" src="/uploads/images/<?= $this->session->u->user_img ?>">
            </div>
            <div class="user-info">
                <span class="user-name"><?= $this->session->u->username ?></span>
                <span class="user-role"><?= \APP\MODELS\RoleModel::getByPK($this->session->u->role_id)->role ?></span>
            </div>
        </div>
        <a href="/" class="item <?= $this->matchUrl('/') == true ? 'active' : '' ?>">
            <i class="fas fa-tv fa-fw"></i>
            <span><?= $text_dashboard ?></span>
        </a>
        <a href="/student" class="item <?= $this->matchUrl('/student') == true ? 'active' : '' ?>">
            <i class="fas fa-user-graduate fa-fw"></i>
            <span><?= $text_students ?></span>
        </a>
        <a href="/payment" class="item <?= $this->matchUrl('/payment') == true ? 'active' : '' ?>">
            <i class="fas fa-dollar-sign fa-fw"></i>
            <span><?= $text_payments ?></span>
        </a>
        <a href="/teacher" class="item <?= $this->matchUrl('/teacher') == true ? 'active' : '' ?>">
            <i class="fas fa-user-tie fa-fw"></i>
            <span><?= $text_teacher ?></span>
        </a>
        <a href="/year" class="item <?= $this->matchUrl('/year') == true ? 'active' : '' ?>">
            <i class="fas fa-calendar-alt fa-fw"></i>
            <span><?= $text_school_years ?></span>
        </a>
        <!--------ssg submenu -->
        <a class="item <?= ($this->matchUrl('/speciality') == true || $this->matchUrl('/sector') == true || $this->matchUrl('/group') == true) ? 'active' : '' ?>">
            <i class="fas fa-layer-group fa-fw"></i>
            <span><?= $text_ssg ?></span>
        </a>
        <ul id="ssg_submenu" class="submenu submenuclosed list-unstyled">
            <li>
                <a href="/speciality" class="<?= $this->matchUrl('/speciality') == true ? 'active' : '' ?>">
                    <i class="fas fa-circle fa-fw"></i>
                    <span><?= $text_specialities ?></span>
                </a>
            </li>
            <li>
                <a href="/sector" class="<?= $this->matchUrl('/sector') == true ? 'active' : '' ?>">
                    <i class="fas fa-circle fa-fw"></i>
                    <span><?= $text_sectors ?></span>
                </a>
            </li>
            <li>
                <a href="/group" class="<?= $this->matchUrl('/group') == true ? 'active' : '' ?>">
                    <i class="fas fa-circle fa-fw"></i>
                    <span><?= $text_groups ?></span>
                </a>
            </li>
        </ul>
        <!-------------users submenu-------->
        <a class="item <?= ($this->matchUrl('/user') == true || $this->matchUrl('/role') == true || $this->matchUrl('/privilege') == true) ? 'active' : '' ?>">
            <i class="fas fa-universal-access fa-fw"></i>
            <span><?= $text_users ?></span>
        </a>
        <ul id="privileges_submenu" class="submenu submenuclosed list-unstyled">
            <li>
                <a href="/user" class="<?= $this->matchUrl('/user') == true ? 'active' : '' ?>">
                    <i class="fas fa-users fa-fw"></i>
                    <span><?= $text_manage_users ?></span>
                </a>
            </li>
            <li>
                <a href="/role" class="<?= $this->matchUrl('/role') == true ? 'active' : '' ?>">
                    <i class="fas fa-key fa-fw"></i>
                    <span><?= $text_privileges ?></span>
                </a>
            </li>
        </ul>
    </div>
    <div class="content">
    <?php
        $messages = $this->messenger->getMessages();
        if(!empty($messages))
        {
            foreach($messages as $message):
            ?>
                <div class="alert <?= $message[1] ?> notification"><i class="close-notification fas fa-times mr-2"></i> <?= $message[0] ?></div>
            <?php
            endforeach;
        }
    ?>