<div class="container">
    <h1 class="text-center pb-0"><?= $text_header ?></h1>
    <h2 class="h1 text-warning pt-0 text-center"><?= $teacher->teacher_first_name . ' ' . $teacher->teacher_last_name ?></h2>
    <div class="row teacher_info_section">
        <div class="col-12">
            <a href="/teacher" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
        <div class="col-md-12">
            <img src="/uploads/images/<?= $teacher->teacher_img ?>" alt="<?= $teacher->teacher_first_name ?>">
        </div>
        <div class="col-md-12 py-3">
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_cin ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $teacher->teacher_cin ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_full_name ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $teacher->teacher_first_name . ' ' . $teacher->teacher_last_name ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_gender ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= \APP\MODELS\GenderModel::getByPK($teacher->teacher_gender_id)->gender_label ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_dob ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $teacher->teacher_birthday ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_email ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $teacher->teacher_email ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_phone ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $teacher->teacher_phone ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-3 w-100 text-left"><?= $text_address ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-3 w-100 text-left"><?= $teacher->teacher_address ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>