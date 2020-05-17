<div class="container sectors no_global_search">
    <h1 class="text-center"><?= $text_header ?></h1>
    <a href="/sector/add" class="btn btn-primary mt-5"><i class="fas fa-plus fa-fw"></i> <?= $text_add_sector ?></a>
    <div class="row">
        <div class="col-md-12">
            <table class="table sectors_table table-bordered table-striped table-responsive-sm w-100 teachers">
                <thead>
                    <tr>
                        <th><?= $text_specialities ?></th>
                        <th><?= $text_sectors ?></th>
                        <th><?= $text_sector_short_name ?></th>
                        <th><?= $text_controls ?></th>
                    </tr>
                </thead>
                <thead class="thead_secotrs">
                    <tr>
                        <td><?= $text_specialities ?></td>
                        <td><?= $text_sectors ?></td>
                        <td><?= $text_sector_short_name ?></td>
                        <td><?= $text_controls ?></td>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(isset($sectors) && !empty($sectors)):
                    foreach($sectors as $sector):
                    ?>
                        <tr>
                            <td><?= $sector->speciality_name ?></td>
                            <td><?= $sector->sector_name ?></td>
                            <td><?= $sector->sector_short_name ?></td>
                            <td>
                                <a href="/sector/edit/<?= $sector->sector_id ?>" class="btn btn-success btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <a href="/sector/delete/<?= $sector->sector_id ?>" class="confirm btn btn-danger btn-sm"><i class="fas fa-trash fa-fw"></i></a>
                                <a href="/sector/module/<?= $sector->sector_id ?>" class="btn btn-info btn-sm"><i class="fas fa-tasks fa-fw"></i></a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                endif;
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>