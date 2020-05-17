<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <h1 class="text-center"><?= $text_header ?> "<?= $student->student_cin ?>"</h1>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('student_cin',$student) ?>" autofocus="autofocus" name="student_cin" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_cin ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_first_name',$student) ?>" name="student_first_name" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_first_name ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_last_name',$student) ?>" name="student_last_name" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_last_name ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_birthday',$student) ?>" name="student_birthday" type="text" autocomplete="off" class="date-input form-control form-control-lg" placeholder="<?= $text_dob ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_email',$student) ?>" name="student_email" type="email" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_email ?>" required>
                </div>
                <div class="form-group">
                    <select name="student_gender_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_gender ?></option>
                        <?php
                        foreach($genders as $gender){
                            ?>
                            <option <?= $this->selectedIf('student_gender_id',$gender->gender_id,$student) ?> value="<?= $gender->gender_id ?>"><?= $gender->gender_label ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_phone',$student) ?>" name="student_phone" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_phone ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_address',$student) ?>" name="student_address" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_address ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('student_city',$student) ?>" name="student_city" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_city ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_bachelore',$student) ?>" name="student_bachelore" type="number" class="form-control form-control-lg" min="0" placeholder="<?= $text_bachelor ?>" required>
                </div>
                <div class="form-group">
                    <select name="school_origine_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_school_origin?></option>
                        <?php
                        foreach($schools as $school){
                            ?>
                            <option <?= $this->selectedIf('school_origine_id',$school->school_origine_id,$student) ?> value="<?= $school->school_origine_id ?>"><?= $school->school_origine_name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <select name="level_studied_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_level ?></option>
                        <?php
                        foreach($levels as $level){
                            ?>
                            <option <?= $this->selectedIf('level_studied_id',$level->level_id,$student) ?> value="<?= $level->level_id ?>"><?= $level->level_label ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="/uploads/images/<?= $student->student_img ?>" width="100%" height="100%">
                        </div>
                        <div class="col-md-10 py-2">
                            <input name="student_img" type="file" accept="image/*" class="form form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="<?= $text_update ?>" class="btn btn-success btn-lg btn-block">
                </div>
                <div class="form-group">
                    <a href="/student" class="btn btn-warning btn-lg btn-block"><?= $text_cancel ?></a>
                </div>
            </div>
        </div>
    </form>
</div>