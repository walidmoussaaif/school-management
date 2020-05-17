<div class="container payments">
    <h1 class="text-center"><?= $text_header ?></h1>
    <form class="my-4" action="" method="GET">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <select name="year" class="form-control form-control-lg" required autofocus="autofocus">
                        <option value=""><?= $text_school_year ?></option>
                        <?php
                        if(isset($years) && !empty($years)):
                            foreach($years as $year):
                            ?>
                                <option <?= $this->selectedIfGet('year',$year->school_year_id) ?> value="<?= $year->school_year_id ?>"><?= $year->label ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValueGet('cin') ?>" type="text" autocomplete="off" name="cin" placeholder="<?= $text_cin ?>" class="form-control form-control-lg" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block btn-lg">
                        <i class="fas fa-search fa-fw"></i>
                        <?= $text_search ?>
                    </button>
                </div>
            </div>
            <?php if(isset($registered) && $registered == 0 && !empty($student)):
            ?>
                <div class="col-md-6 offset-md-3">
                    <div class="form-group">
                        <a href="/student/register/<?= $student->student_id ?>" class="btn btn-warning btn-block btn-lg"><i class="fas fa-plus"></i> <?= $text_register ?> "<?= $student->student_first_name . ' ' . $student->student_last_name ?>"</a>
                    </div>
                </div>
            <?php
            endif;
            ?>
        </div>
    </form>
    <!--student informations -->
    <?php if(isset($registered) && $registered == 1 && isset($folder) && !empty($folder) && !empty($student)):
    ?>
    <hr/>
    <div class="row student_profile">
        <div class="col-md-3 py-2">
            <div class="form-group">
                <img src="/uploads/images/<?= $student->student_img ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_cin ?></label>
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
                <label class="badge badge-dark text-left px-3"><?= $text_gender ?></label>
                <label class="badge badge-light font-weight-normal text-left"><?= $student->gender_label ?></label>
            </div>
            <div class="item my-2">
                <label class="badge badge-dark text-left px-3"><?= $text_phone ?></label>
                <label class="badge badge-danger font-weight-normal text-left"><?= $student->student_phone ?></label>
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
    <div class="row student_registration_section">
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
    </div>
    <hr/>
    <a href="/payment/add/<?= $folder->folder_id ?>" class="<?= ($folder->total_amount - $paid->paid) == 0 ? 'disabled' : '' ?> btn btn-primary"><i class="fas fa-plus fa-w"></i> <?= $text_add_payment ?></a>
    <hr/>
    <div class="row pl-2 d-flex flex-sm-column flex-md-row statements">
        <div class="item">
            <i class="fas fa-square fa-fw fa-2x text-danger"></i>
            <span class="badge badge-light rounded"><?= $text_unpaid ?></span>
        </div>
        <div class="item">
            <i class="fas fa-square fa-fw fa-2x text-success"></i>
            <span class="badge badge-light rounded"><?= $text_paid ?></span>
        </div>
        <div class="item">
            <i class="fas fa-square fa-fw fa-2x text-info"></i>
            <span class="badge badge-light rounded"><?= $text_inpayment ?></span>
        </div>
        <div class="item">
            <i class="fas fa-square fa-fw fa-2x text-warning"></i>
            <span class="badge badge-light rounded"><?= $text_deposited ?></span>
        </div>
    </div>
    <table class="table student_payments table-bordered table-striped table-responsive-sm">
        <thead>
            <tr>
                <th><?= $text_deposited_amount ?></th>
                <th><?= $text_payment_date ?></th>
                <th><?= $text_date_execution ?></th>
                <th><?= $text_status ?></th>
                <th><?= $text_controls ?></th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($detail_payments) && !empty($detail_payments)):
            foreach($detail_payments as $dp):
                ?>
                <tr>
                    <td><?= $dp->amount_deposit ?> MAD</td>
                    <td><?= $dp->received_date ?></td>
                    <td><?= !empty($dp->execution_date) ? $dp->execution_date : '--------' ?></td>
                    <td class="<?php
                         if($dp->reglement_status_id == 1){
                             echo 'badge-success';
                         } elseif($dp->reglement_status_id == 2){
                             echo 'badge-info';
                         } elseif($dp->reglement_status_id == 3){
                             echo 'badge-warning';
                         } else{
                             echo 'badge-danger';
                         }
                    ?>"></td>
                    <td>
                        <a href="/payment/edit/<?= $dp->detail_payment_id ?>" class="btn btn-success btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                        <a href="/payment/delete/<?= $dp->detail_payment_id ?>" class="confirm btn btn-danger btn-sm"><i class="fas fa-trash fa-fw"></i></a>
                        <a href="/payment/info/<?= $dp->detail_payment_id ?>" class="btn btn-dark btn-sm"><i class="fas fa-info fa-fw"></i></a>
                    </td>
                </tr>
            <?php
            endforeach;
        endif;
        ?>
        </tbody>
    </table>
    <?php
    endif;
    ?>
</div>