<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <h1 class="text-center"><?= $text_header ?></h1>
        <div class="row">
            <div class="col-12">
                <a href="/teacher" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_cin') ?>" autofocus="autofocus" name="teacher_cin" type="text" class="form-control form-control-lg" placeholder="<?= $text_cin ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_first_name') ?>" name="teacher_first_name" type="text" class="form-control form-control-lg" placeholder="<?= $text_first_name ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_last_name') ?>" name="teacher_last_name" type="text" class="form-control form-control-lg" placeholder="<?= $text_last_name ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <select name="teacher_gender_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_gender ?></option>
                        <?php
                        if(isset($genders) && !empty($genders)):
                            foreach ($genders as $gender):
                                ?>
                                <option <?= $this->selectedIf('teacher_gender_id',$gender->gender_id) ?> value="<?= $gender->gender_id ?>"><?= $gender->gender_label ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_birthday') ?>" name="teacher_birthday" type="text" class="date-input form-control form-control-lg" placeholder="<?= $text_dob ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_email') ?>" name="teacher_email" type="text" class="form-control form-control-lg" placeholder="<?= $text_email ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_phone') ?>" name="teacher_phone" type="text" class="form-control form-control-lg" placeholder="<?= $text_phone ?>" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_address') ?>" name="teacher_address" type="text" class="form-control form-control-lg" placeholder="<?= $text_address ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input name="teacher_img" type="file" accept="image/*" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <input type="submit" value="<?= $text_add ?>" class="btn btn-success btn-block btn-lg">
                </div>
            </div>
        </div>
    </form>
</div>