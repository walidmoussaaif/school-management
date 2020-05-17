<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <h1 class="text-center"><?= $text_header ?></h1>
        <div class="row">
            <div class="col-12">
                <a href="/student" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('student_cin') ?>" autofocus="autofocus" name="student_cin" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_cin ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_first_name') ?>" name="student_first_name" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_first_name ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_last_name') ?>" name="student_last_name" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_last_name ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_birthday') ?>" name="student_birthday" type="text" autocomplete="off" class="date-input form-control form-control-lg" placeholder="<?= $text_dob ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_email') ?>" name="student_email" type="email" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_email ?>" required>
                </div>
                <div class="form-group">
                    <select name="student_gender_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_gender ?></option>
                        <?php
                        foreach($genders as $gender){
                            ?>
                            <option <?= $this->selectedIf('student_gender_id',$gender->gender_id) ?> value="<?= $gender->gender_id ?>"><?= $gender->gender_label ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_phone') ?>" name="student_phone" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_phone ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_address') ?>" name="student_address" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_address ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input value="<?= $this->showValue('student_city') ?>" name="student_city" type="text" autocomplete="off" class="form-control form-control-lg" placeholder="<?= $text_city ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('student_bachelore') ?>" name="student_bachelore" type="number" class="form-control form-control-lg" min="0" placeholder="<?= $text_bachelor ?>" required>
                </div>
                <div class="form-group">
                    <select name="school_origine_id" class="form-control form-control-lg" required>
                        <option value=""><?= $text_school_origin?></option>
                        <?php
                            foreach($schools as $school){
                                ?>
                                    <option <?= $this->selectedIf('school_origine_id',$school->school_origine_id) ?> value="<?= $school->school_origine_id ?>"><?= $school->school_origine_name ?></option>
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
                            <option <?= $this->selectedIf('level_studied_id',$level->level_id) ?> value="<?= $level->level_id ?>"><?= $level->level_label ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input name="student_img" type="file" accept="image/*" class="form form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="<?= $text_register ?>" class="btn btn-success btn-lg btn-block">
                </div>
            </div>
        </div>
    </form>
</div>