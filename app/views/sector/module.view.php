<div class="container">
    <h1 class="text-center pb-0"><?= $text_header ?></h1>
    <h2 class="h1 text-center text-warning pt-0">"<?= $sector->sector_name ?>"</h2>
    <div class="row">
        <div class="col-12">
            <a href="/sector" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="/sector/addmodule/<?= $sector->sector_id ?>" class="btn btn-primary my-2 px-4"><i class="fas fa-plus"></i> <?= $text_add_module ?></a>
        </div>
    </div>
    <table class="table table-bordered table-striped table-responsive-sm w-100 teachers">
        <thead>
            <tr>
                <th><?= $text_module_name ?></th>
                <th><?= $text_duration ?></th>
                <th><?= $text_controls ?></th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(isset($modules) && !empty($modules)):
            foreach ($modules as $module):
            ?>
            <tr>
                <td><?= $module->module_name ?></td>
                <td><?= $module->duration ?> <?= ($module->duration > 1) ? $text_hours : $text_hour ?></td>
                <td>
                    <a href="/sector/editmodule/<?= $module->module_id ?>" class="btn btn-success btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                    <a href="/sector/deletemodule/<?= $module->module_id ?>" class="confirm btn btn-danger btn-sm"><i class="fas fa-trash fa-fw"></i></a>
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