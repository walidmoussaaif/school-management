<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <form action="" method="post">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <a href="/year/vacation/<?= $year->school_year_id ?>" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
            </div>
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <input value="<?= $this->showValue('start_date') ?>" type="text" name="start_date" class="date-input form-control form-control-lg" placeholder="<?= $text_start_date ?>" required>
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('end_date') ?>" type="text" name="end_date" class="date-input form-control form-control-lg" placeholder="<?= $text_end_date ?>" required>
                </div>
                <div class="form-group">
                    <textarea name="label" class="form-control form-control-lg" rows="5" required placeholder="<?= $text_label ?>"><?= $this->showValue('label') ?></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="<?= $text_add ?>">
                </div>
            </div>
        </div>
    </form>
</div>