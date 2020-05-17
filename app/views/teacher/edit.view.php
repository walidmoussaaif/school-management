<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <h1 class="text-center"><?= $text_header . ' "' . $teacher->teacher_cin . '"'  ?></h1>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_cin',$teacher) ?>" autofocus="autofocus" name="teacher_cin" type="text" class="form-control form-control-lg" placeholder="<?= $text_cin ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_first_name',$teacher) ?>" name="teacher_first_name" type="text" class="form-control form-control-lg" placeholder="<?= $text_first_name ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_last_name',$teacher) ?>" name="teacher_last_name" type="text" class="form-control form-control-lg" placeholder="<?= $text_last_name ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <select name="teacher_gender_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_gender ?></option>
                        <?php
                        if(isset($genders) && !empty($genders)):
                            foreach ($genders as $gender):
                                ?>
                                <option <?= $this->selectedIf('teacher_gender_id',$gender->gender_id,$teacher) ?> value="<?= $gender->gender_id ?>"><?= $gender->gender_label ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_birthday',$teacher) ?>" name="teacher_birthday" type="text" class="date-input form-control form-control-lg" placeholder="<?= $text_dob ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_email',$teacher) ?>" name="teacher_email" type="text" class="form-control form-control-lg" placeholder="<?= $text_email ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_phone',$teacher) ?>" name="teacher_phone" type="text" class="form-control form-control-lg" placeholder="<?= $text_phone ?>" autocomplete="off" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('teacher_address',$teacher) ?>" name="teacher_address" type="text" class="form-control form-control-lg" placeholder="<?= $text_address ?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="/uploads/images/<?= $teacher->teacher_img ?>" width="100%" height="100%">
                        </div>
                        <div class="col-md-10 py-2">
                            <input name="teacher_img" type="file" accept="image/*" class="form-control form-control-lg">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="<?= $text_update ?>" class="btn btn-success btn-block btn-lg">
                </div>
                <div class="form-group">
                    <a href="/teacher" class="btn btn-warning btn-block btn-lg"><?= $text_cancel ?></a>
                </div>
            </div>
        </div>
    </form>
</div>