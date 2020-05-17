<div class="container register_student no_global_search">
    <h1 class="text-center">
        <?= $text_header . ' "' . $student->student_cin . '"' ?>
        <br/>
        <?= $student->student_first_name . ' ' . $student->student_last_name ?>
    </h1>
    <form id="the_form" action="" method="POST">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="form-group">
                    <select name="school_year_id" class="form-control form-control-lg" required autofocus="autofocus">
                        <option value=""><?= $text_select_year ?></option>
                        <?php
                        if(isset($years) && !empty($years)):
                            foreach($years as $year):
                                ?>
                                <option <?= $this->selectedIf('school_year_id',$year->school_year_id,$folder) ?> value="<?= $year->school_year_id ?>"><?= $year->label ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('total_amount',$payment) ?>" type="number" name="total_amount" class="form-control form-control-lg" placeholder="<?= $text_amount ?>" required>
                </div>
                <div class="form-group">
                    <select name="group_id" class="form-control form-control-lg" id="group_id" required>
                        <option value=""><?= $text_group ?></option>
                        <?php
                        if(isset($groups) && !empty($groups)):
                            foreach($groups as $group):
                                ?>
                                <option <?= $this->selectedIf('group_id',$group->group_id,$folder) ?> value="<?= $group->group_id ?>"><?= $group->group_name ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <div class="row table_groups">
        <div class="col-md-8 offset-md-2 pb-4">
            <div class="badge badge-info mt-2 py-2 px-3"><span class="h6 font-weight-normal"><?= $text_select_group ?></span></div>
            <table class="table groups table-bordered table-striped table-responsive-sm">
                <thead>
                <tr>
                    <th><?= $text_specialities ?></th>
                    <th><?= $text_sectors ?></th>
                    <th><?= $text_groups ?></th>
                    <th><?= $text_controls ?></th>
                </tr>
                </thead>
                <thead class="table_thead_groups">
                <tr>
                    <td><?= $text_specialities ?></td>
                    <td><?= $text_sectors ?></td>
                    <td><?= $text_groups ?></td>
                    <td><?= $text_controls ?></td>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($specialities) && !empty($specialities)):
                    foreach($specialities as $speciality):
                        ?>
                        <tr>
                            <td><?= $speciality->speciality_name ?></td>
                            <td><?= $speciality->sector_name ?></td>
                            <td><?= $speciality->group_name ?></td>
                            <td>
                                <button class="btn btn-info btn-sm btn_check_group" value="<?= $speciality->group_id ?>"><i class="fas fa-hand-pointer"></i></button>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                endif;
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-8 offset-md-2">
            <div class="form-group">
                <button form="the_form" type="submit" class="btn btn-success btn-block btn-lg"><?= $text_update ?></button>
            </div>
            <div class="form-group">
                <a href="/student/info/<?= $student->student_id ?>/<?= $folder->school_year_id ?>" class="btn btn-warning btn-lg btn-block"><?= $text_cancel ?></a>
            </div>
        </div>
    </div>
</div>