<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <form action="" method="post" class="mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <input value="<?= $this->showValue('start_date',$vacation) ?>" type="text" name="start_date" class="date-input form-control form-control-lg" placeholder="<?= $text_start_date ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('end_date',$vacation) ?>" type="text" name="end_date" class="date-input form-control form-control-lg" placeholder="<?= $text_end_date ?>" required>
                </div>
                <div class="form-group">
                    <textarea name="label" class="form-control form-control-lg" rows="5" required placeholder="<?= $text_label ?>"><?= $this->showValue('label',$vacation) ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="<?= $text_update ?>">
                </div>
                <div class="form-group">
                    <a href="/year/vacation/<?= $vacation->school_year_id ?>" class="btn btn-warning btn-block btn-lg"><?= $text_cancel ?></a>
                </div>
            </div>
        </div>
    </form>
</div>