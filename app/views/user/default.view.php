<div>
    <h1 class="text-center"><?= $text_header ?></h1>
    <a href="/user/add" class="btn btn-primary"><i class="fas fa-plus"></i> <?= $text_add_user ?></a>
    <table class="table users_table table-bordered table-striped table-responsive-sm w-100">
        <thead>
            <tr>
                <th><?= $text_img ?></th>
                <th><?= $text_cin ?></th>
                <th><?= $text_username ?></th>
                <th><?= $text_email ?></th>
                <th><?= $text_phone ?></th>
                <th><?= $text_gender ?></th>
                <th><?= $text_last_login ?></th>
                <th><?= $text_role ?></th>
                <th><?= $text_controls ?></th>
            </tr>
        </thead>
        <thead class="table_thead_users">
            <tr>
                <td><?= $text_img ?></td>
                <td><?= $text_cin ?></td>
                <td><?= $text_username ?></td>
                <td><?= $text_email ?></td>
                <td><?= $text_phone ?></td>
                <td><?=  $text_gender ?></td>
                <td><?= $text_last_login ?></td>
                <td><?= $text_role ?></td>
                <td><?= $text_controls ?></td>
            </tr>
        </thead>
        <tbody>
        <?php
            if(isset($users) && !empty($users)):
                foreach($users as $user):
                    ?>
                        <tr>
                            <td><img src="/uploads/images/<?= $user->user_img ?>" alt="<?= $user->username ?>" width="60px" height="60px"></td>
                            <td><?= $user->user_cin ?></td>
                            <td><?= $user->username ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->phone ?></td>
                            <td><?= $user->gender_label ?></td>
                            <td><?= $user->last_login ?></td>
                            <td><?= $user->role ?></td>
                            <td>
                                <div class="d-flex">
                                    <div class="p-1">
                                        <a href="/user/edit/<?= $user->user_id ?>" class="btn btn-success btn-sm"><i class="fas fa-edit fa-fw"></i></a>
                                    </div>
                                    <div class="p-1">
                                        <a href="/user/delete/<?= $user->user_id ?>" class="btn btn-danger btn-sm confirm"><i class="fas fa-trash fa-fw"></i></a>
                                    </div>
                                    <div class="p-1">
                                        <a href="/user/info/<?= $user->user_id ?>" class="btn btn-dark btn-sm"><i class="fas fa-info fa-fw"></i></a>
                                    </div>
                                    <div class="p-1">
                                        <?php
                                            if($user->ustatus):?>
                                                <a href="/user/active/<?= $user->user_id ?>" class="btn btn-info btn-sm"><i class="fas fa-power-off fa-fw"></i></a>
                                            <?php
                                            else:?>
                                                <a href="/user/active/<?= $user->user_id ?>" class="btn btn-dark btn-sm"><i class="fas fa-power-off fa-fw"></i></a>
                                            <?php
                                            endif;
                                        ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php
                endforeach;
            endif
        ?>
        </tbody>
    </table>
</div>