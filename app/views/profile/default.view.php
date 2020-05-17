<div class="container">
    <h1 class="text-center pb-0"><?= $text_your_profile ?></h1>
    <div class="row user_info_section">
        <div class="col-12">
            <a href="/" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
        <div class="col-md-12">
            <img src="/uploads/images/<?= $user->user_img ?>" alt="<?= $user->username ?>">
        </div>
        <div class="col-md-12 py-3">
            <div class="item pb-2">
                <a href="/user/edit/<?= $user->user_id ?>" class="btn btn-success btn-block btn-lg"><i class="fas fa-edit"></i> <?= $text_edit ?></a>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_cin ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $user->user_cin ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_username?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $user->username ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_first_name ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $user->first_name ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_last_name ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $user->last_name ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_gender ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= \APP\MODELS\GenderModel::getByPK($user->gender_id)->gender_label ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_dob ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $user->dob  ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_email ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $user->email  ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_phone ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $user->phone  ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_registered_at ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $user->subscription_date  ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_last_login ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $user->last_login  ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_role ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= \APP\MODELS\RoleModel::getByPK($user->role_id)->role ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_status ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $user->ustatus == 1 ? $text_enabled : $text_disabled ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>