<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2 mb-2">
            <a href="/year/add" class="btn btn-primary"><i class="fas fa-plus"></i> <?= $text_add_school_year ?></a>
        </div>
        <div class="col-md-8 offset-md-2">
            <table class="table table-bordered table-striped table-responsive-sm w-100 teachers">
                <thead>
                <tr>
                    <th><?= $text_school_year_label ?></th>
                    <th><?= $text_controls ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($years) && !empty($years)):
                    foreach ($years as $year):
                        ?>
                        <tr>
                            <td><?= $year->label ?></td>
                            <td>
                                <a href="/year/edit/<?= $year->school_year_id ?>" class="btn btn-success btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <a href="/year/delete/<?= $year->school_year_id ?>" class="confirm btn btn-danger btn-sm"><i class="fas fa-trash fa-fw"></i></a>
                                <a href="/year/vacation/<?= $year->school_year_id ?>" class="btn btn-info btn-sm"><i class="fas fa-thumbtack fa-fw"></i></a>
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
        </div>
    </div>
</div>