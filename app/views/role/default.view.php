<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <div class="row">
        <div class="col-md-6 offset-md-2">
            <a href="/role/add" class="btn btn-primary my-3"><i class="fas fa-plus"></i> <?= $text_add_role ?></a>
        </div>
        <div class="col-md-8 offset-md-2">
            <table class="table table-bordered table-striped table-responsive-sm">
                <thead>
                    <tr>
                        <th><?= $text_role ?></th>
                        <th><?= $text_controls ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($roles) && !empty($roles)):
                        foreach ($roles as $role):
                        ?>
                            <tr>
                                <td><?= $role->role ?></td>
                                <td>
                                    <?php
                                    if($role->role_id != 1):
                                    ?>
                                    <div class="d-flex">
                                        <div class="p-1">
                                            <a href="/role/edit/<?= $role->role_id ?>" class="btn btn-success btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                        </div>
                                        <div class="p-1">
                                            <a href="/role/delete/<?= $role->role_id ?>" class="confirm btn btn-danger btn-sm"><i class="fas fa-trash fa-fw"></i></a>
                                        </div>
                                    </div>
                                    <?php
                                    endif;
                                    ?>
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