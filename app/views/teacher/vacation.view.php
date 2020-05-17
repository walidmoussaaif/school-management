<div class="container teacher_vacation">
    <h1 class="text-center pb-0"><?= $text_header ?></h1>
    <h2 class="h1 text-center text-warning mt-0"><?= $teacher->teacher_first_name . ' ' . $teacher->teacher_last_name ?></h2>
    <div class="row">
        <div class="col-12">
            <a href="/teacher" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
    </div>

    <form action="" method="GET" class="search_form mb-2">
        <div class="row">
            <div class="col-md-3 pr-0">
                <a href="/teacher/addvacation/<?= $teacher->teacher_id ?>" class="btn btn-primary btn-block px-4"><i class="fas fa-plus"></i> <?= $text_add_vacation ?></a>
            </div>
            <div class="col-md-4 pr-0">
                <select id="school_year" name="year" class="form-control">
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
        </div>
    </form>

    <table class="table table-bordered table-striped table-responsive-sm w-100 teachers">
        <thead>
            <tr>
                <th><?= $text_start_date ?></th>
                <th><?= $text_end_date ?></th>
                <th><?= $text_total_days ?></th>
                <th><?= $text_reason ?></th>
                <th><?= $text_controls ?></th>
            </tr>
        </thead>
        <tbody>
        <?php
            if(isset($teacher_vacations) && !empty($teacher_vacations)):
                $total = 0;
                foreach ($teacher_vacations as $vacation):
                    $total += $vacation->total;
                ?>
                    <tr>
                        <td><?= $vacation->start_date ?></td>
                        <td><?= $vacation->end_date ?></td>
                        <td><?= $vacation->total . (($vacation->total > 1) ? $text_days : $text_day) ?></td>
                        <td><?= $vacation->reason ?></td>
                        <td>
                            <a href="/teacher/editvacation/<?= $vacation->teacher_vacation_id ?>" class="btn btn-success btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                            <a href="/teacher/deletevacation/<?= $vacation->teacher_vacation_id ?>" class="confirm btn btn-danger btn-sm"><i class="fas fa-trash fa-fw"></i></a>
                        </td>
                    </tr>
                <?php
                endforeach;
            else:
                ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            <i class="fas fa-battery-empty"></i>
                        </td>
                    </tr>
                <?php
            endif;
        ?>
        </tbody>
    </table>
    <?php
    if(isset($total) && $total > 0):
        ?>
        <label class="badge badge-info p-2 px-3">
            <span class="h5 font-weight-normal"><?= $text_total_days . ': ' ?><?= $total . (($total > 1) ? $text_days : $text_day) ?></span>
        </label>
    <?php
    endif;
    ?>
</div>