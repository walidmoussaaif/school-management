<div class="container-fluid">
    <h1 class="text-center"><?= $text_header ?></h1>
    <a href="/teacher/add" class="btn btn-primary"><i class="fas fa-plus"></i> <?= $text_add_teacher ?></a>
    <table class="table teachers_table table-bordered table-striped table-responsive-sm w-100 teachers">
        <thead>
        <tr>
            <th><?= $text_img ?></th>
            <th><?= $text_cin ?></th>
            <th><?= $text_full_name ?></th>
            <th><?= $text_phone ?></th>
            <th><?= $text_email ?></th>
            <th><?= $text_gender ?></th>
            <th><?= $text_registered ?></th>
            <th><?= $text_controls ?></th>
        </tr>
        </thead>
        <!-- --------------------------->
        <thead class="table_thead_teachers">
        <tr>
            <td><?= $text_img ?></td>
            <td><?= $text_cin ?></td>
            <td><?= $text_full_name ?></td>
            <td><?= $text_phone ?></td>
            <td><?= $text_email ?></td>
            <td><?= $text_gender ?></td>
            <td><?= $text_registered ?></td>
            <td><?= $text_controls ?></td>
        </tr>
        </thead>
        <!-- --------------------------->
        <tbody>
        <?php
        if(isset($teachers) && !empty($teachers)):
            foreach($teachers as $teacher):
                ?>
                <tr>
                    <td><img src="/uploads/images/<?=$teacher->teacher_img ?>" width="60px" height="60px"></td>
                    <td><?= $teacher->teacher_cin ?></td>
                    <td><?= $teacher->teacher_first_name . ' ' . $teacher->teacher_last_name ?></td>
                    <td><?= $teacher->teacher_phone ?></td>
                    <td><?= $teacher->teacher_email ?></td>
                    <td><?= $teacher->gender_label ?></td>
                    <td><?= $teacher->registration_date ?></td>
                    <td class="d-flex">
                        <div class="p-1"><a class="btn btn-success btn-sm" href="/teacher/edit/<?= $teacher->teacher_id ?>"><i class="fas fa-edit fa-fw"></i></a></div>
                        <div class="p-1"><a class="confirm btn btn-danger btn-sm" href="/teacher/delete/<?= $teacher->teacher_id ?>"><i class="fas fa-trash fa-fw"></i></a></div>
                        <div class="p-1"><a class="btn btn-dark btn-sm a_info" href="/teacher/info/<?= $teacher->teacher_id ?>"><i class="fas fa-info fa-fw"></i></a></div>
                        <div class="p-1"><a class="btn btn-info btn-sm" href="/teacher/vacation/<?= $teacher->teacher_id ?>"><i class="fas fa-thumbtack fa-fw"></i></a></div>
                    </td>
                </tr>
            <?php
            endforeach;
        endif;
        ?>
        </tbody>
    </table>
</div>
