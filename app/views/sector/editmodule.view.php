<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <form action="" method="post" class="mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <input value="<?= $this->showValue('module_name',$module) ?>" type="text" name="module_name" class="form-control form-control-lg" placeholder="<?= $text_module_name ?>" required autofocus="autofocus" autocomplete="off">
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('duration',$module) ?>" type="number" name="duration" class="form-control form-control-lg" placeholder="<?= $text_duration ?>" required autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="<?= $text_update ?>">
                </div>
                <div class="form-group">
                    <a href="/sector/module/<?= $module->sector_id ?>" class="btn btn-warning btn-lg btn-block"><?= $text_cancel ?></a>
                </div>
            </div>
        </div>
    </form>
</div>