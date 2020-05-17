<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <form class="my-5" action="" method="post">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <select name="school_year_id" class="form-control form-control-lg" required autofocus="autofocus">
                        <option value=""><?= $text_school_year ?></option>
                        <?php
                        if(isset($years) && !empty($years)):
                            foreach($years as $year):
                                ?>
                                <option <?= $this->selectedIf('school_year_id',$year->school_year_id,$vacation) ?> value="<?= $year->school_year_id ?>"><?= $year->label ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('start_date',$vacation) ?>" type="text" name="start_date" class="date-input form-control form-control-lg" placeholder="<?= $text_start_date ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('end_date',$vacation) ?>" type="text" name="end_date" class="date-input form-control form-control-lg" placeholder="<?= $text_end_date ?>" required>
                </div>
                <div class="form-group">
                    <textarea name="reason" class="form-control form-control-lg" rows="5" required placeholder="<?= $text_reason ?>"><?= $this->showValue('reason',$vacation) ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="<?= $text_update ?>">
                </div>
                <div class="form-group">
                    <a href="/teacher/vacation/<?= $teacher_id ?>" class="btn btn-warning btn-lg btn-block"><?= $text_cancel ?></a>
                </div>
            </div>
        </div>
    </form>
</div>