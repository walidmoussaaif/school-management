<div class="container-fluid students">
    <h1 class="text-center"><?= $text_header ?></h1>

    <form action="" method="GET" class="search_form">
        <div class="row">
            <div class="col-md-2 pr-0">
                <a href="/student/add" class="btn btn-primary btn-block"><i class="fas fa-plus"></i> <?= $text_add_student ?></a>
            </div>
            <div class="col-md-4 pr-0">
                <select name="year" class="school_year_id_students form-control">
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
            <div class="col-md-3 p-2 px-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <input value="1" type="radio" class="radio_student_type custom-control-input" id="registered" name="status" <?= $yes ?>>
                    <label class="custom-control-label" for="registered"><?= $text_registered_students ?></label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input value="0" type="radio" class="radio_student_type custom-control-input" id="non_registered" name="status" <?= $no ?>>
                    <label class="custom-control-label" for="non_registered"><?= $text_non_registered_students ?></label>
                </div>
            </div>
        </div>
    </form>
    <?php
    if($status == 1): ?>
    <hr/>
    <div class="row pl-2 d-flex flex-sm-column flex-md-row statements">
        <div class="item">
            <i class="fas fa-square fa-fw fa-2x text-danger"></i>
            <span class="badge badge-light rounded"><?= $text_unpaid ?></span>
        </div>
        <div class="item">
            <i class="fas fa-square fa-fw fa-2x text-warning"></i>
            <span class="badge badge-light rounded"><?= $text_uncompleted ?></span>
        </div>
        <div class="item">
            <i class="fas fa-square fa-fw fa-2x text-success"></i>
            <span class="badge badge-light rounded"><?= $text_paid ?></span>
        </div>
    </div>
    <?php
    endif;
    ?>
    <hr class="p-2"/>
    <table class="table table-bordered table-striped table-responsive-sm w-100 <?= $status == 1 ? 'registered_students' : 'non_registered_students' ?>">
        <thead>
            <tr>
                <th><?= $text_img ?></th>
                <th><?= $text_cin ?></th>
                <th><?= $text_full_name ?></th>
                <th><?= $text_phone ?></th>
                <th><?= $text_email ?></th>
                <th><?= $text_gender ?></th>
                <th><?= $text_registered ?></th>
                <?php
                if($status == 1):
                    ?>
                    <th><?= $text_sector ?></th>
                    <th><?= $text_group ?></th>
                    <th><?= $text_statement ?></th>
                <?php
                endif;
                ?>
                <th><?= $text_controls ?></th>
            </tr>
        </thead>
        <!-- --------------------------->
        <thead class="table_thead_students">
            <tr>
                <td><?= $text_img ?></td>
                <td><?= $text_cin ?></td>
                <td><?= $text_full_name ?></td>
                <td><?= $text_phone ?></td>
                <td><?= $text_email ?></td>
                <td><?= $text_gender ?></td>
                <td><?= $text_registered ?></td>
                <?php
                if($status == 1):
                    ?>
                    <td><?= $text_sector ?></td>
                    <td><?= $text_group ?></td>
                    <td><?= $text_statement ?></td>
                <?php
                endif;
                ?>
                <td><?= $text_controls ?></td>
            </tr>
        </thead>
        <!-- --------------------------->
        <tbody>
        <?php
        if(isset($students) && !empty($students)):
            foreach($students as $student):
                ?>
                <tr>
                    <td><img src="/uploads/images/<?=$student->student_img ?>" width="60px" height="60px"></td>
                    <td><?= $student->student_cin ?></td>
                    <td><?= $student->student_first_name . ' ' . $student->student_last_name ?></td>
                    <td><?= $student->student_phone ?></td>
                    <td><?= $student->student_email ?></td>
                    <td><?= $student->gender_label ?></td>
                    <td><?= $student->registered_date ?></td>
                    <?php
                    if($status == 1):
                        ?>
                        <td><?= $student->sector_short_name ?></td>
                        <td><?= $student->group_name ?></td>
                        <td class="<?= $student->payment_status_id == 1 ? 'badge-success' : ($student->payment_status_id == 2 ? 'badge-danger' : 'badge-warning') ?>"></td>
                    <?php
                    endif;
                    ?>
                    <td class="d-flex">
                        <div class="p-1"><a class="btn btn-success btn-sm" href="/student/edit/<?= $student->student_id ?>"><i class="fas fa-edit fa-fw"></i></a></div>
                        <div class="p-1"><a class="confirm btn btn-danger btn-sm" href="/student/delete/<?= $student->student_id ?>"><i class="fas fa-trash fa-fw"></i></a></div>
                        <div class="p-1"><a class="btn btn-dark btn-sm a_info" href="/student/info/<?= $student->student_id ?>/<?= !empty($school_year) ? $school_year :  $years[0]->school_year_id ?>"><i class="fas fa-info fa-fw"></i></a></div>
                        <?php
                        if($status == 0):
                        ?>
                            <div class="p-1"><a class="btn btn-warning btn-sm" href="/student/register/<?= $student->student_id ?>"><i class="fas fa-plus fa-fw"></i></a></div>
                        <?php
                        else:?>

                        <?php
                        endif;
                        ?>
                    </td>
                </tr>
            <?php
            endforeach;
        endif;
        ?>
        </tbody>
    </table>
</div>