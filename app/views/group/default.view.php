<div class="container no_global_search">
    <h1 class="text-center"><?= $text_header ?></h1>
    <a href="/group/add" class="mt-5 btn btn-primary"><i class="fas fa-plus fa-fw"></i> <?= $text_add_group ?></a>
    <div class="row">
        <div class="col-md-12">
            <table class="table table_groups table-bordered table-striped table-responsive-sm w-100 teachers">
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
                if(isset($groups) && !empty($groups)):
                    foreach($groups as $group):
                        ?>
                        <tr>
                            <td><?= $group->speciality_name ?></td>
                            <td><?= $group->sector_name ?></td>
                            <td><?= $group->group_name ?></td>
                            <td>
                                <a href="/group/edit/<?= $group->group_id ?>" class="btn btn-success btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                <a href="/group/delete/<?= $group->group_id ?>" class="confirm btn btn-danger btn-sm"><i class="fas fa-trash fa-fw"></i></a>
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