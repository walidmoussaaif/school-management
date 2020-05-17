<div class="container student_profile">
    <h1 class="text-center"><?= $text_header ?> "<?= $student->student_cin ?>"</h1>
    <div class="row">
        <div class="col-12">
            <a href="/student" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
        <div class="col-md-3 py-2">
            <div class="form-group">
                <img src="/uploads/images/<?= $student->student_img ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3 "><?= $text_cin ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->student_cin ?></label>
            </div>
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_full_name ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->student_first_name . ' ' . $student->student_last_name ?></label>
            </div>
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_email ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->student_email ?></label>
            </div>
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_phone ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->student_phone ?></label>
            </div>
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_gender ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->gender_label ?></label>
            </div>
        </div>
        <div class="col-md-5">
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_dob ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->student_birthday ?></label>
            </div>
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_address ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->student_city . ' ,' . $student->student_address ?></label>
            </div>
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_registered ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->registered_date ?></label>
            </div>
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_school ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->school_origine_name . ' / ' . $student->level_label ?></label>
            </div>
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_bachelor ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->student_bachelore ?></label>
            </div>
        </div>
    </div>
    <hr/>
    <?php
    if(isset($registered) && $registered):
    ?>
    <div class="row student_registration_section">
        <div class="col-12 pb-3">
            <div class="badge-secondary rounded p-2">
                <i class="fas fa-check-circle fa-2x fa-fw mr-1"></i>
                <span class="h4 font-weight-normal"><?= $text_registered ?></span>
            </div>
        </div>
        <div class="col-sm-3">
            <a href="/student/deletefolder/<?= $folder->folder_id ?>" class="confirm btn btn-danger btn-block btn-lg mb-2"><i class="fas fa-trash"></i> <?= $text_delete ?></a>
        </div>
        <div class="col-sm-3">
            <a href="/student/editfolder/<?= $folder->folder_id ?>" class="btn btn-success btn-block btn-lg"><i class="fas fa-edit"></i> <?= $text_edit ?></a>
        </div>
        <?php
        if(isset($folder)):
        ?>
        <div class="col-md-12 py-3">
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-2 w-100 text-left"><?= $text_school_year ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-info p-2 w-100 text-left"><?= $folder->label ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-2 w-100 text-left"><?= $text_total_amount ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-2 w-100 text-left"><?= $folder->total_amount ?> MAD</div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-2 w-100 text-left"><?= $text_paid ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-2 w-100 text-left"><?= !empty($paid->paid) ? $paid->paid : 0 ?> MAD</div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-2 w-100 text-left"><?= $text_rest ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-2 w-100 text-left"><?= ($folder->total_amount - $paid->paid) ?> MAD</div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-2 w-100 text-left"><?= $text_payment_status ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-2 w-100 text-left">
                            <i class="fas fa-square fa-fw <?= $folder->payment_status_id == 2 ? 'text-danger' : ($folder->payment_status_id == 1 ? 'text-success' : 'text-warning') ?>"></i>
                            <?= $folder->payment_status_id == 2 ? $text_unpaid : ($folder->payment_status_id == 1 ? $text_paid : $text_uncompleted) ?>
                            <a href="/payment?year=<?= $folder->school_year_id ?>&cin=<?= $student->student_cin ?>"><?= $text_detail_payment ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-2 w-100 text-left"><?= $text_speciality ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-2 w-100 text-left"><?= $folder->speciality_name ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-2 w-100 text-left"><?= $text_sector ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-2 w-100 text-left"><?= $folder->sector_name ?></div>
                    </div>
                </div>
            </div>
            <div class="item pb-2">
                <div class="row">
                    <div class="col-5 col-md-3 pr-0">
                        <div class="bdg badge badge-dark p-2 w-100 text-left"><?= $text_group ?></div>
                    </div>
                    <div class="col-7 col-md-9 pl-1">
                        <div class="badge badge-light p-2 w-100 text-left"><?= $folder->group_name ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endif;
        ?>
    </div>
    <?php
    else:
        ?>
        <div class="row">
            <div class="col-md-2 mb-2">
                <a href="/student/register/<?= $student->student_id ?>" class="btn btn-success btn-block btn-lg"><i class="fas fa-plus"></i> <?= $text_register ?></a>
            </div>
            <div class="col-md-10">
                <div class="badge-secondary rounded p-2 px-3">
                    <i class="fas fa-times-circle fa-2x fa-fw mr-1"></i>
                    <span class="h4 font-weight-normal"><?= $text_not_registered . ((isset($selected_school_year)) ? ' ' . $selected_school_year->label : '') ?></span>
                </div>
            </div>
        </div>
    <?php
    endif;
    ?>
</div>