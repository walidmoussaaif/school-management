<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <form action="" method="post" class="mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <input value="<?= $this->showValue('label',$school_year) ?>" name="label" type="text" class="form-control form-control-lg" placeholder="<?= $text_label ?>" required autofocus="autofocus" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="submit" value="<?= $text_update ?>" class="btn btn-success btn-block btn-lg">
                </div>
                <div class="form-group">
                    <a href="/year" class="btn btn-warning btn-block btn-lg"><?= $text_cancel ?></a>
                </div>
            </div>
        </div>
    </form>
</div>