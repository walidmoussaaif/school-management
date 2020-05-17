<div class="container">
    <h1 class="text-center"><?= $text_header ?></h1>
    <div class="row mt-2">
        <div class="col-md-6 offset-md-3">
            <a href="/sector/module/<?= $sector->sector_id ?>" class="btn btn-warning my-2 px-4"><i class="fas fa-chevron-left"></i></a>
        </div>
    </div>
    <form action="" method="post" class="mt-2">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <input value="<?= $this->showValue('module_name') ?>" type="text" name="module_name" class="form-control form-control-lg" placeholder="<?= $text_module_name ?>" required autofocus="autofocus" autocomplete="off">
                </div>
                <div class="form-group">
                    <input value="<?= $this->showValue('duration') ?>" type="number" name="duration" class="form-control form-control-lg" placeholder="<?= $text_duration ?>" required autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success btn-block btn-lg" value="<?= $text_add ?>">
                </div>
            </div>
        </div>
    </form>
</div>