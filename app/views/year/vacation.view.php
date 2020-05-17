<div class="container">
    <h1 class="text-center pb-0"><?= $text_header ?></h1>
    <h2 class="h1 text-center text-warning mt-0"><?= $year->label ?></h2>
    <div class="row">
        <div class="col-12">
            <a href="/year" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/year/addvacation/<?= $year->school_year_id ?>" class="btn btn-primary my-2 px-4"><i class="fas fa-plus"></i> <?= $text_add_vacation ?></a>
        </div>
    </div>
    <table class="table table-bordered table-striped table-responsive-sm w-100 teachers">
        <thead>
        <tr>
            <th><?= $text_label ?></th>
            <th><?= $text_start_date ?></th>
            <th><?= $text_end_date ?></th>
            <th><?= $text_total_days ?></th>
            <th><?= $text_controls ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(isset($school_year_vacations) && !empty($school_year_vacations)):
            $total = 0;
            foreach ($school_year_vacations as $vacation):
                $total += $vacation->total;
                ?>
                <tr>
                    <td><?= $vacation->label ?></td>
                    <td><?= $vacation->start_date ?></td>
                    <td><?= $vacation->end_date ?></td>
                    <td><?= $vacation->total . (($vacation->total > 1) ? $text_days : $text_day) ?></td>
                    <td>
                        <a href="/year/editvacation/<?= $vacation->school_vacation_id ?>" class="btn btn-success btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                        <a href="/year/deletevacation/<?= $vacation->school_vacation_id ?>" class="confirm btn btn-danger btn-sm"><i class="fas fa-trash fa-fw"></i></a>
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