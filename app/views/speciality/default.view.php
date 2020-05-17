<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            <a href="/speciality/add" class="btn btn-primary"><i class="fas fa-plus fa-fw"></i> <?= $text_add_speciality ?></a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-8 offset-md-2">
            <table class="table table-bordered table-striped table-responsive-sm w-100 teachers">
                <thead>
                    <tr>
                        <th><?= $text_speciality_name ?></th>
                        <th><?= $text_controls ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($specialities) && !empty($specialities)):
                    foreach ($specialities as $speciality):
                        ?>
                        <tr>
                            <td><?= $speciality->speciality_name ?></td>
                            <td>
                                <a href="/speciality/edit/<?= $speciality->speciality_id ?>" class="btn btn-success btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <a href="/speciality/delete/<?= $speciality->speciality_id ?>" class="confirm btn btn-danger btn-sm"><i class="fas fa-trash fa-fw"></i></a>
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